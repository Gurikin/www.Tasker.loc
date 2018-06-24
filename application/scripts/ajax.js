function sendRequest(requestType, JSONreq, requestUrl) {
    var req = new XMLHttpRequest();
    req.open(requestType, requestUrl, true);
    req.send(JSONreq);
    return req;
}

function renderResponse(requestType, JSONreq, requestUrl) {
    var req = sendRequest(requestType, JSONreq, requestUrl);
    req.onreadystatechange = function () {
        if (req.readyState !== 4)
            return;
        if (req.status !== 200) {
            //handle of error
            alert(req.status + ': ' + req.statusText);
        } else {
            var response = document.getElementById("container body-content");
            response.innerHTML = req.responseText;
        }
    };
}

/* Article FructCode.com */
function sendForm(result_form, ajax_form, url) {
    $( document ).ready(function() {
    $("#ajax-post").click(
		function(){
			sendAjaxForm(result_form, ajax_form, url);
			return false; 
		}
	);
    });
}
 
function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
            alert(response);
            //result = $.parseJSON(response);            
            //$('#'+result_form).html(result);            
            $('#modalWindow').toggle(350);
    	},
    	error: function(response) { // Данные не отправлены
            $('#'+result_form).html('Ошибка. Данные не отправлены.');
    	}
    });    
}

function renderItemInfo(requestType, JSONreq, requestUrl) {
    var req = sendRequest(requestType, JSONreq, requestUrl);
    req.onreadystatechange = function () {
        if (req.readyState !== 4)
            return;
        if (req.status !== 200) {
            //handle of error
            alert(req.status + ': ' + req.statusText);
        } else {
            //var response = document.getElementById("restDetails");
            //response.innerHTML = req.responseText;
            //var div = $("<div id='restDetails' class='restDetails'></div>");
            //$("#container body-content").append(div);
            $("#modalWindow").fadeToggle(350);
            //$("#modalWindow").css("display:block");
            $("#modalWindow-content").html(req.responseText);
            //$("#modalWindow-container").css("display:inline-block; vertical-align: middle");
            //$("#modalWindow-container").toggle(350);
        }
    };
}

function userInfo() {
    this.firstName = '';
    this.secondName = '';
    this.middleName = '';
    this.jobTitle = '';
    this.phone = 0000;
    this.tasks = {
        'tastTitle': '',
        'orderDate': null,
        'endDate': null,
        'progress': 0
    };
}

function createChart() {
    $(document).ready(function() {
        var req = sendRequest('GET', '', '/chart/getUserEfficiencyChart');
      req.onreadystatechange = function () {
          if (req.readyState !== 4)
              return;
          if (req.status !== 200) {
              //handle of error
              alert(req.status + ': ' + req.statusText);
          } else {
  //      var response = document.getElementById("container body-content");
  //      response.innerHTML = req.responseText;              
              var us = JSON.parse(req.responseText);
              console.log(us);
              createPieChart("myChart", us.users, us.efficiency);
          }
      };    
    });
}

function createPieChart(ctxElementId, labels, data) {
    var ctx = document.getElementById(ctxElementId);
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels,
            datasets: [{
                    label: '# of Votes',
                    data,
                    backgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56"
                    ],
                    hoverBackgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56"
                    ]
                }]
        }
    });
}

function userEfficiency() {
    this.secondName = "";
    this.taskCount = 0;
}

