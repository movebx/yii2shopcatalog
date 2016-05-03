<?php

namespace app\commands;


use yii\console\Controller;
use app\rbac\DefaultRolesRule;

class RbacController extends Controller
{
    public function actionInitRoles()
    {
        $authManager = \Yii::$app->authManager;
        $defaultRolesRule = new DefaultRolesRule();
        $authManager->add($defaultRolesRule);

        $rAdmin = $authManager->createRole('admin');
        $rModer = $authManager->createRole('moder');
        $rUser = $authManager->createRole('user');

        $rAdmin->ruleName = $defaultRolesRule->name;
        $rModer->ruleName = $defaultRolesRule->name;
        $rUser->ruleName = $defaultRolesRule->name;

        $authManager->add($rAdmin);
        $authManager->add($rModer);
        $authManager->add($rUser);

        $authManager->addChild($rModer, $rUser);
        $authManager->addChild($rAdmin, $rModer);

        echo 'DONE!\n\r';
    }
}