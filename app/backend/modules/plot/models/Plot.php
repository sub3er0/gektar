<?php

namespace backend\modules\plot\models;

use Yii;

/**
 * This is the model class for table "plot".
 *
 * @property int $id
 * @property string|null $cadastralNumber
 * @property string|null $address
 * @property float|null $price
 * @property float|null $area
 * @property string|null $updatedAt
 */
class Plot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'area'], 'number'],
            [['cadastralNumber', 'address', 'updatedAt'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cadastralNumber' => 'Cadastral Number',
            'address' => 'Address',
            'price' => 'Price',
            'area' => 'Area',
            'updatedAt' => 'updatedAt',
        ];
    }
}
