$(document).ready(function () {
    plholder();
    $('.content').on('click', '.step.delivery .radio,.step.pay-choose .radio', function (e) {
        $('.content').off('click', $(this));
        var did = '';
        var pid = '';
        if ($(this).attr('data-type') === 'delivery')
        {
            did = $(this).find('input[name=delivery-method]').val();
            pid = $('.step.pay-choose input[name=PAY_SYSTEM_ID]:checked').val();
        }
        if ($(this).attr('data-type') === 'paysistem')
        {
            pid = $(this).find('input[name=PAY_SYSTEM_ID]').val();
            did = $('.step.delivery input[name=delivery-method]:checked').val();
        }
        var step = $(this).closest('.step').attr('data-step');
        submitF(did, pid, step, "N");
        e.preventDefault();
    });
    $('.popup-entrance .password-reminder, .ordering-auth .password-reminder').click(function (e) {
        $(this).closest('.popup-entrance').find('.pop-entrance').hide().siblings('.pop-password-reminder').show();
        e.preventDefault();
    });
    $('.popup-entrance .back').click(function (e) {
        $(this).closest('.popup-entrance').find('.pop-entrance').show().siblings('.pop-password-reminder').hide();
        e.preventDefault();
    });
    $('.already-buy .password-reminder').click(function (e) {
        $(this).closest('.already-buy').find('.pop-entrance').hide().siblings('.pop-password-reminder').show();
        e.preventDefault();
    });
    $('.already-buy .back').click(function (e) {
        $(this).closest('.already-buy').find('.pop-entrance').show().siblings('.pop-password-reminder').hide();
        e.preventDefault();
    });
    $('.popup-product .head li a').click(function (e) {
        $(this).closest('li').addClass('active').siblings().removeClass('active');
        $(this).closest('.popup-product').find('.pop-tab').hide().eq($(this).closest('li').index()).show();
        e.preventDefault();
    });
    $('.popup-product .delete, .popup-product .to-favorites a').click(function (e) {
        var length = $(this).closest('table').find('tr').length;
        if (length > 2) {
            $(this).closest('tr').remove();
        } else {
            $(this).closest('table').hide().siblings('.continue-btn').hide();
            $(this).closest('.pop-tab').find('.discount-coupon-wrap').hide();
            $(this).closest('.pop-tab').find('.calculating').hide();
            $(this).closest('.pop-tab').find('.button-wrpap').hide();
            $(this).closest('table').hide().siblings('.pop-tab-empty').show();
        }
        e.preventDefault();
    });
    // to 1 step
    $('.content').on("click", ".first-buy .button-green", function (e) {
        var scrTop = $(window).scrollTop();
        var ordering_steps = $(this).closest('.ordering-steps');
        ordering_steps.find('.current').toggleClass('current');
        ordering_steps.find('.ordering-auth').slideUp('normal');
        ordering_steps.find('.step.delivery .main-head').addClass('active');
        ordering_steps.find('.delivery-info').slideDown('normal', function () {
            var ths = $(this);
            var top = ths.closest('.step').offset().top - 10;
            if (scrTop > top) {
                $(scrollTopElement + ':not(:animated)').animate({scrollTop: top}, 400);
            }
        });
        e.preventDefault();

    });
    // to 2 step
    $('.content').on("click", ".step.delivery .button-red", function (e) {
        var scrTop = $(window).scrollTop();
        var ordering_steps = $(this).closest('.ordering-steps');
        ordering_steps.find('.delivery-info').css('min-height', '0');
        ordering_steps.find('.current').removeClass('current');
        ordering_steps.find('.step.delivery .main-head, .delivery-info').slideUp('normal');
        ordering_steps.find('.step.delivery .main-head').removeClass('active');
        ordering_steps.find('.complete-info').removeClass('complete-info');
        ordering_steps.find('.step.delivery .delivery-compl').addClass('complete-info').slideDown('normal');
        ordering_steps.find('.step.contacts-info .main-head').addClass('active');
        ordering_steps.find('.recipient-info').slideDown('normal', function () {
            var ths = $(this);
            var top = ths.closest('.step').offset().top - 10;
            if (scrTop > top) {
                $(scrollTopElement + ':not(:animated)').animate({scrollTop: top}, 400);
            }
        });
        e.preventDefault();
    });

    // to 3 step
    $('.content').on("click", ".step.contacts-info .button-red", function (e) {
        var did = $('.step.delivery input[name=delivery-method]:checked').val();
        var pid = $('.step.pay-choose input[name=PAY_SYSTEM_ID]:checked').val();
        var phone = '';
        var step = 2;
        $('.recipient-info .phone-inp > .mask-input').each(function () {
            if ($(this).css('display') !== "none")
                phone = $(this).val();
        });
        var re = /_/g;
        var result = re.exec(phone);
        if (result)
        {
            $(this).siblings('.pop-content').find(".phone-inp").addClass('error');
            $(this).siblings('.pop-content').find("#error-phone").show();
            setTimeout(function () {
                $(this).siblings('.pop-content').find("#error-phone").fadeOut();
            }, 3000);
        }
        else
            submitF(did, pid, step, "N");
        e.preventDefault();
    });
    // to 4 step
    $('.content').on("click", ".step.pay-choose .button-red", function (e) {
        var scrTop = $(window).scrollTop();
        var ordering_steps = $(this).closest('.ordering-steps');
        ordering_steps.find('.current').removeClass('current');
        ordering_steps.find('.step.pay-choose .main-head, .pay-method').slideUp('normal');
        ordering_steps.find('.step.pay-choose .main-head').removeClass('active');
        ordering_steps.find('.step.confirm-data .confirm-info').slideDown('normal', function () {
            var ths = $(this);
            var top = ths.closest('.step').offset().top - 10;
            if (scrTop > top) {
                $(scrollTopElement + ':not(:animated)').animate({scrollTop: top}, 400);
            }
        });
        ordering_steps.find('.step.confirm-data .main-head').addClass('active');
        ordering_steps.find('.pay-compl').addClass('complete-info').slideDown('normal');
        e.preventDefault();
    });
    $('.content').on("click", ".step.confirm-data .button-red", function (e) {
        var did = $('.step.delivery input[name=delivery-method]:checked').val();
        var pid = $('.step.pay-choose input[name=PAY_SYSTEM_ID]:checked').val();
        var step = 4;
        var desc = $(this).closest('.confirm-info').find('textarea').val();
        var sub = 'N';
        if ($('.sent-news').hasClass('checked'))
            sub = 'Y';
        submitF(did, pid, step, "Y", desc, sub);
        e.preventDefault();
    });
    // to change 1 step
    $('.content').on("click", ".step.delivery .change", function (e) {
        var scrTop = $(window).scrollTop();
        var ordering_steps = $(this).closest('.ordering-steps');
        ordering_steps.find('.for-return').removeClass('for-return');
        ordering_steps.find('.step .main-head.active').closest('.step').find('.complete-info').removeClass('complete-info');
        ordering_steps.find('.step .main-head.active, .step .main-head.current').closest('.step').addClass('for-return');
        ordering_steps.find('.current').removeClass('current');
        ordering_steps.find('.step .main-head.active').removeClass('active');
        ordering_steps.find('.step.delivery .main-head').addClass('current');
        ordering_steps.find('.step.delivery .button-red').fadeOut(100);
        ordering_steps.find('.step.delivery .delivery-method .button-green').fadeIn(100);
        ordering_steps.find('.step.delivery .main-head, .delivery-method, .delivery-info').slideDown('normal', function () {
            var ths = $(this);
            var top = ths.closest('.step').offset().top - 10;
            if (scrTop > top) {
                $(scrollTopElement + ':not(:animated)').animate({scrollTop: top}, 400);
            }
        });
        ordering_steps.find('.recipient-info, .pay-method, .confirm-info, .pay-compl, .contacts-compl, .delivery-compl').slideUp('normal');
        ordering_steps.find('.step.contacts-info .main-head, .step.pay-choose .main-head, .step.confirm-data .main-head').slideDown('normal');
        e.preventDefault();
    });

    // to change 2 step
    $('.content').on("click", ".step.contacts-info .change", function (e) {
        var scrTop = $(window).scrollTop();
        var ordering_steps = $(this).closest('.ordering-steps');
        var ths = $(this);
        var top = ths.closest('.step').offset().top - 10;
        if (scrTop > top) {
            $(scrollTopElement + ':not(:animated)').animate({scrollTop: 230}, 400);
        }
        ordering_steps.find('.change').fadeOut(300);
        ordering_steps.find('.for-return').removeClass('for-return');
        ordering_steps.find('.step .main-head.active').closest('.step').find('.complete-info').removeClass('complete-info');
        ordering_steps.find('.step .main-head.active, .step .main-head.current').closest('.step').addClass('for-return');
        ordering_steps.find('.current').removeClass('current');
        ordering_steps.find('.step .active').removeClass('active');
        ordering_steps.find('.step.contacts-info .main-head').addClass('current');
        ordering_steps.find('.step.contacts-info .button-red').fadeOut(100);
        ordering_steps.find('.step.contacts-info .button-green').fadeIn(100);
        ordering_steps.find('.step.contacts-info .main-head, .recipient-info').slideDown('normal');
        ordering_steps.find('.pay-method, .confirm-info, .contacts-compl, .pay-compl').slideUp('normal');
        ordering_steps.find('.step.contacts-info .main-head, .step.pay-choose .main-head, .step.confirm-data .main-head').slideDown('normal', function () {
            if (scrTop > top) {
                $(scrollTopElement + ':not(:animated)').animate({scrollTop: top}, 400);
            }
        });
        e.preventDefault();
    });

    // to change 3 step
    $('.content').on("click", ".step.pay-choose .change", function (e) {
        var scrTop = $(window).scrollTop();
        var ordering_steps = $(this).closest('.ordering-steps');
        ordering_steps.find('.change').fadeOut(300);
        ordering_steps.find('.for-return').removeClass('for-return');
        ordering_steps.find('.step .main-head.active').closest('.step').find('.complete-info').removeClass('complete-info');
        ordering_steps.find('.step .main-head.active, .step .main-head.current').closest('.step').addClass('for-return');
        ordering_steps.find('.current').removeClass('current');
        ordering_steps.find('.step .active').removeClass('active');
        ordering_steps.find('.step.pay-choose .main-head').addClass('current');
        ordering_steps.find('.step.pay-choose .button-red').fadeOut(100);
        ordering_steps.find('.step.pay-choose .button-green').fadeIn(100);
        ordering_steps.find('.step.pay-choose .main-head, .pay-method').slideDown('normal', function () {
            var ths = $(this);
            var top = ths.closest('.step').offset().top - 10;
            if (scrTop > top) {
                $(scrollTopElement + ':not(:animated)').animate({scrollTop: top}, 400);
            }
        });
        ordering_steps.find('.pay-compl, .confirm-info').slideUp('normal');
        e.preventDefault();
    });

    // to close-step
    $('.content').on("click", ".step .close-step, .delivery-method .button-green, .pay-choose .button-green", function (e) {
        var scrTop = $(window).scrollTop();
        var ordering_steps = $(this).closest('.ordering-steps');
        ordering_steps.find('.change').fadeIn(300);
        ordering_steps.find('.current').closest('.step').find('.main-head, .delivery-info, .pay-method, .recipient-info').slideUp('normal');
        ordering_steps.find('.complete-info').closest('.step').find('.main-head').slideUp('normal');
        ordering_steps.find('.step .current').removeClass('current');
        ordering_steps.find('.for-return .main-head').addClass('active');
        ordering_steps.find('.for-return .complete-info').removeClass('complete-info');
        ordering_steps.find('.complete-info').slideDown('normal');
        ordering_steps.find('.for-return .main-head, .for-return .pay-method, .for-return .recipient-info, .for-return .delivery-info, .for-return .confirm-info, .complete-info').slideDown('normal');
        setTimeout(function () {
            var ths = ordering_steps.find('.for-return');
            var top = ths.offset().top - 10;
            if (scrTop > top) {
                $(scrollTopElement + ':not(:animated)').animate({scrollTop: top}, 400);
            }
            ordering_steps.find('.for-return').removeClass('for-return');
        }, 400);
        e.preventDefault();
    });

});
function plholder(prod)
{
    var ths = '';
    if (prod)
        ths = prod;
    else
        ths = $(document);
    ths.find('input[placeholder], textarea[placeholder]').each(function () {
        var pl_val = $(this).attr('placeholder');
        $(this).removeAttr('placeholder');
        $(this).attr('plholder', pl_val);
        if ($(this).val() === '') {
            $(this).val($(this).attr('plholder')).css({color: '#a5a5a5'});
        }
        $(this).blur(function () {
            if ($(this).val() === '') {
                $(this).val($(this).attr('plholder')).css({color: '#a5a5a5'});
            }
        });
        $(this).focus(function () {
            if ($(this).val() === $(this).attr('plholder')) {
                if (!$(this).is('.mask-input'))
                    $(this).val('');
                $(this).css({color: '#767676'});
            }
        });
    });
}
function submitF(did, pid, step, conf, desc, sub)
{
    var user = $('#person_type').val();
    var locid = $('.choice-location-inp').siblings('input[type=hidden]').val();
    var locname = $('.choice-location-inp').siblings('input[type=hidden]').attr('name');
    var sessid = $('#sessid').val();
    var fil = {'DELIVERY_ID': did, 'PAY_SYSTEM_ID': pid, 'sessid': sessid, 'save': 'Y', 'profile_change': 'N', 'confirmorder': conf, 'STEP': step, 'PERSON_TYPE': user, 'PERSON_TYPE_OLD': user, 'ORDER_DESCRIPTION': desc, 'NEWS_SUB': sub};
    fil[locname] = locid;
    if (conf === "Y")
        fil['json'] = 'Y';
    $('.step.contacts-info input[type=text]').each(function () {
        fil[$(this).attr('name')] = $(this).val();
    });
    $('.recipient-info .phone-inp > .mask-input').each(function () {
        if ($(this).css('display') !== "none")
            fil[$(this).attr('name')] = $(this).val();
    });
    GetVeil($('.ordering-steps'), 'veil-paydel');
    $('#veil-paydel').spin('large', '#444');
    if (conf !== "Y")
    {
        $.post("/bitrix/components/igima/sale.ajax.locations/ajax.php", fil,
                function (data) {
                    if (data)
                    {
                        $('.content').html(data);
                        if ($('.delivery-right').height() + 10 < $('.delivery-left').height())
                            $('.delivery-right').height($('.delivery-left').height() - 55);
                        if ($('.pay-right').height() + 10 < $('.pay-left').height())
                            $('.pay-right').height($('.pay-left').height() - 55);
                        $('input.mask-input.phone-ru').mask('+7 (999) 999-99-99');
                        $('input.mask-input.phone-kz').mask('+7 (999) 999-99-99');
                        $('input.mask-input.phone-ua').mask('+380 (999) 999-99-99');
                        $('input.mask-input.phone-by').mask('+375 (999) 999-99-99');
                        $('.my-cart-col .item-scroll').jScrollPane({
                            autoReinitialise: true,
                            autoReinitialiseDelay: 500,
                            mouseWheelSpeed: 100
                        });
                    }
                });
    }
    else
    {
        $.post("/bitrix/components/igima/sale.ajax.locations/ajax.php", fil,
                function (data) {
                    if (data.success === "Y")
                        window.location = data.redirect;
                    else
                    {
                        $('#veil-paydel').hide();
                        alert(data.error);
                    }
                }, "json");
    }
}