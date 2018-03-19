<?php

use yii\helpers\Html;
use yii\helpers\Json;



?>

<div class="uk-position-relative uk-visible-toggle uk-light" uk-slideshow="ratio: 7:4; animation: fade<?=($this->context->autoplay?';autoplay:true':'')?>">

    <ul class="uk-slideshow-items">
        <?php foreach ($items as $item) : ?>
            <li>
                <img src="<?=$item['image']?>">
            </li>
        <?php endforeach; ?>
    </ul>

    <a class="uk-position-center-left uk-position-small <?=$this->context->hiddenNav?'uk-hidden-hover':'uk-hover'?>" href="#" uk-slidenav-previous
       uk-slideshow-item="previous"></a>
    <a class="uk-position-center-right uk-position-small <?=$this->context->hiddenNav?'uk-hidden-hover':'uk-hover'?>" href="#" uk-slidenav-next
       uk-slideshow-item="next"></a>

</div>