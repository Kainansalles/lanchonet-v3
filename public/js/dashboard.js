var chart = AmCharts.makeChart("chartdivDemandsxProducts", {
    "theme": "light",
    "type": "serial",
    "startDuration": 1,
    "dataDateFormat": "YYYY-MM",
    "dataLoader": {
        "url": "/dataclients",
        "reload": 300,
        "noStyles": true,
    },
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "colorField": "color",
        "fillAlphas": 0.85,
        "lineAlpha": 0.1,
        "type": "column",
        "topRadius":1,
        "valueField": "visits"
    }],
    "depth3D": 20,
    "angle": 30,
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 90
    },
    "export": {
        "enabled": true
        }
 });
 var chart = AmCharts.makeChart( "chartdivDemands", {
    "type": "pie",
    "theme": "light",
    "dataLoader": {
        "url": "/datademands",
        "reload": 300,
        "noStyles": true,
    },
    "titleField": "title",
    "valueField": "value",
    "labelRadius": 5,
     "radius": "42%",
    "innerRadius": "60%",
    "labelText": "[[title]]",
    "export": {
      "enabled": true
    }
  } );
 var chartdivProducts = AmCharts.makeChart( "chartdivProducts", {
    "type": "funnel",
    "theme": "light",
    "dataLoader": {
        "url": "/api/dashboard/dataproducts",
        "reload": 300,
        "noStyles": true,
    },
    "balloon": {
        "fixedPosition": true
    },
    "valueField": "value",
    "titleField": "title",
    "marginRight": 120,
    "marginLeft": 12.5,
    "startX": 500,
    "depth3D": 100,
    "angle": 40,
    "outlineAlpha": 1,
    "outlineColor": "#FFFFFF",
    "outlineThickness": 2,
    "labelPosition": "right",
    "balloonText": "[[title]]: [[value]][[description]]",
    "export": {
        "enabled": true
    }
} );