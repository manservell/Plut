<h1> Таблица кодов работ</h1>
<table border="2" align="center">
    <tr>
        <th>Код работ</th>
        <th>Наименование работ</th>
        <th>Вид работ</th>
        <th>Статус</th>
    </tr>
        <? foreach ($cod as $value) { ?>
    <tr>
        <td align="center">
            <?= $value->code ?>
        </td>
        <td align="center">
            <?= $value->name ?>
        </td>
        <td align="center">
            <?= $value->types->type ?></td>
        </td>
        <td align="center">
            <?= $value->note ?>
        </td>
    </tr>

    <?php } ?>
</table>
