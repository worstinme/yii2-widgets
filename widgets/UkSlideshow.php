<?php

namespace worstinme\widgets\widgets;

use Yii;
use yii\helpers\FileHelper;

class UkSlideshow extends Widget
{

    public $content = [];
    public $images = [];
    public $type = 1;

    /*  item => [
            'img'=>'/img.jpg', from @webroot
            'overlay'=>'',
            'item'=>'',
        ]   */

    public function init()
    {
        parent::init();
    }

    public function run()
    {

        if ($this->type == 1 && count($this->content)) {

            return $this->render('uk-slideshow',[
                'items'=>$this->content,
                'images'=>$this->images,
            ]); 

        }

        return null;
    }   

}