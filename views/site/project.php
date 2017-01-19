<h1> Таблица проектов</h1>
<table border="2" align="center">
    <tr>
        <th>Номер заказа</th>
        <th>Наименование</th>
        <th>Заказчик</th>
        <th>Статус</th>
        <th>Ответственный за проект</th>
        <th>Бюджет часов</th>
        <th>Планируемая дата окончания</th>
        <th>Фактическая дата окончания</th>
    </tr>
    <? foreach ($project as $value) { ?>
        <tr>
            <td align="center">
                <?= $value->number ?>
            </td>
            <td align="center">
                <?= $value->name ?>
            </td>
            <td align="center">
                <?= $value->customer ?>
            </td>
            <td align="center">
                <?= $value->status ?>
            </td>
            <td align="center">
                <?= $value->employees->last_name?> <?=$value->employees-> first_name ?> <?=$value->employees-> middle_name ?>
            </td>
            <td align="center">
                <?= $value->budget_hours ?>
            </td>
            <td align="center">
                <?= $value->planned_end_date  ?>
            </td>
            <td align="center">
                <?= $value->actual_end_date  ?>
            </td>
        </tr>
    <?php } ?>
</table>
