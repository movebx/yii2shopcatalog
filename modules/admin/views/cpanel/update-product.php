<?php
/* @var $model \app\modules\admin\models\UpdateProduct */

use yii\widgets\ActiveForm;
use app\models\Categories;
use yii\helpers\Html;

$form = ActiveForm::begin(['options' => ['method' => 'post']]);

echo $form->field($model, 'p_name')->textInput();
echo $form->field($model, 'description')->textarea(['rows' => 15]);
echo $form->field($model, 'category')->dropDownList(Categories::getIndexedCategories(), [
    'prompt' => 'Выберите категорию'
]);

echo Html::submitButton('Обновить продукт', ['class' => 'btn btn-success']);


ActiveForm::end();