<?php 

use yii\helpers\Html;

$key = isset($key)?$key:null;
$last = isset($last)?$last:false;

?>

<?php if ($key !== null && $key>0): ?>
	<?= Html::a('Поднять вверх', $url = null, ['data-up'=>true]); ?> / 
<?php endif ?>

<?php if (!$last): ?>
	<?= Html::a('Вниз', $url = null,  ['data-down'=>true]); ?> / 
<?php endif ?>

<?= Html::a('Удалить', $url = null,  ['data-remove'=>true]); ?> 