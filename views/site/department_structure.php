<h1> Таблица видов работ</h1>
<table border="2" align="center">
    <tr>
        <th>Структура отдела</th>
    </tr>
    <? foreach ($ds as $value) { ?>
        <tr>
            <td align="center">
                <?= $value->structure_category ?>
            </td>
        </tr>
    <?php } ?>
</table>
