<?php

namespace worstinme\widgets\widgets\models;

class AccordionItems extends \worstinme\widgets\models\WidgetsItems {

    public function rules()
    {
        return [
            [['content','title'],'required'],
            ['open','boolean'],
            ['content','string'],
            ['title','string','max'=>255],
        ];
    }

    public function getContent() {
        return isset($this->_params['content']) ? $this->_params['content'] : null;
    }

    public function setContent($value) {
        return $this->_params['content'] = $value;
    }

    public function getTitle() {
        return isset($this->_params['title']) ? $this->_params['title'] : null;
    }

    public function setTitle($value) {
        return $this->_params['title'] = $value;
    }

    public function getOpen() {
        return isset($this->_params['open']) ? $this->_params['open'] : null;
    }

    public function setOpen($value) {
        return $this->_params['open'] = $value;
    }

    public function getFormView() {
        return '@worstinme/widgets/widgets/forms/accordionItem.php';
    }

}