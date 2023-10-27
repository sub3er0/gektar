<?php

namespace backend\modules\plot\controllers;

use backend\modules\plot\services\CadastralDataResponseService;
use backend\modules\plot\services\PlotService;
use Yii;
use yii\web\Controller;
use backend\modules\plot\services\CadastralApiService;

/**
 *
 */
class PlotController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $models = \backend\modules\plot\models\Plot::find()->all();
        //var_dump($models);
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
            $plots = $plotService->getPlotsByCadastralNumbers($cadastralNumbers);
        }
        return $this->render('plot', ['models' => $plots]);
    }

}
