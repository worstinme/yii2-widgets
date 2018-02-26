<?php
/**
 * Created by PhpStorm.
 * User: worst
 * Date: 24.02.2018
 * Time: 12:12
 */

namespace worstinme\widgets\controllers;

use Yii;
use worstinme\widgets\models\Widgets;
use worstinme\widgets\models\WidgetsSearch;

class Controller extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => Yii::$app->widgets->accessRoles,
                    ],
                ],
            ],

            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['post','delete'],
                ],
            ],

        ];
    }

    protected function findModel($id)
    {


        if ($id === null && ($widget = $this->getWidget(Yii::$app->request->get('widget'))) !== null) {
            $model = new Widgets(['state'=>1]);
            $model->widgetModel = new $widget;
            $model->widget = Yii::$app->request->get('widget');
            return $model;
        }
        elseif (($model = Widgets::findOne($id)) !== null && ($widget = $this->getWidget($model->widget)) !== null) {
            $model->widgetModel = new $widget;
            $model->widgetModel->setAttributes(\yii\helpers\Json::decode($model->params));
            return $model;
        }
        else {
            //  throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function getWidget($widget) {

        $widgetsModels = Yii::$app->widgets->widgetsModels;
        return !empty($widgetsModels[$widget]) ? $widgetsModels[$widget] : null;

    }
}