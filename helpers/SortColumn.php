<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace worstinme\widgets\helpers;

use Closure;
use yii\base\InvalidConfigException;
use yii\grid\Column;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;


class SortColumn extends Column
{
    public $url = ['sort'];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->registerClientScript();
    }

    /**
     * {@inheritdoc}
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        return Html::a('<span uk-icon="icon: chevron-up"></span>','', [
                'data-up' => true,
            ])
            . '&nbsp;&nbsp;'
            . Html::a('<span uk-icon="icon: chevron-down"></span>','', [
                'data-down' => true,
            ]);
    }

    /**
     * Registers the needed JavaScript.
     * @since 2.0.8
     */
    public function registerClientScript()
    {

        $url = \yii\helpers\Url::to($this->url);

        $script = <<<JS
    $(document).on("click","[data-up]", function(e) {
        e.preventDefault();
        var row = $(this).closest("tr[data-key]");
        row.prev().before(row);
        var sort = [];
        row.closest("tbody").find("tr[data-key]").each(function(index, item) {
          sort[index] = $(this).data("key");
        })
        $.post("$url",{sort:sort}).fail(function(data) {
            UIkit.notification('Error. Please refresh page');
        });
    });
    $(document).on("click","[data-down]", function(e) {
        e.preventDefault();
        var row = $(this).parents("tr[data-key]");
        row.next().after(row);
        var sort = [];
        row.parents("tbody").find("tr[data-key]").each(function(index, item) {
          sort[index] = $(this).data("key");
        })
        $.post("$url",{sort:sort}).fail(function(data) {
            UIkit.notification('Error. Please refresh page');
        });
    });
JS;
        $this->grid->getView()->registerJs($script, View::POS_READY);
    }
}
