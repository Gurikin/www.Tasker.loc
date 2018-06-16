<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Tasker</title>
        <link rel="stylesheet" type="text/css" href="/application/css/main.css" media="screen" />

        <script src="/application/Scripts/modernizr-2.6.2.js"></script>
        <!--<script src="/application/scripts/jquery-1.10.2.js"></script>-->
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="/application/scripts/bootstrap.js" async="async"></script>
        <script src="/application/Scripts/respond.js"></script>
        <script src="/application/Scripts/ajax.js"></script>
        <script src="/application/Scripts/Chart.js"></script>

        <script type="text/javascript" src="/application/scripts/FusionChart/fusioncharts.js"></script>
        <script type="text/javascript" src="/application/scripts/FusionChart/themes/fusioncharts.theme.fint.js"></script>
        <script type="text/javascript">
            function divCreate() {
                var div = document.createElement('div');
                div.id = "ch-c";
                //div.onload = function(){
                document.getElementById('container body-content').appendChild(div);
                //};
            }
            function fch() {
                $(document).ready(function() {
                    divCreate();
                    
                    FusionCharts.ready(function () {
                        var fusioncharts = new FusionCharts({
                            type: 'gantt',
                            renderAt: 'ch-c',
                            width: '650',
                            height: '400',
                            dataFormat: 'json',
                            dataSource: {
                                "chart": {
                                    "dateformat": "mm/dd/yyyy",
                                    "caption": "Social Media Optimization",
                                    "subcaption": "Project Plan",
                                    "theme": "fint",
                                    "canvasBorderAlpha": "30",
                                    "ganttPaneDuration": "3",
                                    "ganttPaneDurationUnit": "m"
                                },
                                "datatable": {
                                    "headervalign": "bottom",
                                    "datacolumn": [{
                                            "headertext": "Owner",
                                            "headerfontsize": "14",
                                            "headervalign": "bottom",
                                            "headeralign": "left",
                                            "align": "left",
                                            "fontsize": "12",
                                            "text": [{
                                                    "label": "John"
                                                }, {
                                                    "label": "David"
                                                }, {
                                                    "label": "Mary"
                                                }, {
                                                    "label": "John"
                                                }, {
                                                    "label": "Andrew & Harry"
                                                }, {
                                                    "label": "John & Harry"
                                                }, {
                                                    "label": "Neil & Harry"
                                                }, {
                                                    "label": "Neil & Harry"
                                                }, {
                                                    "label": "Chris"
                                                }, {
                                                    "label": "John & Richard"
                                                }]
                                        }]
                                },
                                "categories": [{
                                        "category": [{
                                                "start": "08/01/2014",
                                                "end": "09/30/2014",
                                                "label": "Q3"
                                            }, {
                                                "start": "10/01/2014",
                                                "end": "12/31/2014",
                                                "label": "Q4"
                                            }, {
                                                "start": "01/01/2015",
                                                "end": "03/31/2015",
                                                "label": "Q1"
                                            }]
                                    }, {
                                        "category": [{
                                                "start": "08/01/2014",
                                                "end": "08/31/2014",
                                                "label": "Aug '14"
                                            }, {
                                                "start": "09/01/2014",
                                                "end": "09/30/2014",
                                                "label": "Sep '14"
                                            }, {
                                                "start": "10/01/2014",
                                                "end": "10/31/2014",
                                                "label": "Oct '14"
                                            }, {
                                                "start": "11/01/2014",
                                                "end": "11/30/2014",
                                                "label": "Nov '14"
                                            }, {
                                                "start": "12/01/2014",
                                                "end": "12/31/2014",
                                                "label": "Dec '14"
                                            }, {
                                                "start": "01/01/2015",
                                                "end": "01/31/2015",
                                                "label": "Jan '15"
                                            }, {
                                                "start": "02/01/2015",
                                                "end": "02/28/2015",
                                                "label": "Feb '15"
                                            }, {
                                                "start": "03/01/2015",
                                                "end": "03/31/2015",
                                                "label": "Mar '15"
                                            }]
                                    }],
                                "processes": {
                                    "fontsize": "12",
                                    "align": "left",
                                    "headerText": "Steps",
                                    "headerFontSize": "14",
                                    "headerVAlign": "bottom",
                                    "headerAlign": "left",
                                    "process": [{
                                            "label": "Identify Customers"
                                        }, {
                                            "label": "Survey 500 Customers"
                                        }, {
                                            "label": "Interpret Requirements"
                                        }, {
                                            "label": "Market Analysis"
                                        }, {
                                            "label": "Brainstorm concepts"
                                        }, {
                                            "label": "Define Ad Requirements"
                                        }, {
                                            "label": "Design & Develop"
                                        }, {
                                            "label": "Mock test"
                                        }, {
                                            "label": "Documentation"
                                        }, {
                                            "label": "Start Campaign"
                                        }]
                                },
                                "tasks": {
                                    "task": [{
                                            "start": "08/04/2014",
                                            "end": "08/10/2014"
                                        }, {
                                            "start": "08/08/2014",
                                            "end": "08/19/2014"
                                        }, {
                                            "start": "08/19/2014",
                                            "end": "09/02/2014"
                                        }, {
                                            "start": "08/24/2014",
                                            "end": "09/02/2014"
                                        }, {
                                            "start": "09/02/2014",
                                            "end": "09/21/2014"
                                        }, {
                                            "start": "09/21/2014",
                                            "end": "10/06/2014"
                                        }, {
                                            "start": "10/06/2014",
                                            "end": "01/21/2015",
                                        }, {
                                            "start": "01/21/2015",
                                            "end": "02/19/2015"
                                        }, {
                                            "start": "01/28/2015",
                                            "end": "02/24/2015"
                                        }, {
                                            "start": "02/24/2015",
                                            "end": "03/27/2015"
                                        }]
                                }

                            }
                        }
                        );
                        fusioncharts.render();
                        //revenueChart.setChartAttribute("theme", "carbon");
                    });
                });                
            }
        </script>
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
                        <li><a onclick="renderResponse('GET', '', '/chart/showWeek'); fch(); createChart(); ">Графики</a></li>
                        <li><a onclick="renderResponse('GET', '', '/home/get/contact');">Поиск сотрудника</a></li>
                        <li><a onclick="renderResponse('GET', '', '/task/criticalTask');">Личные задачи</a></li>
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
    <script>
        $(document).ready(function() {
            var event = new Event("click");
            var elem = document.getElementById("circleChart");
            console.log(elem.tostring());
            if (elem) {
                elem.dispatchEvent(event);
            }            
        });        
    </script>
</html>
