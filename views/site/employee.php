<h1> Таблица сотрудников</h1>
<table border="2" align="center">
    <tr>
        <th>Номер</th>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Сектор</th>
        <th>Категория по структуре отдела</th>
        <th>Статус</th>
    </tr>
        <? foreach ($yui as $value) { ?>
    <tr>
        <td align="center">
            <?= $value->id ?>
        </td>
        <td align="center">
            <?= $value->last_name ?>
        </td>
        <td align="center">
            <?= $value->first_name ?>
        </td>
        <td align="center">
            <?= $value->middle_name ?>
        </td>
        <td align="center">
            <?= $value->sectors->sector ?></td>
        </td>
        <td align="center">
            <?= $value->departments->structure_category ?></td>
        </td>
        <td align="center">
            <?= $value->status ?>
        </td>
    </tr>

    <?php } ?>
</table>
