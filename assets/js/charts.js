$(function () {
  
  var options = {
    chart: {
      type: 'column',
      backgroundColor: "#16a085"
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
    },
    
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
        },
        colors: ['#adedc2', '#ededb6', '#f2aaaa', '#a6beed']
      }
      
    },
    series: [{
      name: "House Points (HP)",
      showInLegend: false,
      type: 'column',
      colorByPoint: true
    }]
  };
  
  $.getJSON('http://'+  window.location.hostname + '/xiphias/index.php/pages/getHousePoints', function(data){
    options.series[0].data = data;
    console.log(options);
    $('#house-ranks-chart').highcharts(options);
  });
  
  var clickEvent = false;
  $('#myCarousel').on('click', '.nav a', function() {
          clickEvent = true;
          $('.nav li').removeClass('active');
          $(this).parent().addClass('active');		
  }).on('slid.bs.carousel', function(e) {
      if(!clickEvent) {
          var count = $('.nav').children().length -1;
          var current = $('.nav li.active');
          current.removeClass('active').next().addClass('active');
          var id = parseInt(current.data('slide-to'));
          if(count == id) {
              $('.nav li').first().addClass('active');	
          }
      }
      clickEvent = false;
  });
});