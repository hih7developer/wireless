!!window['addEventListener'] && new WOW().init();



$(document).ready(function() {
	$(".fancybox").fancybox({
	    type: "iframe",
	})
	$('[data-fancybox]').fancybox({
	  buttons : ['close']
	});
});
