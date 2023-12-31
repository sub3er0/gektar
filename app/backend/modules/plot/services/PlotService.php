<?php

namespace backend\modules\plot\services;

use backend\modules\plot\dto\PlotDto;
use backend\modules\plot\models\Plot;

/**
 * Сервис работы с участками
 */
class PlotService
{
    /**
     * Получить участки по кадастровым номерам
     *
     * @param array $cadastralNumbers
     * @return array
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\StaleObjectException
     * @throws \yii\httpclient\Exception
     */
    public function getPlotsByCadastralNumbers(
        CadastralApiService $cadastralApiService,
        CadastralDataResponseService $cadastralDataResponseService,
        array $cadastralNumbers
    ): array {
        $plots = Plot::find()
            ->where(['cadastralNumber' => $cadastralNumbers])
            ->all();

        $actualPlotsNumbers = [];
        $notActualPlots = [];

        /** @var Plot $plot */
        foreach ($plots as $plot) {
            $hoursDiff = round((strtotime(date('Y-m-d H:i:s')) - strtotime($plot->updatedAt))/3600, 1);
            if ($hoursDiff > 1) {
                $notActualPlots[] = $plot;
            } else {
                $actualPlotsNumbers[] = $plot->cadastralNumber;
            }
        }

        // Запрашивать с api толкьо устаревшие или несуществующие учаски
        $notExistedPlots = array_diff($cadastralNumbers, $actualPlotsNumbers);
        $newPlots = [];
        if ($notExistedPlots) {
            $responseData = $cadastralApiService->getData($notExistedPlots);
            $plotData = $cadastralDataResponseService->getPlotDataFromResponse($responseData);

            $updatedPlotNumbers = [];
            foreach ($notActualPlots as $plot) {
                if (isset($plotData[($plot->cadastralNumber)])) {
                    $plot->address = $plotData[($plot->cadastralNumber)]['address'] ?? '';
                    $plot->price = $plotData[($plot->cadastralNumber)]['price'] ?? '';
                    $plot->area = $plotData[($plot->cadastralNumber)]['area'] ?? '';
                    $plot->updatedAt = date('Y-m-d H:i:s');
                    $plot->update();
                    $updatedPlotNumbers[] = $plot->cadastralNumber;
                }
            }

            // Удалить из данных ответа уже обновленные участки
            foreach ($responseData as $key => $data) {
                if (in_array($data['number'], $updatedPlotNumbers)) {
                    unset($responseData[$key]);
                }
            }
            $plotDto = $cadastralDataResponseService->getPlotDtoFromResponse($responseData);
            $newPlots = $this->savePlot($plotDto);
        }
        return array_merge($plots, $newPlots);
    }

    /**
     * Сохранить участок в базу
     *
     * @param PlotDto[] $plotData
     * @return array|Plot[]
     */
    public function savePlot(array $plotData)
    {
        $result = [];
        foreach ($plotData as $plotDto) {
            $plot = new Plot();
            $plot->cadastralNumber = $plotDto->cadastralNumber ?? '';
            $plot->address = $plotDto->address ?? '';
            $plot->price = $plotDto->price ?? null;
            $plot->area = $plotDto->area ?? '';
            $plot->updatedAt = date('Y-m-d H:i:s');
            $plot->save();
            $result[] = $plot;
        }
        return $result;
    }
}