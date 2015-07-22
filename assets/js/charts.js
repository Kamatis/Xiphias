$(function () {
  
  var options = {
    chart: {
      type: 'column'
    },
    title: {
      text: 'HOUSE RANKING'
    },
    xAxis: {
      categories: [
        "Convex Hulk",
        "Segment Thor-ee",
        "Travelling Ironman",
        "Captain Josephus"
      ],
      title: {
        text:   'Houses',
        align:  'middle'
      }
    },
    plotBands: [{
      color: '#66cc88',
      from: -1,
      to: 0.5
    }, {
      color:  '#d9d96c',
      from:   0.5,
      to:     1.5
    }, {
      color:  '#cc6666',
      from:   1.5,
      to:     2.5
    }, {
      color:  '#6688cc',
      from:   2.5,
      to:     3.5
    }],
    yAxis: {
      title: {
        text: "House Points (HP)"
      }
    },
    plotOptions: {
      series: {
        borderWidth: 0,
        dataLabels: {
          enabled: true,
          format: '{point.y}'
        }
      },
      colors: ['#adedc2', '#ededb6', '#f2aaaa', '#a6beed']
    },
    series: [{
      name: "Houses",
      colorByPoint: true
    }]
  };
  
  $.getJSON('index.php/pages/getHousePoints', function(data){
    options.series[0].data = data;
    console.log(options);
    $('#house-ranks-chart').highcharts(options);
  });   
});