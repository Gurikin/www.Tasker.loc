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
                    foreach ($taskField as $user) {
                        $taskUsers .= $user;
                    }
                    echo "<td style='white-space: nowrap;'>". $taskUsers . "</td>";
                default: break;
            }
        }
        echo "</tr>";
    }
    ?>
</table>