<h1> Таблица секторов</h1>
<table border="2" align="center">
    <tr>
        <th>Сектор</th>
    </tr>
    <? foreach ($sec as $value) { ?>
        <tr>
            <td align="center">
                <?= $value->sector ?>
            </td>
        </tr>
    <?php } ?>
</table>
