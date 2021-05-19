<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <ol class="breadcrumb mb-4">
            </ol>
            <br>
            <div class="row">
                <div class="col-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            Productos : <?php echo $total; ?>
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/productos">Ver Detalles</a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            Ventas del dia : <?php echo $minimos; ?>
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/productos">Ver Detalles</a>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card text-white bg-secondary">
                        <div class="card-body">
                            Productos con strock minimo : <?php echo $total; ?>
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/productos/mostrarMinimos">Ver Detalles</a>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="card">
                <div class="card-header ">
                    <i class="fas fa-table mr-1"></i>
                    Productos con stock minimo
                </div>
                <div class="card-body">
                    <!-- HTML -->
                    <div id="chartdiv"></div>

                </div>
            </div>

        </div>
    </main>
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>


    <!-- Chart code -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartdiv", am4charts.XYChart);

            // Add data
            let url = 'http://localhost:3000/api/productos';
            fetch(url)
                .then(res => res.json())
                .then(data => mostrar(data))
                .catch(e => console.log(e))

            const mostrar = (productos) => {
                chart.data = productos
                console.log(chart.data)
            }


            chart.padding(40, 40, 40, 40);

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.dataFields.category = "nombre";
            categoryAxis.renderer.minGridDistance = 60;
            categoryAxis.renderer.inversed = true;
            categoryAxis.renderer.grid.template.disabled = true;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            valueAxis.extraMax = 0.1;
            //valueAxis.rangeChangeEasing = am4core.ease.linear;
            //valueAxis.rangeChangeDuration = 1500;

            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.categoryX = "nombre";
            series.dataFields.valueY = "existencia";
            series.tooltipText = "{valueY.value}"
            series.columns.template.strokeOpacity = 0;
            series.columns.template.column.cornerRadiusTopRight = 10;
            series.columns.template.column.cornerRadiusTopLeft = 10;
            //series.interpolationDuration = 1500;
            //series.interpolationEasing = am4core.ease.linear;
            var labelBullet = series.bullets.push(new am4charts.LabelBullet());
            labelBullet.label.verticalCenter = "bottom";
            labelBullet.label.dy = -10;
            labelBullet.label.text = "{values.valueY.workingValue.formatNumber('#.')}";

            chart.zoomOutButton.disabled = true;

            // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
            series.columns.template.adapter.add("fill", function(fill, target) {
                return chart.colors.getIndex(target.dataItem.index);
            });

            setInterval(function() {
                am4core.array.each(chart.data, function(item) {
                    item.visits += Math.round(Math.random() * 200 - 100);
                    item.visits = Math.abs(item.visits);
                })
                chart.invalidateRawData();
            }, 2000)

            categoryAxis.sortBySeries = series;

        }); // end am4core.ready()
    </script>