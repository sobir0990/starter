// global __t $

function printContent(elem)
{
    $('.collapse').addClass('show');
    var data = $(elem).html();
    var w = window.open();
    w.document.write('<html><head><title></title>');
    w.document.write('<link rel="stylesheet" href="/theme/assets/plugins/bootstrap/css/bootstrap.min.css">');
    w.document.write('<link rel="stylesheet" href="/css/common.css">');
    w.document.write('<link rel="stylesheet" href="/css/print.css">');
    w.document.write('</head><body  onload="window.print()">');
    w.document.write(data);
    w.document.close();
}

(function () {
    'use strict';

    $(".model-date").bind("show hide", function (e) {
        e.stopPropagation();
        return false;
    });

    var body = $("body");

    $('body [data-toggle="popover"]').popover();
    $('body [data-toggle="tooltip"]').tooltip();

    $(document).on('pjax:complete', function () {
        $('body [data-toggle="tooltip"]').tooltip();
        $('body [data-toggle="popover"]').popover();
    })

    $("form").on('afterValidate', function () {

        $(this).find(".language-tabs .nav-link").removeClass("text-danger");

        $(this).find(".accordion [data-toggle='collapse']").removeClass("text-danger");

        var key = $(this).find(".is-invalid").closest('.tab-pane').attr("id");
        $("[href='#" + key + "']").addClass("text-danger");
        $(this).find(".is-invalid").closest('.collapse').prev().find("[data-toggle='collapse']").addClass("text-danger");

    });

    $('.modal-content').attr('id', 'project-modal-container');

    body.on('change', '.per-page', function () {
        window.location.assign(setUrlParameter(window.location.href, 'per-page', $(this).val()));
    });
    body.on('change', '.main-per-page', function () {
        window.location.assign(setUrlParameter(window.location.href, 'main-per-page', $(this).val()));
    });



    body.on('click', '.close-log', function () {
        $(this).closest('.modal').modal('hide');
    })
    body.on('click', '#submit', function () {
        $('#hidden').prop('disabled', false);
        setTimeout(function () {
            $('#hidden').prop('disabled', true);
        }, 3000);
    });


    body.on('click', '.accordion .btn-link', function () {
        $(this).find('i.fa-chevron-down').removeClass('fa-chevron-down').addClass('fa-chevron-right');
        $(this).parent().siblings('h2').find('i.fa-chevron-down').removeClass('fa-chevron-down').addClass('fa-chevron-right');
        $('.family').find('h2').find('i.fa-chevron-down').removeClass('fa-chevron-down').addClass('fa-chevron-right');
        if ($(this).hasClass('collapsed')) {
            $(this).find('.fa-chevron-right').removeClass('fa-chevron-right').addClass('fa-chevron-down');
        }
    });

    var enableSubmit = function (ele) {
        $(ele).removeAttr("disabled");
    };

    body.on('click', '.hide-section', function () {
        $(this).closest('.contact-section').addClass('d-none').find('input').prop('disabled', true);
        $(this).closest('.all-section').find('.show-section').removeClass('d-none');
    });

    body.on('click', '.show-section', function () {
        var dn = $(this).closest('.all-section').find('.contact-section.d-none').first();
        var lc = $(this).closest('.all-section').find('.contact-section.d-none').length;
        dn.removeClass('d-none');
        dn.find('input').prop('disabled', false);
        if (lc === 1) {
            $(this).addClass('d-none')
        }
    });

    body.on('click', 'form [type=submit], .export', function () {
        var that = this;
        $(this).attr("disabled", true);

        if ($(this).attr('form')) {
            $('#' + $(this).attr('form')).submit();
        } else {
            $(this).parents('form').submit();
        }
        setTimeout(function () {
            enableSubmit(that)
        }, 5000);
    });


    $('body [data-toggle="popover"]').on('show.bs.popover', function () {
        $('.popup-overlay').addClass('overlay-fade');
    });
    $('body [data-toggle="popover"]').on('hide.bs.popover', function () {
        $('.popup-overlay').removeClass('overlay-fade');
    });

    $(document).off('pjax:start');

    $(document).on('pjax:start', function () {
        $('body [data-toggle="tooltip"]').tooltip('dispose');
    });

    // $(document).on('pjax:end', function () {
    //     $('body [data-toggle="tooltip"]').tooltip();
    //     $('[data-toggle="popover"]').popover();
    // });


})();

function __t(txt, prm) {
    /* global VAR_TRANSLATIONS */
    'use strict';

    // var v = VAR_TRANSLATIONS[txt];
    // if (!v)
    var v = txt;

    for (var k in prm) {
        v = v.replace("{" + k.toString() + "}", prm[k]);
    }

    return htmlspecialchars(v);
}

