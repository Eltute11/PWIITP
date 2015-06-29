<?php 
	session_start();

	include_once('aside.php');
 

$link = mysql_connect('localhost', 'root', '');
mysql_select_db("seguridadlandia"); 

// HISTORIAL DE ALARMAS REALES
$mysql_R = "SELECT COUNT(real_falsa) FROM hist_alarmas_hogar WHERE cod_alarma_hist = 1 AND real_falsa = 'R';";
$query_R = mysql_query($mysql_R);

if($query_R == FALSE) { 
    		die(mysql_error());
		}
	while($line = mysql_fetch_array($query_R)) {
	    $real = $line[0];
	}


// HISTORIAL DE ALARMAS FALSAS
$mysql_F= "SELECT COUNT(real_falsa) FROM hist_alarmas_hogar WHERE cod_alarma_hist = 1 AND real_falsa = 'F';";
$query_F= mysql_query($mysql_F);

if($query_F == FALSE) { 
    		die(mysql_error()); // 
		}
	while($line = mysql_fetch_array($query_F)) {
	    $falsa = $line[0];
	}

?>

  <div id="content" class="app-content" role="main">
    <div class="app-content-body ">
      

<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Beauty Your Data</h1>
</div>
<div class="wrapper-md">
  <div ng-controller="FlotChartDemoCtrl">
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading font-bold">Spline</div>
          <div class="panel-body">
            <div ui-jq="plot" ui-options="
              [
                { data: [ [1,6.5],[2,6.5],[3,7],[4,8],[5,7.5],[6,7],[7,6.8],[8,7],[9,7.2],[10,7],[11,6.8],[12,7] ], points: { show: true, radius: 6}, splines: { show: true, tension: 0.45, lineWidth: 5, fill: 0 } }
              ], 
              {
                colors: ['#23b7e5'],
                series: { shadowSize: 3 },
                xaxis:{ 
                  font: { color: '#ccc' },
                  position: 'bottom',
                  ticks: [
                    [ 1, 'Jan' ], [ 2, 'Feb' ], [ 3, 'Mar' ], [ 4, 'Apr' ], [ 5, 'May' ], [ 6, 'Jun' ], [ 7, 'Jul' ], [ 8, 'Aug' ], [ 9, 'Sep' ], [ 10, 'Oct' ], [ 11, 'Nov' ], [ 12, 'Dec' ]
                  ]
                },
                yaxis:{ font: { color: '#ccc' } },
                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },
                tooltip: true,
                tooltipOpts: { content: '%x.1 is %y.4',  defaultTheme: false, shifts: { x: 0, y: 20 } }
              }
            " style="height:240px" >
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading font-bold">Multiple</div>
          <div class="panel-body">
            <div ui-jq="plot" ui-options="
              [
                { data: [ [0,7],[1,6.5],[2,12.5],[3,7],[4,9],[5,6],[6,11],[7,6.5],[8,8],[9,7] ], label: 'Unique Visits', points: { show: true } }, 
                { data: [ [0,4],[1,4.5],[2,7],[3,4.5],[4,3],[5,3.5],[6,6],[7,3],[8,4],[9,3] ], label: 'Page Views', bars: { show: true, barWidth: 0.6, fillColor: { colors: [{ opacity: 0.2 }, { opacity: 0.4}] } } }
              ],
              {                
                colors: [ '#23b7e5','#27c24c' ],
                series: { shadowSize: 2 },
                xaxis:{ font: { color: '#ccc' } },
                yaxis:{ font: { color: '#ccc' } },
                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },
                tooltip: true,
                tooltipOpts: { content: '%s of %x.1 is %y.4',  defaultTheme: false, shifts: { x: 0, y: 20 } }
              }
            " style="height:240px"></div>
          </div>                  
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading font-bold">Order bar</div>
          <div class="panel-body">
            <div ui-jq="plot" ui-options="
              [ 
                { label: 'A', data: [ [10, 120], [20, 70], [30, 70], [40, 60] ] },
                { label: 'B', data: [ [10, 50],  [20, 60], [30, 90],  [40, 35] ] },
                { label: 'C', data: [ [10, 80],  [20, 40], [30, 30],  [40, 20] ] }
              ],
              {
                bars: { show: true, fill: true, lineWidth: 1, order: 1, fillColor: { colors: [{ opacity: 0.5 }, { opacity: 0.9}] } },
                colors: ['#23b7e5', '#27c24c', '#7266ba'],
                series: { shadowSize: 1 },
                xaxis:{ font: { color: '#ccc' } },
                yaxis:{ font: { color: '#ccc' } },
                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },                
                tooltip: true
              }
            " style="height:240px"></div>
          </div>                  
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading font-bold">Bar</div>
          <div class="panel-body">
            <div ui-jq="plot" ui-options="
              [
                { data: [ [10, 80],  [20, 40], [30, 30],  [40, 20] ], label: 'Pressure', color: '#23b7e5' }
              ],
              {
                bars: { show: true, barWidth: 0.6, fillColor: { colors: [{ opacity: 0.5 }, { opacity: 0.9}] }  },
                xaxis: { font: { color: '#ccc' } },
                yaxis: { font: { color: '#ccc' }, min: -2, max: 2 },
                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },
                series: { shadowSize: 1 },
                tooltip: true
              }
            " style="height:240px"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading font-bold">Compose</div>
          <div class="panel-body">
            <div ui-jq="plot" ui-options="
              [
                { data: [ [0,7],[1,6.5],[2,12.5],[3,7],[4,9],[5,6],[6,11],[7,6.5],[8,8],[9,7] ], label: 'A', points: { show: true }, lines: { show: true, fill: true, fillColor: { colors: [{ opacity: 0.1 }, { opacity: 0.1}] } } }, 
                { data: [ [0,4],[1,4.5],[2,7],[3,4.5],[4,3],[5,3.5],[6,6],[7,3],[8,4],[9,3] ], label: 'B', points: { show: true, radius: 4 } }
              ],
              {
                colors: [ '#23b7e5','#fad733' ],
                series: { shadowSize: 2 },
                xaxis:{ font: { color: '#ccc' } },
                yaxis:{ font: { color: '#ccc' } },
                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },
                tooltip: true,
                tooltipOpts: { content: '%s of %x.1 is %y.4',  defaultTheme: false, shifts: { x: 0, y: 20 } }
              }
            " style="height:240px"></div>
          </div>                  
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading font-bold">Donut Pie</div>
          <div class="panel-body">
            <div ui-jq="plot" ui-options="
              [ [10, 80],  [20, 40], [30, 30],  [40, 20] ],
              {
                series: { pie: { show: true, innerRadius: 0.5, stroke: { width: 0 }, label: { show: true, threshold: 0.05 } } },
                colors: ['#7266ba','#23b7e5','#27c24c','#fad733','#f05050'],
                grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },   
                tooltip: true,
                tooltipOpts: { content: '%s: %p.0%' }
              }
            " style="height:240px"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">Pie</div>
        <div class="panel-body text-center">              
          <div ui-jq="sparkline" ui-options="[60,40], {type:'pie', height:154, sliceColors:['#23b7e5','#eaeeea']}" class="sparkline inline"></div>
          <div class="line pull-in"></div>
          <div class="text-xs">
            <i class="fa fa-circle text-info"></i> 60%
            <i class="fa fa-circle text-muted m-l"></i> 40%
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">Data graph</div>
        <div class="bg-light dker wrapper m-t-n-xxs">
          <span class="pull-right">Friday</span>
          <span class="h4">$540</span>
          <div class="text-center m-b-n m-t-sm">
              <div ui-jq="sparkline" ui-options="[50.32,45.23,47.56,36.25,53.85,40.15,41.25,50.15,57.14,36.15,97.26,50.15,45.32,47.19,37.75,25.15,56.34,50.35,47.25,53.15], {type:'line', height:65, width: '100%', lineWidth:2, valueSpots:{'0:':'#fff'}, lineColor:'#fff', spotColor:'#fff', fillColor:'', highlightLineColor:'#fff', spotRadius:3}"></div>

              <div ui-jq="sparkline" ui-options="[ 10,9,11,10,11,10,12,10,9,10,11,9,8 ], {type:'bar', height:45, barWidth:6, barSpacing:6, barColor:'#7266ba'}" class="sparkline inline">loading...</div>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-4">
              <small class="text-muted block">Market</small>
              <span>$1500.00</span>
            </div>
            <div class="col-xs-4">
              <small class="text-muted block">Referal</small>
              <span>$600.00</span>
            </div>
            <div class="col-xs-4">
              <small class="text-muted block">Affiliate</small>
              <span>$400.00</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">Stacked</div>
        <div class="panel-body">
          <div class="m-b-md">
            <p class="h3 font-thin">Investings</p>
            Avarage investing in last year.
          </div>
          <div class="row m-b">
            <div class="col-xs-6">
              <div ui-jq="sparkline" ui-options="[ [2, 8], [4, 6], [6, 4], [8, 2], [10, 0], [8, 2], [6, 4], [4, 6], [2,8] ], {type:'bar', height:112, barWidth:6, barSpacing:10, stackedBarColor:['#27c24c', '#d7e5e8']}" class="sparkline inline"></div>
            </div>
            <div class="col-xs-6">
              Revenue
              <div class="h3 text-black m-b">4500,00</div>
              Costs
              <div class="h3 text-success">3450,00</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">
          Easypiechart
        </div>
        <div class="panel-body text-center">
          <h4>62.5<small> hrs</small></h4>
          <small class="text-muted block">Updated at 2 minutes ago</small>
          <div class="inline">
            <div ui-jq="easyPieChart" ui-options="{
                      percent: 75,
                      lineWidth: 10,
                      trackColor: '#e8eff0',
                      barColor: '#fad733',
                      scaleColor: '#e8eff0',
                      size: 188,
                      lineCap: 'butt'
                    }">
              <div>
                <span class="h2 m-l-sm step">75</span>%
                <div class="text text-sm">new</div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer"><small>% of avarage rate of the Conversion</small></div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">
          Animate
        </div>
        <div class="panel-body text-center">
          <h4><small>last </small>12<small> hrs</small></h4>
          <small class="text-muted block">yesterday: 20%</small>
          <div class="inline">
            <div ui-jq="easyPieChart"  ui-options="{
                      percent: 25,
                      lineWidth: 10,
                      trackColor: '#e8eff0',
                      barColor: '#27c24c',
                      scaleColor: '#e8eff0',
                      size: 188,
                      lineCap: 'butt',
                      animate: 1000
                    }">
              <div>
                <span class="h2 m-l-sm step">25</span>%
                <div class="text text-sm">today</div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer"><small>% of change</small></div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">
          Rotate
        </div>
        <div class="panel-body text-center">
          <h4>3,450</h4>
          <small class="text-muted block">Worldwide visitors</small>
          <div class="inline m-t m-b">
            <div ui-jq="easyPieChart" ui-options="{
                      percent: 50,
                      lineWidth: 10,
                      trackColor: '#e8eff0',
                      barColor: '#23b7e5',
                      scaleColor: false,
                      size: 158,
                      rotate: 90,
                      lineCap: 'butt'
                    }">
              <div>
                <span class="h2 m-l-sm step">50</span>%
                <div class="text text-sm">new visits</div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer"><small>% of avarage rate of the visits</small></div>
      </div>
    </div>
  </div>
</div>


    </div>
  </div>
  <!-- / content -->

  <?php include_once('footer.php'); ?>