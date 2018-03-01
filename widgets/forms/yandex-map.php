<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

var_dump($iconImageHref);

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
        <div class="uk-width-medium-2-6">
            <?= $form->field($model, "iconImageHref")->widget(\mihaildev\elfinder\InputFile::className(), [
                'language' => 'ru',
                'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
                'filter' => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                'options' => ['class' => ''],
                'buttonOptions' => ['class' => 'uk-button uk-button-primary'],
            ]); ?>
        </div>
        <div class="uk-width-medium-1-6">
            <?= $form->field($model, 'iconImageSizeW')->textInput(['option' => '']); ?>
        </div>
        <div class="uk-width-medium-1-6">
            <?= $form->field($model, 'iconImageSizeH')->textInput(['option' => '']); ?>
        </div>
        <div class="uk-width-medium-1-6">
            <?= $form->field($model, 'iconImageOffsetX')->textInput(['option' => '']); ?>
        </div>
        <div class="uk-width-medium-1-6">
            <?= $form->field($model, 'iconImageOffsetY')->textInput(['option' => '']); ?>
        </div>
    </div>

    <div id="map" class="uk-margin-top" style="height:400px;width:100%"></div>

<?php if (Yii::$app->request->isPjax): ?>
    <script>ymaps.ready(init);</script>
<?php endif ?>

<?php Pjax::end(); ?>


<?php

if (!empty($model->iconImageHref)) {
    $config = [
        'iconLayout' => 'default#image',
        'iconImageHref' => $model->iconImageHref,
    ];
    if (!empty($model->iconImageSizeW) && !empty($model->iconImageSizeH)) {
        $config['iconImageSize'] = [$model->iconImageSizeW, $model->iconImageSizeH];
    }
    if ($model->iconImageOffsetX !== null && $model->iconImageOffsetY !== null) {
        $config['iconImageOffset'] = [$model->iconImageOffsetX, $model->iconImageOffsetY];
    }
} else {
    $config = [
        'preset' => $model->preset,
    ];
    if (!empty($model->iconColor)) {
        $config['iconColor'] = $model->iconColor;
    }
}

$config['draggable'] = true;

$config = yii\helpers\Json::encode($config);

$script = <<<JS

function init() {
    var myMap = new ymaps.Map("map", {
            center: [$model->center],
            zoom: $model->zoom
        }, {
            searchControlProvider: 'yandex#search'
        }),
        config = $config;
    
    myGeoObject = new ymaps.Placemark([$model->point], {
        
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
        console.log(myGeoObject.geometry.getCoordinates());
    });
}

ymaps.ready(init);

$('body').on('change','#yandexmap-preset',function(){
    $(this).parents("form").append('<input type="hidden" value="true" name="reload">').submit();
});

JS;

$this->registerJs($script, $this::POS_READY);