<?php

use yii\helpers\Html;
use worstinme\uikit\ActiveForm;

$form = ActiveForm::begin(['layout'=>'horizontal','field_width'=>'full']); ?>

<div class="uk-form-row">
	<?= Html::activeLabel($model, 'content', ['class' => 'uk-form-label']); ?>
	<div class="uk-form-controls">
	<?=\mihaildev\ckeditor\CKEditor::widget([
	        'model'=>$model,
	        'attribute'=>'content',
	        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],[
	                'preset' => 'standart',
	                'allowedContent' => true,
	                'height'=>'200px',
                	'toolbar' => Yii::$app->zoo->cke_editor_toolbar,
                	'contentsCss'=>Yii::$app->zoo->cke_editor_css,
	        ])
	    ])?>
	</div>
</div>

<?php ActiveForm::end(); ?>