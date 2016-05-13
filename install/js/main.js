$(document).ready(function () {
    plholder();
    $('.tablebodytext').remove();
    $('body').on("click", ".composition-title", function (e) {
        $(this).closest('.order-composition').find(".order-full").slideToggle("slow");
        $(this).closest('.order-composition').find(".composition-title").toggleClass("used");
        e.preventDefault();
    });
    $('body').on("click", ".order-buttons .button-green", function (e) {
        var ths = $(this);
        $(this).closest('.my-orders-data').find('.order,.pagination-wrap').fadeOut(300, function () {
            ths.closest('.order').next('.order-details').fadeIn(300);
        });
        e.preventDefault();
    });
    $('body').on("click", ".order-details .button-green", function (e) {
        $(this).closest('.order-details').fadeOut(300, function () {
            $(this).closest('.my-orders-data').find('.order,.pagination-wrap').fadeIn(300);
        });
        e.preventDefault();
    });

    $('.menu-button.my-subscribe').click(function (e) {
        if ($(this).hasClass('active')) {
            return false;
        }
        $(this).closest('.menu-buttons').find('.active').removeClass('active').closest('.menu-buttons').find('.my-subscribe').addClass('active');
        $(this).closest('.private-office-wrapper').find('.my-data.current').removeClass('current').fadeOut(300, function () {
            $(this).closest('.private-office-wrapper').find('.my-subscribe-data').addClass('current').fadeIn(300);
        });

        e.preventDefault();
    });

    $('.menu-button.my-profile').click(function (e) {
        if ($(this).hasClass('active')) {
            return false;
        }
        $(this).closest('.menu-buttons').find('.active').removeClass('active').closest('.menu-buttons').find('.my-profile').addClass('active');
        $(this).closest('.private-office-wrapper').find('.my-data.current').removeClass('current').fadeOut(300, function () {
            $(this).closest('.private-office-wrapper').find('.my-profile-data').addClass('current').fadeIn(300);
        });
        e.preventDefault();
    });

    $('.menu-button.my-orders').click(function (e) {
        if ($(this).hasClass('active')) {
            return false;
        }
        $(this).closest('.menu-buttons').find('.active').removeClass('active').closest('.menu-buttons').find('.my-orders').addClass('active');
        $(this).closest('.private-office-wrapper').find('.my-data.current').removeClass('current').fadeOut(300, function () {
            $(this).closest('.private-office-wrapper').find('.my-orders-data').addClass('current').fadeIn(300);
        });

        e.preventDefault();
    });

    $('.avatar .remove-avatar').click(function (e) {
        $.post("/bitrix/tools/igima.moddos/ajax/personal.php", {"avatar-remove": true},
        function ()
        {
            $('.photo-name').hide();
            $('.yesava').remove();
        }, "json");
        $(this).closest('.yesavatar').fadeOut(300, function () {
            $(this).closest('.avatar').find('.noavatar').fadeIn(300);
        });
        e.preventDefault();

    });

    $('.change-password .button-green').click(function (e) {
        if (($('input[name=enpass]').val() && $('input[name=enpassagain]').val()) && ($('input[name=enpass]').val() === $('input[name=enpassagain]').val()))
        {
            $(this).closest('.change-password').find('.tip-confirm-pass').fadeIn(300).delay(3000).fadeOut(300);
            e.preventDefault();
        }
        else
        {
            $(this).closest('.change-password').find('.tip-confirm-pass-nchanged').fadeIn(300).delay(3000).fadeOut(300);
            e.preventDefault();
        }
        e.preventDefault();
    });

    $('.my-subscribe-data .button-green').click(function (e) {
        if ($('input[name=EMAIL]').val())
        {
            $(this).closest('.my-subscribe-data').find('.tip-confirm').fadeIn(300).delay(3000).fadeOut(300);
            e.preventDefault();
        }
    });

    $('.address-info .button-green').click(function (e) {
        $(this).closest('.address-info').find('.tip-confirm').fadeIn(300).delay(3000).fadeOut(300);
        e.preventDefault();

    });

    $('.recipient-info .button-green').click(function (e) {
        var email = $('input[name=emailprivate]').val();
        if (email && email.search("@") !== -1 && email.search(".") !== -1)
        {
            $(this).closest('.recipient-info').find('.tip-confirm').fadeIn(300).delay(3000).fadeOut(300);
            e.preventDefault();
        }
        else
        {
            $(this).closest('.recipient-info').find('.tip-confirm-nchanged').fadeIn(300).delay(3000).fadeOut(300);
            e.preventDefault();
        }

    });
    $('body').on("click", ".order-buttons .button-grey", function (e) {
        var ths = $(this);
        $('#confirm-delete').find('.button-green').unbind().on("click", function (e) {
            $.post("/bitrix/tools/igima.moddos/ajax/personal.php", {"order-cancel": true, "orderid": ths.attr("name")},
            function (data)
            {

            }, "json");
            ths.closest('.order').find('.button-grey-border').fadeOut('300');
            ths.closest('.order').removeClass('status-yellow').removeClass('status-blue').removeClass('status-orange').removeClass('status-green').removeClass('status-grey').addClass('status-red');
            ths.closest('.order').find('.order-status').find('.status-option').text('Отменен');
            $(this).closest('.fancybox-skin').find('.fancybox-close').click();
            ths.closest('.order').next('.order-details').find('.status-order-details').removeClass('status-yellow').removeClass('status-blue').removeClass('status-orange').removeClass('status-green').removeClass('status-grey').addClass('status-red').text(BX.message('IGIMA_MODDOS_JS_CANSEL'));
            e.preventDefault();
        });
        e.preventDefault();
    });
    // to delete
    $('.order-buttons .button-grey').fancybox({
        padding: 0,
        openEffect: 'elastic',
        openSpeed: 300,
        closeEffect: 'elastic',
        closeSpeed: 150,
        scrolling: 'no',
        keys: {close: [27]},
        helpers: {
            overlay: {
                showEarly: false
            }
        },
        beforeShow: function () {
            $('html').css({'margin-right': scrollbarWidth()});
            $('.button-up').css({'margin-left': 555 - scrollbarWidth() / 2});
            $('.products-viewed').css({'margin-left': -495 - scrollbarWidth() / 2});
        },
        beforeClose: function () {
            $('.fancybox-skin').find('.back').click();
        },
        afterClose: function () {
            $('.fancybox-overlay').hide();
            $('html').css({'margin-right': '0'});
            $('.button-up').css({'margin-left': '555px'});
            $('.products-viewed').css({'margin-left': '-495px'});
        }
    });
    $('body').on("click", ".content-confirm .button-red", function (e) {
        $(this).closest('.fancybox-skin').find('.fancybox-close').click();
        e.preventDefault();
    });
    $('.my-subscribe-data label input[type=checkbox]').each(function () {
        if ($(this).is(':checked'))
            $(this).closest('label').addClass('checked');
        $(this).change(function () {
            $(this).closest('label').toggleClass('checked');
        });
    });
    $('.upload-photo input[type=file], .upload-new-avatar input[type=file]').change(function () {
        var ths = $(this);
        $('.photo-name').show('fast');
        var file = this.files[0];
        var reader = new FileReader();
        if (reader)
        {
            reader.onload = function () {
                var dataURL = reader.result;
                ths.closest('.ava').css('background', 'url("' + dataURL + '") no-repeat scroll center center #ebeaea');
                ths.closest('.ava').css('background-size', 'cover');
            };
            reader.readAsDataURL(file);
        }
        else
            $('.photo-name div').show();
    });
    $('body').on("focusin", "input[type=text], input[type=password]", function () {
        $(this).siblings('.entry-ico').css('background', 'none');
        $(this).parent().removeClass('ok');
        $(this).parent().removeClass('error');
        if ($(this).parent().hasClass('entry-form')) {
            $(this).parent().addClass('focus');
        }
        ;
    });
    $('body').on("focusout", "input[type=text], input[type=password]", function () {
        var ths = $(this);
        ths.siblings('.hint-error').stop(true, true);
        $(this).parent().removeClass('focus');
        if (!$(this).hasClass('callback-name') && !$(this).hasClass('no-error') && !$(this).hasClass('mask-input'))
        {
            $(this).siblings('.entry-ico').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
            if ($(this).parent().hasClass('entry-form') && !$(this).val() === '' && $(this).val() !== $(this).attr('plholder'))
            {
                $(this).siblings('.entry-ico').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll left 0px rgba(0, 0, 0, 0)');
                $(this).siblings('.entry-ico').show();
            }
            ;
            if ($(this).parent().hasClass('entry-form') && ($(this).val() === '' || $(this).val() === $(this).attr('plholder')))
            {
                $(this).parent().addClass('error');
                $(this).siblings('.entry-ico').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
                $(this).siblings('.entry-ico').show();
                setTimeout(function () {
                    ths.siblings('.hint-error').fadeOut();
                }, 3000);
            }
            ;
        }
        else
        {
            $(this).siblings('.entry-ico').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll left 0px rgba(0, 0, 0, 0)');
            $(this).siblings('.entry-ico').show();
        }
    });
    $('.delivery-method .delivery-left label.radio input,.pay-method .pay-left label.radio input').each(function () {
        if ($(this).is(':checked')) {
            $(this).closest('.delivery-method, .pay-method').find('.delivery-item, .pay-item').eq($(this).closest('label').index()).show();
        }
    });
    if (window.location.hash === '#show-inf')
    {
        $('.button-up').click();
        $('.pop-expect-revenues > a').closest('li').addClass('active').siblings().removeClass('active');
        $('.pop-expect-revenues > a').closest('.popup-product').find('.pop-tab').hide().eq($('.pop-expect-revenues > a').closest('li').index()).show();
        $('header .sub-item').trigger('click');
    }
    $('.search-btn').click(function (e) {
        $('.search > form').submit();
    });
    $('.subus').click(function (e) {
        $('.hints-red').hide();
        var submail = $('#sub-mail').val();
        var sub = [];
        $("input:checked").each(function () {
            sub.push($(this).val());
        });
        if (sub.length > 0)
        {
            $.post("/bitrix/tools/igima.moddos/ajax/main.php", {'submail': submail, 'rub[]': [sub]},
            function (data) {
                if (data.error)
                {
                    $('#sub-error-3').html('<span class="hints-arrow"></span>' + data.error).show();
                    setTimeout(function () {
                        $('.hints-red').fadeOut();
                    }, 3000);
                }
                else
                {
                    $('#sub-ok').show();
                    setTimeout(function () {
                        $('.hints').fadeOut();
                    }, 3000);
                }
            }, "json");
        }
        else
        {
            $('#sub-error-2').show();
            setTimeout(function () {
                $('.hints-red').fadeOut();
            }, 3000);
        }
        e.preventDefault();
    });
    $('.unsubus').click(function (e) {
        $('.hints-red').hide();
        var submail = $('#sub-mail').val();
        var sub = [];
        $("input:checked").each(function () {
            sub.push($(this).val());
        });
        $.post("/bitrix/tools/igima.moddos/ajax/main.php", {'submail': submail, 'rub[]': [sub]},
        function (data) {
            if (data.error)
            {
                $('#sub-error-3').html('<span class="hints-arrow"></span>' + data.error).show();
                setTimeout(function () {
                    $('.hints-red').fadeOut();
                }, 3000);
            }
            else
            {
                $('#unsub-ok').show();
                setTimeout(function () {
                    $('.hints').fadeOut();
                }, 3000);
            }
        }, "json");
        e.preventDefault();
    });
    $('#callback-but').click(function () {
        var sess = $("input[name=sessid]").val();
        var name = $('.callback-name').val();
        var f1 = $('#cb-name').attr('data-var');
        var f2 = $('#cb-phone').attr('data-var');
        var f3 = $('#cb-txtarea').attr('data-var');
        var phone = '';
        var items = {};
        var fid = $('#calbform').attr('data-fid');
        var but = $(this);
        $('.phone-inp > .mask-input').each(function () {
            if ($(this).css('display') !== "none")
                phone = $(this).val();
        });
        var text = $('.entry-form > textarea').val();

        if ($('.entry-form > textarea').attr('plholder') === text)
            text = '';
        var re = /_/g;
        var result = re.exec(phone);
        if (result)
        {
            but.siblings(".phone-inp").addClass('error');
            $("#callback-popup #error-phone").show();
            setTimeout(function () {
                $('#callback-popup #error-phone').fadeOut();
            }, 3000);
        }
        else
        {
            items['form_text_'+f1+''] = name;
            items['form_text_'+f2+''] = phone;
            items['form_textarea_'+f3+''] = text;
            items['web_form_apply'] = 'Y';
            items['WEB_FORM_ID'] = fid;
            items['sessid'] = sess;
            $.post("/bitrix/tools/igima.moddos/ajax/callback.php", items,
            function (data) {
                if (data.ok === "Y")
                {
                    but.siblings(".hints").html('<span class="hints-arrow"></span>' + BX.message('IGIMA_MODDOS_JS_REQUEST_OK'));
                    but.siblings(".hints").show();
                    setTimeout(function () {
                        $('.fancybox-close').click();
                        but.siblings(".hints").hide();
                    }, 3000);
                    $('.callback-name').val('');
                    $('.phone-inp > .mask-input').each(function () {
                        $(this).val('');
                    });
                    $('.entry-form > textarea').val('');
                    $('.entry-ico').css('background', 'none');
                }
                else
                {
                    but.siblings(".hints").html('<span class="hints-arrow"></span>' + data.error + '');
                    but.siblings(".hints").show();
                    setTimeout(function () {
                        $('#error-phone').fadeOut();
                    }, 3000);
                }

            }, "json");
        }
    });
    $("input[name=USER_LOGIN]").blur(function () {
        $('#x-email').css('background', 'none');
        if ($(this).val() !== $(this).attr('plholder') && $(this).val().length > 0)
        {
            var email = $(this);
            $.post("/bitrix/tools/igima.moddos/ajax/main.php", {'verif-email': $(this).val()},
            function (data) {
                if (data.result)
                {
                    $('#x-email').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll left 0px rgba(0, 0, 0, 0)');
                    $('#x-email').show();
                }
                else
                {
                    $('#x-email').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
                    $('#error-email').show();
                    $('#x-email').show();
                    email.closest('.entry-form').addClass('error');
                    setTimeout(function () {
                        $('#x-email').fadeOut();
                        $('#error-email').fadeOut();
                    }, 3000);
                }
            }, "json");
        }
        else
        {
            $('#x-email').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
            $('#x-email').show();
            $('#error-email').show();
            setTimeout(function () {
                $('#x-email').fadeOut();
                $('#error-email').fadeOut();
            }, 3000);
        }
    });
    $("input[name=USER_LOGIN]").focus(function () {
        $('#error-email').hide();
        $('#x-email').css('background', 'none');
        $('#x-email').hide();
    });
    $("input[name=INFORM_EMAIL]").blur(function () {
        $('#f-email').css('background', 'none');
        var email = $(this);
        if ($(this).val() !== $(this).attr('plholder') && $(this).val().length > 0)
        {
            $.post("/bitrix/tools/igima.moddos/ajax/main.php", {'verif-email': $(this).val(), 'verif-user': 'Y'},
            function (data) {
                if (data.result)
                {
                    $('#f-email').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll left 0px rgba(0, 0, 0, 0)');
                    $('#f-email').show();
                }
                else
                {
                    if (data.error)
                        $('#error-femail').html('<i></i>' + data.error);
                    $('#f-email').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
                    $('#error-femail').show();
                    $('#f-email').show();
                    email.closest('.entry-form').addClass('error');
                    setTimeout(function () {
                        ths.siblings('.hint-error').fadeOut();
                    }, 3000);
                }
            }, "json");
        }
        else
        {
            $('#f-email').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
            $('#f-email').show();
            $('#error-femail').show();
            email.closest('.entry-form').addClass('error');
        }
    });
    $("input[name=INFORM_EMAIL]").focus(function () {
        $('#error-femail').hide();
        $('#f-email').css('background', 'none');
        $('#f-email').hide();
    });
    $('body').on("focusout", ".mask-input", function () {
        var phone = $(this).val();
        var re = /_/g;
        var result = re.exec(phone);
        if (result || phone.length === 0)
        {
            $(this).siblings('.entry-ico').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
            $(this).closest('.phone-inp').addClass('error');
            $(this).siblings('.hint-error').show();
            setTimeout(function () {
                $('#error-phone').fadeOut();
            }, 3000);
        }
        else
            $(this).siblings('.entry-ico').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll left 0px rgba(0, 0, 0, 0)');
    });
    $('.fancybox-media').fancybox({
        padding: 0,
        openEffect: 'elastic',
        openSpeed: 300,
        closeEffect: 'elastic',
        closeSpeed: 150,
        scrolling: 'no',
        keys: {close: [27]},
        helpers: {
            overlay: {
                showEarly: false
            }
        },
        beforeShow: function () {
            $('html').css({'margin-right': scrollbarWidth()});
        },
        beforeClose: function () {
            $('.fancybox-skin').find('.back').click();
        },
        afterClose: function () {
            $('.fancybox-overlay').hide();
            $('html').css({'margin-right': '0'});
        }
    });
    $('.VKontakte').click(function () {
        BX.util.popup($(this).attr('data-url'), 700, 470);
    });
    $('.Facebook').click(function () {
        BX.util.popup($(this).attr('data-url'), 700, 470);
    });
    $('.Twitter').click(function () {
        BX.util.popup($(this).attr('data-url'), 700, 470);
    });
    $('.datepicker').click(function () {
        BX.calendar(
                {node: 'your-birthdate', value: $(this).val(), field: 'your-birthdate', form: 'form1', bTime: false}
        );
    });
    $('#profile-entr').click(function (e) {
        $('#wrong-pasw').hide();
        $('.entry-ico').hide();
        var login = $('input[name=USER_LOGIN]').val();
        var pasw = $('input[name=USER_PASSWORD]').val();
        if (login.length > 0 && pasw.length > 0)
        {
            $.post("/bitrix/tools/igima.moddos/ajax/auth.php", {'USER_LOGIN': $('input[name=USER_LOGIN]').val(), 'USER_PASSWORD': $('input[name=USER_PASSWORD]').val(), 'AUTH_FORM': 'Y', 'TYPE': 'AUTH', 'register_submit_button': 'Y', 'auth_service_id': ''},
            function (data) {
                if (data.error)
                {
                    $('#wrong-pasw').show();
                    $('#x-pasw').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
                    $('#x-pasw').show();
                    setTimeout(function () {
                        $('#x-pasw').fadeOut();
                        $('#wrong-pasw').fadeOut();
                    }, 3000);
                }
                else
                {
                    location.reload();
                }
            }, "json");
        }
        else
        {
            $('#wrong-pasw').show();
            $('#x-pasw').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
            $('#x-pasw').show();
            setTimeout(function () {
                $('#x-pasw').fadeOut();
                $('#wrong-pasw').fadeOut();
            }, 3000);
        }
    });
    $("input[name=USER_PASSWORD]").blur(function () {
        if ($(this).val() === $(this).attr('plholder') || $(this).val().length === 0)
        {
            $('#x-pasw').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
            $('#x-pasw').show();
            $('#wrong-pasw').show();
            setTimeout(function () {
                $('#x-pasw').fadeOut();
                $('#wrong-pasw').fadeOut();
            }, 3000);
        }
    });
    $("input[name=YOUR_EMAIL]").focus(function () {
        $('#not-new-pas').hide();
        $('#x-new-pas').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll left 0px rgba(0, 0, 0, 0)');
        $('#x-new-pas').hide();
    });
    $("input[name=YOUR_EMAIL]").blur(function () {
        $('#x-new-pas').css('background', 'none');
        var email = $(this);
        if ($(this).val() !== $(this).attr('plholder') && $(this).val().length > 0)
        {
            $.post("/bitrix/tools/igima.moddos/ajax/main.php", {'verif-email': $(this).val(), 'verif-user': 'Y'},
            function (data) {
                if (data.result)
                {
                    $('#not-new-pas').html('<i></i>' + BX.message('IGIMA_MODDOS_JS_USER_EXIST'));
                    $('#x-new-pas').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
                    $('#not-new-pas').show();
                    $('#x-new-pas').show();
                    email.closest('.entry-form').addClass('error');
                    setTimeout(function () {
                        ths.siblings('.hint-error').fadeOut();
                    }, 3000);
                }
                else
                {
                    if (data.error)
                    {
                        $('#x-new-pas').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll left 0px rgba(0, 0, 0, 0)');
                        $('#x-new-pas').show();
                    }
                    else
                    {
                        $('#not-new-pas').html('<i></i>' + BX.message('IGIMA_MODDOS_JS_EMAIL_ERROR'));
                        $('#x-new-pas').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
                        $('#not-new-pas').show();
                        $('#x-new-pas').show();
                        email.closest('.entry-form').addClass('error');
                        setTimeout(function () {
                            $('#not-new-pas').fadeOut();
                            $('#x-new-pas').fadeOut();
                        }, 3000);
                    }
                }
            }, "json");
        }
        else
        {
            $('#x-new-pas').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
            $('#x-new-pas').show();
            $('#not-new-pas').show();
            email.closest('.entry-form').addClass('error');
        }
    });
    $("input[name=USER_PASSWORD]").focus(function () {
        $('#wrong-pasw').hide();
        $('#x-pasw').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll left 0px rgba(0, 0, 0, 0)');
        $('#x-pasw').hide();
    });
    $('#send-new-pasw').click(function (e) {
        $('#not-new-pas').hide();
        $('#x-new-pas').hide();
        $.post("/bitrix/tools/igima.moddos/ajax/main.php", {'USER_EMAIL': $('input[name=YOUR_EMAIL]').val(), 'NEW_PASW': 'Y'},
        function (data) {
            if (data.error)
            {
                $('#not-new-pas').show();
                $('#x-new-pas').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
                $('#x-new-pas').show();
            }
            else
            {
                location.reload();
            }
        }, "json");
    });


    $("input[name=EMAIL]").focus(function () {

        $('#err-reg-email').hide();
        $('#x-reg-email').hide();
    });
    $("input[name=EMAIL]").blur(function () {
        var email = $(this);
        $('#x-reg-email').css('background', 'none');
        if ($(this).val() !== $(this).attr('plholder') && $(this).val().length > 0)
        {
            $.post("/bitrix/tools/igima.moddos/ajax/main.php", {'verif-email': $(this).val(), 'verif-user': 'Y'},
            function (data) {
                if (data.result)
                {
                    $('#x-reg-email').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll left 0px rgba(0, 0, 0, 0)');
                    $('#x-reg-email').show();

                }
                else
                {
                    if (data.error)
                        $('#err-reg-email').html('<i></i>' + data.error);
                    $('#x-reg-email').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
                    $('#err-reg-email').show();
                    $('#x-reg-email').show();
                    email.closest('.entry-form').addClass('error');
                    setTimeout(function () {
                        $('#err-reg-email').fadeOut();
                    }, 3000);
                }
            }, "json");
        }
        else
        {
            $('#x-reg-email').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
            $('#x-reg-email').show();
            $('#err-reg-email').show();
        }
    });
    $("input[name=NAME]").blur(function () {
        if ($(this).val() === $(this).attr('plholder') || $(this).val().length === 0)
        {
            $('#x-reg-name').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
            $('#x-reg-name').show();
            $('#err-reg-name').show();
        }
    });
    $("input[name=NAME]").focus(function () {
        $('#err-reg-name').hide();
        $('#x-reg-name').hide();
    });
    $("a[name=general-save]").focus(function () {
        $.post("/bitrix/tools/igima.moddos/ajax/personal.php", {"general-save": true, "name": $('input[name=namels]').val(), "email": $('input[name=emailprivate]').val(), "phoneru": $('input[name=pmobileru]').val(), "phoneua": $('input[name=pmobileua]').val(), "phonekz": $('input[name=pmobilekz]').val(), "phoneby": $('input[name=pmobileby]').val(), "birthday": $('input[name=your-birthdate]').val()},
        function ()
        {

        }, "json");
    });

    $("a[name=address-save]").focus(function () {
        $.post("/bitrix/tools/igima.moddos/ajax/personal.php", {"address-save": true, "city": $('input[name=city]').val(), "zip": $('input[name=zippriv]').val(), "street": $('input[name=streetpriv]').val(), "house": $('input[name=housepriv]').val(), "apartaments": $('input[name=aparpriv]').val()},
        function ()
        {

        }, "json");

    });
    $("a[name=password-save]").focus(function () {
        if (($('input[name=enpass]').val() && $('input[name=enpassagain]').val()) && ($('input[name=enpass]').val() === $('input[name=enpassagain]').val()))
        {
            $.post("/bitrix/tools/igima.moddos/ajax/personal.php", {"password-save": true, "enpass": $('input[name=enpass]').val(), "enpassagain": $('input[name=enpassagain]').val()},
            function ()
            {

            }, "json");
        }
    });
    $("a[name=avatar-save]").focus(function () {
        $.post("/bitrix/tools/igima.moddos/ajax/personal.php", {"avatar-save": true, "newphoto": $('input[class=button-green]').val(), "newavatar": $('input[class=button-green]').val()},
        function ()
        {

        }, "json");
    });
    $("a[name=avatar-remove]").focus(function () {
        $.post("/bitrix/tools/igima.moddos/ajax/personal.php", {"avatar-remove": true},
        function ()
        {

        }, "json");
    });
    $('#but-reg').click(function (e) {
        if ($('input[name=NAME]').val().length === 0 || $('input[name=NAME]').val() === $('input[name=NAME]').attr('plholder'))
        {
            $('#err-reg-name').show();
            $('#x-reg-name').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
            $('#x-reg-name').show();
        }
        else
        {
            if ($('input[name=EMAIL]').val().length === 0 || $('input[name=EMAIL]').val() === $('input[name=EMAIL]').attr('plholder'))
            {
                $('#err-reg-email').show();
                setTimeout(function () {
                    $('#err-reg-email').fadeOut();
                }, 3000);
            }
            else
            {
                $.post("/bitrix/tools/igima.moddos/ajax/register.php", {'USER_NAME': $('input[name=NAME]').val(), 'USER_EMAIL': $('input[name=EMAIL]').val(), 'register_submit_button': 'Y'},
                function (data) {
                    if (data.error)
                    {
                        $('#err-reg-email').html('<i></i>' + data.error);
                        $('#err-reg-email').show();
                        $('#x-reg-email').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
                        $('#x-reg-email').show();
                        setTimeout(function () {
                            $('#err-reg-email').fadeOut();
                        }, 3000);
                    }
                    else
                    {
                        location.reload();
                    }
                }, "json");
            }
        }
    });
    $('#inform-but').click(function (e) {
        var but = $(this);
        $('#inform-receipt .error-area').html('');
        var sess = $("#inform-receipt input[name=sessid]").val();
        var name = $("input[name=INFORM_NAME]").val();
        var email = $("input[name=INFORM_EMAIL]").val();
        var phone = '';
        $('#inform-receipt .phone-inp > .mask-input').each(function () {
            if ($(this).css('display') !== "none")
                phone = $(this).val();
        });
        var text = $('#inform-receipt .entry-form > textarea').val();

        if ($('#inform-receipt .entry-form > textarea').attr('plholder') === text)
            text = '';
        var re = /_/g;
        var result = re.exec(phone);
        if (result)
        {
            $(this).siblings('.phone-inp > .entry-ico').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
            $(this).siblings('.phone-inp').addClass('error');
            $(this).siblings('.phone-inp > .hint-error').show();
            $("#error-phone-inf").show();
            setTimeout(function () {
                $('#error-phone-inf').fadeOut();
            }, 3000);
        }
        else
        {
            var txt = but.html();
            $.post("/bitrix/tools/igima.moddos/ajax/main.php", {'verif-email': email},
            function (data) {
                but.html(txt);
                if (data.result)
                {
                    $.post("/bitrix/tools/igima.moddos/ajax/inform.php", {'form_text_4': name, 'form_email_7': email, 'form_text_5': phone, 'form_textarea_6': text, 'web_form_apply': 'Y', 'WEB_FORM_ID': 2, 'sessid': sess},
                    function (data) {
                        but.html(txt);
                        if (data.ok === "Y")
                        {
                            $.post("/bitrix/tools/igima.moddos/ajax/register.php", {'USER_NAME': name, 'USER_EMAIL': email, 'register_submit_button': 'Y', 'USER_PHONE': phone},
                            function (data) {
                                but.html(txt);
                                if (data.error)
                                {
                                    but.siblings(".hints").html('<span class="hints-arrow"></span>' + data.error + '');
                                    but.siblings(".hints").show();
                                    setTimeout(function () {
                                        $('.fancybox-close').click();
                                        but.siblings(".hints").hide();
                                    }, 3000);
                                }
                                else
                                {
                                    if ($("#inform-receipt .checkbox").hasClass('checked'))
                                    {
                                        $.post("/bitrix/tools/igima.moddos/ajax/main.php", {'submail': email, 'rub[]': [4]},
                                        function (data) {
                                            but.html(txt);
                                            if (data.error)
                                            {
                                                but.siblings(".hints").html('<span class="hints-arrow"></span>' + data.error + '');
                                                but.siblings(".hints").show();
                                                setTimeout(function () {
                                                    but.siblings(".hints").fadeOut();
                                                }, 3000);
                                            }
                                        }, "json");
                                    }
                                    $.post("/bitrix/tools/igima.moddos/ajax/addtocart.php", {'PRODUCT_ID': $('#inform-receipt').find('.title').attr('offer-id'), 'SUBSCRIBE': 'Y'},
                                    function (data) {
                                        but.html(txt);
                                        if (data)
                                        {
                                            but.siblings(".hints").html('<span class="hints-arrow"></span>' + BX.message('IGIMA_MODDOS_JS_SUBS_OK'));
                                            but.siblings(".hints").show();
                                            setTimeout(function () {
                                                window.location.hash = '#show-inf';
                                                location.reload();
                                            }, 2000);
                                        }
                                    }, "html");
                                }
                            }, "json");
                        }
                        else
                        {
                            but.siblings(".hints").html('<span class="hints-arrow"></span>' + data.error + '');
                            but.siblings(".hints").show();
                            setTimeout(function () {
                                but.siblings(".hints").fadeOut();
                            }, 3000);
                        }

                    }, "json");
                }
                else
                {
                    but.siblings('.user-email-inp > .entry-ico').css('background', 'url("/bitrix/images/igima.moddos/entry-form-ico.png") no-repeat scroll right 0px rgba(0, 0, 0, 0)');
                    but.siblings('.user-email-inp').addClass('error');
                    but.siblings('.user-email-inp > .hint-error').show();
                    $("#error-femail").show();
                    setTimeout(function () {
                        $('#error-femail').fadeOut();
                    }, 3000);
                }
            }, "json");
        }
        e.preventDefault();
    });
    $('.popup-product').on("click", ".continue-btn", function (e) {
        $(this).closest('.fancybox-skin').find('.fancybox-close').click();
        e.preventDefault();
    });
    $('.popup-product').on("click", ".delete", function (e) {
        var obj = $(this);
        var truthBeTold = window.confirm(BX.message('IGIMA_MODDOS_JS_CART_DEL'));
        if (truthBeTold)
        {
            GetVeil(obj.closest('.popup-product'), 'cart-veil');
            $('#cart-veil').spin('large', '#444');
            $.post("/bitrix/tools/igima.moddos/ajax/addtocart.php", {'BASKET_ITEM_ID': $(this).attr('offer-id'), 'DELETE': 'Y'},
            function (res)
            {
                $('.veil').spin(false).hide();
                if (res.DEL === "Y")
                {
                    var actab = $('.head').find('.active');
                    if (actab.is('.pop-cart'))
                    {
                        var cartn = $('#bx_cart_num').html();
                        $('#bx_cart_num').html(cartn - 1);
                        var showp = ".tab-cart";
                        actab.find('a > .numb').html(cartn - 1);
                    }
                    else
                    {
                        if (actab.is('.pop-elected'))
                        {
                            var showp = ".tab-elected";
                            var cartn = $('#bx_fav_num').html();
                            $('#bx_fav_num').html(cartn - 1);
                            actab.find('a > .numb').html(cartn - 1);
                        }
                        else
                        {
                            if (actab.is('.pop-expect-revenues'))
                                var showp = ".tab-expect-revenues";
                            var cartn = $('.pop-expect-revenues .numb').html();
                            actab.find('a > .numb').html(cartn - 1);
                        }
                    }
                    var length = obj.closest('table').find('tr').length;
                    if (length > 2) {
                        obj.closest('tr').remove();
                        ShowPrice(showp);
                    } else {
                        actab.find('.numb').html('0');
                        obj.closest('table').hide().siblings('.continue-btn').hide();
                        obj.closest('.pop-tab').find('.discount-coupon-wrap').hide();
                        obj.closest('.pop-tab').find('.calculating').hide();
                        obj.closest('.pop-tab').find('.button-wrpap').hide();
                        obj.closest('table').hide().siblings('.pop-tab-empty').show();
                        if (actabcl === 'pop-cart active')
                        {
                            $('#bx_cart_num').addClass('grey');
                            $('#bx_cart_num').siblings('.ico').addClass('empty');
                            $('#bx_cart_num').siblings('a').addClass('grey');
                        }
                        if (actabcl === 'pop-elected active')
                        {
                            $('#bx_fav_num').siblings('.ico').removeClass('full');
                        }
                    }
                }
            }, "json");
        }
        e.preventDefault();
    });
    $('.popup-product').on("click", ".apply-btn", AddCoupon);
    $('.popup-product').on("click", ".plus", function (e) {
        var obj = $(this);
        var inp = obj.closest('.inp-count').find('.count');
        var oid = obj.closest('.inp-count').attr('offer-id');
        var v = parseInt(inp.val());
        v++;
        GetVeil(obj.closest('.popup-product'), 'cart-veil');
        $('#cart-veil').spin('large', '#444');
        $.post("/bitrix/tools/igima.moddos/ajax/addtocart.php", {'OFFER_ID': oid, 'QNT': v},
        function (data) {
            $('.veil').spin(false).hide();
            if (data.OK)
            {
                inp.val(v);
                ShowPrice('.tab-cart');
            }
        }, "json");
        e.preventDefault();
        return false;
    });
    $('.popup-product').on("click", ".minus", function (e) {
        var obj = $(this);
        var inp = obj.closest('.inp-count').find('.count');
        var oid = obj.closest('.inp-count').attr('offer-id');
        var v = parseInt(inp.val());
        if (v > 1)
        {
            GetVeil(obj.closest('.popup-product'), 'cart-veil');
            $('#cart-veil').spin('large', '#444');
            v--;
            $.post("/bitrix/tools/igima.moddos/ajax/addtocart.php", {'OFFER_ID': oid, 'QNT': v},
            function (data) {
                $('.veil').spin(false).hide();
                if (data.OK)
                {
                    inp.val(v);
                    ShowPrice('.tab-cart');
                }
            }, "json");
        }
        e.preventDefault();
        return false;
    });
    $('.popup-product').on("click", ".to-favorites a", function (e) {
        var obj = $(this);
        var txt = obj.html();
        GetVeil(obj.closest('.popup-product'), 'cart-veil');
        $('#cart-veil').spin('large', '#444');
        $.post("/bitrix/tools/igima.moddos/ajax/addtocart.php", {'OFFER_ID': $(this).attr('offer-id'), 'SEND_TO_FAV': 'Y'},
        function (data) {
            $('.veil').spin(false).hide();
            if (data)
            {
                obj.html(txt);
                $('.elected-item > .ico').addClass('full');
                $('.tab-elected .pop-tab-empty').removeClass('disbl');
                $('.tab-elected .pop-tab-empty').hide();
                $('.tab-elected').html(data);
                ShowPrice('.tab-elected');
                var length = obj.closest('table').find('tbody > tr').length;
                if (length > 1)
                    obj.closest('tr').remove();
                else
                {
                    obj.closest('table').hide().siblings('.continue-btn').hide();
                    obj.closest('.pop-tab').find('.discount-coupon-wrap').hide();
                    obj.closest('.pop-tab').find('.calculating').hide();
                    obj.closest('.pop-tab').find('.button-wrpap').hide();
                    obj.closest('table').hide().siblings('.pop-tab-empty').show();
                    obj.closest('table').remove();
                    var curt_num = $('#bx_cart_num').html();
                    if (curt_num === "0")
                    {
                        $('.cart-item > a').addClass('grey');
                        $('.cart-item > .ico').addClass('empty');
                        $('.cart-item > .numb').addClass('grey');
                    }
                }
                ShowPrice('.tab-cart');
            }
        }, "html");
        e.preventDefault();
    });

    $('.popup-product').on("click", ".send-to-cart", function (e) {
        var obj = $(this);
        var txt = obj.html();
        GetVeil(obj.closest('.popup-product'), 'cart-veil');
        $('#cart-veil').spin('large', '#444');
        $.post("/bitrix/tools/igima.moddos/ajax/addtocart.php", {'OFFER_ID': $(this).attr('offer-id'), 'SEND_TO_CART': 'Y'},
        function (data) {
            $('.veil').spin(false).hide();
            if (data)
            {
                $('.tab-cart > table').remove();
                $('.tab-cart .pop-tab-empty').removeClass('disbl');
                $('.tab-cart .pop-tab-empty').hide();
                $('.tab-cart').prepend(data);
                obj.html(txt);
                $('.tab-cart > .discount-coupon-wrap').show();
                $('.tab-cart > .calculating').show();
                $('.tab-cart > .button-wrpap').show();
                $('#bx_cart_num').removeClass('grey');
                $('#bx_cart_num').siblings('.ico').removeClass('empty');
                $('#bx_cart_num').siblings('a').removeClass('grey');
                ShowPrice('.tab-cart');
                var length = obj.closest('table').find('tbody > tr').length;
                if (length > 1)
                    obj.closest('tr').remove();
                else
                {
                    obj.closest('table').siblings('.pop-tab-empty').show();
                    obj.closest('table').siblings('.continue-btn').remove();
                    obj.closest('table').remove();
                    $('.elected-item > .ico').removeClass('full');
                }
            }
        }, "html");
        e.preventDefault();
    });
    $('.popup-product').on("click", ".number-coupon", function (e) {
        var length = $(this).closest('ul').find('li').length;
        if (length > 1) {
            $(this).closest('li').remove();
        } else {
            $(this).closest('.used-coupon').find('li').addClass('nodisp');
            $(this).closest('.used-coupon').hide();

        }
        ;
        e.preventDefault();
    });
    $('.popup-product').on("focusout", ".discount-coupon .coupon-inp", function () {
        var pl_val = $(this).attr('placeholder');
        $(this).removeAttr('placeholder');
        $(this).attr('plholder', pl_val);
        if ($(this).val() === '') {
            $(this).val($(this).attr('plholder')).css({color: '#a5a5a5'});
        }
        if ($(this).val() === ' ')
            $(this).val($(this).attr('plholder')).css({color: '#a5a5a5'});
    });
    $('.popup-product').on("focusin", ".discount-coupon .coupon-inp", function () {
        var pl_val = $(this).attr('placeholder');
        $(this).removeAttr('placeholder');
        $(this).attr('plholder', pl_val);
        if ($(this).val() === '') {
            $(this).val($(this).attr('plholder')).css({color: '#a5a5a5'});
        }
        if ($(this).val() === $(this).attr('plholder'))
        {
            $(this).val(' ');
            $(this).css({color: '#767676'});
        }
    });
    $('.tabs').on('click', '.delivery-method .radio', ClickDelivery);
    $('body').on("click", ".entry-form .list-country li a", function (e) {
        var ths = $(this);
        var src = ths.find('img').attr('src');
        ths.closest('ul').fadeOut(200, function () {
            ths.closest('li').hide().siblings().show();
        });
        ths.closest('.entry-form ').find('.desc-inp').find('img').attr('src', src);
        ths.closest('.entry-form ').find('.mask-input').hide().eq(ths.closest('li').index()).show().focus();
        e.preventDefault();
    });
    $('body').on("click", ".entry-form.phone-inp .desc-inp", function (e) {
        var listCnt = $(this).siblings('.list-country');
        if (listCnt.is(':visible')) {
            listCnt.fadeOut(200);
        } else {
            listCnt.fadeIn(200);
        }
        ;
    });

    $('body').on("click", ".entry-form.user-name-inp .desc-inp", function (e) {
        $(this).closest('.entry-form').find('input[type=text]').focus();
        e.preventDefault();
    });
    $('.write-review .button-green').fancybox({
        padding: 0,
        openEffect: 'elastic',
        openSpeed: 300,
        closeEffect: 'elastic',
        closeSpeed: 150,
        scrolling: 'no',
        keys: {close: [27]},
        helpers: {
            overlay: {
                showEarly: false
            }
        },
        beforeShow: function () {
            $('.fancybox-skin').addClass('fancybox-write-review-popup');
            $('.products-viewed').css({'margin-left': -495 - scrollbarWidth() / 2});
        },
        beforeClose: function () {
            $('.fancybox-skin').find('.back').click();
        },
        afterClose: function () {
            $('.fancybox-overlay').hide();
            $('.products-viewed').css({'margin-left': '-495px'});
        }
    });
    $('#write-review').on("click", ".button-green", function (e) {
        var items = {};
        items[$('.rating input:checked').attr('name')] = $('.rating input:checked').val();
        items[$('.radio-answer input:checked').attr('name')] = $('.radio-answer input:checked').val();
        items[$('.item-scroll').attr('name')] = $('.item-scroll').val();
        items[$('.full-name').attr('name')] = $('.full-name').val();
        items['add_review'] = 'Y';
        items['iblock_submit'] = 'Y';
        items['sessid'] = $('#sessid').val();
        $.post("/bitrix/tools/igima.moddos/ajax/reviews.php", items,
                function (data) {
                    $('.veil').spin(false).hide();
                    if (data)
                    {
                        $('.write-review-popup').html(data);
                        $('#write-review').find('.error-message').delay(3000).fadeOut('normal');
                    }
                    else
                    {
                        $('.write-review-popup').append('<div class="confirm-message">' + BX.message('IGIMA_MODDOS_JS_CONFIRM_MESSAGE') + '</div>');
                        $('.write-review-popup').find('.confirm-message').delay(3000).fadeOut('normal', function () {
                            location.reload();
                        });

                    }
                }, "html");
        e.preventDefault();
    });

    var shopAddOpinionRating = 0;
    var ths = $('.rating');
    $('.write-review-popup').on("click", ".rating input[type=radio]", function () {
        ths.removeClass('rating-0 rating-1 rating-2 rating-3 rating-4  rating-5');
        if ($(this).is(':checked')) {
            shopAddOpinionRating = $(this).attr('data-rating');
            ths.addClass('rating-' + shopAddOpinionRating);
            ths.siblings('input[type=hidden]').val(shopAddOpinionRating);
        }
    });
    // hover stars
    $('.write-review-popup').on("mouseenter", ".rating label", function () {
        var ths = $(this).closest('.rating');
        shopAddOpinionRating = ths.find('input[type=radio]:checked').attr('data-rating');
        var hover_inp = $(this).find('input[type=radio]');
        ths.removeClass('rating-0 rating-1 rating-2 rating-3 rating-4  rating-5');
        ths.addClass('rating-' + hover_inp.attr('data-rating'));
    });
    $('.write-review-popup').on("mouseleave", ".rating label", function () {
        var ths = $(this).closest('.rating');
        ths.removeClass('rating-0 rating-1 rating-2 rating-3 rating-4  rating-5');
        if (!shopAddOpinionRating)
            shopAddOpinionRating = 0;
        ths.addClass('rating-' + shopAddOpinionRating);
    });

    $('.write-review-popup').on("click", ".radio-answer input[type=radio]", function () {
        $(this).closest('.radio-answer').find('label').removeClass('checked');
        if ($(this).is(':checked'))
            $(this).closest('label').addClass('checked');
    });

// we'll use this as the selector for our page scrolling animation.
    scrollTopElement = getScrollTopElement();


    $('.popup-product .continue-btn').click(function (e) {
        $(this).closest('.fancybox-skin').find('.fancybox-close').click();
        e.preventDefault();
    });
    $('.breadcrumbs a.active').click(function (e) {
        e.preventDefault();
    });

    $('header .callback, header .cabinet-item>a').fancybox({
        padding: 0,
        openEffect: 'elastic',
        openSpeed: 100,
        closeEffect: 'elastic',
        closeSpeed: 50,
        scrolling: 'no',
        keys: {close: [27]},
        helpers: {
            overlay: {
                showEarly: false
            }
        },
        beforeShow: function () {
            $('html').css({'margin-right': scrollbarWidth()});
            $('.button-up').css({'margin-left': 555 - scrollbarWidth() / 2});
            $('.products-viewed').css({'margin-left': -495 - scrollbarWidth() / 2});
        },
        beforeClose: function () {
            $('.fancybox-skin').find('.back').click();
        },
        afterClose: function () {
            $('.fancybox-overlay').hide();
            $('html').css({'margin-right': '0'});
            $('.button-up').css({'margin-left': '555px'});
            $('.products-viewed').css({'margin-left': '-495px'});
        }
    });


    $('.view a.choose').fancybox({
        padding: 0,
        autoWidth: true,
        openEffect: 'elastic',
        openSpeed: 100,
        closeEffect: 'elastic',
        closeSpeed: 50,
        scrolling: 'no',
        keys: {close: [27]},
        helpers: {
            overlay: {
                showEarly: false
            }
        },
        beforeShow: function () {
            $('html').css({'margin-right': scrollbarWidth()});
            $('.button-up').css({'margin-left': 555 - scrollbarWidth() / 2});
            $('.products-viewed').css({'margin-left': -495 - scrollbarWidth() / 2});
            $('.fancybox-skin').addClass('fancybox-popup-product').find('.pop-elected').find('a').click();

            $('.fancybox-skin').find('.descript-block').width($('.fancybox-skin').find('.table-size').find('th').length * 79);
        },
        afterShow: function () {
        },
        afterClose: function () {
            $('.fancybox-overlay').hide();
            $('html').css({'margin-right': '0'});
            $('.button-up').css({'margin-left': '555px'});
            $('.products-viewed').css({'margin-left': '-495px'});
        }
    });
    $('.popup-entrance .password-reminder ').click(function (e) {
        $(this).closest('.popup-entrance').find('.pop-entrance').hide().siblings('.pop-password-reminder').show();
        e.preventDefault();
    });

    $('.popup-entrance .back').click(function (e) {
        $(this).closest('.popup-entrance').find('.pop-entrance').show().siblings('.pop-password-reminder').hide();
        e.preventDefault();
    });

    $('.popup-product .head li a').click(function (e) {
        $(this).closest('li').addClass('active').siblings().removeClass('active');
        $(this).closest('.popup-product').find('.pop-tab').hide().eq($(this).closest('li').index()).show();
        e.preventDefault();
    });

    $('.popup-product .used-coupon .number-coupon').click(function (e) {
        var length = $(this).closest('ul').find('li').length;
        if (length > 1) {
            $(this).closest('li').remove();
        } else {
            $(this).closest('.used-coupon').hide();
        }
        ;
        e.preventDefault();
    });



    alignmentByHeight('feedback');


    $('header .menu').mouseleave(function () {
        $('.overlay').hide();
        $(this).find('.submenu').hide();
        $(this).find('li.active').find('.text').css({'background': '#FF0000', 'border-bottom: 2px solid': '#FFF'});
    });
    $('header .menu li').hover(
            function () { //over
                $('.overlay').height($('body').height()).show();
                if (!$(this).closest('.menu').find('.submenu').is(':visible')) {
                    $(this).find('.submenu').fadeIn(500);
                } else {
                    $(this).find('.submenu').show();
                    $(this).siblings().find('.submenu').hide();
                }
                ;
                $(this).find('.text').css({'background': '#FF0000', 'border-bottom: 2px solid': '#FF0000'});
                $(this).siblings().find('.text').css({'background': '#000', 'border-bottom: 2px solid': '#FFF'});
            }, function () { //out
        $(this).find('.text').css({'background': '#000', 'border-bottom: 2px solid': '#FFF'});
    }
    );

    $('.content-left-column .sidebar').each(function () {
        var accordion_head = $('.content-left-column .sidebar> ul > li > a'),
                accordion_body = $('.content-left-column .sidebar> ul > li > ul');
        if (accordion_head.hasClass('active')) {
            $('.content-left-column .sidebar> ul > li > a.active').next().slideDown('normal');
        } else {
            accordion_head.first().addClass('active').next().slideDown('normal');
        }
        ;
        accordion_head.on('click', function (event) {
            event.preventDefault();
            if ($(this).attr('class') !== 'active') {
                accordion_body.slideUp('normal');
                $(this).next().stop(true, true).slideToggle('normal');
                accordion_head.removeClass('active');
                $(this).addClass('active');
            }
            else
            {
                document.location.href = $(this).attr('href');
            }
        });
    });

    $('#main, .popup').on("change", "label.checkbox input[type=checkbox]", function () {
        if ($(this).is(':checked')) {
            $(this).closest('label').addClass('checked');
        } else {
            $(this).closest('label').removeClass('checked');
        }
    });

    $('#main, .popup').on("change", "label.radio input[type=radio]", function () {
        if ($(this).attr('name') !== 'delivery-method')
        {
            var inp_name = $(this).attr('name');
            $('input[name=' + inp_name + ']').closest('label').removeClass('checked');
            if ($(this).is(':checked')) {
                $(this).closest('label').addClass('checked');
            } else {
                $(this).closest('label').removeClass('checked');
            }
        }
    });
    $('label.radio input[type=radio]').each(function () {
        if ($(this).is(':checked')) {
            $(this).closest('label').addClass('checked');
        } else {
            $(this).closest('label').removeClass('checked');
        }
    });
    $('.product-carousel').each(function () {
        $(this).find('.carousel').bxSlider({
            slideWidth: 151,
            minSlides: 1,
            maxSlides: 5,
            moveSlides: 5,
            slideMargin: 42,
            pager: false
        });
    });
    var carousell = $('.products-viewed-carousel').bxSlider({
        slideWidth: 151,
        minSlides: 1,
        maxSlides: 5,
        moveSlides: 5,
        slideMargin: 42,
        pager: false
    });
    $('.products-viewed .slide').click(function (e) {
        var el = $(e.target);
        var length = $(this).closest('.products-viewed ').find('.slide').length - $(this).closest('.products-viewed ').find('.bx-clone').length;
        var total = $(this).closest('.products-viewed').find('.total').text();
        total--;
        if (el.get(0) === $(this).find('.remove').get(0) && length > 6) {
            $(this).closest('.products-viewed').find('.total').text(total);
            $(this).remove();
            carousell.reloadSlider();
            e.preventDefault();
        } else if (el.get(0) === $(this).find('.remove').get(0) && length > 1) {
            $(this).closest('.products-viewed').find('.bx-controls').hide();
            $(this).closest('.products-viewed').find('.bx-clone').text('').css({'box-shadow': 'none', 'cursor': 'default'});
            $(this).closest('.products-viewed').find('.total').text(total);
            $(this).remove();
            e.preventDefault();
        } else if (el.get(0) === $(this).find('.remove').get(0) && length === 1) {
            $(this).closest('.products-viewed').slideUp();
            $(this).remove();
            $('.overlay').css({'position': 'absolute', 'opacity': '1'}).hide();
        }
        ;
    });
    $('.products-viewed .remove-all').click(function (e) {
        $(this).closest('.products-viewed').find('.total').text('0');
        $(this).closest('.products-viewed').find('.slide').fadeOut(100, function () {
            $(this).closest('.products-viewed').slideUp('normal');
            $('.overlay').css({'position': 'absolute', 'opacity': '1'}).hide();
        });
        e.preventDefault();
    });
    $('.products-viewed .button-top').click(function (e) {
        if ($(this).closest('.products-viewed').find('.product-carousel').is(':visible')) {
            $(this).removeClass('active');
            $('.overlay').css({'position': 'absolute', 'opacity': '1'}).hide();
            $(this).closest('.products-viewed').find('.product-carousel').slideUp('normal', function () {
            });
        } else {
            $('.overlay').show().css({'position': 'fixed', 'opacity': '0'});
            $(this).closest('.products-viewed').find('.product-carousel').slideDown('normal');
            $(this).addClass('active');
            carousell.reloadSlider();
        }
        ;
        e.preventDefault();
    });
    $('.overlay').click(function (e) {
        if ($('.products-viewed').find('.product-carousel').is(':visible')) {
            $('.products-viewed').find('.product-carousel').slideUp();
            $(this).css({'position': 'absolute', 'opacity': '1'}).hide();
        }
        ;
    });
    $('.pop-choose-size .table-size tr').click(function (e) {
        $(this).closest('.fancybox-skin').find('.fancybox-close').click();
    });

    $('.main-slides').slides({
        preload: true,
        preloadImage: '/bitrix/images/igima.moddos/loader64.gif',
        container: 'slides_container',
        generateNextPrev: false,
        next: 'next',
        prev: 'prev',
        pagination: true,
        generatePagination: true,
        paginationClass: 'pagination',
        currentClass: 'active',
        effect: 'fade', // 'fade'
        slideSpeed: 450, // fadeSpeed
        // crossfade: false,
        randomize: false,
        play: 5000, // Autoplay in msec
        pause: 2500,
        hoverPause: true,
        bigTarget: false // Click on slide = click on next
    });

    $('header .contacts .phone .info').hover(
            function () { //over
                $(this).addClass('active').find('.info-block').stop(true, true).fadeIn(200);
            },
            function () { //out
                $(this).removeClass('active').find('.info-block').stop(true, true).fadeOut(200);
            }
    );

    $('header .contacts .search input').focus(function () {
        $(this).closest('.search').addClass('active');
    });
    $('header .contacts .search input').blur(function () {
        $(this).closest('.search').removeClass('active');
    });

    $('.button-up').click(function (e) {
        $('html, body').animate({scrollTop: 0}, 400);
        e.preventDefault();
    });

    $('input.mask-input.phone-ru').mask('+7 (999) 999-99-99');
    $('input.mask-input.phone-kz').mask('+7 (999) 999-99-99');
    $('input.mask-input.phone-ua').mask('+380 (999) 999-99-99');
    $('input.mask-input.phone-by').mask('+375 (999) 999-99-99');

    $('#main').on("click", ".social a", function (e) {
        var url = $(this).closest('.social').attr('data-url');
        var id = $(this).attr('data-id');
        var vk = "https://vk.com/share.php?url=http://";
        var fb = "https://www.facebook.com/sharer/sharer.php?u=http://";
        var tw = "https://twitter.com/home?status=http://";
        var gp = "https://plus.google.com/share?url=http://";
        var mr = "https://connect.mail.ru/share?url=http://";
        var ok = "https://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=http://";
        if (id === "vk")
            BX.util.popup(vk + url, 700, 470);
        if (id === "fb")
            BX.util.popup(fb + url, 700, 470);
        if (id === "tw")
            BX.util.popup(tw + url, 700, 470);
        if (id === "gp")
            BX.util.popup(gp + url, 700, 470);
        if (id === "ok")
            BX.util.popup(ok + url, 700, 470);
        if (id === "mr")
            BX.util.popup(mr + url, 700, 470);
        e.preventDefault();
    });
    $('.my-cart-col .item-scroll').jScrollPane({
        autoReinitialise: true,
        autoReinitialiseDelay: 500,
        mouseWheelSpeed: 100
    });
    $('.content').on('blur', '.search input[type=text]', function () {
        $(this).parent().removeClass('focus');
        if ($(this).val() === BX.message('IGIMA_MODDOS_JS_WRONG')) {
            $(this).closest('.delivery').find('.error').show();
        }
    });
});
$(window).scroll(function () {
    button_to_up();
    var scrTop = $(window).scrollTop();
    var footerTop = $('footer').offset().top - $(window).height();
    var difference = scrTop - footerTop;
    if (scrTop > footerTop && difference > 0 || difference === 0) {
        $('.products-viewed').css({'bottom': difference});
    } else {
        $('.products-viewed').css({'bottom': 0});
    }
    ;

});

