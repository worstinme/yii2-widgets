<?php 

use yii\helpers\Html;

$key = isset($key)?$key:null;
$last = isset($last)?$last:false;

?>

<?php if ($key !== null && $key>0): ?>
	<?= Html::a('Поднять вверх', $url = null, ['data-up'=>true],['class'=>'uk-button uk-button-primary']); ?> /
<?php endif ?>

<?php if (!$last): ?>
	<?= Html::a('Вниз', $url = null,  ['data-down'=>true,'class'=>'uk-button uk-button-success']); ?> /
<?php endif ?>

<?= Html::a('Удалить', $url = null,  ['data-remove'=>true,'class'=>'uk-button uk-button-danger']); ?>