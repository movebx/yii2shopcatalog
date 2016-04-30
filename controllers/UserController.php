<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\RegisterForm;
use yii\web\Controller;

class UserController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction'
            ]
        ];
    }

    public function actionRegister()
    {
        $model = new RegisterForm();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $model->save();
            $this->redirect('/');
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionLogin()
    {
        $model = new LoginForm();

        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if($model->validateData())
            {
                $model->login();
                $this->goBack();
            }

        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout(false);
        $this->redirect('/');
    }

}