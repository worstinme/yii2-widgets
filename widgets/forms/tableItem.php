<?php

use yii\helpers\Html;


$row = 0;

$columnNames = explode("|", $widget->widgetModel->columnNames);

?>

<?= $form->field($model, 'name')->textInput(['class' => 'uk-input']) ?>
    <hr>

    <table class="editable-table uk-table uk-table-small uk-table-condensed uk-table-striped">
        <thead>
        <tr>
            <th>#</th>
            <?php foreach ($columnNames as $columnName) : ?>
                <th><?= $columnName ?></th>
            <?php endforeach; ?>
        </tr>

        </thead>
        <tbody>
        <?php if (count($model->row)) : ?>
            <?php foreach ($model->row as $columns) : ?>
                <tr>
                    <td><?= $row + 1 ?></td>
                    <?php for ($column = 0; $column < $widget->widgetModel->columns; $column++) { ?>
                        <td contenteditable="true">
                            <?= $model->row[$row][$column] ?? null ?>
                            <?= Html::activeHiddenInput($model, "row[$row][$column]", ['autocomplete' => 'off', 'class' => 'uk-form-small uk-input uk-width-1-1']) ?>
                        </td>
                    <?php } ?>
                    <td><a data-up><i uk-icon="icon: chevron-up"></i></a></td>
                    <td><a data-down><i uk-icon="icon: chevron-down"></i></a></td>
                    <td><a data-remove><i uk-icon="icon:trash"></i></a></td>
                </tr>
                <?php $row++; endforeach; ?>
        <?php endif; ?>
        <?php for ($row = $row; $row < $widget->widgetModel->chunk; $row++) { ?>
            <tr>
                <td><?= $row + 1 ?></td>
                <?php for ($column = 0; $column < $widget->widgetModel->columns; $column++) { ?>
                    <td contenteditable="true">
                        <?= Html::activeHiddenInput($model, "row[$row][$column]", ['autocomplete' => 'off', 'class' => 'uk-form-small uk-input uk-width-1-1']) ?>
                    </td>
                <?php } ?>
                <td><a data-up><i uk-icon="icon: chevron-up"></i></a></td>
                <td><a data-down><i uk-icon="icon: chevron-down"></i></a></td>
                <td><a data-remove><i uk-icon="icon:trash"></i></a></td>
            </tr>
        <?php } ?>
        <tr class="uk-hidden">
            <td></td>
            <?php for ($column = 0; $column < $widget->widgetModel->columns; $column++) { ?>
                <td contenteditable="true" data-column="<?= $column ?>">
                    <input type="hidden" class="uk-form-small uk-input uk-width-1-1" autocomplete="off">
                </td>
            <?php } ?>
            <td><a data-up><i uk-icon="icon: chevron-up"></i></a></td>
            <td><a data-down><i uk-icon="icon: chevron-down"></i></a></td>
            <td><a data-remove><i uk-icon="icon:trash"></i></a></td>
        </tr>
        </tbody>
    </table>

    <p>
        <button class="uk-button uk-button-success" data-row="<?= $row ?>">Добавить строку</button>
    </p>


<?php $script = <<<JS

$(document)
    .on("click",".editable-table [data-up]", function(e) {
        var row = $(this).parents("tr");
        row.prev().before(row);
    })
    .on("click",".editable-table [data-down]", function(e) {
        var row = $(this).parents("tr");
        row.next().after(row);
    })
    .on("click",".editable-table [data-remove]", function(e) {
        $(this).parents("tr").remove();
    })
    .on("click","[data-row]",function(e) {
        e.preventDefault();
        var row = $(".editable-table").find("tr.uk-hidden").clone();
        var rowNum = $(this).data("row");
        row.find("td[data-column]").each(function() {
          $(this).find("input").attr("name","TableItems[row]["+rowNum+"]["+$(this).data("column")+"]");
        })
        row.removeClass("uk-hidden");
        row.find("td:first-child").text(rowNum+1);
        $(this).data("row",rowNum+1);
        $(".editable-table").find("tr.uk-hidden").before(row)
    })
    .on("blur keyup paste input", '[contenteditable]', function() {
        $(this).find("input").val($(this).text());
        console.log($(this).text());
    })

JS;

$this->registerJs($script, $this::POS_READY);