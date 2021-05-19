var dzrevapi;
var dzQuery =jQuery;

function dz_rev_slider_1(){
	if(dzQuery("#welcome").revolution == undefined){
		revslider_showDoubleJqueryError("#welcome");
	}else{
		dzrevapi = dzQuery("#welcome").show().revolution({
			sliderType:"standard",
			jsFileLocation:"plugins/revolution/revolution/js/",
			sliderLayout:"fullscreen",
			dottedOverlay:"none",
			delay:9000,
			particles: {startSlide: "first", endSlide: "last", zIndex: "1",
				particles: {
					number: {value: 25}, color: {value: "#ffffff"},
					shape: {
						type: "circle", stroke: {width: 0, color: "#ffffff", opacity: 1},
						image: {src: ""}
					},
					opacity: {value: 1, random: true, min: 0.25, anim: {enable: true, speed: 3, opacity_min: 0, sync: false}},
					size: {value: 2, random: true, min: 0.5, anim: {enable: true, speed: 5, size_min: 1, sync: false}},
					line_linked: {enable: false, distance: 150, color: "#ffffff", opacity: 0.4, width: 1},
					move: {enable: true, speed: 2, direction: "none", random: true, min_speed: 1, straight: false, out_mode: "out"}},
				interactivity: {
					events: {onhover: {enable: false, mode: "bubble"}, onclick: {enable: false, mode: "repulse"}},
					modes: {grab: {distance: 400, line_linked: {opacity: 0.5}}, bubble: {distance: 400, size: 40, opacity: 0.5}, repulse: {distance: 200}}
				}
			},
			revealer: {
				direction: "open_horizontal",
				color: "#ffffff",
				duration: "1500",
				delay: "0",
				easing: "Power2.easeInOut",
				overlay_enabled: true,
				overlay_color: "#000000",
				overlay_duration: "1500",
				overlay_delay: "0",
				overlay_easing: "Power2.easeInOut",
				spinner: "1",
				spinnerColor: "#006dd2",
			},
			navigation: {
				keyboardNavigation:"off",
				keyboard_direction: "horizontal",
				mouseScrollNavigation:"off",
 							mouseScrollReverse:"default",
				onHoverStop:"off",
				arrows: {
					style:"uranus",
					enable:true,
					hide_onmobile:false,
					hide_onleave:false,
					tmp:'',
					left: {
						h_align:"left",
						v_align:"center",
						h_offset:10,
						v_offset:0
					},
					right: {
						h_align:"right",
						v_align:"center",
						h_offset:10,
						v_offset:0
					}
				}
			},
			viewPort: {
				enable:true,
				outof:"wait",
				visible_area:"80%",
				presize:true
			},
			responsiveLevels:[1240,1024,778,480],
			visibilityLevels:[1240,1024,778,480],
			gridwidth:[1240,1024,778,480],
			gridheight:[868,768,960,720],
			lazyType:"single",
			parallax: {
				type:"scroll",
				origo:"slidercenter",
				speed:400,
				speedbg:0,
				speedls:0,
				levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,55],
			},
			shadow:0,
			spinner:"spinner2",
			stopLoop:"off",
			stopAfterLoops:5,
			stopAtSlide:1,
			shuffle:"off",
			autoHeight:"off",
			fullScreenAutoWidth:"off",
			fullScreenAlignForce:"off",
			fullScreenOffsetContainer: "",
			fullScreenOffset: "",
			disableProgressBar:"on",
			hideThumbsOnMobile:"off",
			hideSliderAtLimit:0,
			hideCaptionAtLimit:0,
			hideAllCaptionAtLilmit:0,
			debugMode:false,
			fallbacks: {
				simplifyAll:"off",
				nextSlideOnWindowFocus:"off",
				disableFocusListener:false,
			}
		});
		
	}
}

