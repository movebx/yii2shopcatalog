<?php

namespace app\models;

use Yii;
use app\models\identity\User;
use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe;

    public $user;


    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
        ];
    }


    public function validateData()
    {
        $this->user = User::findByEmail($this->email);

        if($this->user)
        {
            if(Yii::$app->security->validatePassword($this->password, $this->user->password))
                return true;
            else
                $this->addError('loginData', 'Не верный пароль!');
        }
        else
        {
            $this->addError('loginData', 'Такого електронного адреса не существует!');
        }

        return false;
    }

    public function login()
    {
        Yii::$app->user->login($this->user, $this->rememberMe ? 3600*24*30 : 0);
    }

}