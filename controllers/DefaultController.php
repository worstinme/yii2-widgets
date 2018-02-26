<?php

namespace worstinme\widgets\controllers;

use worstinme\widgets\models\WidgetsSearch;
use Yii;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new WidgetsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $positions = (new \yii\db\Query())->select(['position'])->distinct()->from('{{%widgets}}')->indexBy('position')->column();

        $types = (new \yii\db\Query())->select(['widget'])->distinct()->from('{{%widgets}}')->indexBy('widget')->column();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'positions'=>$positions,
            'types'=>$types,
        ]);
    }

    public function actionCreate()
    {   
        $widgets = Yii::$app->widgets->widgetsModels;

        return $this->render('create', [
            'widgets'=>$widgets,
        ]);
        
    }

    public function actionUpdate($id = null)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->widgetModel->validate()) {

            if (Yii::$app->request->post('reload') === null && $model->save()) {

                if (Yii::$app->request->isAjax && Yii::$app->request->post('submitButton') === null) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        'success' => true,
                        'model' => $model->getAttributes(),
                    ];
                }

                Yii::$app->session->setFlash('success','Widget was updated');

                return $this->redirect(['update','id'=>$model->id]);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
        ]);
        
    }

    public function actionSort() {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $sort = Yii::$app->request->post('sort');

        $result = [];

        if ($sort !== null && is_array($sort)) {
            
            foreach ($sort as $key => $value) {
                
                $widget = $this->findModel($key);
                $widget->sort = (int)$value;
                $widget->save();

                $result[] = $widget->errors;

            }

            return [
                'success' => true,
                'result'=>$result,
            ];

        }

        return [
            'success' => false,
        ];
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


}