function alignmentByHeight(classname) {
    var divs = $("div ." + classname);
    var max = 0;
    for (var i = 0; i < divs.length; i++) {
        max = Math.max(max, $(divs[i]).height());
    }
    $(divs).css('min-height', max + 'px');
}
;
function scrollbarWidth() {
    var div = document.createElement('div');
    div.style.overflowY = 'scroll';
    div.style.width = '50px';
    div.style.height = '50px';
    div.style.visibility = 'hidden';
    document.body.appendChild(div);
    var scrollWidth = div.offsetWidth - div.clientWidth;
    document.body.removeChild(div);
    return scrollWidth;
}
;
function button_to_up() {
    if ($(window).scrollTop() > 40) {
        $('.button-up').show();
    } else {
        $('.button-up').hide();
    }
    ;
}
;
function getScrollTopElement() {

    if (document.compatMode !== 'CSS1Compat')
        return 'body';

    // if there's a doctype (and your page should)
    // most browsers will support the scrollTop property on EITHER html OR body
    // we'll have to do a quick test to detect which one...

    var html = document.documentElement;
    var body = document.body;

    // get our starting position.
    // pageYOffset works for all browsers except IE8 and below
    var startingY = window.pageYOffset || body.scrollTop || html.scrollTop;

    // scroll the window down by 1px (scrollTo works in all browsers)
    var newY = startingY + 1;
    window.scrollTo(0, newY);

    // And check which property changed
    // FF and IE use only html. Safari uses only body.
    // Chrome has values for both, but says
    // body.scrollTop is deprecated when in Strict mode.,
    // so let's check for html first.
    var element = (html.scrollTop === newY) ? 'html' : 'body';

    // now reset back to the starting position
    window.scrollTo(0, startingY);

    return element;
}

