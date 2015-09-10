$(window).load(function () {
//королбокс на картинки
    $("a.gallery").colorbox({
        maxWidth: 1024, maxHeight: 900, title: function () {
            var url = $(this).attr('href');
            return '<a href="' + url + '" target="_blank">Открыть в полном окне</a>';
        }
    });

//  $("a.form").colorbox();
    $(function () {
        $('form#newsAdd').find('button');
    })
});

$(function () {

    var today = new Date();
    var now = today.getDate();
    var year = today.getYear();
    var month = today.getMonth();
    var hours = today.getHours();
    var minuts = today.getMinutes();
    var monarr = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    if (((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0)) monarr[1] = "29";

    var data = new Date();
    var data = new Date(data.getFullYear(), data.getMonth(), data.getDate() + (monarr[month] + 1 - now), data.getHours() - hours, data.getMinutes() - minuts, 0, 0);
    var ts = new Date(data);

    $('.counter').countdown({timestamp: ts});
    $('.counter1').countdown({timestamp: ts});
});

$(document).ready(function () {
    $('.scrollto').click(function (event) {
        event.preventDefault();
        var full_url = this.href;
        var parts = full_url.split("#");
        var trgt = parts[1];
        var fix = 0;
        var target_offset = $("#" + trgt).offset();
        var target_top = target_offset.top - 40;
        var scrTop = $(window).scrollTop();
        if (target_top != scrTop) {
            $('html, body').animate({scrollTop: target_top}, 500);
        }
    });
    $('.popup').fancybox();
    $('.section6 .flexslider').flexslider({
        animation: "slide",
        controlNav: false,
        itemWidth: 212,
        prevText: "",
        nextText: ""
    });
    $('.section8 .flexslider').flexslider({
        animation: "slide",
        controlNav: false,
        prevText: "",
        nextText: ""
    });


    var myMap;
    ymaps.ready(init);
    function init() {
        myMap = new ymaps.Map("map", {
            center: [57.9515, 56.0],
            zoom: 11,
            controls: []
        }),
            myPlacemark = new ymaps.Placemark([57.9951, 56.1992], {
                iconContent: '(СѓР». Р Р°Р±РѕС‡Р°СЏ 9) вЂ“ РћС‚РґРµР» РїСЂРѕРґР°Р¶',
                balloonContentHeader: 'Р’РѕР»С€РµР±РЅС‹Р№ Р‘Р РР— вЂ“ РћС‚РґРµР» РїСЂРѕРґР°Р¶',
                balloonContentBody: 'Рі. РџРµСЂРјСЊ, СѓР». Р Р°Р±РѕС‡Р°СЏ 9, РѕС„. 57<br>+7 (342) 787-57-44'
            }, {
                preset: 'islands#blackStretchyIcon'
            }),
            myPlacemark1 = new ymaps.Placemark([57.8980, 55.9405], {
                iconContent: '(РљРёСЂРѕРІР° 9) вЂ“ РџСЂРѕРёР·РІРѕРґСЃС‚РІРѕ',
                balloonContentHeader: 'Р’РѕР»С€РµР±РЅС‹Р№ Р‘Р РР— - РџСЂРѕРёР·РІРѕРґСЃС‚РІРѕ',
                balloonContentBody: 'СЃ.РљСѓР»С‚Р°РµРІРѕ, СѓР».РљРёСЂРѕРІР° 9'
            }, {
                preset: 'islands#blackStretchyIcon'
            });
        myMap.behaviors
            .disable(['scrollZoom']);
        myMap.controls
            .add('zoomControl', {left: 5, top: 5})
        myMap.geoObjects
            .add(myPlacemark);
        myMap.geoObjects
            .add(myPlacemark1);
    }

});


var submitForm = function (form) {
    $.post(
        './php/form.php',
        $('#' + form).serialize(),
        function (response) {
            var data = $.parseJSON(response);
            if (data.result == 'ok') {
                $('#' + form)[0].reset();
                $.fancybox({href: '#win_success'});
            }
            else {
                $('#' + form + ' .error').addClass('active');
                var top;
                var left;
                if (data.message == 'name') {
                    if (form == 'form01') {
                        top = '180px';
                        left = '30px';
                    }
                    if (form == 'form02' || form == 'form04') {
                        top = '201px';
                        left = '30px';
                    }
                    if (form == 'form03' || form == 'form05' || form == 'form06' || form == 'form07' || form == 'form08' || form == 'form09') {
                        top = '78px';
                        left = '0px';
                    }
                }
                if (data.message == 'phone') {
                    if (form == 'form01') {
                        top = '240px';
                        left = '30px';
                    }
                    if (form == 'form02' || form == 'form04') {
                        top = '261px';
                        left = '30px';
                    }
                    if (form == 'form03' || form == 'form05') {
                        top = '78px';
                        left = '265px';
                    }
                    if (form == 'form06' || form == 'form07' || form == 'form08' || form == 'form09') {
                        top = '78px';
                        left = '292px';
                    }
                }
                $('.error').css('left', left);
                $('.error').css('top', top);
            }
        }
    )

    return false;
};

