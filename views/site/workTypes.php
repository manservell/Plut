<h1> Таблица видов работ</h1>
<table border="2" align="center">
    <tr>
        <th>Тип работ</th>
    </tr>
    <? foreach ($tp as $value) { ?>
        <tr>
            <td align="center">
                <?= $value->type ?>
            </td>
        </tr>
    <?php } ?>
</table>
