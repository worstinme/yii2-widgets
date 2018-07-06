<?php

namespace worstinme\widgets\widgets;

use worstinme\widgets\widgets\models\ImagesItems;
use worstinme\widgets\widgets\models\TableItems;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

class Table extends Widget
{
    public $columns;
    public $columnNames;
    public $chunk;

    public function run()
    {
        $items = ArrayHelper::toArray(TableItems::find()->where(['widget_id' => $this->id])->orderBy('sort')->all(),[
            TableItems::className() =>[
                'name',
                'rows'=>function($model) {
                    return $model->row;
                },
            ]
        ]);

        return $this->render('table', [
            'items'=>$items,
            'columns'=>$this->columns,
            'chunk'=>$this->chunk,
            'columnNames'=>explode("|", $this->columnNames)
        ]);

    }

}