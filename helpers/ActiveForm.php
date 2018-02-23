<?php
/**
 * @link https://github.com/worstinme/yii2-zoo
 * @copyright Copyright (c) 2017 Eugene Zakirov
 * @license https://github.com/worstinme/yii2-zoo/LICENSE
 */

namespace worstinme\widgets\helpers;


class ActiveForm extends \yii\widgets\ActiveForm
{
    public function run()
    {
        if (!isset($this->options['class'])) {
            $this->options['class'] = 'uk-form';
        }
        else {
            $this->options['class'] .= ' uk-form';
        }

        parent::run();
    }
    public $fieldClass = 'worstinme\zoo\widgets\ActiveField';
}