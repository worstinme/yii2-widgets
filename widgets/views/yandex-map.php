<?php

use yii\helpers\Html;

$id = uniqid();

$this->registerJsFile('//api-maps.yandex.ru/2.1/?lang=ru_RU');

?>
    <div class="yandex-map">
        <?php if (!empty($this->context->caption)) : ?>

            <div class="<?= $this->context->captionContainer ? 'uk-container' : '' ?>">
                <div class="caption">
                    <div class="caption-container">
                        <?= $this->context->caption ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div id="<?= $id ?>" style="<?= 'width:' . $width . '; height:' . $height ?>"></div>
    </div>
<?php

if (!empty($iconImageHref)) {
    $config = [
        'iconLayout' => 'default#image',
        'iconImageHref' => $iconImageHref,
    ];
    if (!empty($iconImageSizeW) && !empty($iconImageSizeH)) {
        $config['iconImageSize'] = [$iconImageSizeW, $iconImageSizeH];
    }
    if ($iconImageOffsetX !== null && $iconImageOffsetY !== null) {
        $config['iconImageOffset'] = [$iconImageOffsetX, $iconImageOffsetY];
    }
} else {
    $config = [
        'preset' => $preset,
    ];
    if (!empty($iconColor)) {
        $config['iconColor'] = $iconColor;
    }
}

$config = yii\helpers\Json::encode($config);
$disableScrollZoom = $this->context->disableScrollZoom ? 'true' : 'false';

$script = <<<JS

ymaps.ready(function() {
    var myMap = new ymaps.Map("$id", {
            center: [$center],
            zoom: $zoom
        }, {
            searchControlProvider: 'yandex#search'
        }),
        config = $config;
    
    myGeoObject = new ymaps.GeoObject({
        geometry: { type: "Point",coordinates: [$point]}
    }, config);

    myMap.geoObjects.add(myGeoObject);
    
    if($disableScrollZoom) {
        myMap.behaviors.disable('scrollZoom'); 
    }
    
});

JS;

$this->registerJs($script, $this::POS_LOAD);