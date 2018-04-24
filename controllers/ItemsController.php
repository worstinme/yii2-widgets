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
            if (Yii::$app->request->post('continue') == 'true') {
                return $this->refresh();
            }
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

    public function actionSort()
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $sort = Yii::$app->request->post('sort');

        $result = [];

        if ($sort !== null && is_array($sort)) {

            $transaction = Yii::$app->db->beginTransaction();

            try {

                foreach ($sort as $index => $id) {

                    if (($item = WidgetsItems::findOne($id)) !== null) {

                        $item->sort = (int)$index;

                        if (!$item->save(false)) {
                            throw new \Exception('Один из сортируемых эелемнтов не удалось сохранить');
                        }

                    } else {
                        throw new \Exception('Один из сортируемых эелемнтов не найден');
                    }

                }

                $transaction->commit();

                return [
                    'success' => true,
                    'message' => 'Saved!',
                ];

            } catch (\Exception $e) {

                $transaction->rollBack();

                throw $e;

            }

        }

        throw new \Exception('Не удалось завершить сортировку');
    }

    public function actionDelete($id)
    {

        if (($model = WidgetsItems::findOne($id)) === null) {
            throw new NotFoundHttpException();
        }

        $model->delete();

        return $this->redirect(['default/update', 'id' => $model->widget_id]);
    }

}
