<?php

namespace worstinme\widgets\widgets;

use worstinme\widgets\widgets\models\ImagesItems;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

class Images extends Widget
{
    public $columns_m;
    public $columns_s;
    public $layout;
    public $slideset;
    public $lightbox;

    public function run()
    {
        $items = ArrayHelper::toArray(ImagesItems::find()->where(['widget_id' => $this->id])->orderBy('sort')->all(),[
            ImagesItems::className() =>[
                'imageAlt',
                'imageTitle',
                'caption',
                'image',
                'title',
                'url',
            ]
        ]);

        return $this->render('images', [
            'items'=>$items,
        ]);

    }

}