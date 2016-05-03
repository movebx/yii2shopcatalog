<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\MainAsset;
use yii\helpers\Url;

MainAsset::register($this);
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


<div style="text-align: center"><?= Yii::$app->user->isGuest ? '<a href="'.Url::to(['user/login']).'">login</a>'
        : 'Hello, '.Yii::$app->user->identity->name.' <a href="'.Url::to(['user/logout']).'">logout</a>' ?>
</div>
<div style="text-align: center">
    <a href="<?= Url::to(['user/register']) ?>">Register</a>
</div>

<?= $content ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
