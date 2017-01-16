<h1> Таблица категорий по проектам</h1>
<table border="2" align="center">
    <tr>
        <th>Категории по проектам</th>
    </tr>
    <? foreach ($category as $value) { ?>
        <tr>
            <td align="center">
                <?= $value->responsible_for ?>
            </td>
        </tr>
    <?php } ?>
</table>
