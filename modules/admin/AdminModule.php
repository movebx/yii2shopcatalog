<?php
namespace app\modules\admin;


use yii\base\Module;

class AdminModule extends Module
{


    public function init()
    {
        parent::init();

        \Yii::configure($this, $this->config());
    }

    protected function config()
    {
        return [
            'layout' => 'admin_main'
        ];
    }

}