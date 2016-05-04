<?php


namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\AddProduct;
use yii\web\UploadedFile;


class CpanelController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action)
                        {
                            return Yii::$app->user->can('moder');
                        }
                    ]
                ]
            ]
        ];
    }


    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionAddProduct()
    {
        $model = new AddProduct();
        $POST = Yii::$app->request->post();

        if(Yii::$app->request->isPost && $model->load($POST))
        {
            $model->images = UploadedFile::getInstances($model, 'images');

            if($model->validate())
                $model->save();
        }

        return $this->render('add-product', ['model' => $model]);
    }
}