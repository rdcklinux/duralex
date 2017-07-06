<div id="graficos" class="container">
  <div class="row">
    <div class="col-md-6"> <a href="/backend/estadistica/atenciones" class="btn btn-default">Ver Reporte de Atenciones</a></div>
  </div>
  <div class="row"><div class="col-md-12"><h2>Reporte de Clientes</h2></div></div>
  <div class="row">
    <div class="col-md-6">
      <div class="Panel with panel-primary class">
           <div style="background-color: #003399;" class="panel-heading">
        <h3 class="text-center">Rango de antiguedad</h3>
        <h6 class="text-center">En meses</h6>
        </div>
        <div class="panel-body">
          <div class="grafico" id="rango"></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="Panel with panel-primary class">
      <div style="background-color: #b34da0" class="panel-heading">
        <h3 class="text-center">Cantidad de clientes</h3>
        <h6 class="text-center">Tipo de persona</h6>
        </div>
        <div class="panel-body">
          <div class="grafico" id="tipoPersona"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
    <div class="Panel with panel-default class">
        <div style="background-color: #ff9300;" class="panel-heading">
        <h3 class="text-center">Cantidad atenciones recibidas</h3>
        </div>
        <div class="panel-body">
          <div class="grafico" id="atenciones"></div>
        </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="/js/highcharts.js"></script>
<script type="text/javascript">
  Highcharts.chart('tipoPersona',{
      chart: {type: 'column'},
      title: {text: ''},
      subtitle: {text: ''},
      xAxis: { categories: <?=json_encode($chart['tipopersona']['categories'])?>, crosshair: true},
      yAxis: {min: 0, tickInterval: 1, title: {text: 'Cantidad'}},
      tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0; font-size:15px;">{series.name}: </td><td style="padding:0"><b>{point.y:1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      },
      plotOptions: {
        column: {
          pointPadding: 0.2,
          borderWidth: 0,
          enableMouseTracking: false,
          color: '#b34da0'
        }
      },
      series: [{name: 'Cantidad de clientes', data: <?=json_encode($chart['tipopersona']['series'])?>}]
  });

  Highcharts.chart('rango', {
      chart: {type: 'bar'},
      title: {text: ''},
      subtitle: {text: ''},
      xAxis: {categories: <?=json_encode($chart['rango']['categories'])?>, crosshair: true, title:{text: 'Meses'}},
      yAxis: {min: 0, tickInterval: 1, title: {text: 'Cantidad'}},
      tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0; font-size:15px;">{series.name}: </td><td style="padding:0"><b>{point.y:1f}</b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
      },
      plotOptions: {
          column: {
              pointPadding: 0.2,
              borderWidth: 0,
              enableMouseTracking: false,
              color: '#b34da0'
          }
      },
      series: [{name: 'Cantidad clientes', data: <?=json_encode($chart['rango']['series'])?>}]
  });

  Highcharts.chart('atenciones', {
      chart: {type: 'line'},
      title: {text: ''},
      xAxis: {categories: <?=json_encode($chart['atenciones']['categories'])?>},
      yAxis: {title: {text: 'Cantidad atenciones'}},
      plotOptions: {
          line: {
              dataLabels: {enabled: true},
              enableMouseTracking: false,
              color: '#ff9300'
          }
      },
      series: [{name: 'Cantidad atenciones', data:<?=json_encode($chart['atenciones']['series'])?>}]
  });
</script>
