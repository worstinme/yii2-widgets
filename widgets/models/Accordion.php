<?php

namespace worstinme\widgets\widgets\models;

use Yii;

class Accordion extends \yii\base\Model
{
    public $collapsible = 1;
    public $multiple = 0;
    public $animation = 1;
    public $duration = 200;
    public $transition = 'ease';

    public static function getName() {
        return 'Accordion';
    }

    public static function getDescription() {
        return 'Uikit 3 Accordion widget';
    }

    public static function getFormView() {
        return '@worstinme/widgets/widgets/forms/accordion';
    }

    public function getItemClass() {
        return AccordionItems::className();
    }

    public function rules()
    {
        return [
            ['collapsible','boolean'],
            ['multiple','boolean'],
            ['animation','boolean'],
            ['duration','integer'],
            ['transition','string','max'=>255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'animation'=>'Animation (Reveal item directly or with a transition.)',
            'collapsible'=>'Collapsible (Allow all items to be closed.)',
            'duration'=>'Animation duration in milliseconds.',
            'multiple'=>'Allow multiple open items.',
            'transition'=>'The transition to use when revealing items. Use keyword for easing functions.',
        ];
    }


}