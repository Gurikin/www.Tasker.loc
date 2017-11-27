<h2>Список задач для пользователя <?=$_SESSION['secondName']." ".$_SESSION['firstName']?></h2>

<p>
    <a href="./create">Добавить задание</a>
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
        <th>CRUD</th>
    </tr>

    <?php
    for ($i = 0; $i < count($this->taskList); $i++) {
        echo "<tr>";
        foreach ($this->taskList[$i] as $taskCol => $taskField) {
            switch ($taskCol) {
                case 'id' : break;
                case 'taskTitle';
                    printf("<td><a onclick=\"renderResponse('GET', '', '/task/singleTask/id/%s')\">%s</a></td>", $this->taskList[$i]['task_id'], $taskField);
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
                default: echo"<td></td>"; break;
            }
        }
        echo "</tr>";
    }
    ?>
</table>