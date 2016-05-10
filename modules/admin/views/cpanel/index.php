<?php
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\admin\models\ProductsSearch */

use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => \yii\grid\SerialColumn::className()],
        [
            'attribute' => 'id',
            'label' => 'Идентификатор'
        ],
        [
            'attribute' => 'p_name',
            'label' => 'Название продукта'
        ],
        [
            'attribute' => 'category.c_name',
            'label' => 'Категория'
        ],
        [
            'attribute' => 'created_at',
            'format' => ['date', 'php:Y-m-d'],
            'label' => 'Добавлен'
        ],
        [
            'attribute' => 'updated_at',
            'format' => ['date', 'php:Y-m-d'],
            'label' => 'Обновлён'
        ],
        [
            'class' => \yii\grid\ActionColumn::className(),
            'header' => 'Действия',
        ]


    ]
]);