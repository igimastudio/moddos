$(document).ready(function () {
    slider();
    var ths = $('.filter-catalogue .item');
    ths.find('input[type=checkbox]').removeAttr('checked');
    $('.filter-catalogue').on("click", " .title .text", function (e) {
        $(this).closest('.item').toggleClass('active').find('.item-content').slideToggle('normal');
        e.preventDefault();
    });
    $('.filter-catalogue').on("click", ".title .reset", function (e) {
        var min = $('#slider-range').attr('data-min');
        var max = $('#slider-range').attr('data-max');
        $(this).closest('.title').siblings('.item-content').find('label.checked').removeClass('checked');
        $(this).closest('.title').siblings('.item-content').find('#slider-range').attr('data-act', "");
        $(this).removeClass('display');
        get_filter(min, max, false);
        e.preventDefault();
    });

    $('.filter-catalogue').on("change", "label.checkbox", function () {
        ths = $(this).closest('.filter-catalogue .item');
        if ($(this).hasClass('checked')) {
            ths.find('.title').children('.reset').show();
            $(this).removeClass('checked');
        } else {
            ths.find('.title').children('.reset').hide();
            $(this).addClass('checked');
        }
        ;
        var value1 = $(".filter-catalogue #amount-min").val();
        var value2 = $(".filter-catalogue #amount-max").val();
        get_filter(value1, value2, false);
    });
    $('.filter-catalogue').on("click", ".filter-total-reset", function (e) {
        var fltr = $(this).closest('.filter-catalogue');
        var min = $('#slider-range').attr('data-min');
        var max = $('#slider-range').attr('data-max');
        $('#slider-range').attr('data-act', "");
        fltr.find('label.checked').removeClass('checked');
        $('#slider-range').attr('data-maxf', max);
        $('#slider-range').attr('data-minf', min);
        get_filter(min, max, false);
        $(this).hide();
        e.preventDefault();
    });
    $('.filter-catalogue').on("focus", ".input-wrpap input", function () {
        $(this).closest('.input-wrpap').addClass('active');
    });
    $('.filter-catalogue').on("blur", ".input-wrpap input", function () {
        $(this).closest('.input-wrpap').removeClass('active');
    });

    $('.filter-catalogue .item-scroll').jScrollPane({
        autoReinitialise: false,
        autoReinitialiseDelay: 100
    });
    $('.filter-catalogue').on("keyup", ".input-wrpap input", function () {
        var value = $(this).val();
        if (value.length >= 1)
        {
            $($(this).closest('.input-wrpap').siblings('.item-scroll').find('.checkbox')).each(function () {
                var chk = $(this).attr('data-val').toLowerCase();
                if (chk.indexOf(value) < 0)
                {
                    $(this).closest('p').hide('fast');
                }
                else
                {
                    $(this).closest('p').show('fast');
                }
            });
        }
        else
        {
            $($(this).closest('.input-wrpap').siblings('.item-scroll').find('.checkbox')).each(function () {
                $(this).closest('p').show('fast');
            });
        }
    });
});
function slider()
{
    var min = parseInt($("#slider-range").attr('data-min'));
    var max = parseInt($("#slider-range").attr('data-max'));
    if ($("#slider-range").attr('data-minf') > 0)
        var minf = parseInt($("#slider-range").attr('data-minf'));
    else
        var minf = parseInt(min);
    if ($("#slider-range").attr('data-maxf') > 0)
        var maxf = parseInt($("#slider-range").attr('data-maxf'));
    else
        var maxf = parseInt(max);
    $("#slider-range").slider({
        range: true,
        min: min,
        max: max,
        values: [minf, maxf],
        step: 10,
        slide: function (event, ui) {
            $(".filter-catalogue #amount-min").val(ui.values[ 0 ]);
            $(".filter-catalogue #amount-max").val(ui.values[ 1 ]);
        },
        stop: function (event, ui) {
            get_filter(ui.values[ 0 ], ui.values[ 1 ], true);
        }
    });

    $(".filter-catalogue #amount-min").val($(".filter-catalogue #slider-range").slider("values", 0));
    $(".filter-catalogue #amount-max").val($(".filter-catalogue #slider-range").slider("values", 1));

    $(".filter-catalogue").on("change", "#amount-min", function () {
        var min = $('#slider-range').attr('data-min');
        if (parseInt($(this).val()) < parseInt(min))
        {
            $(this).val(min);
            return false;
        }
        var value1 = $(".filter-catalogue #amount-min").val();
        var value2 = $(".filter-catalogue #amount-max").val();
        if (parseInt(value1) > parseInt(value2)) {
            value1 = value2;
            $(".filter-catalogue #amount-min").val(value1);
        }
        get_filter(value1, value2, false);
        $(".filter-catalogue #slider-range").slider("values", 0, value1);
    });

    $(".filter-catalogue").on("change", " #amount-max", function () {
        var max = $('#slider-range').attr('data-max');
        if (parseInt($(this).val()) >= parseInt(max))
        {
            $(this).val(max);
            return false;
        }
        var value1 = $(".filter-catalogue #amount-min").val();
        var value2 = $(".filter-catalogue #amount-max").val();
        if (value2 > 50000) {
            value2 = 50000;
            $(".filter-catalogue #amount-max").val(50000);
        }

        if (parseInt(value1) > parseInt(value2)) {
            value2 = value1;
            $(".filter-catalogue #amount-max").val(value2);
        }
        get_filter(value1, value2, false);
        $(".filter-catalogue #slider-range").slider("values", 1, value2);
    });
}
function check_reset()
{
    if ($('.filter-catalogue').find('label.checked').length > 0 || $('#slider-range').attr('data-act') === "Y")
        $('.filter-catalogue').find('.filter-total-reset').slideDown('normal');
    else
        $('.filter-catalogue').find('.filter-total-reset').slideUp('normal');
}
function get_filter(min, max, sld)
{
    var i = 0;
    var minf = parseInt($('#slider-range').attr('data-min'));
    var maxf = parseInt($('#slider-range').attr('data-max'));
    var minfid = $('.amount-min').attr('data-fid');
    var maxfid = $('.amount-max').attr('data-fid');
    var act = $('#slider-range').attr('data-act');
    var items = {};
    var cnt = parseInt($('#cnt-mod').html());
    GetVeil($('.catalog-area'), 'veil-showcase');
    GetVeil($('.filter-catalogue'), 'veil-filter');
    $('#veil-showcase').spin('large', '#444');
    $('#veil-filter').spin('large', '#444');
    $(".filter-catalogue label.checkbox").each(function () {
        if ($(this).hasClass('checked'))
        {
            items[$(this).closest('.checkbox').attr('data-fid')] = "Y";
            i = 1;
        }
    });
    if ((parseInt(min) !== minf || parseInt(max) !== maxf) && (act === "Y" || sld === true))
    {
        items[minfid] = min;
        items[maxfid] = max;
    }
    items['SECTION_CODE'] = $('.filter-catalogue').attr('data-sec');
    items['set_filter'] = "Y";

    $.post("/bitrix/tools/igima.moddos/ajax/filter.php", items,
            function (data) {
                if (data)
                {
                    $('.filter-catalogue').html(data.filter);
                    slider();
                    check_reset();
                    if (cnt <= 8)
                        $('.button-up').click();
                    $('.catalog-area').html(data.showcase);
                    $('.filter-catalogue .item-scroll').jScrollPane({
                        autoReinitialise: false,
                        autoReinitialiseDelay: 100
                    });
                }
            }, "json");
}