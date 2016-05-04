<?php

namespace app\modules\admin\assets;


use yii\web\AssetBundle;

class CpanelAsset extends AssetBundle
{
    public $sourcePath = '@admin/assets';

    public $css = ['css/main.css'];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}