<?php

namespace worstinme\widgets\widgets\models;

use Yii;

class Table extends \yii\base\Model
{
    public $columns;
    public $columnNames;
    public $chunk;

    public static function getName() {
        return 'Table';
    }

    public static function getDescription() {
        return 'Table data widget';
    }

    public static function getFormView() {
        return '@worstinme/widgets/widgets/forms/table';
    }

    public function getItemClass() {
        return TableItems::className();
    }

    public function rules()
    {
        return [
            [['columns','chunk'],'integer'],
            [['columnNames'],'string','max'=>255],
        ];
    }

    public function attributeLabels()
    {
        return [

        ];
    }


}