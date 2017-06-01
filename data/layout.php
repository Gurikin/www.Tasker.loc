<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Tasker</title>
        <link rel="stylesheet" type="text/css" href="/application/css/main.css" media="screen" />

        <script src="/application/Scripts/modernizr-2.6.2.js"></script>
        <script src="/application/scripts/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="/application/scripts/bootstrap.js" async="async"></script>
        <script src="/application/Scripts/respond.js"></script>
        <script src="/application/Scripts/ajax.js"></script>
        <script src="/application/Scripts/Chart.js"></script>

    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" onclick="renderResponse('GET', '', '/');">Tasker</a><!--<a class="navbar-brand" href="/">Tasker</a>-->
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a onclick="renderResponse('GET', '', '/home/get/about');">О программе</a></li>
                        <li><a onclick="renderResponse('GET', '', '/task/selectTask');">Задачи</a></li>
                        <li><a onclick="renderResponse('GET', '', '/user/selectUser');">Рабочая группа</a></li>
                        <li><a onclick="renderResponse('GET', '', '/chart/showWeek');">График</a></li>
                        <li><a onclick="renderResponse('GET', '', '/home/get/contact');">Контакт</a></li>
                        <li><a onclick="renderResponse('GET', '', '/task/criticalTask');">Актуальные задачи</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="container body-content" class="container body-content">|||            
            <hr />
            <footer>
                <p>&copy; 2017 – BIV</p>
            </footer>
        </div>
    </body>
</html>
