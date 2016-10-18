<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

$this->registerJsFile('//api-maps.yandex.ru/2.1/?lang=ru_RU'); ?>

<?php Pjax::begin(['id' => 'pjax', 'timeout' => 5000, 'options' => ['data-uk-observe' => true]]); ?>

    <div class="uk-grid uk-grid-small">
        <div class="uk-width-medium-1-4">
            <?= $form->field($model, 'center')->textInput(); ?>
        </div>
        <div class="uk-width-medium-1-4">
            <?= $form->field($model, 'zoom')->textInput(); ?>
        </div>
        <div class="uk-width-medium-1-4">
            <?= $form->field($model, 'height')->textInput(); ?>
        </div>
        <div class="uk-width-medium-1-4">
            <?= $form->field($model, 'width')->textInput(); ?>
        </div>
        <div class="uk-width-medium-1-4">
            <?= $form->field($model, 'point')->textInput(); ?>
        </div>
        <div class="uk-width-medium-1-4">
            <?= $form->field($model, 'preset')->textInput(['option' => '']); ?>
        </div>
        <div class="uk-width-medium-1-4">
            <?= $form->field($model, 'iconColor')->textInput(['option' => '']); ?>
        </div>
    </div>

    <div id="map" class="uk-margin-top" style="height:400px;width:100%"></div>

<?php if (Yii::$app->request->isPjax): ?>
    <script>ymaps.ready(init);</script>
<?php endif ?>

<?php Pjax::end(); ?>

<?php $script = <<<JS

function init() {
    var myMap = new ymaps.Map("map", {
            center: [$model->center],
            zoom: $model->zoom
        }, {
            searchControlProvider: 'yandex#search'
        }), 
        
        config = {preset: '$model->preset', draggable: true};
        
    if ('$model->iconColor' != '') {
        config.iconColor = '$model->iconColor';
    }
    
    myGeoObject = new ymaps.GeoObject({
        geometry: { type: "Point",coordinates: [$model->point]}
    }, config);

    myMap.geoObjects.add(myGeoObject);
    
    myMap.events.add('boundschange', function (event) {
        if (event.get('newZoom') != event.get('oldZoom')) {
            $('#yandexmap-zoom').val(event.get('newZoom'));
        }
        if (event.get('newCenter') != event.get('oldCenter')) {
            $('#yandexmap-center').val(event.get('newCenter'));
        }
    });
    
    myGeoObject.events.add('dragend', function (event) {
        $('#yandexmap-point').val(myGeoObject.geometry.getCoordinates());
    });
}

ymaps.ready(init);

$('body').on('change','#yandexmap-preset',function(){
    $(this).parents("form").append('<input type="hidden" value="true" name="reload">').submit();
});

JS;

$this->registerJs($script, $this::POS_READY);