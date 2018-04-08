<?php

namespace worstinme\widgets\widgets;

use Yii;
use yii\helpers\Html;

class Widget extends \yii\base\Widget
{
    public $id;
    public $options = [];
    public $name;
    public $header_show = false;
    public $header_class = null;
    public $cache = false;
    public $container = true;
    public $view_path;

    public static function widget($config = [])
    {
        $id = 'widget-'.(!empty($config['id']) ? $config['id'] : uniqid());
        $cache_id = !empty($config['cache']) && $config['cache'] ? $id : false;

       // if (!YII_ENV_PROD || !$cache_id || ($data = Yii::$app->cache->get($cache_id)) === false) {

            $defaultConfig = [
                'options'=>[
                    'id'=>$id,
                    'class'=>'widget-'.strtolower((new \ReflectionClass(self::classname()))->getShortName()),
                ],
            ];

            $config = array_merge_recursive($defaultConfig, $config);
            
            $data = Html::tag('div', parent::widget($config),$config['options']);;

         /*   if (YII_ENV_PROD && $cache_id) {

                Yii::$app->cache->set($cache_id, $data);

            } */
       // }

        return $data;
    }

    public function run()
    {
        if ($this->header_show) {
            $header = Html::tag('h3',$this->name,['class'=>$this->header_class]).PHP_EOL;
            return $header.parent::run();
        }
        return parent::run();
    }

    public function render($view, $params = [])
    {
        $view = $this->view_path ? $this->view_path : $view;
        return $this->getView()->render($view, $params, $this);
    }

}