<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Tasker</title>
        <link rel="stylesheet" type="text/css" href="/application/css/main.css" media="screen" />
        
        
        <script src="/application/scripts/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="/application/scripts/FusionChart/fusioncharts.js"></script>
        <script type="text/javascript" src="/application/scripts/FusionChart/themes/fusioncharts.theme.fint.js"></script>
        
        <script src="/application/Scripts/modernizr-2.6.2.js"></script>
        <!--<script src="/application/scripts/jquery-1.10.2.js"></script>-->
        
        <script type="text/javascript" src="/application/scripts/bootstrap.js" async="async"></script>
        
        <script src="/application/Scripts/respond.js"></script>
        <script src="/application/Scripts/ajax.js"></script>
        <script src="/application/Scripts/Chart.js"></script>
        <script src="/application/Scripts/GantGraph.js"></script>

        
        
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
                        <li><a onclick="renderResponse('GET', '', '/task/selectTask');">Задачи группы</a></li>
                        <li><a onclick="renderResponse('GET', '', '/user/selectUser');">Коллеги</a></li>
                        <li><a onclick="renderResponse('GET', '', '/chart/showWeek'); createChart(); createGanttChart();">Графики</a></li>
                        <li><a onclick="renderResponse('GET', '', '/home/get/contact');">Поиск сотрудника</a></li>
                        <li><a onclick="renderResponse('GET', '', '/task/criticalTask');">Личные задачи</a></li>
                        <!--<li><a onclick="renderItemInfo('GET', '', '/test/updateData');">TEST</a></li>-->
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
        <div id='modalWindow' class='modalWindow'>
        <!--<table>
            <tr><td id="restName"></td></tr>
            <tr><td id="restRep"></td></tr>
            <tr><td id="restEmail"></td></tr>
            <tr><td id="restPhone"></td></tr>
        </table>-->
            <div class="modalWindow-table">
                <div class="modalWindow-cell">
                    <div id='modalWindow-container' class='modalWindow-container'>
                        <div href="" class="close" onclick="$('#modalWindow').fadeToggle(350);"></div>
                        <div id='modalWindow-content' class='modalWindow-content'></div>
                    </div>
                </div>
            </div>
            <p>
                <a class='btn' onclick="$('#modalWindow').toggle(350);">&laquo; Вернуться</a>
            </p>
        </div>
    </body>    
    
</html>
