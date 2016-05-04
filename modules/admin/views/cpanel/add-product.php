<?php
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AddProduct */

use yii\widgets\ActiveForm;
use app\models\Categories;
use yii\helpers\Html;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

echo $form->field($model, 'p_name')->textInput();
echo $form->field($model, 'description')->textarea(['rows' => 15]);
echo $form->field($model, 'category')->dropDownList(Categories::find()->select(['c_name', 'id'])
    ->indexBy('id')->column(), ['prompt' => 'Выберите категорию']);

echo $form->field($model, 'images[]')->fileInput(['multiple' => true]);

echo Html::submitButton('Добавить', ['class' => 'btn btn-success']);



ActiveForm::end();

