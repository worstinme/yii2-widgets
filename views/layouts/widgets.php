<?php

/* @var $this \yii\web\View */

/* @var $content string */

use worstinme\uikit\Alert;
use worstinme\uikit\Breadcrumbs;
use worstinme\uikit\Nav;
use yii\helpers\Html;
use yii\widgets\Menu;

\worstinme\widgets\assets\AdminAsset::register($this);

$this->beginContent('@worstinme/widgets/views/layouts/main.php'); ?>

    <div class="widgets">

        <section id="content" class="uk-container uk-container-expand uk-margin-top">
            <?= $content ?>
        </section>

    </div>

<?php $this->endContent(); ?>