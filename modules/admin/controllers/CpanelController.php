<?php


namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;

class CpanelController extends Controller
{



    public function actionIndex()
    {
        if(Yii::$app->user->can('admin'))
            return $this->render('index');
    }
}