function number_format(number, decimals, dec_point = '.', thousands_sep = ' ') {  // Format a number with grouped thousands
    var i, j, kw, kd, km, nl, lkd;
    // input sanitation & defaults
    if (isNaN(decimals = Math.abs(decimals))) {
        decimals = 2;
    }
    if (dec_point == undefined) {
        dec_point = ".";
    }
    if (thousands_sep == undefined) {
        thousands_sep = " ";
    }
    i = parseInt(number = (+number || 0).toFixed(decimals)) + "";
    if ((j = i.length) > 3) {
        j = j % 3;
    } else {
        j = 0;
    }
    km = (j ? i.substr(0, j) + thousands_sep : "");
    kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
    //kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
    kd = '0' + (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");
    nl = parseFloat(kd).valueOf();
    if (nl > 0) {
        lkd = nl.toString().substr(1);
    } else {
        lkd = '';
    }

    return km + kw + lkd;
}

/**
 *
 * @param sParam
 * @returns {*}
 */
function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
}

/**
 * Url parametrni o'zgartirib qaytaradi
 * @param url
 * @param param
 * @param new_value
 * @returns {string|null}
 */
function setUrlParameter(url, param, new_value) {

    var key = encodeURIComponent(param),
        value = encodeURIComponent(new_value);

    if (!url) {
        return null
    }

    var baseUrl = url.split('?')[0],
        newParam = key + '=' + value,
        params = '?' + newParam;

    if (url.split('?')[1] === undefined) { // if there are no query strings, make urlQueryString empty
        var urlQueryString = '';
    } else {
        var urlQueryString = '?' + url.split('?')[1];
    }

    // If the "search" string exists, then build params from it
    if (urlQueryString) {
        var updateRegex = new RegExp('([\?&])' + key + '[^&]*');
        var removeRegex = new RegExp('([\?&])' + key + '=[^&;]+[&;]?');

        if (value === undefined || value === null || value === '') { // Remove param if value is empty
            params = urlQueryString.replace(removeRegex, "$1");
            params = params.replace(/[&;]$/, "");

        } else if (urlQueryString.match(updateRegex) !== null) { // If param exists already, update it
            params = urlQueryString.replace(updateRegex, "$1" + newParam);

        } else if (urlQueryString == '') { // If there are no query strings
            params = '?' + newParam;
        } else { // Otherwise, add it to end of query string
            params = urlQueryString + '&' + newParam;
        }
    }

    // no parameter was set so we don't need the question mark
    params = params === '?' ? '' : params;

    return baseUrl + params;
}


function getValueByLanguage(data, defaultLanguage) {
    'use strict';
    var currentLanguage = $('html').attr('lang'),
        name = '';

    if (typeof data == 'undefined' || data == null)
        return;

    if (typeof data[currentLanguage] != "undefined" && data[currentLanguage] != null && data[currentLanguage] != '')
        return data[currentLanguage];

    if ((typeof data) == 'string')
        data = JSON.parse(data);

    if (defaultLanguage && (defaultLanguage in data)) {
        name = data[defaultLanguage];
    } else if (data) {
        $.each(data, function (k, item) {
            if (item.length > 0) {
                name = item;
                return false;
            }
        });
    }

    return name;
}

function htmlspecialchars(string, quote_style, charset, double_encode) {
    var optTemp = 0, i = 0, noquotes = false;
    if (typeof quote_style === 'undefined' || quote_style === null) {
        quote_style = 2;
    }
    string = string + '';
    if (double_encode !== false) { // Put this first to avoid double-encoding
        string = string.replace(/&/g, '&amp;');
    }
    string = string.replace(/</g, '<').replace(/>/g, '>');

    var OPTS = {
        'ENT_NOQUOTES': 0,
        'ENT_HTML_QUOTE_SINGLE': 1,
        'ENT_HTML_QUOTE_DOUBLE': 2,
        'ENT_COMPAT': 2,
        'ENT_QUOTES': 3,
        'ENT_IGNORE': 4
    };
    if (quote_style === 0) {
        noquotes = true;
    }
    if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
        quote_style = [].concat(quote_style);
        for (i = 0; i < quote_style.length; i++) {
            // Resolve string input to bitwise e.g. 'ENT_IGNORE' becomes 4
            if (OPTS[quote_style[i]] === 0) {
                noquotes = true;
            } else if (OPTS[quote_style[i]]) {
                optTemp = optTemp | OPTS[quote_style[i]];
            }
        }
        quote_style = optTemp;
    }
    if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
        string = string.replace(/'/g, '&#039;');
    }
    if (!noquotes) {
        string = string.replace(/"/g, '"');
    }
    return string;
}


