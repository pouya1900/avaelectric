(function ($) {
  "use strict";
  var nivoSlider = function ($scope, $) {
    if ($(".nivoSlider").length) {
      var nivoSlider_obj = $(".nivoSlider").data("slick");
     
      $(".nivoSlider").nivoSlider({
        manualAdvance: false,
        animSpeed: parseInt(nivoSlider_obj.anim_speed),
        pauseTime: parseInt(nivoSlider_obj.pause_time),
        pauseOnHover: JSON.parse(nivoSlider_obj.pause_on_hover),
        effect: nivoSlider_obj.effect,
        directionNav: JSON.parse(nivoSlider_obj.direction_nav),
        prevText: nivoSlider_obj.prev_text,
        nextText: nivoSlider_obj.next_text,
        autoplay: nivoSlider_obj.autoplay,
        controlNav: JSON.parse(nivoSlider_obj.control_nav),
      });
    }




	var $body = $('body'),

	// Template Blocks
	blocks = {
		mainSlider: $('#js-mainSlider')
	};

	// main slider
	if (blocks.mainSlider.length) {
		mainSlider();
	};
	function mainSlider() {
		var $el = blocks.mainSlider;
		$el.find('.slide').first().imagesLoaded({
			background: true
		}, function(){
			setTimeout(function () {
				$el.parent().find('.loading-content').addClass('disable');
				$body.addClass('load-mainslider');
			}, 300);
		});
		$el.on('init', function (e, slick) {
			var $firstAnimatingElements = $('div.slide:first-child').find('[data-animation]');
			doAnimations($firstAnimatingElements);
		});
		$el.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
			var $currentSlide = $('div.slide[data-slick-index="' + nextSlide + '"]');
			var $animatingElements = $currentSlide.find('[data-animation]');
			doAnimations($animatingElements);
		});
		$el.slick({
			arrows: false,
			dots: false,
			autoplay: true,
			autoplaySpeed: 5500,
			fade: true,
			speed: 1000,
			pauseOnHover: false,
			pauseOnDotsHover: true,
			responsive: [{
				breakpoint: 768,
				settings: {
					arrows: false
				}
			},{
				breakpoint: 1025,
				settings: {
					dots: false,
					arrows: false
				}
			}]
		});
	};
	function doAnimations(elements) {
		var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		elements.each(function () {
			var $this = $(this);
			var $animationDelay = $this.data('animation-delay');
			var $animationType = 'animated ' + $this.data('animation');
			$this.css({
				'animation-delay': $animationDelay,
				'-webkit-animation-delay': $animationDelay
			});
			$this.addClass($animationType).one(animationEndEvents, function () {
				$this.removeClass($animationType);
			});
			if ($this.hasClass('animate')) {
				$this.removeClass('animation');
			}
		});
	};

	// background image inline
	dataBg('[data-bgslide]');
	function dataBg(el) {
		blocks.mainSlider.find(el).each(function(){
			var $this = $(this),
			bg = $this.attr('data-bgslide');
			$this.css({
				'background-image': 'url(' + bg + ')'
			});
		});
	};




  };

  var bulbSlider = function ($scope, $) {
    if ($(".bulb-carousel").length) {
      var bulb_obj = $(".bulb-carousel").data("slick");
      $(".bulb-carousel").slick({
        mobileFirst: JSON.parse(bulb_obj.mobile_first),
        slidesToShow: parseInt(bulb_obj.slides_to_show),
        slidesToScroll: parseInt(bulb_obj.slides_to_scroll),
        infinite: JSON.parse(bulb_obj.infinite),
        autoplay: JSON.parse(bulb_obj.autoplay),
        autoplaySpeed: parseInt(bulb_obj.autoplay_speed),
        arrows: JSON.parse(bulb_obj.arrows),
        dots: JSON.parse(bulb_obj.dots),
        responsive: [
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
    }
  };

  var testimonials_1 = function ($scope, $) {
    if ($(".testimonials-carousel").length) {
      var testi_obj = $(".testimonials-carousel").data("slick");
      $(".testimonials-carousel").slick({
        mobileFirst: JSON.parse(testi_obj.mobile_first),
        slidesToShow: parseInt(testi_obj.slides_to_show),
        slidesToScroll: parseInt(testi_obj.slides_to_scroll),
        infinite: JSON.parse(testi_obj.infinite),
        autoplay: JSON.parse(testi_obj.autoplay),
        autoplaySpeed: parseInt(testi_obj.autoplay_speed),
        arrows: JSON.parse(testi_obj.arrows),
        dots: JSON.parse(testi_obj.dots),
      });
    }
  };

  var priceboxcarousel = function ($scope, $) {

    if ($(".price-box-carousel").length) {
      var testi_obj = $(".price-box-carousel").data("slick");
      $(".price-box-carousel").slick({
        mobileFirst: JSON.parse(testi_obj.mobile_first),
        slidesToShow: parseInt(testi_obj.slides_to_show),
        slidesToScroll: parseInt(testi_obj.slides_to_scroll),
        infinite: JSON.parse(testi_obj.infinite),
        autoplay: JSON.parse(testi_obj.autoplay),
        autoplaySpeed: parseInt(testi_obj.autoplay_speed),
        arrows: JSON.parse(testi_obj.arrows),
        dots: JSON.parse(testi_obj.dots),
        responsive: [
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
    }

    $('.tt-layout02-wrapper').slick({
      "dots": true,
      "arrows": false,
      "slidesToShow": 3,
      "slidesToScroll": 2,
      "autoplaySpeed": 5000,
      "responsive": [
        {
          "breakpoint": 1230,
          "settings": {
            "slidesToShow": 2,
            "slidesToScroll": 2
          }
        },
        {
          "breakpoint": 767,
          "settings": {
            "slidesToShow": 1,
            "slidesToScroll": 1
          }
        }
      ]
    });

  };

  var counterCarousel = function ($scope, $) {
    if ($(".counter-carousel").length) {
      var count_obj = $(".counter-carousel").data("slick");
      $(".counter-carousel").slick({
        mobileFirst: false,
        slidesToShow: parseInt(count_obj.slides_to_show),
        slidesToScroll: parseInt(count_obj.slides_to_scroll),
        infinite: JSON.parse(count_obj.infinite),
        autoplay: JSON.parse(count_obj.autoplay),
        autoplaySpeed: parseInt(count_obj.autoplay_speed),
        arrows: JSON.parse(count_obj.arrows),
        dots: JSON.parse(count_obj.dots),
        responsive: [
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
    }
  };

  var counterCarouselcount = function ($scope, $) {
    if ($(".counter-carousel").length) {
      function count(options) {
        var $this = $(this);
        options = $.extend(
          {},
          options || {},
          $this.data("countToOptions") || {}
        );
        $this.countTo(options);
      }
      $(".counter-box").each(function () {
        var $this = $(this);
        $this.waypoint(
          function () {
            $(".counter-box-number > span", $this).each(count);
            $this.addClass("counted");
            this.destroy();
          },
          {
            triggerOnce: true,
            offset: "80%",
          }
        );
      });
    }
  };

  var newspreviewcarousel = function ($scope, $) {
    if ($(".news-preview-carousel").length) {
      var news_obj = $(".news-preview-carousel").data("slick");
      $(".news-preview-carousel").slick({
        mobileFirst: false,
        slidesToShow: parseInt(news_obj.slides_to_show),
        slidesToScroll: parseInt(news_obj.slides_to_scroll),
        infinite: JSON.parse(news_obj.infinite),
        autoplay: JSON.parse(news_obj.autoplay),
        autoplaySpeed: parseInt(news_obj.autoplay_speed),
        arrows: JSON.parse(news_obj.arrows),
        dots: JSON.parse(news_obj.dots),
        responsive: [
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
    }
  };

  // brands carousel
  var brands_carousel = function ($scope, $) {
    if ($(".brands-carousel").length) {
      var brands_obj = $(".brands-carousel").data("slick");
      $(".brands-carousel").slick({
        mobileFirst: false,
        slidesToShow: parseInt(brands_obj.slides_to_show),
        slidesToScroll: parseInt(brands_obj.slides_to_scroll),
        infinite: JSON.parse(brands_obj.infinite),
        autoplay: JSON.parse(brands_obj.autoplay),
        autoplaySpeed: parseInt(brands_obj.autoplay_speed),
        arrows: JSON.parse(brands_obj.arrows),
        dots: JSON.parse(brands_obj.dots),
        variableWidth: true,
        responsive: [
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 5,
            },
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 3,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
    }
  };


  // mobile carousel
  function slickMobile(carousel, options) {
    if ($(carousel).hasClass("custom-css-add-container")) {
      $(carousel).closest(".custom-css-add").removeClass("custom-css-add");
      $(carousel).removeClass("custom-css-add-container");
    }
    var rtltrue= jQuery("body").hasClass("rtl");
    if(!carousel.hasClass('slick-initialized')) {
      carousel.slick({
      mobileFirst: JSON.parse(options.mobile_first),
      slidesToShow: parseInt(options.slides_to_show),
      slidesToScroll: parseInt(options.slides_to_scroll),
      infinite: JSON.parse(options.infinite),
      autoplay: JSON.parse(options.autoplay),
      autoplaySpeed: parseInt(options.autoplay_speed),
      rtl: rtltrue,
      arrows: JSON.parse(options.arrows),
      dots: JSON.parse(options.dots),
      responsive: [
        {
          breakpoint: 767,
          settings: "unslick",
        },
      ],
    });
      
    } 
    
  }

  function startCarousel() {
    if (jQuery(".category-carousel .container").length) {
      var ajax_cat_car = $(".category-carousel").data("slick");
      slickMobile(jQuery(".category-carousel .container"), ajax_cat_car);
    }
  }
  function startCarousel2() {
    if (jQuery(".text-icon-carousel").length) {
      var ajax_icon_carousel = $(".text-icon-carousel").data("slick");
      slickMobile(jQuery(".text-icon-carousel"), ajax_icon_carousel);
    }
  }
  function startCarouselele() {
    var windowWidth = window.innerWidth || $window.width();
    if (windowWidth < 768) {
      startCarousel();
    }
  }
  function startCarouselele2() {
    var windowWidth = window.innerWidth || $window.width();
    if (windowWidth < 768) {
      startCarousel2();
    }
  }

  function startCarouseleleresize() {
    $(window).resize(function () {
      var windowWidth = window.innerWidth || $window.width();
      if (windowWidth < 768) {
        startCarousel();
      } else {
        $(".category-carousel").addClass("custom-css-add");
        $(".category-carousel .container").addClass("custom-css-add-container");
      }
    });
  }





  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/electrician-nivo-slider.default",nivoSlider);
    elementorFrontend.hooks.addAction("frontend/element_ready/elec_work_category.default",startCarouselele);

    elementorFrontend.hooks.addAction("frontend/element_ready/elec_our_services.default",startCarouselele2);
    elementorFrontend.hooks.addAction("frontend/element_ready/elec_work_category.default",startCarouseleleresize);
    elementorFrontend.hooks.addAction("frontend/element_ready/electrician-bulb.default",bulbSlider);
    elementorFrontend.hooks.addAction("frontend/element_ready/electrician-testimonials-1.default",testimonials_1);
    elementorFrontend.hooks.addAction("frontend/element_ready/elec_price.default",priceboxcarousel);
    elementorFrontend.hooks.addAction("frontend/element_ready/elec_count.default",counterCarousel);
    elementorFrontend.hooks.addAction("frontend/element_ready/elec_count.default",counterCarouselcount);

    elementorFrontend.hooks.addAction("frontend/element_ready/ele_latest_news.default",newspreviewcarousel);
    elementorFrontend.hooks.addAction("frontend/element_ready/electrician-brands.default",brands_carousel);

  });
})(jQuery);
