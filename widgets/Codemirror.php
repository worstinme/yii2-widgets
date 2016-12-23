<?php

namespace worstinme\widgets\widgets;

use Yii;

class Codemirror extends Widget
{
    public $content;

    public function run()
    {
        return $this->content;
    }   

}