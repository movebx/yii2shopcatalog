<?php


namespace app\modules\admin\controllers;

use app\models\Products;
use app\modules\admin\models\ProductsSearch;
use app\modules\admin\models\UpdateProduct;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\modules\admin\models\AddProduct;
use yii\web\NotFoundHttpException;
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
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionAddProduct()
    {
        $model = new AddProduct();
        $POST = Yii::$app->request->post();

        if(Yii::$app->request->isPost && $model->load($POST))
        {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

            if($model->validate())
                $model->save();
        }

        return $this->render('add-product', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $product = Products::findOne($id);
        if(empty($product))
            throw new NotFoundHttpException();

        $model = UpdateProduct::specifyProduct($product);
        $request = Yii::$app->request;
        if($request->isPost && $model->load($request->post()) && $model->validate())
        {
            $model->confirmUpdate();
        }

        $model->fillInTheForm();

        return $this->render('update-product', ['model' => $model]);
    }
}