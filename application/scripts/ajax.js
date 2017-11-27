function sendRequest(requestType, JSONreq, requestUrl) {
  var req = new XMLHttpRequest();
  req.open (requestType, requestUrl, true);
  req.send(JSONreq);
  return req;
}

function renderResponse (requestType, JSONreq, requestUrl) {
  var req = sendRequest(requestType, JSONreq, requestUrl);
  req.onreadystatechange = function() {
    if (req.readyState !== 4) return;
    if (req.status !== 200) {
      //handle of error
      alert (req.status + ': ' + req.statusText);
    } else {
      var response = document.getElementById("container body-content");
      response.innerHTML = req.responseText;
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
        'tastTitle':'',
        'orderDate':null,
        'endDate':null,
        'progress':0
    };
}

function createChart() {
  var req = sendRequest('GET', '', '/chart/getUserEffectivityChart');
  req.onreadystatechange = function() {
    if (req.readyState !== 4) return;
    if (req.status !== 200) {
      //handle of error
      alert (req.status + ': ' + req.statusText);
    } else {
      //var response = document.getElementById("container body-content");
      //response.innerHTML = req.responseText;
    }
  };
  var ctx = document.getElementById("myChart");
  var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: ["Red", "Blue", "Yellow"],
          datasets: [{
              label: '# of Votes',
              data: [12, 19, 3],
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
  
  function userTasks() {
    
  }