// Add modules here to include them in dist/vendor.js file for improved code splitting

// IMPORTANT: babel-polyfill must be imported, but only once, so leave it imported only in this file
// *********************
import 'babel-polyfill';
// *********************
<% if (jquery === true || slick_slider === true) { -%>
import 'jquery';
<% } -%>
<% if (svgxuse === true) { -%>
import 'svgxuse';
<% } -%>
<% if (tweenmax === true || scrollmagic === true) { -%>
import 'gsap/TweenMax.js';
<% } -%>
<% if (is_js === true) { -%>
import 'is_js';
<% } -%>
<% if (slick_slider === true) { -%>
import 'slick-carousel/slick/slick.js';
<% } -%>
<% if (scrollmagic === true) { -%>
import 'ScrollMagic/scrollmagic/uncompressed/ScrollMagic.js';
import 'ScrollMagic/scrollmagic/uncompressed/plugins/animation.gsap.js';
import 'ScrollMagic/scrollmagic/uncompressed/plugins/debug.addIndicators.js';
<% } -%>
