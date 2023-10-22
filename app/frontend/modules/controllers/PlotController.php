<?php

namespace frontend\modules\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PlotController extends Controller
{
    public function actionView($id)
    {
        $model = Plot::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Plot;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
}