<?php

use yii\helpers\Html;
use worstinme\uikit\ActiveForm;

$form = ActiveForm::begin(['layout'=>'horizontal','field_width'=>'full']); ?>

<?=$form->field($model, "content")->widget(\worstinme\jodit\Editor::className(), [
    'settings' => [
        'buttons'=>[
        	'source', '|', 'bold', 'italic', '|', 'ul', 'ol', '|', 'font', 'fontsize', 'brush', 'paragraph', '|','image', 'table', 'link', '|', 'left', 'center', 'right', 'justify', '|', 'undo', 'redo', '|', 'hr', 'eraser', 'fullsize'
        ],
    ],
]);?>

<?php ActiveForm::end(); ?>