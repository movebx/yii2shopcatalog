<?php

namespace app\controllers;


use app\models\Products;
use yii\web\Controller;

class MainController extends Controller
{

    public function actionIndex()
    {
        $model = Products::find()->joinWith('category')->where(['like', 'categories.c_name', 'IT'])->all();

        return $this->render('index', ['model' => $model]);
    }

}