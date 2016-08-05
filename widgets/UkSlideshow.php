<?php

namespace worstinme\widgets\widgets;

use Yii;
use yii\helpers\FileHelper;

class UkSlideshow extends Widget
{

    public $content = [];
    public $images = [];
    public $type = 1;
    public $height;
    public $autoplay;

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
        $options = [];

        if ($this->height !== null) {
            $options['height'] = $this->height;
        }

        if ($this->autoplay !== null) {
            $options['autoplay'] = $this->autoplay;
        }
        
        if ($this->type == 1 && count($this->content)) {

            return $this->render('uk-slideshow',[
                'items'=>$this->content,
                'images'=>$this->images,
                'options'=>$options,
            ]); 

        }

        return null;
    }   

}