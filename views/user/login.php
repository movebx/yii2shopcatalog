<?php
/* @var $model app\models\LoginForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;


$form = ActiveForm::begin();

echo $form->field($model, 'email')->textInput();
echo $form->field($model, 'password')->passwordInput();
echo $form->field($model, 'rememberMe')->checkbox();

echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);

ActiveForm::end();