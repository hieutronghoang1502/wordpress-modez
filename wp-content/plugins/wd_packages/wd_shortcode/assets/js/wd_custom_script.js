function slick_slider_load(selector, item, dots = true, centermode = false, autoplay = true) { //dots : true/false, item: number
	$(selector).slick({
	  dots: dots,
	  centerMode: centermode,
	  infinite: false,
	  autoplay: autoplay,
	  autoplaySpeed: 2000,
	  speed: 300,
	  slidesToShow: item,
	  slidesToScroll: item,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: item,
	        slidesToScroll: item,
	        infinite: true,
	        dots: dots
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: (item > 1) ? item - 1 : 1,
	        slidesToScroll: (item > 1) ? item - 1 : 1
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});
}