<?php

namespace app\modules\admin\models;

use Imagine\Gd\Imagine;
use Yii;
use app\models\Images;
use app\models\Products;
use Imagine\Filter\Transformation;
use yii\base\Model;
use Imagine\Image\Box;

class AddProduct extends Model
{
    const FULL_IMAGES_PATH = 'images/products/full/';
    const THUMBS_IMAGES_PATH = 'images/products/thumbs/';
    const THUMB_REDUCTION = 2;

    public $p_name;
    public $description;
    public $category;
    public $imageFiles;

    public function rules()
    {
        return [
            [['p_name', 'description', 'category'], 'required'],
            ['imageFiles', 'image', 'extensions' => 'png, jpg, gif, jpeg',
                'maxSize' => 5000000, 'maxFiles' => 5, 'skipOnEmpty' => false]
        ];
    }

    public function attributeLabels()
    {
        return [
            'p_name' => 'Название продукта',
            'description' => 'Описание продукта',
            'category' => 'Категория',
            'imageFiles' => 'Изображения'
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


            $imgSizeReduct = function ($imagePath, $side = 'width')
            {
                $size = getimagesize($imagePath);
                if($side === 'width')
                    return ($size[0] / self::THUMB_REDUCTION);
                if($side === 'height')
                    return ($size[1] / self::THUMB_REDUCTION);
            };

            foreach($this->imageFiles as $image)
            {
                /* @var $image \yii\web\UploadedFile */
                $randomStringName = Yii::$app->security->generateRandomString();
                $fullImagePath = self::FULL_IMAGES_PATH.$randomStringName.'.'.$image->extension;
                $thumbsImagePath = self::THUMBS_IMAGES_PATH.$randomStringName.'.'.$image->extension;

                $image->saveAs($fullImagePath);

                $imagine = new Imagine();
                $transformation = new Transformation();
                $box = new Box($imgSizeReduct($fullImagePath, 'width'), $imgSizeReduct($fullImagePath, 'height'));

                $transformation->thumbnail($box)->save(Yii::getAlias('@webroot/'.$thumbsImagePath));
                $transformation->apply($imagine->open(Yii::getAlias('@webroot/'.$fullImagePath)));

                $images = new Images();
                $images->product_id = $products->id;
                $images->img_name = $randomStringName.'.'.$image->extension;

                if(!$images->save(false))
                    throw new \Exception();

            }


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