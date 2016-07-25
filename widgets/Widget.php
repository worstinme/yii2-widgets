<?php

namespace worstinme\widgets\widgets;

use Yii;

class Widget extends \yii\base\Widget
{
    public $id;
    public $options = [];
    public $name;
    public $cache = false;
}