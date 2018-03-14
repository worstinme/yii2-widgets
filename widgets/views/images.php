<?php
/**
 * Created by PhpStorm.
 * User: worst
 * Date: 01.03.2018
 * Time: 12:45
 */

use worstinme\widgets\helpers\ImageHelper;
use yii\helpers\Html;

$class = 'uk-grid uk-grid-medium uk-child-width-1-' . $this->context->columns_s . ' uk-child-width-1-' . $this->context->columns_m . '@m'

?>

<?php if ($this->context->slideset) : ?>

    <div class="uk-position-relative uk-visible-toggle uk-light" uk-slider="finite: true">
        <ul class="uk-slider-items <?= $class ?>"<?=$this->context->lightbox?' uk-lightbox':''?>>
            <?php foreach ($items as $item): ?>
                <li>
                    <?php if ($this->context->lightbox) : ?>
                        <?= Html::a(Html::img(ImageHelper::thumbnailFileUrl(Yii::getAlias(Yii::$app->widgets->basePath) . $item['image'], 275, 275,ImageHelper::THUMBNAIL_OUTBOUND), ['class' => 'uk-width-responsive', 'alt' => $item['alt'], 'title' => $item['title']]), $item['image'], ['data-caption' => $item['caption']]) ?>
                    <?php else: ?>
                        <?= Html::img(ImageHelper::thumbnailFileUrl(Yii::getAlias(Yii::$app->widgets->basePath) . $item['image'], 275, 275,ImageHelper::THUMBNAIL_OUTBOUND), ['class' => 'uk-width-responsive', 'alt' => $item['alt'], 'title' => $item['title']]) ?>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <a class="uk-slidenav" href="#" uk-slidenav-previous
           uk-slider-item="previous"></a>
        <a class="uk-slidenav" href="#" uk-slidenav-next
           uk-slider-item="next"></a>
    </div>

<?php else: ?>

    <div class="<?= $class ?>" uk-grid uk-lightbox>
        <?php foreach ($items as $item): ?>
            <div>
                <?= Html::a(Html::img(ImageHelper::thumbnailFileUrl(Yii::getAlias(Yii::$app->widgets->basePath) . $item['image'], 275, 275), ['class' => 'uk-width-responsive', 'alt' => $item['alt'], 'title' => $item['title']]), $item['image'], ['data-caption' => $item['caption']]) ?>
            </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>