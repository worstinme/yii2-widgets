<?php

namespace worstinme\widgets\widgets;

use worstinme\widgets\widgets\models\SlideshowItems;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

class Slideshow extends Widget
{

    public $height;
    public $autoplay;
    public $hiddenNav;

    public function run()
    {
        $options = [];

        if (!empty($this->height)) {
            $options['height'] = $this->height;
        }

        if (!empty($this->autoplay)) {
            $options['autoplay'] = $this->autoplay;
        }

        $items = ArrayHelper::toArray(SlideshowItems::findAll(['widget_id'=>$this->id]),[
            SlideshowItems::className() =>[
                'caption',
                'image',
            ]
        ]);

        return $this->render('slideshow', [
            'options' => $options,
            'items'=>$items,
        ]);

    }

}