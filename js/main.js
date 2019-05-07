/**
 * File main.js.
 *
 * Series of initialize tasks.
 *
 * Please see comments below.
 */

( function( $ ) {

	// ----- Site visible after all elements are loaded. Fix object fit for IE
	$(document).ready(function() {
	  document.getElementsByTagName("html")[0].style.visibility = "visible";
		objectFitImages();
	});

  // ----- Cross browser vh range fix
  // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
  let vh = window.innerHeight * 0.01;
  // Then we set the value in the --vh custom property to the root of the document. `${vh}px`
  document.documentElement.style.setProperty('--vh', vh + 'px');
  // CSS set -> height: 100vh; height: calc(var(--vh, 1vh) * 100);

  // ----- Fixed navigation scripts
  // --- Fixed navigation header add sticky class on scroll
	$(document).ready(function() {
    // When the user scrolls the page, execute myFunction
    window.onscroll = function() {myFunction()};
    // Get the header
    var header = document.getElementById("masthead");
    // If top header exist, get main header
    var mainheader = document.getElementById("main-header");
    
    // // Get the offset position of the header
    // var sticky = header.offsetTop;
    // If top header exist, get the offset position of the main header instead
    var sticky = mainheader.offsetTop;
    
    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
        $('.site-content').css('margin-top', $('#masthead.sticky').height()); // add page content top spacing on scroll
        $('.menu-primary').css('top', $('#wpadminbar').height()); // add mobile menu top spacing on scroll
      } else {
        header.classList.remove("sticky");
        $('.site-content').css('margin-top', 0); // reset page content top spacing
        $('.menu-primary').css('top', 0); // reset mobile menu top spacing
      }
    };
  });

  // add hamburgers support for bootstrap mobile menu
  $('.navbar-toggle').click(function () {
    $('.navbar-toggle').toggleClass('is-active');
  });

	// ----- Add bootstrap container to gutenberg wp-block-column class
	$('header.page-header').addClass('container');
	$('header.entry-header').addClass('container');
  $('.entry-content > .wp-block-columns:not(.fullwidth)').wrapInner("<div class='container' />");
  $('body:not(.no-sidebar) .site-content').wrapInner("<div class='container' />");
  $('body.woocommerce .site-content').wrapInner("<div class='container' />");


} )( jQuery );
