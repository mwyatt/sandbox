(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var dialogueFactory = require('mwyatt-dialogue');

},{"mwyatt-dialogue":3}],2:[function(require,module,exports){
!function(a,b){"object"==typeof exports?module.exports=b():"function"==typeof define&&define.amd?define([],b):a.Draggable=b()}(this,function(){"use strict";function a(a,b){var c=this,d=k.bind(c.start,c),e=k.bind(c.drag,c),g=k.bind(c.stop,c);if(!f(a))throw new TypeError("Draggable expects argument 0 to be an Element");k.assign(c,{element:a,handlers:{start:{mousedown:d,touchstart:d},move:{mousemove:e,mouseup:g,touchmove:e,touchend:g}},options:k.assign({},i,b)}),c.initialize()}function b(a){return parseInt(a,10)}function c(a){return"currentStyle"in a?a.currentStyle:getComputedStyle(a)}function d(a){return a instanceof Array}function e(a){return void 0!==a&&null!==a}function f(a){return a instanceof Element||a instanceof HTMLDocument}function g(a){return a instanceof Function}function h(){}var i={grid:0,filterTarget:null,limit:{x:null,y:null},threshold:0,setCursor:!1,setPosition:!0,smoothDrag:!0,useGPU:!0,onDrag:h,onDragStart:h,onDragEnd:h},j={transform:function(){for(var a=" -o- -ms- -moz- -webkit-".split(" "),b=document.body.style,c=a.length;c--;){var d=a[c]+"transform";if(d in b)return d}}()},k={assign:function(){for(var a=arguments[0],b=arguments.length,c=1;b>c;c++){var d=arguments[c];for(var e in d)a[e]=d[e]}return a},bind:function(a,b){return function(){a.apply(b,arguments)}},on:function(a,b,c){if(b&&c)k.addEvent(a,b,c);else if(b)for(var d in b)k.addEvent(a,d,b[d])},off:function(a,b,c){if(b&&c)k.removeEvent(a,b,c);else if(b)for(var d in b)k.removeEvent(a,d,b[d])},limit:function(a,b){return d(b)?(b=[+b[0],+b[1]],a<b[0]?a=b[0]:a>b[1]&&(a=b[1])):a=+b,a},addEvent:"attachEvent"in Element.prototype?function(a,b,c){a.attachEvent("on"+b,c)}:function(a,b,c){a.addEventListener(b,c,!1)},removeEvent:"attachEvent"in Element.prototype?function(a,b,c){a.detachEvent("on"+b,c)}:function(a,b,c){a.removeEventListener(b,c)}};return k.assign(a.prototype,{setOption:function(a,b){var c=this;return c.options[a]=b,c.initialize(),c},get:function(){var a=this.dragEvent;return{x:a.x,y:a.y}},set:function(a,b){var c=this,d=c.dragEvent;return d.original={x:d.x,y:d.y},c.move(a,b),c},dragEvent:{started:!1,x:0,y:0},initialize:function(){var a,b=this,d=b.element,e=d.style,f=c(d),g=b.options,h=j.transform,i=b._dimensions={height:d.offsetHeight,left:d.offsetLeft,top:d.offsetTop,width:d.offsetWidth};g.useGPU&&h&&(a=f[h],"none"===a&&(a=""),e[h]=a+" translate3d(0,0,0)"),g.setPosition&&(e.display="block",e.left=i.left+"px",e.top=i.top+"px",e.bottom=e.right="auto",e.margin=0,e.position="absolute"),g.setCursor&&(e.cursor="move"),b.setLimit(g.limit),k.assign(b.dragEvent,{x:i.left,y:i.top}),k.on(b.element,b.handlers.start)},start:function(a){var b=this,c=b.getCursor(a),d=b.element;b.useTarget(a.target||a.srcElement)&&(a.preventDefault?a.preventDefault():a.returnValue=!1,b.dragEvent.oldZindex=d.style.zIndex,d.style.zIndex=1e4,b.setCursor(c),b.setPosition(),b.setZoom(),k.on(document,b.handlers.move))},drag:function(a){var b=this,c=b.dragEvent,d=b.element,e=b._cursor,f=b._dimensions,g=b.options,h=f.zoom,i=b.getCursor(a),j=g.threshold,k=(i.x-e.x)/h+f.left,l=(i.y-e.y)/h+f.top;!c.started&&j&&Math.abs(e.x-i.x)<j&&Math.abs(e.y-i.y)<j||(c.original||(c.original={x:k,y:l}),c.started||(g.onDragStart(d,k,l,a),c.started=!0),b.move(k,l)&&g.onDrag(d,c.x,c.y,a))},move:function(a,b){var c=this,d=c.dragEvent,e=c.options,f=e.grid,g=c.element.style,h=c.limit(a,b,d.original.x,d.original.y);return!e.smoothDrag&&f&&(h=c.round(h,f)),h.x!==d.x||h.y!==d.y?(d.x=h.x,d.y=h.y,g.left=h.x+"px",g.top=h.y+"px",!0):!1},stop:function(a){var b,c=this,d=c.dragEvent,e=c.element,f=c.options,g=f.grid;k.off(document,c.handlers.move),e.style.zIndex=d.oldZindex,f.smoothDrag&&g&&(b=c.round({x:d.x,y:d.y},g),c.move(b.x,b.y),k.assign(c.dragEvent,b)),c.dragEvent.started&&f.onDragEnd(e,d.x,d.y,a),c.reset()},reset:function(){this.dragEvent.started=!1},round:function(a){var b=this.options.grid;return{x:b*Math.round(a.x/b),y:b*Math.round(a.y/b)}},getCursor:function(a){return{x:(a.targetTouches?a.targetTouches[0]:a).clientX,y:(a.targetTouches?a.targetTouches[0]:a).clientY}},setCursor:function(a){this._cursor=a},setLimit:function(a){var b=this,c=function(a,b){return{x:a,y:b}};if(g(a))b.limit=a;else if(f(a)){var d=b._dimensions,h=a.scrollHeight-d.height,i=a.scrollWidth-d.width;b.limit=function(a,b){return{x:k.limit(a,[0,i]),y:k.limit(b,[0,h])}}}else if(a){var j={x:e(a.x),y:e(a.y)};b.limit=j.x||j.y?function(b,c){return{x:j.x?k.limit(b,a.x):b,y:j.y?k.limit(c,a.y):c}}:c}else b.limit=c},setPosition:function(){var a=this,c=a.element,d=c.style;k.assign(a._dimensions,{left:b(d.left)||c.offsetLeft,top:b(d.top)||c.offsetTop})},setZoom:function(){for(var a=this,b=a.element,d=1;b=b.offsetParent;){var e=c(b).zoom;if(e&&"normal"!==e){d=e;break}}a._dimensions.zoom=d},useTarget:function(a){var b=this.options.filterTarget;return b instanceof Function?b(a):!0},destroy:function(){k.off(this.element,this.handlers.start),k.off(document,this.handlers.move)}}),a});
},{}],3:[function(require,module,exports){
(function (global){
var $ = (typeof window !== "undefined" ? window['$'] : typeof global !== "undefined" ? global['$'] : null);
var mustache = (typeof window !== "undefined" ? window['Mustache'] : typeof global !== "undefined" ? global['Mustache'] : null);
var draggable = require('draggable');

var $document = $(document);
var $window = $(window);
var $body = $('body');
var dialogueOpenCount = 1;

var templateContainer = require('./js/container.mustache');

var keyCode = {
  esc: 27
};

var classNames = {
  container: 'js-dialogue-container',
  dialogue: 'js-dialogue',
  dialogueHtml: 'js-dialogue-html',
  dialogueClose: 'js-dialogue-close',
  dialogueMask: 'js-dialogue-mask'
};

// obtains css selector version of a class name
// how can this be done better?
var gS = function(className) {
  return '.' + className;
};

function getRandomString() {
  var text = '';
  var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  for (var i = 0; i < 5; i++)
  text += possible.charAt(Math.floor(Math.random() * possible.length));
  return text;
}

// unchanging events
// does event pass?
var Dialogue = function(event) {};

// override if you wish to use your own template
Dialogue.prototype.setTemplateContainer = function(html) {
  templateContainer = html;
};

/**
 * render, bind events, and position new dialogue
 */
Dialogue.prototype.create = function(options) {
  var defaultOptions = {
    templateContainer: '', // the mustache template container html
    className: '', // to identify the dialogue uniquely

    // optional
    title: '',
    description: '',
    positionTo: '', // $selector where the dialogue will appear
    hardClose: false, // make it difficult to close the dialogue
    mask: false, // mask the page below
    width: false, // int
    ajax: false, // starts the dialogue with html = spinner
    hideClose: false,
    html: '', // raw html to be placed in to body area, under description
    draggable: '', // draggable instance
    actions: {
    // 'Cancel': function() {
    //   this.close();
    // },
    // 'Ok': function() {
    //   console.log('Ok');
    // }
    },

    // new layout which allows for limitless definition of what an action does
    // should basic actions be removed? yes to keep all consistent
    actions: [
    // {
    //    name: 'Open',
    //    classes: ['button primary', 'right'],
    //    action: function() {

		 //    }
    // }
    ],
    onComplete: function() {}, // fired when dialogue has been rendered
    onClose: function() {}, // fired when dialogue has been closed

    // jquery ajax object
    ajaxConfig: false,

    // proposed
    cssAnimation: false // to tell close whether to check for animation end? still a problem with browser compatibility
  };
  this.options = $.extend(defaultOptions, options);

  // need to have a unique classname otherwise it cant be selected
  this.options.className = this.options.className ? this.options.className : getRandomString();

  if (this.options.actions) {
    this.options.actionNames = [];
    for (var actionName in this.options.actions) {
      this.options.actionNames.push(actionName);
    };
  };

  $body.prepend(mustache.render(templateContainer, this.options));

  this.$container = $(gS(classNames.container) + gS(this.options.className + '-container'));
  this.$dialogue = this.$container.find(gS(classNames.dialogue));
  this.$dialogueHtml = this.$container.find(gS(classNames.dialogueHtml));

  if (this.options.mask) {
    this.$dialogueMask = this.$container.find(gS(classNames.dialogueMask));
  };

  if (this.options.draggable) {
    new draggable (this.$dialogue[0], {
      filterTarget: function(target) {
        return $(target).hasClass('js-dialogue-draggable-handle');
      }
    });
  }

  if (typeof event == 'undefined') {
    var event = {};
  }
  event.data = this;

  this.setEvents(event);

  if (this.options.ajax) {
    this.setHtml('<div class="dialogue-spinner-container"><div class="dialogue-spinner"></div></div>');
  }

  if (this.options.ajaxConfig) {
    this.handleAjax(event);

    // no ajax
  } else {

    // completed build
    this.options.onComplete.call(event.data);

    this.$container.css('z-index', dialogueOpenCount++);
    event.data.applyCssPosition(event);
  };
};

Dialogue.prototype.handleAjax = function(event) {
  var config = event.data.options.ajaxConfig;
  var isImage;

  // using a class because cant think of a way to get the ajax loader
  // inside the plugin, css3 spinner?
  var ajaxLoadClass = 'dialogue-ajax-is-loading';

  event.data.$container.addClass(ajaxLoadClass);
  event.data.applyCssPosition(event);

  // image or data?
  // if (config.url.indexOf('.jpg') || config.url.indexOf('.gif') || config.url.indexOf('.png')) {
  //   isImage = true;
  // };

  $.ajax({
    type: config.type,
    url: config.url,
    dataType: config.dataType,
    data: config.data,
    complete: function() {
      event.data.$container.removeClass(ajaxLoadClass);
      // config.complete.call(event.data);
      event.data.options.onComplete.call(event.data);
      event.data.applyCssPosition(event);
    },
    success: function(response) {
      config.success.call(event.data, response);
      event.data.applyCssPosition(event);
    },
    error: function(response) {
      config.error.call(event.data, response);
      event.data.applyCssPosition(event);
    }
  });
};

Dialogue.prototype.setEvents = function(event) {

  // not hard to close
  if (!event.data.options.hardClose) {

    // hit esc
    $document.on('keyup.dialogue.close', event.data, function(event) {
      if (event.which == keyCode.esc) {
        event.data.closeWithEvent(event);
      }
    });

    // mousedown outside of dialogue
    // down used because when clicking and dragging an input value will
    // close it
    event.data.$container.on('mousedown.dialogue.close', event.data, function(event) {
      if (!$(event.target).closest(gS(classNames.dialogue)).length) {
        event.data.closeWithEvent(event);
      }
    });
  };

  $window.on('scroll.mwyatt-dialogue', function() {
    // console.log('scrolling');
  });

  // option actions [ok, cancel]
  var actions = event.data.options.actions;
  if (actions) {
    $document.on('keypress.dialogue.action', '.js-dialogue-action', function(event) {
      if (event.which == keyCode.enter) {
        $(this).trigger('click.dialogue.action');
      };
    });
    for (var actionName in actions) {
      event.data.setActionEvent(event, actionName, actions[actionName]);
    };
    $('.js-dialogue-action').last().focus();
  };

  // click body means dont close
  event.data.$container.on('click.dialogue.body', gS(classNames.dialogue), this, function(event) {
    event.stopPropagation();
  });

  // clicking close [x]
  event.data.$container.on('click.dialogue.close', gS(classNames.dialogueClose), this, function(event) {
    event.data.closeWithEvent(event);
  });
};

Dialogue.prototype.setActionEvent = function(event, actionName, actionFunction) {
  event.data.$container.on('click.dialogue.action', '.js-dialogue-action[data-name="' + actionName + '"]', event.data, function(event) {
    actionFunction.call(event.data);
  });
};

// apply the css to the dialogue
// max-width
// position
Dialogue.prototype.applyCssPosition = function(event) {
  var containerPadding = 20;
  var cssSettings = {};
  cssSettings['max-width'] = event.data.options.width;

  // position dialogue
  var $positionalElement = event.data.options.positionTo;
  var clientFrame = {
    positionVertical: $window[0].pageYOffset,
    height: $window[0].innerHeight,
    width: $window.width()
  };

  var borderWidth = 1;
  var paddingWidth = 20;
  var dialogueHeight = parseInt(event.data.$dialogue.height()) + (paddingWidth * 2) + (borderWidth * 2);

  // position container
  event.data.$container.css({
    top: clientFrame.positionVertical
  });

  // position to element or centrally window
  if ($positionalElement.length) {

    // calc top
    cssSettings.position = 'absolute';
    cssSettings.top = parseInt($positionalElement.offset().top) - parseInt(event.data.$container.offset().top);
    cssSettings.left = parseInt($positionalElement.offset().left);

    // if the right side of the dialogue is poking out of the clientFrame then
    // bring it back in plus 50px padding
    if ((cssSettings.left + cssSettings['max-width']) > clientFrame.width) {
      cssSettings.left = clientFrame.width - 50;
      cssSettings.left = cssSettings.left - cssSettings['max-width'];
    };

    // no positional element so center to window
  } else {
    cssSettings.position = 'relative';
    cssSettings.margin = '0 auto';
    cssSettings.left = 'auto';

    // center vertically if there is room
    // otherwise send to top and then just scroll
    if (dialogueHeight < clientFrame.height) {
      cssSettings.top = parseInt(clientFrame.height / 2) - parseInt(dialogueHeight / 2) - containerPadding;
    } else {
      cssSettings.top = 0;
    };
  };

  event.data.$dialogue.css(cssSettings);
};

/**
 * call onclose and remove
 * @param  {object} data
 * @return {null}
 */
Dialogue.prototype.closeWithEvent = function(event) {

  dialogueOpenCount--;

  // remove after animation (issue with if there was no animation)
  // var removeClassName = 'dialogue-remove';
  // this.$container.addClass(removeClassName);
  // this.$dialogue.on(getMotionEventName('animation'), function() {

  // remove events
  $document
  // .off('click.dialogue.action')
  .off('keyup.dialogue.close');

  // may have never been opened, attempted to close without ever opening
  if (typeof event.data.$container !== 'undefined') {
    event.data.$container.off(); // needed?
    event.data.$container.remove();
    event.data.options.onClose.call(event.data);
    $window.off('scroll.mwyatt-dialogue');
  }
};

Dialogue.prototype.close = function() {
  this.closeWithEvent({data: this});
};

Dialogue.prototype.setHtml = function(html) {
  this.$dialogueHtml.html(html);
};

Dialogue.prototype.setTitle = function(html) {
  this.$dialogue.find('.js-dialogue-title').html(html);
};

Dialogue.prototype.isOpen = function() {
  return typeof this.$dialogue !== 'undefined';
};

Dialogue.prototype.reposition = function() {
  this.applyCssPosition({data: this});
};

module.exports = Dialogue;

}).call(this,typeof global !== "undefined" ? global : typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{"./js/container.mustache":4,"draggable":2}],4:[function(require,module,exports){
module.exports = "<div class=\"dialogue-container js-dialogue-container {{#className}}{{className}}-container{{/className}}\">\n\n{{#mask}}\n\n    <div class=\"dialogue-mask js-dialogue-mask {{#className}}{{className}}-mask{{/className}}\"></div>\n\n{{/mask}}\n\n    <div class=\"dialogue js-dialogue {{#className}}{{className}}-dialogue{{/className}}\">\n\n{{#draggable}}\n\n        <div class=\"dialogue-draggable-handle js-dialogue-draggable-handle\"></div>\n    \n{{/draggable}}\n{{^hideClose}}\n\n        <span class=\"dialogue-close js-dialogue-close\">&times;</span>\n\n{{/hideClose}}\n{{#title}}\n\n        <h6 class=\"dialogue-title js-dialogue-title\">{{title}}</h6>\n\n{{/title}}\n{{#description}}\n\n        <p class=\"dialogue-description\">{{description}}</p>\n\n{{/description}}\n\n        <div class=\"dialogue-html js-dialogue-html\">{{{html}}}</div>\n\n{{#actionNames.length}}\n\n        <div class=\"dialogue-actions\">\n\n    {{#actionNames}}\n\n            <button class=\"button primary dialogue-action js-dialogue-action\" data-name=\"{{.}}\">{{.}}</button>\n\n    {{/actionNames}}\n\n        </div>\n\n{{/actionNames.length}}\n\n    </div>\n</div>\n";

},{}]},{},[1]);