// we'll use this as the selector for our page scrolling animation.
var scrollTopElement = ''; // defined in document ready section

function ShowPrice(cls)
{
    var price = 0;
    var disc = 0;
    var sum_price = 0;
    var sum_disc = 0;
    var sum_price_old = 0;
    $(cls).find('.price').each(function () {
        if ($(this).attr('data-price'))
        {
            price = $(this).attr('data-price');
            disc = $(this).attr('data-disc');
            var num = $(this).siblings('.number').find('.count').val();
            var prod_pr = price * num;
            var prod_disc = disc * num;
            sum_price = parseInt(sum_price) + parseInt(prod_pr);
            sum_disc = parseInt(sum_disc) + parseInt(prod_disc);
            if (disc > 0)
            {
                var prod_pr_old = prod_pr + parseInt(prod_disc);
                if (!$(this).siblings('.prim').find('.discount').html())
                {
                    var onepers = prod_disc / (prod_pr_old / 100);
                    $(this).siblings('.prim').find('.photo').append('<span class="discount">-' + onepers + '%</span>');
                }
                if (!$(this).find('new-price').html())
                {
                    $(this).html('');
                    $(this).append('<span class="new-price">' + XFormatPrice(prod_disc) + '<span class="rur">i</span></span><br /><span class="price-old"><span class="erase"><span>' + XFormatPrice(prod_pr_old) + '</span></span><span class="rur">i</span></span>');
                }
                $(this).find('.new-price').html(XFormatPrice(prod_pr) + ' <span class="rur">i</span>');
                $(this).find('.erase > span').html(XFormatPrice(prod_pr_old));
            }
            else
                $(this).html(XFormatPrice(prod_pr) + ' <span class="rur">i</span>');
        }

    });
    if (sum_disc)
    {
        sum_price_old = sum_price + parseInt(sum_disc);
        $(cls).find('.sale-amount').html(XFormatPrice(sum_price_old) + ' <span class="rur">i</span>');
        $(cls).find('.sale-disc').html(XFormatPrice('-' + sum_disc) + ' <span class="rur">i</span>');
        $(cls).find('.sale-total').html(XFormatPrice(sum_price) + ' <span class="rur">i</span>');
    }
    else
    {
        $(cls).find('.sale-amount').html(XFormatPrice(sum_price) + ' <span class="rur">i</span>');
        $(cls).find('.sale-disc').html('0 <span class="rur">i</span>');
        $(cls).find('.sale-total').html(XFormatPrice(sum_price) + ' <span class="rur">i</span>');
    }

}
function XFormatPrice(_number)
{
    var decimal = 0;
    var separator = ' ';
    var decpoint = '.';
    var format_string = '# ';

    var r = parseFloat(_number);

    var exp10 = Math.pow(10, decimal);
    r = Math.round(r * exp10) / exp10;

    rr = Number(r).toFixed(decimal).toString().split('.');

    b = rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g, "\$1" + separator);

    r = (rr[1] ? b + decpoint + rr[1] : b);
    return format_string.replace('#', r);
}
function AddCoupon(e)
{
    var obj = $(this);
    $('.used-coupon').find('.nodisp').remove();
    $('.used-coupon').show();
    if ($(this).siblings('input[type=text]').attr('plholder') !== $(this).siblings('input[type=text]').val())
    {
        $('.popup-product').off("click", ".apply-btn");
        var txt = obj.find('.continue-brd').html();
        GetVeil(obj.closest('.popup-product'), 'cart-veil');
        $('#cart-veil').spin('large', '#444');
        $.post("/bitrix/tools/igima.moddos/ajax/addtocart.php", {'COUPON': $(this).siblings('input[type=text]').val(), 'BasketRefresh': 'Y'},
        function (data) {
            $('.veil').spin(false).hide();
            obj.find('.continue-brd').html(txt);
            $('.popup-product').on("click", ".apply-btn", AddCoupon);
            if (data)
            {
                $.each($('.tab-cart > table > tbody > tr > .price'), function (i, val)
                {
                    var old_var = $(this);
                    $.each(data[i], function (j, pri)
                    {
                        if (j === "PRICE")
                            old_var.attr('data-price', pri);
                        else
                            old_var.attr('data-disc', pri);
                    });
                });
                ShowPrice('.tab-cart');
                $('.used-coupon > ul').prepend('<li><a href="#" class="number-coupon">' + $('.apply-btn').siblings('input[type=text]').val() + '</a></li>');

            }
            else
                $('.used-coupon > ul').prepend('<li><a href="#" class="number-coupon wrong-coupon">' + $('.apply-btn').siblings('input[type=text]').val() + ' (' + BX.message('IGIMA_MODDOS_JS_WRONG_COUPON') + ')</a></li>');

        }, "json");
    }
    else
        $('.used-coupon > ul').prepend('<li><a href="#" class="number-coupon wrong-coupon">' + BX.message('IGIMA_MODDOS_JS_EMPTY_COUPON') + '</a></li>');

    $('.used-coupon > span').show();
    e.preventDefault();
}
function GetVeil(prod, type)
{
    var sizeshoh = prod.outerHeight();
    var sizeshow = prod.outerWidth();
    var ssw = (sizeshow / 2) - 32 + 'px';
    var ssh = (sizeshoh / 2) - 32 + 'px';
    $('#' + type + ' img').css('top', ssh);
    $('#' + type + ' img').css('left', ssw);
    $('#' + type).height(sizeshoh);
    $('#' + type).width(sizeshow);
    $('#' + type).show();
}
function ClickDelivery()
{
    var inc = "N";
    $('.content').off('click', '.delivery-method .radio');
    var user = $('#order_form_content').find('input[name=PERSON_TYPE]').val();
    var delid = $(this).find('input[name=delivery-method]').val();
    var locid = $('.choice-location-inp').siblings('input[type=hidden]').val();
    var locname = $('.choice-location-inp').siblings('input[type=hidden]').attr('name');
    if ($('.button-green').siblings('.wrap').find('.checkbox').hasClass('checked'))
        inc = 'Y';
    findDelivery(delid, inc, locid, locname, $('#sessid').val(), user);
}
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