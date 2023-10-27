<?php

namespace backend\modules\plot\services;

use backend\modules\plot\dto\PlotDto;

/**
 * Класс обработчик ответа от Api сервиса
 */
class CadastralDataResponseService
{
    /**
     * Получить из ответа массив PlotDTO
     *
     * @param array $responseData
     * @return PlotDto[]|array
     */
    public function getPlotDtoFromResponse(array $responseData): array
    {
        $result = [];
        foreach ($responseData as $plotResponseData) {
            $plotDto = new PlotDto(
                $plotResponseData['number'] ?? '',
                $plotResponseData['attrs']['plot_address'] ?? '',
                $plotResponseData['attrs']['plot_price'] ?? '',
                $plotResponseData['attrs']['plot_area'] ?? ''
            );
            $result[] = $plotDto;
        }
        return $result;
    }

    /**
     * Получить данные в формате ассоциативного массива с ключем кадастровым номером для быстрого поиска
     *
     * @param array $responseData
     * @return array
     */
    public function getPlotDataFromResponse(array $responseData): array
    {
        $plotData = [];
        foreach ($responseData as $plotResponseData) {
            $plotData[$plotResponseData['number']]['address'] = $plotResponseData['attrs']['plot_address'] ?? '';
            $plotData[$plotResponseData['number']]['price'] = $plotResponseData['attrs']['plot_price'] ?? '';
            $plotData[$plotResponseData['number']]['area'] = $plotResponseData['attrs']['plot_area'] ?? '';
        }
        return $plotData;
    }
}