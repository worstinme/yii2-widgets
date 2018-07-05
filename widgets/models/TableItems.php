<?php
/**
 * Created by PhpStorm.
 * User: worst
 * Date: 24.02.2018
 * Time: 12:18
 */
namespace worstinme\widgets\widgets\models;

use yii\helpers\Json;

class TableItems extends \worstinme\widgets\models\WidgetsItems {

    public function rules()
    {
        return [
            [['name'],'string'],
            ['row','safe'],
            ['row','validateColumns'],
        ];
    }

    public function validateColumns($attribute, $params) {

    }

    public function getName() {
        return isset($this->_params['name']) ? $this->_params['name'] : null;
    }

    public function setName($value) {
        return $this->_params['name'] = $value;
    }

    public function getRow() {
        return isset($this->_params['row']) ? $this->_params['row'] : null;
    }

    public function setRow($array) {
        $rows = [];
        $row = 0;
        if (is_array($array)) {
            foreach ($array as $columns) {
                if (is_array($columns)) {
                    $f = [];
                    foreach ($columns as $column => $value) {
                        $value = trim(\yii\helpers\Html::encode($value));
                        if (!empty($value) || $value === 0) {
                            $f[$column] = $value;
                        }
                    }
                    if (count($f)) {
                        $rows[$row] = $f;
                        $row++;
                    }
                }
            }
        }

        return $this->_params['row'] = $rows;
    }

    public function getFormView() {
        return '@worstinme/widgets/widgets/forms/tableItem.php';
    }

}