<div id="graficos" class="container">
  <div class="row">
    <div class="col-md-6"> <a href="/backend/estadistica" class="btn btn-default">Ver Reporte de Clientes</a></div>
  </div>
  <div class="row"><div class="col-md-12"><h2>Reporte de Atenciones</h2></div></div>
  <div class="row">
    <div class="col-md-6">
        <div class="Panel with panel-primary class">
           <div style="background-color: #003399;" class="panel-heading">
                <h3 class="text-center">Cantidad de atenciones</h3>
                <h6 class="text-center">Por meses</h6>
            </div>
            <div class="panel-body">
                <div class="grafico" id="atencionPorMeses"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="Panel with panel-primary class">
            <div style="background-color: #b34da0" class="panel-heading">
                <h3 class="text-center">Cantidad de atenciones</h3>
                <h6 class="text-center">Por rango de fechas</h6>
            </div>
            <div class="panel-body">
                <div class="grafico" id="atencionesRangoFechas"></div>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
       <div class="Panel with panel-default class">
            <div style="background-color: #00cc66;" class="panel-heading">
                <h3 class="text-center">Cantidad atenciones por Estado</h3>
            </div>
            <div class="panel-body">
                <div class="grafico" id="atencionesEstados"></div>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
       <div class="Panel with panel-default class">
            <div style="background-color: #00cc66;" class="panel-heading">
                <h3 class="text-center">Cantidad atenciones por abogado</h3>
            </div>
            <div class="panel-body">
                <div class="grafico" id="atencionesAbogados"></div>
            </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
        <div class="Panel with panel-default class">
            <div style="background-color: #ff9300;" class="panel-heading">
                <h3 class="text-center">Cantidad atenciones por especialidad</h3>
            </div>
            <div class="panel-body">
                <div class="grafico" id="atencionesEspecialidad"></div>
            </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="/js/highcharts.js"></script>
<script type="text/javascript">
    Highcharts.chart('atencionPorMeses', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: <?=json_encode($chart['meses']['categories'])?>,
            crosshair: true,
            title: {
                text: 'Meses'
            }
        },
        yAxis: {
            min: 0,
            tickInterval: 1,
            title: {
                text: 'Cantidad'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0; font-size:15px;">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Cantidad de atenciones',
            data: <?=json_encode($chart['meses']['series'])?>

        }]
    });

    Highcharts.chart('atencionesRangoFechas', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: <?=json_encode($chart['fechas']['categories'])?>,
            crosshair: true
        },
        yAxis: {
            min: 0,
            tickInterval: 1,
            title: {
                text: 'Cantidad'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0; font-size:15px;">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                color: '#b34da0'
            }
        },
        series: [{
            name: 'Cantidad de atenciones',
            data: <?=json_encode($chart['fechas']['series'])?>

        }]
    });

    Highcharts.chart('atencionesEstados', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: <?=json_encode($chart['estados']['categories'])?>,
            crosshair: true,
            title: {
                text: 'Estado'
            }
        },
        yAxis: {
            min: 0,
            tickInterval: 1,
            title: {
                text: 'Cantidad'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0; font-size:15px;">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Cantidad de atenciones',
            data: <?=json_encode($chart['estados']['series'])?>

        }]
    });

    Highcharts.chart('atencionesAbogados', {
        chart: {
            type: 'line'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: <?=json_encode($chart['abogados']['categories'])?>
        },
        yAxis: {
            tickInterval: 1,
            title: {
                text: 'Cantidad atenciones'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false,
                color: '#55c639'
            }
        },
        series: [{
            name: 'Cantidad atenciones',
            data: <?=json_encode($chart['abogados']['series'])?>
        },]
    });

    Highcharts.chart('atencionesEspecialidad', {
        chart: {
            type: 'line'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: <?=json_encode($chart['especialidad']['categories'])?>
        },
        yAxis: {
            tickInterval: 1,
            title: {
                text: 'Cantidad atenciones por especialidad'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false,
                color: '#ff9300'
            }
        },
        series: [{
            name: 'Cantidad atenciones',
            data: <?=json_encode($chart['especialidad']['series'])?>
        },]
    });
</script>
