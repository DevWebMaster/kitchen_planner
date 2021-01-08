(function($) { 
	"use strict";

	/* JavaScript Document */
jQuery(document).ready(function() {
    'use strict';

	/* image-carousel function by = owl.carousel.js */
	jQuery('.project-carousel').owlCarousel({
		loop:true,
		center:true,
		autoplay:true,
		margin:30,
		nav:true,
		dots: false,
		navText: ['<i class="la la-long-arrow-left"></i>', '<i class="la la-long-arrow-right"></i>'],
		responsive:{
			0:{
				items:1,
			},
			480:{
				items:2,
				margin:20
			},			
			1024:{
				items:3
			},
			1200:{
				items:2
			},
			1400:{
				items:2
			}
		}
	})
	
	/*  Blog post Carousel function by = owl.carousel.js */
	jQuery('.blog-carousel').owlCarousel({
		loop:true,
		autoplay:true,
		margin:30,
		nav:true,
		dots: false,
		navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow"></i>'],
		responsive:{
			0:{
				items:1
			},
			480:{
				items:2
			},			
			991:{
				items:2
			},
			1000:{
				items:3
			}
		}
	})
	
	/*  Blog post Carousel function by = owl.carousel.js */
	jQuery('.blog-carousel2').owlCarousel({
		loop:true,
		autoplay:true,
		margin:30,
		center: true,
		nav:true,
		dots: true,
		navText: ['<i class="flaticon-left-arrow"></i>', '<i class="flaticon-right-arrow"></i>'],
		responsive:{
			0:{
				items:1
			},
			480:{
				items:2
			},			
			991:{
				items:2
			},
			1000:{
				items:3
			}
		}
	})
	
	/*  Blog post Carousel function by = owl.carousel.js */
	jQuery('.team-carousel').owlCarousel({
		loop:true,
		autoplay:true,
		margin:100,
		nav:true,
		stagePadding: 100,
		autoplaySpeed: 1000,
		navSpeed: 1000,
		paginationSpeed: 1000,
		slideSpeed: 1000,
		dots: false,
		navText: ['<i class="la la-long-arrow-left"></i> <span>Prev</span>', '<span>Next</span><i class="la la-long-arrow-right"></i>'],
		responsive:{
			0:{
				items:1,
				stagePadding: 0
			},
			480:{
				items:1
			},			
			991:{
				items:1
			},
			1000:{
				items:1
			}
		}
	})
	
	/*  Blog post Carousel function by = owl.carousel.js */
	jQuery('.team-carousel2').owlCarousel({
		loop:true,
		autoplay:true,
		margin:30,
		nav:true,
		autoplaySpeed: 1000,
		navSpeed: 1000,
		paginationSpeed: 1000,
		slideSpeed: 1000,
		dots: false,
		navText: ['<i class="la la-long-arrow-left"></i> <span>Prev</span>', '<span>Next</span><i class="la la-long-arrow-right"></i>'],
		responsive:{
			0:{
				items:2,
				stagePadding: 0
			},
			480:{
				items:3
			},	
				
			991:{
				items:5
			},
			1000:{
				items:5
			},
			1200:{
				items:6
			}

		}
	})
	
	/* testimonial two function by = owl.carousel.js */
	jQuery('.exhibition-carousel').owlCarousel({
		loop:true,
		autoplay:true,
		right:true,
		margin:0,
		nav:true,
		dots: true,
		navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		responsive:{
			0:{
				items:1
			},
			
			480:{
				items:1
			},			
			
			991:{
				items:1
			},
			1000:{
				items:1
			}
		}
	})
	
	/* testimonial two function by = owl.carousel.js */
	jQuery('.project-carousel-1').owlCarousel({
		loop:true,
		autoplay:true,
		right:true,
		margin:0,
		nav:true,
		autoplaySpeed: 1000,
		navSpeed: 1000,
		paginationSpeed: 1000,
		slideSpeed: 1000,
		dots: true,
		navText: ['<i class="la la-arrow-left"></i> Prev', 'Next <i class="la la-arrow-right"></i>'],
		responsive:{
			0:{
				items:1
			},
			
			480:{
				items:1
			},			
			
			991:{
				items:1
			},
			1000:{
				items:1
			}
		}
	})
	
	/* image-carousel function by = owl.carousel.js */
	jQuery('.related-post').owlCarousel({
		loop:true,
		margin:30,
		autoplay:true,
		nav:true,
		dots: false,
		navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		responsive:{
			0:{
				items:1,
			},
			480:{
				items:2,
			},			
			1024:{
				items:2
			},
			1200:{
				items:2
			}
		}
	})
	
	/* image-carousel function by = owl.carousel.js */
	jQuery('.about-slide').owlCarousel({
		loop:true,
		center:true,
		autoplay: true,
		margin:0,
		nav:true,
		dots: true,
		navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
		responsive:{
			0:{
				items:1
			},
			480:{
				items:1
			},			
			1024:{
				items:1
			},
			1200:{
				items:1
			},
			1400:{
				items:1
			}
		}
	})
	
	/*  Blog post Carousel function by = owl.carousel.js */
	jQuery('.client-logo').owlCarousel({
		loop:true,
		autoplay:true,
		margin:0,
		nav:true,
		dots: false,
		navText: ['<i class="la la-long-arrow-left"></i>', '<i class="la la-long-arrow-right"></i>'],
		responsive:{
			0:{
				items:2
			},
			480:{
				items:3
			},			
			991:{
				items:5
			},
			1000:{
				items:5
			}
		}
	})
	
	
	/* Testimonial Carousel function by = owl.carousel.js */
	jQuery('.testimonial-three').owlCarousel({
		loop:true,
		margin:15,
		autoplay:true,
		center: true,
		nav:true,
		dots: true,
		navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
		responsive:{
			0:{
				items:1,
			},
			480:{
				items:2,
			},			
			1024:{
				items:3
			},
			1200:{
				items:3
			},
			1400:{
				items:3
			}
		}
	})
		
	
	/* image-carousel function by = owl.carousel.js */
	jQuery('.news-carousel').owlCarousel({
		loop:true,
		margin:0,
		autoplay:true,
		nav:true,
		dots: false,
		navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
		responsive:{
			0:{
				items:1
			},
			480:{
				items:1
			},			
			1024:{
				items:2
			},
			1200:{
				items:2
			},
			1400:{
				items:3
			}
		}
	})
	
	/*  Blog post Carousel function by = owl.carousel.js */
	jQuery('.news-carousel-bx').owlCarousel({
		loop:true,
		autoplay:true,
		margin:30,
		nav:true,
		dots: false,
		navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
		responsive:{
			0:{
				items:1
			},
			480:{
				items:2
			},			
			991:{
				items:2
			},
			1000:{
				items:3
			}
		}
	})
	
	/*  Blog post Carousel function by = owl.carousel.js */
	jQuery('.news-carousel-bx1').owlCarousel({
		loop:true,
		autoplay:true,
		margin:0,
		nav:true,
		dots: false,
		navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
		responsive:{
			0:{
				items:1
			},
			480:{
				items:1
			},			
			768:{
				items:2
			},
			991:{
				items:2
			},
			1000:{
				items:3
			}
		}
	})
	
	/*  Blog post Carousel function by = owl.carousel.js */
	jQuery('.product-item-carousel').owlCarousel({
		loop:true,
		autoplay:true,
		center: true,
		margin:30,
		nav:true,
		dots: true,
		navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
		responsive:{
			0:{
				items:1
			},
			480:{
				items:1
			},			
			768:{
				items:2
			},
			991:{
				items:2
			},
			1000:{
				items:3
			}
		}
	})
	
	/*  Blog post Carousel function by = owl.carousel.js */
	jQuery('.project-carousel-2').owlCarousel({
		loop:true,
		autoplay:true,
		center: false,
		margin:0,
		nav:true,
		dots: true,
		navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
		responsive:{
			0:{
				items:1
			},
			480:{
				items:1
			},			
			768:{
				items:2
			},
			991:{
				items:3
			},
			1000:{
				items:4
			}
		}
	})
	
	/* image-carousel function by = owl.carousel.js */
	jQuery('.portfolio-carousel').owlCarousel({
		loop:true,
		margin:0,
		nav:true,
		dots: false,
		autoplaySpeed: 1000,
		navSpeed: 1000,
		paginationSpeed: 1000,
		slideSpeed: 1000,
		dots: true,
		navText: ['<i class="la la-arrow-left"></i> Prev', 'Next <i class="la la-arrow-right"></i>'],
		responsive:{
			0:{
				items:1,
			},
			480:{
				items:2,
			},			
			1024:{
				items:3
			},
			1200:{
				items:4
			}
		}
	})
	
	/* image-carousel function by = owl.carousel.js */
	jQuery('.portfolio-carousel-2').owlCarousel({
		loop:true,
		margin:0,
		nav:true,
		autoWidth:true,
		dots: false,
		dots: true,
		navText: ['<i class="la la-arrow-left"></i> Prev', 'Next <i class="la la-arrow-right"></i>'],
		responsive:{
			0:{
				items:1,
			},
			480:{
				items:2,
			},			
			1024:{
				items:3
			},
			1200:{
				items:4
			}
		}
	})
	jQuery('.portfolio-carousel-2').on('mousewheel', '.owl-stage', function (e) {
		if (e.deltaY>0) {
			jQuery('.portfolio-carousel-2').trigger('next.owl',[2000]);
		} else {
			jQuery('.portfolio-carousel-2').trigger('prev.owl',[2000]);
		}
		e.preventDefault();
	});
	
});
/* Document .ready END */

	
})(jQuery);	