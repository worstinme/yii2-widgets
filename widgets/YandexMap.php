<?php

namespace worstinme\widgets\widgets;

use Yii;

class YandexMap extends Widget
{

    public $point;
    public $center;
    public $zoom;
    public $height;
    public $width;
    public $ballon;
    public $preset;
    public $iconColor;
    public $iconImageHref;
    public $iconImageSizeW;
    public $iconImageOffsetX;
    public $iconImageSizeH;
    public $iconImageOffsetY;
    public $disableScrollZoom = 1;
    public $caption;
    public $captionContainer;

    public function run()
    {
        return $this->render('yandex-map',[
            'point'=>$this->point,
            'center'=>$this->center,
            'zoom'=>$this->zoom,
            'height'=>$this->height,
            'width'=>$this->width,
            'preset'=>$this->preset,
            'iconColor'=>$this->iconColor,
            'iconImageHref'=>$this->iconImageHref,
            'iconImageSizeW'=>$this->iconImageSizeW,
            'iconImageOffsetX'=>$this->iconImageOffsetX,
            'iconImageSizeH'=>$this->iconImageSizeH,
            'iconImageOffsetY'=>$this->iconImageOffsetY,
        ]);
    }   

}