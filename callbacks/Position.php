<?php

namespace worstinme\widgets\callbacks;

use worstinme\widgets\models\Widgets;
use Yii;

class Position extends \yii\base\Widget
{
    public $name;

    public function run()
    {
        $out = '';

        if (!empty($this->name)) {

            $key = 'worstinme_widgets_' . $this->name . '_' . Yii::$app->language;

            $data = Yii::$app->cache->get($key);

            if (true || $data === false) {

                $widgets = Widgets::find()
                    ->where(['state' => 1, 'position' => $this->name, 'lang' => ['', null, Yii::$app->language]])
                    ->with('bounds')
                    ->orderBY('sort')
                    ->all();

                $data = \yii\helpers\ArrayHelper::toArray($widgets, [
                    'worstinme\widgets\models\Widgets' => [
                        'callback' => 'widget',
                        'bounds' => function ($model) {
                            $bounds = ['only' => [], 'except' => []];
                            if (count($model->bounds)) {
                                foreach ($model->bounds as $bound) {
                                    if ($bound['except']) {
                                        $bounds['except'][] = $bound['module'] . '/' . $bound['controller'] . '/' . $bound['action'];
                                    } else {
                                        $bounds['only'][] = $bound['module'] . '/' . $bound['controller'] . '/' . $bound['action'];
                                    }
                                }
                            }
                            return $bounds;
                        },
                        'params' => function ($model) {
                            $params = $model->getParams();
                            $params['options'] = ['class' => $model->css_class];
                            $params['cache'] = $model->cache;
                            $params['name'] = $model->name;
                            $params['id'] = $model->id;
                            $params['header_show'] = $model->header_show;
                            $params['header_class'] = $model->header_class;
                            $params['view_path'] = $model->view_path;
                            return $params;
                        },
                    ],
                ]);

                $dependency = new \yii\caching\ChainedDependency([
                    'dependencies' => [
                        new \yii\caching\DbDependency(['sql' => 'SELECT MAX(updated_at) FROM {{%widgets}}'])
                    ],
                ]);

                Yii::$app->cache->set($key, $data, 0, $dependency);

            }

            foreach ($data as $widget) {
                $out .= Yii::$app->widgets->callWidget($widget);
            }

        }

        return $out;

    }

}