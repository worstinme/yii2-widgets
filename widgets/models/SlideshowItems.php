<?php
/**
 * Created by PhpStorm.
 * User: worst
 * Date: 24.02.2018
 * Time: 12:18
 */
namespace worstinme\widgets\widgets\models;

class SlideshowItems extends \worstinme\widgets\models\WidgetsItems {

    public function rules()
    {
        return [
            ['caption','string'],
            [['image','url','imageAlt','imageTitle'],'string','max'=>255],
            [['image'],'required'],
        ];
    }

    public function getCaption() {
        return isset($this->_params['caption']) ? $this->_params['caption'] : null;
    }

    public function setCaption($value) {
        return $this->_params['caption'] = $value;
    }

    public function getImage() {
        return isset($this->_params['image']) ? $this->_params['image'] : null;
    }

    public function setImage($value) {
        return $this->_params['image'] = $value;
    }

    public function getUrl() {
        return isset($this->_params['url']) ? $this->_params['url'] : null;
    }

    public function setUrl($value) {
        return $this->_params['url'] = $value;
    }

    public function getImageAlt() {
        return isset($this->_params['imageAlt']) ? $this->_params['imageAlt'] : null;
    }

    public function setImageAlt($value) {
        return $this->_params['imageAlt'] = $value;
    }

    public function getImageTitle() {
        return isset($this->_params['imageTitle']) ? $this->_params['imageTitle'] : null;
    }

    public function setImageTitle($value) {
        return $this->_params['imageTitle'] = $value;
    }

    public function getFormView() {
        return '@worstinme/widgets/widgets/forms/slideshowItem.php';
    }

}