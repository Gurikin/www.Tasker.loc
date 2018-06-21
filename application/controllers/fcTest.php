<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fcTest
 *
 * @author gurik
 */
class fcTest {
    //put your code here
}

?>

<?php

/* Include the `fusioncharts.php` file that contains functions    to embed the charts. */

   include("includes/fusioncharts.php");

/* The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */

   $hostdb = "localhost";  // MySQl host
   $userdb = "root";  // MySQL username
   $passdb = "";  // MySQL password
   $namedb = "fusioncharts_phpsample";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
   if ($dbhandle->connect_error) {
      exit("There was an error with your connection: ".$dbhandle->connect_error);
   }
?>

<html>
   <head>
      <title>FusionCharts XT - Column 2D Chart - Data from a database</title>
    <link  rel="stylesheet" type="text/css" href="css/style.css" />

      <!-- You need to include the following JS file to render the chart.
      When you make your own charts, make sure that the path to this JS file is correct.
      Else, you will get JavaScript errors. -->

      <script src="fusioncharts/fusioncharts.js"></script>
  </head>

   <body>
      <?php

         // Form the SQL query that returns the top 10 most populous countries
         $strQuery = "SELECT Name, Population FROM Country ORDER BY Population DESC LIMIT 10";

         // Execute the query, or else return the error message.
         $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

         // If the query returns a valid response, prepare the JSON string
         if ($result) {

  $arrData = array(
        "chart" => array(
            "caption"=> "Harry's SuperMart",
            "subCaption"=> "Sales analysis of last year",
            "xAxisname"=> "Month",
            "yAxisName"=> "Revenues (In USD)",
            "numberPrefix"=> "$",
            "legendItemFontColor"=> "#666666",
            "theme"=> "zune"
            )
          );
          // creating array for categories object

          $categoryArray=array();
          $dataseries1=array();
          $dataseries2=array();
          $dataseries3=array();

          // pushing category array values
          while($row = mysqli_fetch_array($result)) {
            array_push($categoryArray, array(
            "label" => $row["category"]
          )
        );
        array_push($dataseries1, array(
          "value" => $row["value1"]
          )
        );

        array_push($dataseries2, array(
          "value" => $row["value2"]
          )
        );
        array_push($dataseries3, array(
          "value" => $row["value3"]
          )
        );

      }

      $arrData["categories"]=array(array("category"=>$categoryArray));
      // creating dataset object
      $arrData["dataset"] = array(array("seriesName"=> "Actual Revenue", "data"=>$dataseries1), array("seriesName"=> "Projected Revenue",  "renderAs"=>"line", "data"=>$dataseries2),array("seriesName"=> "Profit",  "renderAs"=>"area", "data"=>$dataseries3));


      /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
      $jsonEncodedData = json_encode($arrData);

      // chart object
      $msChart = new FusionCharts("gantt", "ganttChart" , "800", "600", "ch-c", "json", $jsonEncodedData);

      // Render the chart
      $msChart->render();

      // closing db connection
      $dbhandle->close();

   }

?>

      <div id="chart-1"><!-- Fusion Charts will render here--></div>

   </body>

</html>
