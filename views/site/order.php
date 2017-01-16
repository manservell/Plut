<h1> Таблица заказов</h1>
<table border="2" align="center">
    <tr>
        <th>Номер заказа</th>
        <th>Наименование</th>
        <th>Ответственный</th>
        <th>Бюджет часов</th>
        <th>Запланированная дата выполнения</th>
        <th>Фактическая дата выполнения</th>
        <th>Статус</th>
    </tr>
    <? foreach ($order as $value) { ?>
        <tr>
            <td align="center">
                <?= $value->number ?>
            </td>
            <td align="center">
                <?= $value->name ?>
            </td>
            <td align="center">
                <?= $value->responsible_id ?>
            </td>
            <td align="center">
                <?= $value->budget_hours ?>
            </td>
            <td align="center">
                <?= $value->planned_end_date ?>
            </td>
            <td align="center">
                <?= $value->actual_end_date ?>
            </td>
            <td align="center">
                <?= $value->status ?>
            </td>
        </tr>
    <?php } ?>
</table>
