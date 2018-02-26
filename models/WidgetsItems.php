<?php

namespace worstinme\widgets\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "widgets_items".
 *
 * @property int $id
 * @property int $widget_id
 * @property string $params
 * @property int $sort
 * @property int $state
 */
class WidgetsItems extends \yii\db\ActiveRecord
{
    public $_params = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widgets_items';
    }

    public function afterFind()
    {
        $this->_params = $this->params ? Json::decode($this->params) : [];
        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        $this->params = Json::encode($this->_params);
        return parent::beforeSave($insert);
    }
}
