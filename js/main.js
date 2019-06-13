/**
 * File main.js.
 *
 * Series of initialize tasks.
 *
 * Please see comments below.
 */

( function( $ ) {

	// ----- Base & Cross Browsing ----- //
	$(document).ready(function() {
    // Show site after all elements are loaded
    document.getElementsByTagName("html")[0].style.visibility = "visible";
    // Execute object fit hack for IE
    objectFitImages();
	});

  // --- vh hack: height: 100vh; height: calc(var(--vh, 1vh) * 100); -- //
  // First we get the viewport height and we multiple it by 1% to get a value for a vh unit
  let vh = window.innerHeight * 0.01;
  // Then we set the value in the --vh custom property to the root of the document. `${vh}px`
  document.documentElement.style.setProperty('--vh', vh + 'px');

  // ----- Underscores Support ----- //
  // --- Fixed Header --- //
	$(document).ready(function() {
    // When the user scrolls the page, execute addFixedHeader
    window.onscroll = function() { addFixedHeader() };
    // Get the header
    var masthead = document.getElementById("masthead");
    // If top header exist, get the main header
    var mainheader = document.getElementById("main-header");
  
    // If top header exist, get the offset position of the main header
    var disttotop = mainheader.offsetTop;

    // Get the Wordpress admin bar height
    var wpadminbarheight = $('#wpadminbar').height();
    // Get the header height
    var mastheadheight = $('#masthead').height();
    
    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function addFixedHeader() {
      // For width <= 600px, add sticky class after scroll y pos is >= 46px
      if (window.innerWidth <= 600 && window.pageYOffset > wpadminbarheight || (window.innerWidth > 600 && window.pageYOffset > disttotop)) {
        // Add sticky class on scroll
        masthead.classList.add("sticky");
        // Add fixed position on scroll
        $('#masthead').css('position', 'fixed');
        // Add page content top spacing on scroll
        $('.site-content').css('margin-top', mastheadheight);
      } else {
        masthead.classList.remove("sticky");
        // Add relative position on top pos
        $('#masthead').css('position', 'relative');
        // Reset page content top spacing
        $('.site-content').css('margin-top', 0);
      }
    };
  });
  // --- Sidebar --- //
  // If sidebar exist, add class to body
  if ( $('#secondary').length > 0 ) {
    $('body').addClass('has-sidebar');
  };

  // ----- Bootstrap Support ----- //
  // --- Underscore --- //
  $('header.page-header').addClass('container');
  $('header.entry-header').addClass('container');
  $('body:not(.no-sidebar) .site-content').wrapInner("<div class='container' />");
  // --- Woocommerce --- //
  $('body.woocommerce .site-content').wrapInner("<div class='container' />");
  // --- Gutenberg & Stackable extension --- //
  $('.wp-block-columns').addClass('row');
  $('.wp-block-column').addClass('col');
  // --- Stackable - Gutenberg Blocks --- //
  if ( $('.ugb-container').hasClass('fullwidth') ) {
    $('.fullwidth .ugb-container__content-wrapper').addClass('container-fluid');
  } else {
      $('.ugb-container').addClass('boxed');
      $('.boxed .ugb-container__content-wrapper').addClass('container');
      $('.boxed .ugb-container__content-wrapper').attr('style','margin-right: auto; margin-left: auto');
  };
  // --- Hamburgers Menu --- //
  $('.navbar-toggle').click(function () {
    $('.navbar-toggle').toggleClass('is-active');
  });


} )( jQuery );
