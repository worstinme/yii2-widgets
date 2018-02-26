<?php

namespace worstinme\widgets\controllers;

use worstinme\widgets\models\WidgetsItems;
use Yii;
use yii\web\NotFoundHttpException;

class ItemsController extends Controller
{
    public function actionCreate($wid)
    {
        $widget = $this->findModel($wid);

        $model = new $widget->widgetModel->itemClass;

        $model->widget_id = $widget->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['default/update', 'id' => $widget->id]);
        }

        return $this->render('create', [
            'widget' => $widget,
            'model' => $model,
        ]);

    }

    public function actionUpdate($wid, $id)
    {
        $widget = $this->findModel($wid);

        $class = $widget->widgetModel->itemClass;

        if (($model = $class::findOne($id)) === null) {
            throw new NotFoundHttpException();
        }

        $model->widget_id = $widget->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['default/update', 'id' => $widget->id]);
        }

        return $this->render('update', [
            'widget' => $widget,
            'model' => $model,
        ]);

    }

    public function actionDelete($id) {

        if (($model = WidgetsItems::findOne($id)) === null) {
            throw new NotFoundHttpException();
        }

        $model->delete();

        return $this->redirect(['default/update', 'id' => $model->widget_id]);
    }

}
