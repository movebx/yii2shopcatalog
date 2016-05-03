<?php


namespace app\rbac;


use yii\rbac\Rule;

class DefaultRolesRule extends Rule
{
    public $name = 'defaultRoles';


    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest)
        {
            $role = \Yii::$app->user->identity->role;
            if($item->name === 'admin')
                return $role === 1;
            elseif($item->name === 'moder')
                return $role === 1 || $role === 2;
            elseif($item->name === 'user')
                return $role === 1 || $role === 2 || $role === 3;

        }

        return false;
    }
}