<?php

use yii\helpers\Html;

$id = uniqid();

$this->registerJsFile('//api-maps.yandex.ru/2.1/?lang=ru_RU');

echo Html::tag('div', '', [
    'class' => 'yandex-map',
    'id' => $id,
    'style' => 'width:' . $width . '; height:' . $height,
]);

if (!empty($iconImageHref)) {
    $config = [
        'iconLayout' => 'default#image',
        'iconImageHref'=>$iconImageHref,
    ];
    if (!empty($iconImageSizeW) && !empty($iconImageSizeH)) {
        $config['iconImageSize'] = [$iconImageSizeW,$iconImageSizeH];
    }
    if ($iconImageOffsetX !== null && $iconImageOffsetY !== null ) {
        $config['iconImageOffset'] = [$iconImageOffsetX,$iconImageOffsetY];
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
});

JS;

$this->registerJs($script, $this::POS_READY);