<h1> Таблица сотрудников</h1>
<table border="2" align="center">
    <tr>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Сектор</th>
        <th>Категория по структуре отдела</th>
<? foreach ($emp as $employee) {?>
<tr>
    <td align="center">
    <?=$employee->last_name?>
    </td>
    <td align="center">
    <?=$employee->first_name?>
    </td>
    <td align="center">
        <?=$employee->middle_name?>
    </td>
    <td align="center">
        <?=$employee->department_id?>
    </td>
    <td  align="center">
        <?=$employee->sector_id?></td>
    </td>
</tr>

        <?php  }?>
</table>
