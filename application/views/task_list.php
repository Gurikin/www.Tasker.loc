<h2>Список задач</h2>

<p>
    <a href="./create">Добавить задание</a>
</p>


<table class="table">
    <tr>
        <th>
            Название
        </th>
        <th>
            Дата назначения
        </th>
        <th>
            Дата начала выполнения
        </th>
        <th>
            Дата завершения
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
        <th></th>
    </tr>

    <?php
    for ($i = 1; $i <= count($this->taskList); $i++) {
        echo "<tr>";
        foreach ($this->taskList[$i] as $taskCol => $taskField) {
            switch ($taskCol) {
                case 'id' : break;
                case 'taskTitle';
                case 'progress';
                case 'description';
                    echo "<td>$taskField</td>";
                    break;
                case 'orderDate';
                case 'beginDate';
                case 'endDate';
                    $timeStamp = strtotime($taskField);
                    $date = date('d.m.Y', $timeStamp);
                    //$time = date('H:i:s',$timeStamp);
                    echo "<td>$date</td>";
                    break;
                case 'users' :
                    $taskUsers = '';
                    echo "<td style='white-space: nowrap;'>";
                    foreach ($taskField as $user) {
                        if (!empty($user)) {
                            printf("<a href='/user/selectUserConst/id/%s'>%s %s<br></a>", $user["user_id"], $user["firstName"], $user["secondName"]);
                        }
                        //echo "<a href='/user/selectSingleUser/id/".$user["user_id"]."'>".$user["firstName"].$user["secondName"]. "</a>";
                        
                        //$taskUsers .= $user;
                    }
                    echo "</td>";
                    //echo "<td style='white-space: nowrap;'><a href='/user/selectSingleUser/' ". $taskUsers . "</td>";
                default: break;
            }
        }
        echo "</tr>";
    }
    ?>
</table>