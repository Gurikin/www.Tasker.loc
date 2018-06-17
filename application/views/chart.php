<h2>График производительности</h2>

<!--<table class="table">
    <tr>
        <th>
            Пн
        </th>
        <th>
            Вт
        </th>
        <th>
            Ср
        </th>
        <th>
            Чт
        </th>
        <th>
            Пт
        </th>
        <th>
            Сб
        </th>
        <th>
            Вс
        </th> 
        
        <script language="javascript" type="text/javascript">fch();</script>

<?php
/*
 * =====Вывод данных в форме календаря за неделю =====
 * ===== вывод производиться в форме таблицы с =======
 * ===== окрашиванием ячеек и выводом количества ======
 * ===== выполненных/назначенных/просроченных задач ==
 * TODO посмотреть, может лучше стоит попробовать выводить 
 * задачи в формате timeline (see http://visjs.org/timeline_examples.html )
 */
/*
  echo "<tr>";
  foreach($this->calendar['completeTask'] as $key=>$day) {
  echo "<td align='center' style='vertical-align: middle;'>".$key."</th>";
  }
  echo "</tr>";
  echo "<tr>";
  foreach($this->calendar['completeTask'] as $key=>$day) {
  if (count($day) != 0) {
  echo "<td class = 'completeTask' height='150px' align='center' style='background: #aec; vertical-align: middle;'>";
  echo "<div>".count($day)."</div>";
  echo "</td>";
  } else {
  echo "<td height='100px' align='center' style='vertical-align: middle;'>";
  echo "</td>";
  }
  }
  echo "</tr>"; */
?>
</table>-->

<button id="c" onclick="fch();">Create Gantt Chart</button>
<div id="chart-container" class="chart-container" style="position: relative; height:16vh; width:16vw">
    <canvas id="myChart"></canvas>
</div>
<br><br><br><pre> <div id='ch-c'>Gant Graph</div></pre>
<script type="text/javascript">
    fch();
</script> 
<?php
//print_r($this->calendar['completeTask']);
//echo "<br></pre>";
//echo '<script type="text/javascript" src="/application/scripts/loadCharts.js"></script>';
?>