<?php
/* @var $model app\models\RegisterForm */

use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

$form = ActiveForm::begin();

echo $form->field($model, 'name')->textInput();
echo $form->field($model, 'email')->textInput();
echo $form->field($model, 'password')->passwordInput();
echo $form->field($model, 'password_repeat')->passwordInput();
echo $form->field($model, 'captcha')->widget(Captcha::className());

echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);

ActiveForm::end();
