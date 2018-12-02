// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdivDemandsxProducts", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

// Add data
chart.dataSource.url = "/dataclients";
chart.dataSource.reloadFrequency = 300000; // 5 minutos
chart.dataSource.load();

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 270;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 50;

// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 40;
series.columns.template.column.cornerRadiusTopRight = 40;
//series.columns.template.column.fillOpacity = 0.8;

// Cursor
chart.cursor = new am4charts.XYCursor();


// Create chart instance
var demands = am4core.create("chartdivDemands", am4charts.PieChart);

// Add data
demands.dataSource.url = "/datademands";
demands.dataSource.reloadFrequency = 300000; // 5 minutos
demands.dataSource.load();

// Add and configure Series
var pieSeries = demands.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "value";
pieSeries.dataFields.category = "title";
pieSeries.innerRadius = am4core.percent(50);
pieSeries.ticks.template.disabled = true;
pieSeries.labels.template.disabled = true;

let rgm = new am4core.RadialGradientModifier();
rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
pieSeries.slices.template.fillModifier = rgm;
pieSeries.slices.template.strokeModifier = rgm;
pieSeries.slices.template.strokeOpacity = 0.4;
pieSeries.slices.template.strokeWidth = 0;

demands.legend = new am4charts.Legend();
demands.legend.position = "bottom";

let products = am4core.create("chartdivProducts", am4charts.SlicedChart);
products.dataSource.url = "/api/dashboard/dataproducts";
products.dataSource.reloadFrequency = 300000; // 5 minutos
products.dataSource.load();

let teste = products.series.push(new am4charts.PyramidSeries());
teste.dataFields.value = "value";
teste.dataFields.category = "title";
teste.alignLabels = true;
teste.valueIs = "height";