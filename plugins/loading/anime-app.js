jQuery(document).ready(function() {
	'use strict';
	  
	// Wrap every letter in a span
	$('.loader1').each(function(){
	  $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
	});
	
	anime.timeline({loop: true})
	  .add({
		targets: '.loader1 .letter',
		translateX: [40,0],
		translateZ: 0,
		opacity: [0,1],
		easing: "easeOutExpo",
		duration: 1200,
		delay: function(el, i) {
		  return 500 + 30 * i;
		}
	  }).add({
		targets: '.loader1 .letter',
		translateX: [0,-30],
		opacity: [1,0],
		easing: "easeInExpo",
		duration: 1100,
		delay: function(el, i) {
		  return 100 + 30 * i;
		}
	  });
	
	var loader2 = {};
	loader2.opacityIn = [0,1];
	loader2.scaleIn = [0.2, 1];
	loader2.scaleOut = 3;
	loader2.durationIn = 800;
	loader2.durationOut = 600;
	loader2.delay = 500;

	anime.timeline({loop: true})
	  .add({
		targets: '.loader2 .letters-1',
		opacity: loader2.opacityIn,
		scale: loader2.scaleIn,
		duration: loader2.durationIn
	  }).add({
		targets: '.loader2 .letters-1',
		opacity: 0,
		scale: loader2.scaleOut,
		duration: loader2.durationOut,
		easing: "easeInExpo",
		delay: loader2.delay
	  }).add({
		targets: '.loader2 .letters-2',
		opacity: loader2.opacityIn,
		scale: loader2.scaleIn,
		duration: loader2.durationIn
	  }).add({
		targets: '.loader2 .letters-2',
		opacity: 0,
		scale: loader2.scaleOut,
		duration: loader2.durationOut,
		easing: "easeInExpo",
		delay: loader2.delay
	  }).add({
		targets: '.loader2 .letters-3',
		opacity: loader2.opacityIn,
		scale: loader2.scaleIn,
		duration: loader2.durationIn
	  }).add({
		targets: '.loader2 .letters-3',
		opacity: 0,
		scale: loader2.scaleOut,
		duration: loader2.durationOut,
		easing: "easeInExpo",
		delay: loader2.delay
	  }).add({
		targets: '.loader2',
		opacity: 0,
		duration: 500,
		delay: 500
	  });
	  
	  
	  // Wrap every letter in a span
	$('.loader3 .letters').each(function(){
	  $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
	});

	anime.timeline({loop: true})
	  .add({
		targets: '.loader3 .letter',
		translateY: ["1.1em", 0],
		translateZ: 0,
		duration: 750,
		delay: function(el, i) {
		  return 50 * i;
		}
	  }).add({
		targets: '.loader3',
		opacity: 0,
		duration: 1000,
		easing: "easeOutExpo",
		delay: 1000
	  });
	  
	  // Wrap every letter in a span
	$('.loader4 .letters').each(function(){
	  $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
	});

	anime.timeline({loop: true})
	  .add({
		targets: '.loader4 .letter',
		scale: [0, 1],
		duration: 1500,
		elasticity: 600,
		delay: function(el, i) {
		  return 45 * (i+1)
		}
	  }).add({
		targets: '.loader4',
		opacity: 0,
		duration: 1000,
		easing: "easeOutExpo",
		delay: 1000
	  });
});