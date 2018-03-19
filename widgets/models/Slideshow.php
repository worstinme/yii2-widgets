<?php

namespace worstinme\widgets\widgets\models;

use Yii;

class Slideshow extends \yii\base\Model
{
    public $height;
    public $autoplay;
    public $hiddenNav;

    public static function getName() {
        return 'Slideshow';
    }

    public static function getDescription() {
        return 'Uikit 3 Slideshow widget';
    }

    public static function getFormView() {
        return '@worstinme/widgets/widgets/forms/slideshow';
    }

    public function getItemClass() {
        return SlideshowItems::className();
    }

    public function rules()
    {
        return [
            ['hiddenNav','boolean'],
            ['autoplay','boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [

        ];
    }


}