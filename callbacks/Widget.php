<?php

namespace worstinme\widgets\callbacks;

use worstinme\widgets\models\Widgets;
use Yii;

class Widget extends \yii\base\Widget
{
    public $id;

    public function run() {

        if (($model = Widgets::findOne($this->id)) !== null) {

            $params = $model->getParams();

            $params['options'] = ['class'=>$model->css_class];
            $params['cache'] = $model->cache;
            $params['name'] = $model->name;
            $params['id'] = $model->id;

            return Yii::$app->widgets->callWidget([
                'callback'=>$model->widget,
                'params'=>$params,
            ]);

        }
    }

}