<?php
/**
 * Created by PhpStorm.
 * User: worst
 * Date: 22.03.2018
 * Time: 21:14
 */


?>

<ul uk-accordion="<?=$options?>">
    <?php foreach ($items as $item) : ?>
        <li<?=$item->open?' class="uk-open"':''?>>
            <a class="uk-accordion-title" href="#"><?=$item->title?></a>
            <div class="uk-accordion-content">
                <?=$item->content?>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
