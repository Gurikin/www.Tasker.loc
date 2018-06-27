<h2>Рабочая группа</h2>
<p>
    <a onclick="renderItemInfo('GET', '', '/user/create')">Добавить сотрудника</a>
</p>
<table class="table">
    <tr>
        <th>
            Имя
        </th>
        <th>
            Фамилия
        </th>
        <th>
            Отчество
        </th>
        <th>
            Должность
        </th>
        <th>
            Назначенные задачи
        </th>
        <th></th>
    </tr>

    <?php
    for ($i = 0; $i < count($this->userList); $i++) {
        echo "<tr>";
        foreach ($this->userList[$i] as $userCol => $userField) {

            if (!is_array($userField)) {// && $userCol != 'user_id') {
                switch ($userCol) {
                    case 'user_id': break;
                    case 'secondName':
                        printf("<td><a onclick=\"renderItemInfo('GET', '', '/user/selectUserConst/id/%s')\">%s</a></td>", $this->userList[$i]['user_id'], $userField);
                        break;
                    default:
                        echo "<td>$userField</td>";
                        break;
                }
                //echo "<td>$userField</td>";
            } else {
                $userTasksCount = count($userField);
            }
        }
        echo "<td style='wordwrap: break-word; white-space: nowrap;'>$userTasksCount</td>";
        echo "</tr>";
    }
    ?>
</table>