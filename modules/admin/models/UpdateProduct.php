<?php


namespace app\modules\admin\models;


use yii\base\InvalidParamException;
use yii\base\Model;

class UpdateProduct extends Model
{
    public $p_name;
    public $description;
    public $category;

    public $product;

    public function rules()
    {
        return [
            [['p_name', 'description', 'category'], 'required'],
            ['category', 'integer']
        ];
    }

    public function confirmUpdate()
    {
        $transaction = \Yii::$app->db->beginTransaction();

        try
        {
            if(empty($this->product))
                throw new InvalidParamException();

            $this->product->p_name = $this->p_name;
            $this->product->description = $this->description;
            $this->product->c_id = $this->category;

            if(!$this->product->save(false))
                throw new \Exception('Ошибка при сохранении в базу данных');

            $transaction->commit();
        }
        catch(\Exception $e)
        {
            $transaction->rollBack();
            throw $e;
        }

    }

    final static public function specifyProduct($product)
    {
        $updateProduct = new self();
        $updateProduct->product = $product;

        return $updateProduct;
    }

    public function fillInTheForm()
    {
        $this->p_name = $this->product->p_name;
        $this->description = $this->product->description;
        $this->category = $this->product->c_id;
    }


}