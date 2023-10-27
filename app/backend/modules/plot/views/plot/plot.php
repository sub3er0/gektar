<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/** @var yii\web\View $this */
/** @var backend\modules\plot\models\Plot $models */
/** @var ActiveForm $form */
?>
<div class="Plot">
    <h3>Кадастровые номера</h3>
    <?php $form = ActiveForm::begin(['action' =>['plot/get-data'], 'id' => 'forum_post', 'method' => 'post',]); ?>

    <?=  Html::input(
            'cadastral_number',
            'cadastral_number',
            '',
            $options = ['class'=>'form-control', 'style'=>'width:450px'])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Получить данные', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <table class="iksweb">
        <tbody>
        <tr>
            <td>Кадастровый номер</td>
            <td>Адрес</td>
            <td>Стоимость</td>
            <td>Площадь</td>
        </tr>
        <?php $form = ActiveForm::begin(); ?>
        <?php foreach ($models as $model) { ?>
            <tr>
                <td><?= $model['cadastralNumber'] ?? '' ?></td>
                <td><?= $model['address'] ?? '' ?></td>
                <td><?= $model['price'] ?? '' ?></td>
                <td><?= ($model['area']) ? $model['area'] . ' м²' : '' ?></td>
            </tr>
        <?php } ?>
        <?php ActiveForm::end(); ?>
        </tbody>
    </table>
</div><!-- Plot -->

<?php
$this->registerCss(
    "table.iksweb{
            width: 100%;
            border-collapse:collapse;
            border-spacing:0;
            height: auto;
        }
        table.iksweb,table.iksweb td, table.iksweb th {
            border: 1px solid #595959;
        }
        table.iksweb td,table.iksweb th {
            padding: 3px;
            width: 30px;
            height: 35px;
        }
        table.iksweb th {
            background: #347c99;
            color: #fff;
            font-weight: normal;
        }"
    );
?>

