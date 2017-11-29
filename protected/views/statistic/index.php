<?php
$this->breadcrumbs=array(
	'Статистика',
);
?>

<h1 style="z-index: 2; position: absolute; margin-left: 400px; ">Статистика торговли</h1>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Даты');
        data.addColumn('number', 'Доход');
        data.addRows([
          <?php
          	foreach ($dataProvider as $value) {
				echo '[new Date('.(strtotime($value['day'])*1000).'),'.($value['amount']*($value['direction']==0?(-1):1)).'],';//????? $value['id']=S Что за S??????
			}
          ?>
        ]);
        
        var options = {title:'Статистика по доходам',   
                    backgroundColor:'#eee',
                    hAxis: {
			        	title: 'Дата'
			        },
			        vAxis: {
			          title: 'Доходность(в долларах США)'
			        },
          			legend: { position: 'none'}
                     };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <div id="chart_parent" style="margin-left:-240px;">
      <div class="center-column" style="margin-left:80px;">
      	<a href="/statistic/create" class="btn">Добавить запись</a>
       	<a href="/statistic/admin" class="btn">Просмотреть все записи</a>
      </div>
      <div id="chart_div" style="width: 1400px; height: 800px;"></div>
    </div>