<?php

namespace app\modules\admin\models;


use app\models\Products;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class ProductsSearch extends ActiveRecord
{

    static public function tableName()
    {
        return 'products';
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['category.c_name']);
    }

    public function rules()
    {
        return [
            ['id', 'integer'],
            [['p_name', 'category.c_name'], 'safe']
        ];
    }


    public function search($GET)
    {
        $query = Products::find()->joinWith(['category' => function($query){ $query->from(['category' => 'categories']); }]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'attributes' => [
                    'id',
                    'p_name',
                    'category.c_name'
                ]
            ]
        ]);

        if (!($this->load($GET) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['products.id' => $this->id])
            ->andFilterWhere(['LIKE', 'p_name', $this->p_name])
            ->andFilterWhere(['LIKE', 'category.c_name', $this->getAttribute('category.c_name')]);

        return $dataProvider;
    }
}