function dz_rev_slider_2(){
	if(dzQuery("#rev_slider_478_1").revolution == undefined){
		revslider_showDoubleJqueryError("#rev_slider_478_1");
	}else{
		dzrevapi = dzQuery("#rev_slider_478_1").show().revolution({
			sliderType:"standard",
			jsFileLocation:"//server.local/revslider/wp-content/plugins/revslider/public/assets/js/",
			sliderLayout:"fullscreen",
			dottedOverlay:"none",
			delay:9000,
			navigation: {
				keyboardNavigation:"off",
				keyboard_direction: "horizontal",
				mouseScrollNavigation:"off",
				mouseScrollReverse:"default",
				onHoverStop:"off",
				touch:{
					touchenabled:"on",
					swipe_threshold: 75,
					swipe_min_touches: 1,
					swipe_direction: "horizontal",
					drag_block_vertical: false
				}
				,
				bullets: {
					enable:true,
					hide_onmobile:false,
					style:"hermes",
					hide_onleave:false,
					direction:"vertical",
					h_align:"right",
					v_align:"center",
					h_offset:30,
					v_offset:0,
					space:10,
					tmp:''
				}
				,
				thumbnails: {
					style:"gyges",
					enable:true,
					width:60,
					height:60,
					min_width:60,
					wrapper_padding:0,
					wrapper_color:"rgba(0,0,0,0)",
					wrapper_opacity:"0",
					tmp:'<span class="tp-thumb-img-wrap">  <span class="tp-thumb-image"></span></span>',
					visibleAmount:10,
					hide_onmobile:false,
					hide_onleave:false,
					direction:"horizontal",
					span:false,
					position:"inner",
					space:10,
					h_align:"left",
					v_align:"bottom",
					h_offset:30,
					v_offset:30
				}
			},
			responsiveLevels:[1240,1024,778,480],
			visibilityLevels:[1240,1024,778,480],
			gridwidth:[1240,1024,778,480],
			gridheight:[868,768,960,720],
			lazyType:"none",
			shadow:0,
			spinner:"off",
			stopLoop:"on",
			stopAfterLoops:0,
			stopAtSlide:1,
			shuffle:"off",
			autoHeight:"off",
			disableProgressBar:"on",
			hideThumbsOnMobile:"off",
			hideSliderAtLimit:0,
			hideCaptionAtLimit:0,
			hideAllCaptionAtLilmit:0,
			debugMode:false,
			fallbacks: {
				simplifyAll:"off",
				nextSlideOnWindowFocus:"off",
				disableFocusListener:false,
			}
		});
	}
}

function dz_rev_slider_3(){
	if(dzQuery("#rev_slider_1061_1").revolution == undefined){
		revslider_showDoubleJqueryError("#rev_slider_1061_1");
	}else{
	dzrevapi = dzQuery("#rev_slider_1061_1").show().revolution({
	sliderType:"standard",
	jsFileLocation:"revolution/js/",
	sliderLayout:"fullscreen",
	dottedOverlay:"none",
	delay:9000,
	navigation: {
		keyboardNavigation:"off",
		keyboard_direction: "horizontal",
		mouseScrollNavigation:"off",
		mouseScrollReverse:"default",
		onHoverStop:"off",
		touch:{
			touchenabled:"on",
			swipe_threshold: 75,
			swipe_min_touches: 50,
			swipe_direction: "horizontal",
			drag_block_vertical: false
		}
		,
		thumbnails: {
			style: "hesperiden",
			enable: true,
			width: 165,
			height: 110,
			min_width: 100,
			wrapper_padding: 3,
			wrapper_color: "#ffffff",
			wrapper_opacity: "0.5",
			tmp: '<span class="tp-thumb-image"></span><span class="tp-thumb-title">{{title}}</span>',
			visibleAmount: 5,
			hide_onmobile: false,
			hide_onleave: false,
			direction: "horizontal",
			span: false,
			position: "inner",
			space: 3,
			h_align: "center",
			v_align: "bottom",
			h_offset: 0,
			v_offset: 50
		}
	},
	responsiveLevels:[1240,1024,778,480],
	visibilityLevels:[1240,1024,778,480],
	gridwidth:[1240,1024,778,480],
	gridheight:[868,768,960,720],
	lazyType:"none",
	parallax: {
		type:"3D",
		origo:"slidercenter",
		speed:1000,
		levels:[2,4,6,8,10,12,14,16,45,50,47,48,49,50,0,50],
		type:"3D",
		ddd_shadow:"off",
		ddd_bgfreeze:"on",
		ddd_overflow:"hidden",
		ddd_layer_overflow:"visible",
		ddd_z_correction:100,
	},
	spinner:"off",
	stopLoop:"on",
	stopAfterLoops:0,
	stopAtSlide:1,
	shuffle:"off",
	autoHeight:"off",
	fullScreenAutoWidth:"off",
	fullScreenAlignForce:"off",
	fullScreenOffsetContainer: "",
	fullScreenOffset: "0",
	disableProgressBar:"on",
	hideThumbsOnMobile:"off",
	hideSliderAtLimit:0,
	hideCaptionAtLimit:0,
	hideAllCaptionAtLilmit:0,
	debugMode:false,
	fallbacks: {
		simplifyAll:"off",
		nextSlideOnWindowFocus:"off",
		disableFocusListener:false,
	}
	});
	}
}