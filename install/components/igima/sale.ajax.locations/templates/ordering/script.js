$(document).ready(function () {
    $('.content').on('click', '.choice-location a', function (e) {
        var txt = $(this).text();
        var id = $(this).attr('data-id');
        var name = $(this).closest('.search').find('input[type=hidden]').attr('name');
        $(this).closest('.search').find('input[type=text]').attr('value', txt).focus();
        $(this).closest('.search').find('.button-green').attr('loc-id', id);
        $(this).closest('.search').find('.button-green').attr('loc-name', name);
        $(this).closest('.choice-location').slideUp('normal');
        e.preventDefault();
    });
    $('.content').on('keyup', '.choice-location-inp', function () {
        var ths = $(this);
        var query = $(this).val().trim();
        if (query.length > 0)
        {
            GetVeil(ths.closest('.delivery-info'), 'veil-paydel');
            $('#veil-paydel').spin('large', '#444');
            $.post("/bitrix/components/igima/sale.ajax.locations/ajax.php", {'GET_CITY': query},
            function (data) {
                if (data)
                {
                    $('.choice-location').html(data);
                    if ($('.choice-location').height() >= 280)
                    {
                        $('.choice-location').height(280).slideDown('normal').jScrollPane({
                            autoReinitialise: true,
                            autoReinitialiseDelay: 100
                        });
                    }
                    else
                    {
                        $('.choice-location').slideDown('normal');
                    }
                    ;
                }
                $('#veil-paydel').hide();
            });
        }
    });
    $(document).on('click', function (event) {
        if ($(event.target).closest('.choice-location').length || $(event.target).closest('.choice-location-inp').length)
            return;
        $('.choice-location').slideUp('normal');
        event.stopPropagation();
    });
    $('.content').on('click', '.search .button-green', function (e) {
        var inc = "N";
        var user = $('#order_form_content').find('input[name=PERSON_TYPE]').val();
        if ($(this).siblings('.wrap').find('.checkbox').hasClass('checked'))
            inc = 'N';
        findDelivery("N", inc, $(this).attr('loc-id'), $(this).attr('loc-name'), $('#sessid').val(), user, 'ordering');
        $(this).closest('.step.delivery').find('.delivery-info').slideDown('normal');
        var scrTop = $(window).scrollTop();
        var top = $(this).closest('.step.delivery').offset().top + $(this).closest('.step.delivery').height() + 30 - $(window).height();
        if (top > scrTop) {
            $('html, body').animate({scrollTop: top}, 400);
        }
        ;
        e.preventDefault();
    });
    $('.content').on('focus', '.search input[type=text]', function () {
        $(this).parent().addClass('focus');
        $(this).closest('.delivery').find('.error').hide();

    });
});
function findDelivery(id, inc, locid, locname, sess, user)
{
    var prodid = $('#order_form_div').attr('data-prodid');
    var fil = {'DELIVERY_ID': id, 'INC_CART': inc, 'sessid': sess, 'save': 'Y', 'profile_change': 'N', 'confirmorder': 'N', 'PRODUCT_ID': prodid, 'TEMP': 'ordering', 'STEP': '1', 'PERSON_TYPE': user};
    fil[locname] = locid;
    GetVeil($('.content .delivery'), 'veil-paydel');
    $('#veil-paydel').spin('large', '#444');
    $.post("/bitrix/components/igima/sale.ajax.locations/ajax.php", fil,
            function (data) {
                if (data)
                {
                    $('.content').html(data);
                    $('input.mask-input.phone-ru').mask('+7 (999) 999-99-99');
                    $('input.mask-input.phone-kz').mask('+7 (999) 999-99-99');
                    $('input.mask-input.phone-ua').mask('+380 (999) 999-99-99');
                    $('input.mask-input.phone-by').mask('+375 (999) 999-99-99');
                    $('.my-cart-col .item-scroll').jScrollPane({
                        autoReinitialise: true,
                        autoReinitialiseDelay: 500,
                        mouseWheelSpeed: 100
                    });
                    if (id !== "N")
                        $('.content .delivery').on('click', '.delivery-method .radio', ClickDelivery);
                    if ($('.delivery-right').height() + 10 < $('.delivery-left').height())
                        $('.delivery-right').height($('.delivery-left').height() - 55);
                    $('.button-green').attr('loc-id', locid);
                    $('.button-green').attr('loc-name', locname);
                }
                $('#veil-paydel').hide();
            });
}