<?php

namespace app\modules\admin\models;

use app\models\Products;
use Yii;
use yii\base\Model;

class AddProduct extends Model
{
    const FULL_IMAGES_PATH = '/images/products/full/';
    const THUMBS_IMAGES_PATH = '/images/products/thumbs/';
    const THUMB_REDUCTION = 2;

    public $p_name;
    public $description;
    public $category;
    public $images;

    public function rules()
    {
        return [
            [['p_name', 'description', 'category'], 'required'],
            ['images', 'image', 'extensions' => 'png, jpg, gif, jpeg', 'maxFiles' => 5, 'maxSize' => 5000000, 'skipOnEmpty' => false]
        ];
    }

    public function save()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try
        {
            $products = new Products();
            $products->p_name = $this->p_name;
            $products->description = $this->description;
            $products->c_id = $this->category;

            if(!$products->save(false))
                throw new \Exception('Product not save');





            $transaction->commit();
            Yii::$app->session->addFlash('add-product', 'Продукт успешно добавлен');
        }
        catch(\Exception $e)
        {
            $transaction->rollBack();
            throw $e;
        }
    }

}