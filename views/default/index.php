<?php

use yii\helpers\Html;
use yii\helpers\Url;
use worstinme\widgets\helpers\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Widgets';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="widgets-index">

    <?php if (empty($searchModel->position)): ?>

        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'summaryOptions' => ['class' => 'uk-text-center'],
            'tableOptions' => ['class' => 'uk-table uk-table-striped uk-table-hover uk-table-small'],
            'options' => ['class' => 'items'],
            'layout' => '{items}{summary}{pager}',
            'columns' => [
                [
                    'attribute' => 'name',
                    'format' => 'raw',
                    'value' => function ($model, $index, $widget) {
                        return Html::a($model->name, ['update', 'id' => $model->id]);
                    },
                ],
                [
                    'attribute' => 'state',
                    'label' => '',
                    'format' => 'raw',
                    'value' => function ($model, $index, $widget) {
                         return Html::a('<i uk-icon="icon: check"></i>', '#', ['onClick' => "var link=$(this);$.ajax({url:'" . \yii\helpers\Url::to(['update', 'id' => $model->id]) . "',type:'POST',data: {'" . $model->formName() . "[state]':0},success: function(data){ if(data.success) { $('.state-button-$model->id').toggleClass('uk-hidden'); } }})", 'class' => "state-button-".$model->id.($model->state ? null : " uk-hidden")]).
                             Html::a('<i uk-icon="icon: close"></i>', '#', ['onClick' => "var link=$(this);$.ajax({url:'" . \yii\helpers\Url::to(['update', 'id' => $model->id]) . "',type:'POST',data: {'" . $model->formName() . "[state]':1},success: function(data){ if(data.success) { $('.state-button-$model->id').toggleClass('uk-hidden'); } }})", 'class' => "state-button-".$model->id.($model->state ? " uk-hidden" : null)]);
                         },
                    'headerOptions' => ['class' => 'uk-text-center'],
                    'contentOptions' => ['class' => 'uk-text-center'],
                ],
                [
                    'attribute' => 'position',
                    'filter' => $positions,
                ],
                [
                    'attribute' => 'id',
                    'label' => '# callback',
                    'format' => 'raw',
                    'value' => function ($model, $index, $widget) {
                        return '[widget id=' . $model->id . ']';
                    },
                    'headerOptions' => ['class' => 'uk-text-center'],
                    'contentOptions' => ['class' => 'uk-text-center'],
                ],
                [
                    'attribute' => 'widget',
                    'filter' => $types,
                ],
                [
                    'attribute' => 'lang',
                    'filter' => Yii::$app->widgets->languages,
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            return Html::a('<i uk-icon="icon: trash"></i>', $url, [
                                'title' => 'Удалить',
                                'data' => [
                                    'method' => 'post',
                                    'confirm' => 'Точно удалить?',
                                ],
                            ]);
                        },
                    ],
                    'contentOptions' => ['class' => 'uk-text-center'],
                ],
            ],

        ]); ?>

    <?php else: ?>

        <?php $dataProvider->pagination = false; ?>

        <div class="uk-display-inline-block uk-margin-left">

            <?php $form = ActiveForm::begin(['id' => 'login-form', 'method' => 'get']); ?>

            <?= Html::activeDropDownList($searchModel, 'position', $positions, ['class'=>'uk-select','prompt' => 'Сбросить позицию']); ?>

            <?php ActiveForm::end(); ?>

        </div>

        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['tag' => false],
            'layout' => '{items}',
            'options' => ['tag' => 'ul', 'class' => 'uk-sortable'],
            'itemView' => '_item',
        ]) ?>

        <?php

        $url = Url::to(['sort']);

        $js = <<<JS

        $("#widgetssearch-position").on("change",function(){ $(this).parents("form").submit()});
        
        var sortable = UIkit.sortable($(".uk-sortable"));
        
        $(".uk-sortable").on('moved',function(event){
            
            var sort = {}; 

            $("ul.uk-sortable > li").each(function(index) {
                sort[$(this).data('item-id')] = index;
            });

            console.log(sort);

            $.post("$url",{'sort':sort}, function( data ) {
                UIkit.notification("Есть кптан");
            });

        });

JS;

        $this->registerJs($js, $this::POS_READY); ?>

    <?php endif ?>


</div>