    <div>
        <h4>Детальная информация о задаче</h4>
            <hr />
        <dl class='dl-horizontal'>
            <dt>Название</dt>

            <dd><?=$this->taskList['taskTitle']?></dd>

            <dt>Приступить к выполнению</dt>

            <dd><?=$this->taskList['orderDate']?></dd>

            <dt>Требуемый срок выполнения</dt>

            <dd><?=$this->taskList['endDate']?></dd>

            <dt>Прогресс выполнения</dt>

            <dd><?=$this->taskList['progress']?></dd>

            <dt>Детальное описание задачи</dt>

            <dd><?=$this->taskList['description']?></dd>
            
            <dt>Ответственные за выполнение задачи</dt>

            <dd>
            <?php
                foreach ($this->taskList['users'] as $users) {
                    echo "<div>".$users['secondName']." ".$users['firstName']."</div>";
                }
            ?></dd>
        </dl>
    </div>