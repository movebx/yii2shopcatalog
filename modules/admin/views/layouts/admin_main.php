<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\assets\CpanelAsset;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

CpanelAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->registerMetaTag(['charset' => Yii::$app->charset]) ?>
    <?php $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']) ?>

    <?= Html::csrfMetaTags() ?>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php NavBar::begin(['brandLabel' => 'На главную']) ?>

<?= Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        [
            'label' => 'Редактировать продукты <span class="glyphicon glyphicon-th-list"></span>',
            'url' => Url::to(['/admin/cpanel/index']),
            'encode' => false
        ],
        [
            'label' => 'Добавить продукт <span class="glyphicon glyphicon-plus"></span>',
            'url' => Url::to(['/admin/cpanel/add-product']),
            'encode' => false
        ],
        [
            'label' => 'Менеджер пользователей <span class="glyphicon glyphicon-user"></span>',
            'url' => Url::to(['#']),
            'encode' => false,
            'visible' => Yii::$app->user->can('admin'),
        ],
    ]
]) ?>

<?php NavBar::end(); ?>

<div class="container">



    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>