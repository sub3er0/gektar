<?php

namespace backend\modules\plot\controllers;

use backend\modules\plot\services\CadastralApiService;
use backend\modules\plot\services\CadastralDataResponseService;
use backend\modules\plot\services\PlotService;
use Yii;
use yii\web\Controller;

/**
 * PlotController
 */
class PlotController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $models = \backend\modules\plot\models\Plot::find()->all();
        return $this->render('plot', ['models' => $models]);
    }

    /**
     * @return string
     */
    public function actionGetData()
    {
        $plotService = new PlotService(); // di не настроил
        $data = str_replace(' ', '', Yii::$app->request->post());

        $plots = [];
        $cadastralNumbers = [];
        if (isset($data['cadastral_number'])) {
            $cadastralNumbers = explode(',', $data['cadastral_number']);
        }

        if (!empty($cadastralNumbers)) {
            $cadastralApiService = new CadastralApiService(); // di не настроил
            $cadastralDataResponseService = new CadastralDataResponseService(); // di не настроил
            $plots = $plotService->getPlotsByCadastralNumbers(
                $cadastralApiService,
                $cadastralDataResponseService,
                $cadastralNumbers
            );
        }
        return $this->render('plot', ['models' => $plots]);
    }

}
