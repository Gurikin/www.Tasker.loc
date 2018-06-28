<h2>Список задач</h2>

<p>
    <a onclick="renderItemInfo('GET', '', '/task/create')">Добавить задачу</a>
</p>


<table class="table">
    <tr>
        <th>
            Название
        </th>
        <th>
            Приступить к выполнению
        </th>
        <th>
            Дата начала выполнения
        </th>
        <th>
            Требуется закончить
        </th>
        <th>
            Фактическая дата завершения
        </th>
        <th>
            Прогресс выполнения
        </th>
        <th>
            Описание
        </th>
        <th>
            Кому назначена
        </th>
        <th>CRUD</th>
    </tr>

    <?php
    for ($i = 1; $i <= count($this->taskList); $i++) {
        echo "<tr>";
        foreach ($this->taskList[$i] as $taskCol => $taskField) {
            switch ($taskCol) {
                case 'id' : break;
                case 'taskTitle';
                    echo "<td><a onclick=\"renderItemInfo('GET', '', '/task/singleTask/id/".$this->taskList[$i]['id']."')\">".$taskField."</a></td>";
                    break;
                case 'progress';
                case 'description';
                    echo "<td>$taskField</td>";
                    break;
                case 'orderDate';
                case 'beginDate';
                case 'endDate';
                case 'factEndDate':
                    $timeStamp = strtotime($taskField);
                    if ($timeStamp != 0) {
                        $date = date('d.m.Y', $timeStamp);
                        echo "<td>$date</td>";
                    } else {
                        echo "<td></td>";
                    }                    
                    break;
                case 'users' :
                    $taskUsers = '';
                    echo "<td style='white-space: nowrap;'>";
                    foreach ($taskField as $user) {
                        if (!empty($user)) {
                            printf("<a onclick=\"renderItemInfo('GET', '', '/user/selectUserConst/id/%s');\">%s %s<br></a>", $user["user_id"], $user["firstName"], $user["secondName"]);
                        }
                    }
                    echo "</td>";
                default: echo"<td align='center' valign='middle'><i class='fas fa-times'></i></td>"; break;
            }
        }
        echo "</tr>";
    }
    ?>
</table>