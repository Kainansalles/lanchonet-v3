var chart = AmCharts.makeChart("chartdivClients", {
    "theme": "light",
    "type": "serial",
    "startDuration": 1,
    "dataDateFormat": "YYYY-MM",
    "dataLoader": {
        "url": "/dataclients",
        "reload": 30,
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

var chartDemands = AmCharts.makeChart("chartdivDemands", {
    "type": "pie",
    "theme": "light",
    "innerRadius": "40%",
    "startDuration": 1,
    "gradientRatio": [-0.4, -0.4, -0.4, -0.4, -0.4, -0.4, 0, 0.1, 0.2, 0.1, 0, -0.2, -0.5],
    "dataLoader": {
        "url": "/datademands",
        "reload": 30,
        "noStyles": true,
    },
    "balloonText": "[[value]]",
    "valueField": "litres",
    "titleField": "country",
    "balloon": {
        "drop": true,
        "adjustBorderColor": false,
        "color": "#FFFFFF",
        "fontSize": 16
    },
    "export": {
        "enabled": true
    }
});

var chartdivProducts = AmCharts.makeChart( "chartdivProducts", {
    "type": "funnel",
    "theme": "light",
    "dataLoader": {
        "url": "/dataproducts",
        "reload": 30,
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