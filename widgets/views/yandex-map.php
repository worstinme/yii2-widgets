<?php

use yii\helpers\Html;

$id = uniqid();

$this->registerJsFile('//api-maps.yandex.ru/2.1/?lang=ru_RU');

echo Html::tag('div','',[
    'class'=>'yandex-map',
    'id'=>$id,
    'style'=>'width:'.$width.'; height:'.$height,
]);

$script = <<<JS

ymaps.ready(function() {
    var myMap = new ymaps.Map("$id", {
            center: [$center],
            zoom: $zoom
        }, {
            searchControlProvider: 'yandex#search'
        }), 
        
        config = {preset: '$preset'};
        
    if ('$iconColor' != '') {
        config.iconColor = '$iconColor';
    }
    
    myGeoObject = new ymaps.GeoObject({
        geometry: { type: "Point",coordinates: [$point]}
    }, config);

    myMap.geoObjects.add(myGeoObject);
});

JS;

$this->registerJs($script, $this::POS_READY);