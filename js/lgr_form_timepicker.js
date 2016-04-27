/*
  jQuery ui.timepickr - @VERSION
  http://code.google.com/p/jquery-utils/

  (c) Maxime Haineault <haineault@gmail.com> 
  http://haineault.com

  MIT License (http://www.opensource.org/licenses/mit-license.php

  Note: if you want the original experimental plugin checkout the rev 224 

  Dependencies
  ------------
  - jquery.utils.js
  - jquery.strings.js
  - jquery.ui.js
  
*/

(function(jQuery) {

jQuery.tpl('timepickr.menu',   '<div class="ui-helper-reset ui-timepickr ui-widget" />');
jQuery.tpl('timepickr.row',    '<ol class="ui-timepickr-row ui-helper-clearfix" />');
jQuery.tpl('timepickr.button', '<li class="{className:s}"><span class="ui-state-default">{label:s}</span></li>');

jQuery.widget('ui.timepickr', {
    plugins: {},
    _init: function() {
        this._dom = {
            menu: jQuery.tpl('timepickr.menu'),
            row:  jQuery.tpl('timepickr.menu')
        };
        this._trigger('initialize');
        this._trigger('initialized');
    },

    _trigger: function(type, e, ui) {
        var ui = ui || this;
        jQuery.ui.plugin.call(this, type, [e, ui]);
        return jQuery.widget.prototype._trigger.call(this, type, e, ui);
    },

    _createButton: function(i, format, className) {
        var o  = format && jQuery.format(format, i) || i;
        var cn = className && 'ui-timepickr-button '+ className || 'ui-timepickr-button';
        return jQuery.tpl('timepickr.button', {className: cn, label: o}).data('id', i)
                .bind('mouseover', function(){
                    jQuery(this).siblings().find('span')
                        .removeClass('ui-state-hover').end().end()
                        .find('span').addClass('ui-state-hover');
                });

    },

    _addRow: function(range, format, className, insertAfter) {
        var ui  = this;
        var btn = false;
        var row = jQuery.tpl('timepickr.row').bind('mouseover', function(){
            jQuery(this).next().show();
        });
        jQuery.each(range, function(idx, val){
            ui._createButton(val, format || false).appendTo(row);
        });
        if (className) {
            jQuery(row).addClass(className);
        }
        if (this.options.corners) {
             row.find('span').addClass('ui-corner-'+ this.options.corners);
        }
        if (insertAfter) {
            row.insertAfter(insertAfter);
        }
        else {
            ui._dom.menu.append(row);
        }
        return row;
    },

    _setVal: function(val) {
        val = val || this._getVal();
        this.element.data('timepickr.initialValue', val);
        this.element.val(this._formatVal(val));
        if(this._dom.menu.is(':hidden')) {
            this.element.trigger('change');
        }
    },

    _getVal: function() {
        var ols = this._dom.menu.find('ol');
        function get(unit) {
            var u = ols.filter('.'+unit).find('.ui-state-hover:first').text();
            return u || ols.filter('.'+unit+'li:first span').text();
        }
        return {
            h: get('hours'),
            m: get('minutes'),
            s: get('seconds'),
            a: get('prefix'),
            z: get('suffix'),
            f: this.options['format'+ this.c],
            c: this.c
        };
    },

    _formatVal: function(ival) {
        var val = ival || this._getVal();
        val.c = this.options.convention;
        val.f = val.c === 12 && this.options.format12 || this.options.format24;
        return (new Time(val)).getTime();
    },

    blur: function() {
        return this.element.blur();      
    },

    focus: function() {
        return this.element.focus();      
    },
    show: function() {
        this._trigger('show');
        this.element.trigger(this.options.trigger);
    },
    hide: function() {
        this._trigger('hide');
        this._dom.menu.hide();
    }

});

// These properties are shared accross every instances of timepickr 
jQuery.extend(jQuery.ui.timepickr, {
    version:     '@VERSION',
    //eventPrefix: '',
    //getter:      '',
    defaults:    {
        convention:  24, // 24, 12
        trigger:     'click',
        format12:    '{h:02.d}:{m:02.d} {z:s}',
        format24:    '{h:02.d}:{m:02.d}',
        hours:       true,
        prefix:      ['am', 'pm'],
        suffix:      ['am', 'pm'],
        prefixVal:   false,
        suffixVal:   true,
        rangeHour12: jQuery.range(1, 13),
        rangeHour24: [jQuery.range(0, 12), jQuery.range(12, 24)],
        rangeMin:    jQuery.range(0, 60, 15),
        rangeSec:    jQuery.range(0, 60, 15),
        corners:     'all',
        // plugins
        core:        true,
        minutes:     true,
        seconds:     false,
        val:         false,
        updateLive:  true,
        resetOnBlur: true,
        keyboardnav: true,
        handle:      false,
        handleEvent: 'click'
    }
});

jQuery.ui.plugin.add('timepickr', 'core', {
    initialized: function(e, ui) {
        var menu = ui._dom.menu;
        var pos  = ui.element.position();

        menu.insertAfter(ui.element).css('left', pos.left);

        if (!jQuery.boxModel) { // IE alignement fix
            menu.css('margin-top', ui.element.height() + 8);
        }
        
        ui.element
            .bind(ui.options.trigger, function() {
                ui._dom.menu.show();
                ui._dom.menu.find('ol:first').show();
                ui._trigger('focus');
                if (ui.options.trigger != 'focus') {
                    ui.element.focus();
                }
                ui._trigger('focus');
            })
            .bind('blur', function() {
                ui.hide();
                ui._trigger('blur');
            });

        menu.find('li').bind('mouseover.timepickr', function() {
            ui._trigger('refresh');
        });
    },
    refresh: function(e, ui) {
        // Realign each menu layers
        ui._dom.menu.find('ol').each(function(){
            var p = jQuery(this).prev('ol');
            try { // .. to not fuckup IE
                jQuery(this).css('left', p.position().left + p.find('.ui-state-hover').position().left);
            } catch(e) {};
        });
    }
});

jQuery.ui.plugin.add('timepickr', 'hours', {
    initialize: function(e, ui) {
        if (ui.options.convention === 24) {
            // prefix is required in 24h mode
            ui._dom.prefix = ui._addRow(ui.options.prefix, false, 'prefix'); 

            // split-range
            if (jQuery.isArray(ui.options.rangeHour24[0])) {
                var range = [];
                jQuery.merge(range, ui.options.rangeHour24[0]);
                jQuery.merge(range, ui.options.rangeHour24[1]);
                ui._dom.hours = ui._addRow(range, '{0:0.2d}', 'hours');
                ui._dom.hours.find('li').slice(ui.options.rangeHour24[0].length, -1).hide();
                var lis   = ui._dom.hours.find('li'); 

                var show = [
                    function() {
                        lis.slice(ui.options.rangeHour24[0].length).hide().end()
                           .slice(0, ui.options.rangeHour24[0].length).show()
                           .filter(':visible:first').trigger('mouseover');

                    },
                    function() {
                        lis.slice(0, ui.options.rangeHour24[0].length).hide().end()
                           .slice(ui.options.rangeHour24[0].length).show()
                           .filter(':visible:first').trigger('mouseover');
                    }
                ];

                ui._dom.prefix.find('li').bind('mouseover.timepickr', function(){
                    var index = ui._dom.menu.find('.prefix li').index(this);
                    show[index].call();
                });
            }
            else {
                ui._dom.hours = ui._addRow(ui.options.rangeHour24, '{0:0.2d}', 'hours');
                ui._dom.hours.find('li').slice(12, -1).hide();
            }
        }
        else {
            ui._dom.hours  = ui._addRow(ui.options.rangeHour12, '{0:0.2d}', 'hours');
            // suffix is required in 12h mode
            ui._dom.suffix = ui._addRow(ui.options.suffix, false, 'suffix'); 
        }
    }});

jQuery.ui.plugin.add('timepickr', 'minutes', {
    initialize: function(e, ui) {
        var p = ui._dom.hours && ui._dom.hours || false;
        ui._dom.minutes = ui._addRow(ui.options.rangeMin, '{0:0.2d}', 'minutes', p);
    }
});

jQuery.ui.plugin.add('timepickr', 'seconds', {
    initialize: function(e, ui) {
        var p = ui._dom.minutes && ui._dom.minutes || false;
        ui._dom.seconds = ui._addRow(ui.options.rangeSec, '{0:0.2d}', 'seconds', p);
    }
});

jQuery.ui.plugin.add('timepickr', 'val', {
    initialized: function(e, ui) {
        ui._setVal(ui.options.val);
    }
});

jQuery.ui.plugin.add('timepickr', 'updateLive', {
    refresh: function(e, ui) {
        ui._setVal();
    }
});

jQuery.ui.plugin.add('timepickr', 'resetOnBlur', {
    initialized: function(e, ui) {
        ui.element.data('timepickr.initialValue', ui._getVal());
        ui._dom.menu.find('li > span').bind('mousedown.timepickr', function(){
            ui.element.data('timepickr.initialValue', ui._getVal()); 
        });
    },
    blur: function(e, ui) {
        ui._setVal(ui.element.data('timepickr.initialValue'));
    }
});

jQuery.ui.plugin.add('timepickr', 'handle', {
    initialized: function(e, ui) {
        jQuery(ui.options.handle).bind(ui.options.handleEvent + '.timepickr', function(){
            ui.show();
        });
    }
});

jQuery.ui.plugin.add('timepickr', 'keyboardnav', {
    initialized: function(e, ui) {
        ui.element
            .bind('keydown', function(e) {
                if (jQuery.keyIs('enter', e)) {
                    ui._setVal();
                    ui.blur();
                }
                else if (jQuery.keyIs('escape', e)) {
                    ui.blur();
                }
            });
    }
});

var Time = function() { // arguments: h, m, s, c, z, f || time string
    if (!(this instanceof arguments.callee)) {
        throw Error("Constructor called as a function");
    }
    // arguments as literal object
    if (arguments.length == 1 && jQuery.isObject(arguments[0])) {
        this.h = arguments[0].h || 0;
        this.m = arguments[0].m || 0;
        this.s = arguments[0].s || 0;
        this.c = arguments[0].c && (jQuery.inArray(arguments[0].c, [12, 24]) >= 0) && arguments[0].c || 24;
        this.f = arguments[0].f || ((this.c == 12) && '{h:02.d}:{m:02.d} {z:02.d}' || '{h:02.d}:{m:02.d}');
        this.z = arguments[0].z || 'am';
    }
    // arguments as string
    else if (arguments.length < 4 && jQuery.isString(arguments[1])) {
        this.c = arguments[2] && (jQuery.inArray(arguments[0], [12, 24]) >= 0) && arguments[0] || 24;
        this.f = arguments[3] || ((this.c == 12) && '{h:02.d}:{m:02.d} {z:02.d}' || '{h:02.d}:{m:02.d}');
        this.z = arguments[4] || 'am';
        
        this.h = arguments[1] || 0; // parse
        this.m = arguments[1] || 0; // parse
        this.s = arguments[1] || 0; // parse
    }
    // no arguments (now)
    else if (arguments.length === 0) {
        // now
    }
    // standards arguments
    else {
        this.h = arguments[0] || 0;
        this.m = arguments[1] || 0;
        this.s = arguments[2] || 0;
        this.c = arguments[3] && (jQuery.inArray(arguments[3], [12, 24]) >= 0) && arguments[3] || 24;
        this.f = this.f || ((this.c == 12) && '{h:02.d}:{m:02.d} {z:02.d}' || '{h:02.d}:{m:02.d}');
        this.z = 'am';
    }
    return this;
};

Time.prototype.get        = function(p, f, u)    { return u && this.h || jQuery.format(f, this.h); };
Time.prototype.getHours   = function(unformated) { return this.get('h', '{0:02.d}', unformated); };
Time.prototype.getMinutes = function(unformated) { return this.get('m', '{0:02.d}', unformated); };
Time.prototype.getSeconds = function(unformated) { return this.get('s', '{0:02.d}', unformated); };
Time.prototype.setFormat  = function(format)     { return this.f = format; };
Time.prototype.getObject  = function()           { return { h: this.h, m: this.m, s: this.s, c: this.c, f: this.f, z: this.z }; };
Time.prototype.getTime    = function()           { return jQuery.format(this.f, {h: this.h, m: this.m, z: this.z}); };
Time.prototype.parse      = function(str) { 
    // 12h formats
    if (this.c === 12) {
        // Supported formats: (can't find any *official* standards for 12h..)
        //  - [hh]:[mm]:[ss] [zz] | [hh]:[mm] [zz] | [hh] [zz] 
        //  - [hh]:[mm]:[ss] [z.z.] | [hh]:[mm] [z.z.] | [hh] [z.z.]
        this.tokens = str.split(/\s|:/);    
        this.h = this.tokens[0] || 0;
        this.m = this.tokens[1] || 0;
        this.s = this.tokens[2] || 0;
        this.z = this.tokens[3] || '';
        return this.getObject();
    }
    // 24h formats
    else { 
        // Supported formats:
        //  - ISO 8601: [hh][mm][ss] | [hh][mm] | [hh]  
        //  - ISO 8601 extended: [hh]:[mm]:[ss] | [hh]:[mm] | [hh]
        this.tokens = /:/.test(str) && str.split(/:/) || str.match(/[0-9]{2}/g);
        this.h = this.tokens[0] || 0;
        this.m = this.tokens[1] || 0;
        this.s = this.tokens[2] || 0;
        this.z = this.tokens[3] || '';
        return this.getObject();
    }
};

})(jQuery);