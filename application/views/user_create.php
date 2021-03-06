<?php ?>
<div id='modalWindow-content' class='modalWindow-content'>

    <form action="./add" method="post">

        <div class="form-horizontal">
            <h4>Создание карточки сотрудника</h4>
            <hr />


            <div class="form-group">
                <label class="control-label col-md-2" for="secondName">Фамилия</label>
                <div class="col-md-10">
                    <input class="text-box single-line" id="secondName"  onchange="validateInput();" name="secondName" type="text" />
                    <span id="errSN" value=""></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="firstName">Имя</label>
                <div class="col-md-10">
                    <input class="text-box single-line" id="firstName" onchange="validateInput();" name="firstName" type="text" />
                    <span id="errFN" value=""></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="middleName">Отчество</label>
                <div class="col-md-10">
                    <input class="text-box single-line" id="middleName" onchange="validateInput();" name="middleName" type="text" />
                    <span id="errMN" value=""></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="jobTitle">Должность</label>
                <div class="col-md-10">
                    <input class="text-box single-line" id="jobTitle" onchange="validateInput();" name="jobTitle" type="text" />
                    <span id="errJT" value=""></span>
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-md-2" for="phone">Телефон</label>
                <div class="col-md-10">
                    <input class="text-box single-line" id="phone" name="phone" type="text" value="" />
                    <span class="field-validation-valid"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2" for="password">Пароль</label>
                <div class="col-md-10">
                    <input class="text-box single-line" id="password" name="password" type="text" value="" />
                    <span class="field-validation-valid"></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type="submit" value="Добавить" class="btn btn-default" />
                </div>
            </div>
        </div>
    </form>

    <div>
        <a href="./selectUser">Вернуться к списку</a>
    </div>
</div>

<?php
?>