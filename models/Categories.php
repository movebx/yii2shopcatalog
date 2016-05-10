<?php

namespace app\models;


use yii\db\ActiveRecord;

class Categories extends ActiveRecord
{

    static public function getIndexedCategories()
    {
        return static::find()->select(['c_name', 'id'])
            ->indexBy('id')->column();
    }


    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['c_id' => 'id'])->inverseOf('category');
    }

}