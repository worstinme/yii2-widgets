<?php

namespace worstinme\widgets\widgets;

use worstinme\widgets\widgets\models\AccordionItems;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

class Accordion extends Widget
{
    public $collapsible = 1;
    public $multiple = 0;
    public $animation = 1;
    public $duration = 200;
    public $transition = 'ease';

    public function run()
    {
        $items = AccordionItems::findAll(['widget_id' => $this->id]);

        $options = [
            'collapsible: ' . ($this->collapsible ? 'true' : 'false'),
            'multiple: ' . ($this->multiple ? 'true' : 'false'),
            'animation: ' . ($this->animation ? 'true' : 'false'),
            'transition: ' . $this->transition,
            'duration: ' . (int)$this->duration,
        ];

        $options = implode("; ",$options);

        return $this->render('accordion', [
            'items' => $items,
            'options'=>$options,
        ]);

    }

}