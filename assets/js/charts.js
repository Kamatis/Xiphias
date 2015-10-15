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

	// timeline init values
	$('#timeline').html("Wait, Loading graph...");
	var timeline = {
		chart: {
			type: 'line',
			renderTo: 'timeline'
		},
		title: {
			text: ''
		},
		xAxis: {
			type: 'datetime',
			dateTimeLabelFormats: {
				month: '%e %b',
				year: '%b'
			},
			title: {
				text: 'Date'
			}
		},
		yAxis: {
			title: {
				text: 'Experience'
			},
			min: 0
		},
		tooltip: {
			formatter: function() {
				var header = '<small>' + Highcharts.dateFormat('%b %e, %Y', new Date(this.point.x)) + '</small><br>';
				var body = '';
				for(var i = 0; i < this.point.activity.length; i++)
					body += this.point.activity[i] + '<br>';
				return header+body;
			},
			useHTML: true,
			crosshairs: true
		},
		plotOptions: {
			spline: {
				marker: {
					enabled: true
				}
			}
		},
		series: [{
			showInLegend: false,
			name: 'Activities',
			color: '#c33131'
		}],
		exporting: {
			enabled: true
		}
	};

	// get the username of the profile being viewed
	var url = window.location.href;
	var username = url.substring(url.lastIndexOf('/') + 1);

	// draw the chart after getting json
	$.ajax({
		url: 'http://'+  window.location.hostname + '/xiphias/index.php/pages/getUserActivity/' + username,
		dataType: 'json',
		success: function(json) {
			timeline.series[0].data = json;
			var timelineGraph = new Highcharts.Chart(timeline);
		},
		error: function(jqXHR, exception) {
			if (jqXHR.status === 0) {
					alert ('Not connected.\nPlease verify your network connection.');
			} else if (jqXHR.status == 404) {
					alert ('The requested page not found. [404]');
			} else if (jqXHR.status == 500) {
					alert ('Internal Server Error [500].');
			} else if (exception === 'parsererror') {
					alert ('Requested JSON parse failed.');
			} else if (exception === 'timeout') {
					alert ('Time out error.');
			} else if (exception === 'abort') {
					alert ('Ajax request aborted.');
			} else {
					alert ('Uncaught Error.\n' + jqXHR.responseText);
			}
		}
	});

});
