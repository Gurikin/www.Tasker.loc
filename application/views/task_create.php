<?php
//include_once '/application/models/Task_Class.php';
?>
<div id='modalWindow-content' class='modalWindow-content'>
    <form id="ajax-form" action="/task/add">

        <div class="form-horizontal">
            <h4>Создание новой задачи</h4>
            <hr />


            <div class="form-group">
                <label class="control-label col-md-2" for="taskTitle">Название задачи</label>
                <div class="col-md-10">
                    <input class="text-box single-line" id="taskTitle"  onchange="validateInput();" name="taskTitle" type="text" value="Task # "/>
                    <span id="errSN" value=""></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="beginDate">Приступить к выполнению</label>
                <div class="col-md-10">
                    <input class="text-box single-line" id="beginDate" onchange="validateInput();" name="beginDate" type="date" value="2018-06-25"/>
                    <span id="errMN" value=""></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="endDate">Срок выполнения</label>
                <div class="col-md-10">
                    <input class="text-box single-line" id="endDate" onchange="validateInput();" name="endDate" type="date" value="2018-06-26"/>
                    <span id="errJT" value=""></span>
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-md-2" for="progress">Процент завершенности</label>
                <div class="col-md-10">
                    <input class="text-box single-line" id="progress" name="progress" type="number" value="0" />
                    <span class="field-validation-valid"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="description">Описание задачи</label>
                <div class="col-md-10">
                    <input class="text-box single-line" id="description" name="description" type="text" value="Desctiption of task #" />
                    <span class="field-validation-valid"></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" value="Добавить" onclick="sendAjaxForm();"/>
                </div>
            </div>
        </div>
    </form>

    <div>
        <a onclick="$('#modalWindow').toggle(350);">Вернуться к списку</a>
    </div>
</div>
