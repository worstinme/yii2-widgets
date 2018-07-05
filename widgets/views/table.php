<?php
/**
 * Created by PhpStorm.
 * User: worst
 * Date: 01.03.2018
 * Time: 12:45
 */

use worstinme\widgets\helpers\ImageHelper;
use yii\helpers\Html;

?>

<?php foreach ($items as $item) : ?>
    <h2><?=$item['name']?></h2>
    <table>
    <?php foreach ($item['rows'] as $row) : ?>
        <tr>
        <?php foreach ($row as $column) : ?>
            <td><?=$column?></td>
        <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endforeach; ?>