<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;


class Products extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'TimeStamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ]
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'c_id'])->inverseOf('products');
    }


}
