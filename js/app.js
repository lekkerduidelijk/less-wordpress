// Include libraries with Gulp Include

//=require ../bower_components/jquery/dist/jquery.js
//=include module/**/*.js

/**
 * Main app
 *
 * @author: Rutger Laurman - lekkerduidelijk.nl
 * @url: https://github.com/lekkerduidelijk/less-wordpress
 */

// Avoid `console` errors in browsers that lack a console.
!function(){for(var a,b=function(){},c=["assert","clear","count","debug","dir","dirxml","error","exception","group","groupCollapsed","groupEnd","info","log","markTimeline","profile","profileEnd","table","time","timeEnd","timeline","timelineEnd","timeStamp","trace","warn"],d=c.length,e=window.console=window.console||{};d--;)a=c[d],e[a]||(e[a]=b)}(); // jshint ignore:line

var js_debug = js_debug || undefined;
// Global debug logger
var log = function(s){
  if (typeof(js_debug) !== 'undefined' && js_debug) {
    console.log(s);
  }
};

// APP namespace
var APP = (function($){

  // Object scope settings
  var s = {};

  // Init method
  function init() {
    log("APP.init()");

  }

  // Expose to public
  return { init: init };

})(jQuery);

// Document ready
jQuery(document).ready(function(){
  APP.init();
});
