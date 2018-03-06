<?php

namespace worstinme\widgets\widgets\models;

use Yii;

class Images extends \yii\base\Model
{
    public $columns_m;
    public $columns_s;
    public $layout;
    public $slideset;
    public $lightbox = 1;

    public static function getName() {
        return 'Images';
    }

    public static function getDescription() {
        return 'Uikit 3 Wall images gallery';
    }

    public static function getFormView() {
        return '@worstinme/widgets/widgets/forms/images';
    }

    public function getItemClass() {
        return ImagesItems::className();
    }

    public function rules()
    {
        return [
            [['columns_m','columns_s'],'integer'],
            [['slideset','lightbox'],'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [

        ];
    }


}