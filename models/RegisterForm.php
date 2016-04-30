<?php

namespace app\models;


use app\models\identity\User;
use yii\base\Model;

class RegisterForm extends Model
{
    public $name;
    public $password;
    public $password_repeat;
    public $email;
    public $captcha;

    public function rules()
    {
        return [
            [['name', 'password', 'email'], 'required'],
            ['email', 'email'],
            ['captcha', 'captcha'],
            ['password', 'match', 'pattern' => '/^[\w]{6,}$/'],
            ['password_repeat', 'compare', 'operator' => '==', 'compareAttribute' => 'password'],
            ['name', 'unique', 'targetClass' => User::className()],
            ['email', 'unique', 'targetClass' => User::className()]

        ];
    }

    public function save()
    {
        $transaction = \Yii::$app->getDb()->beginTransaction();
        try
        {
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->setPassword($this->password);

            $user->save();

            /*
             * @TODO:
             */

            $transaction->commit();
        }
        catch(\Exception $e)
        {
            $transaction->rollBack();
            \Yii::error($e->getMessage());
            throw $e;
        }
    }

}