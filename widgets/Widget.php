<?php

namespace worstinme\widgets\widgets;

use Yii;

class Widget extends \yii\base\Widget
{
    public $id;
    public $options = [];
    public $name;
    public $cache = false;

	public static function widget($config = [])
    {
    /*	$id = 'widget-'.(!empty($config['id']) ? $config['id'] : uniqid());
    	$cache_id = !empty($config['cache']) && $config['cache'] ? $id : false;
		
		if (empty($config['options'])) {
			$config['options'] = [];
		}

		$config['options']['id'] = $id;

    	if ($cache_id) {
    		$data = Yii::$app->cache->get($cache_id); 
    		if ($data === false) {
	            $data = parent::widget($config);
	            Yii::$app->cache->set($cache_id, $data);
	        }
	        return $data;
    	} */

        return parent::widget($config);
    }

}