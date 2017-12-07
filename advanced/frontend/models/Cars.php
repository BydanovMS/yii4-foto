<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cars".
 *
 * @property integer $car_id
 * @property integer $car_sel_id
 * @property string $car_manufacture
 * @property string $car_model
 * @property integer $car_year
 * @property string $car_info
 *
 * @property Sellers $carSel
 */
class cars extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cars';
    }

    /**
     * @inheritdoc !
     */
    public function rules()
    {
        return [
            [['car_id'], 'required'],
            [['car_id', 'car_sel_id', 'car_year'], 'integer'],
            [['car_manufacture', 'car_model'], 'string', 'max' => 200],
            [['car_info'], 'string', 'max' => 4000],
            [['car_sel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sellers::className(), 'targetAttribute' => ['car_sel_id' => 'sel_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'car_id' => 'Car ID',
            'car_sel_id' => 'Car Sel ID',
            'car_manufacture' => 'Car Manufacture',
            'car_model' => 'Car Model',
            'car_year' => 'Car Year',
            'car_info' => 'Car Info',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarSel()
    {
        return $this->hasOne(Sellers::className(), ['sel_id' => 'car_sel_id']);
    }
    
        public function getTel()
    {
        return $this->hasMany(Sellers::className(), ['fkey' => 'sel_id']);
    }
}
