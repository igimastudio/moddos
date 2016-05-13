$(document).ready(function () {
    if ($('#viewed-cnt').length > 0)
    {
        ViewedRefresh($('#viewed-cnt').attr('data-pid'), $('#viewed-cnt').attr('data-sid'));
    }
    $('header .cart-item>a').fancybox({
        padding: 0,
        openEffect: 'none',
        openSpeed: 'fast',
        closeEffect: 'none',
        closeSpeed: 50,
        scrolling: 'no',
        keys: {close: [27]},
        helpers: {
            overlay: {
                showEarly: false
            }
        },
        beforeShow: function () {
            ShowPrice('.tab-cart');
            $('html').css({'margin-right': scrollbarWidth()});
            $('.fancybox-skin').addClass('fancybox-popup-product').find('.pop-cart').find('a').click();
            $('.button-up').css({'margin-left': 555 - scrollbarWidth() / 2});
            $('.products-viewed').css({'margin-left': -495 - scrollbarWidth() / 2});
        },
        afterClose: function () {
            $('.fancybox-overlay').hide();
            $('html').css({'margin-right': '0'});
            $('.button-up').css({'margin-left': '555px'});
            $('.products-viewed').css({'margin-left': '-495px'});
        }
    });
    $('header .elected-item>a').fancybox({
        padding: 0,
        openEffect: 'none',
        openSpeed: 'fast',
        closeEffect: 'none',
        closeSpeed: 50,
        scrolling: 'no',
        keys: {close: [27]},
        helpers: {
            overlay: {
                showEarly: false
            }
        },
        beforeShow: function () {
            ShowPrice('.tab-cart');
            $('html').css({'margin-right': scrollbarWidth()});
            $('.button-up').css({'margin-left': 555 - scrollbarWidth() / 2});
            $('.products-viewed').css({'margin-left': -495 - scrollbarWidth() / 2});
            $('.fancybox-skin').addClass('fancybox-popup-product').find('.pop-elected').find('a').click();
        },
        afterClose: function () {
            $('.fancybox-overlay').hide();
            $('html').css({'margin-right': '0'});
            $('.button-up').css({'margin-left': '555px'});
            $('.products-viewed').css({'margin-left': '-495px'});
        }
    });
    $('.view .inform-unlogin').fancybox({
        padding: 0,
        openEffect: 'none',
        openSpeed: 'fast',
        closeEffect: 'none',
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
        afterClose: function () {
            $('.view').on("click", ".inform-button", AddInform);
            $('.fancybox-overlay').hide();
            $('html').css({'margin-right': '0'});
            $('.button-up').css({'margin-left': '555px'});
            $('.products-viewed').css({'margin-left': '-495px'});
        }
    });
    $('header .sub-item').fancybox({
        padding: 0,
        openEffect: 'none',
        openSpeed: 'fast',
        closeEffect: 'none',
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
            $('.fancybox-skin').addClass('fancybox-popup-product');
        },
        afterClose: function () {
            $('.view').on("click", ".inform-button", AddInform);
            $('.fancybox-overlay').hide();
            $('html').css({'margin-right': '0'});
            $('.button-up').css({'margin-left': '555px'});
            $('.products-viewed').css({'margin-left': '-495px'});
        }
    });
    $('.catalog-area').on('click', ".view-btn", QuickView);
    $('.catalog-area').on('click', '.next', NextProd);
    $('.catalog-area').on('click', '.prev', PrevProd);
    $('.catalog-area').on('click', '.viem-next', ViemNextProd);
    $('.catalog-area').on('click', '.viem-prev', ViemPrevProd);
    $('.view .zoom-right').each(function () {
        if ($(this).find('.poto-full').length) {
            $(this).find('.poto-full').height($(this).closest('td').siblings('.descript').height() - 14);
        }
        ;
    });
    $('.catalog-area').on("mouseenter", ".view-block .zoom-left > a", function (e) {
        var ths = $(this);
        var thsSrc = ths.find('img').attr('src');
        ths.closest('.zoom-block').find('.main-img').find('img').attr('src', thsSrc);
        e.preventDefault();
    });
    $('.catalog-area').on("mouseleave", ".view-block .zoom-left > a", function (e) {
        var ths = $(this);
        var mainImg = ths.closest('.zoom-left').siblings('.zoom-right').find('.main-img > img').attr('src');
        var src = ths.closest('.zoom-left').find('.active').find('img').attr('src');
        if (!ths.hasClass('active') && !ths.siblings().hasClass('active')) {
            $(this).closest('.zoom-block').find('.main-img').find('img').attr('src', mainImg);
        } else if (ths.siblings().hasClass('active')) {
            $(this).closest('.zoom-block').find('.main-img').find('img').attr('src', src);
        }
        e.preventDefault();
    });
    $('.catalog-area').on("click", ".view-block .zoom-left > a", function (e) {
        var ths = $(this);
        var mainImg = ths.closest('.zoom-left').siblings('.zoom-right').find('.main-img > img').attr('src');
        var thsSrc = ths.find('img').attr('src');
        ths.toggleClass('active').siblings().removeClass('active');

        if (ths.hasClass('active')) {
            ths.closest('td').find('.poto-full').find('img').attr('src', thsSrc);
        } else {
            ths.closest('td').find('.poto-full').find('img').attr('src', mainImg);
        }
        ;
        e.preventDefault();
    });
    $('.catalog-area').on("mouseenter", ".view-block .color li a,.size li a", function () {
        var show = '';
        if ($(this).closest('.sizech').find('a').hasClass('active'))
            show = $(this).closest('.sizech').find('.active').attr('class');
        var top = -($(this).siblings('.hints').outerHeight());
        var left = -($(this).siblings('.hints').outerWidth() / 2);
        if ($(this).closest('li').find('.hints').length) {
            $(this).closest('li').css({'z-index': '12'});
        }
        ;
        $(this).siblings('.hints').css({'top': top, 'margin-left': left}).stop(true, true).fadeIn(200);
        if ($(this).hasClass('no-available'))
        {
            if (show)
            {
                $(this).closest('ul').siblings('.waiting').hide();
                $(this).closest('ul').siblings('.available').hide();
            }
            $(this).closest('ul').siblings('.waiting').show();
            $(this).closest('.descript').find('.add-cart-btn').hide();
            $(this).closest('.descript').find('.inform-button').show();
        }
        else
        {
            if (show)
            {
                $(this).closest('ul').siblings('.waiting').hide();
                $(this).closest('ul').siblings('.available').hide();
            }
            $(this).closest('ul').siblings('.available').show();
            $(this).closest('.descript').find('.add-cart-btn').show();
            $(this).closest('.descript').find('.inform-button').hide();
        }
    });
    $('.catalog-area').on("mouseleave", ".view-block .color li a,.size li a", function () {
        var show = '';
        if ($(this).closest('.sizech').find('a').hasClass('active'))
            show = $(this).closest('.sizech').find('.active').attr('class');
        $(this).siblings('.hints').stop(true, true).fadeOut(200, function () {
            $(this).closest('li').css({'z-index': 'auto'});
        });
        if ($(this).hasClass('no-available'))
        {
            if (!$(this).hasClass('active'))
            {
                if (!show)
                {
                    $(this).closest('ul').siblings('.waiting').hide();
                    if ($(this).closest('.descript').find('.color > span').hasClass('waiting'))
                    {
                        $(this).closest('.descript').find('.add-cart-btn').hide();
                        $(this).closest('.descript').find('.inform-button').show();
                    }
                    else
                    {
                        $(this).closest('.descript').find('.add-cart-btn').show();
                        $(this).closest('.descript').find('.inform-button').hide();
                    }
                }
                else
                if (show === 'no-available active')
                {
                    $(this).closest('ul').siblings('.waiting').show();
                    $(this).closest('.descript').find('.add-cart-btn').hide();
                    $(this).closest('.descript').find('.inform-button').show();
                }
                else
                {
                    $(this).closest('ul').siblings('.waiting').hide();
                    $(this).closest('ul').siblings('.available').show();
                    $(this).closest('.descript').find('.add-cart-btn').show();
                    $(this).closest('.descript').find('.inform-button').hide();
                }
            }
            else
                $(this).closest('ul').siblings('.waiting').show();
        }
        else
        {
            if (!$(this).hasClass('active'))
            {
                if (!show)
                {
                    $(this).closest('ul').siblings('.available').hide();
                    $(this).closest('.descript').find('.add-cart-btn').show();
                    $(this).closest('.descript').find('.inform-button').hide();
                }
                else
                if (show === 'no-available active')
                {
                    $(this).closest('ul').siblings('.available').hide();
                    $(this).closest('ul').siblings('.waiting').show();
                    $(this).closest('.descript').find('.add-cart-btn').hide();
                    $(this).closest('.descript').find('.inform-button').show();
                }
            }
            else
                $(this).closest('ul').siblings('.available').show();
        }
    });
    $('.catalog-area').on("click", ".view .close", function (e) {
        $(this).closest('.product').find('.view-btn').click();
        e.preventDefault();
    });

    $('.catalog-area').on("click", ".view .add-cart-btn", AddToCart);

    $('.catalog-area').on("click", ".view .size li a", function (e) {
        var ths = $(this);
        var noavbut = ths.closest('.size').siblings('.button-wrap').find('.inform-button');
        ths.toggleClass('active').closest('li').siblings().find('a').removeClass('active');
        if (ths.hasClass('active'))
        {
            ths.closest('.descript').find('.inform-button').attr('offer-id', ths.attr('data-offer'));
            ths.closest('.descript').find('.add-cart-btn').attr('offer-id', ths.attr('data-offer'));
            ths.closest('.descript').find('.add-elected-btn').attr('offer-id', ths.attr('data-offer'));
        }
        else
        {
            ths.closest('.descript').find('.inform-button').attr('offer-id', '');
            ths.closest('.descript').find('.add-cart-btn').attr('offer-id', '');
            ths.closest('.descript').find('.add-elected-btn').attr('offer-id', '');
        }
        if (ths.hasClass('no-available'))
        {

            if (noavbut.attr('user-auth') === 'N')
            {
                if (ths.hasClass('active'))
                {
                    noavbut.attr('href', '#inform-receipt');
                    noavbut.addClass('inform-unlogin');
                }
                else
                {
                    noavbut.attr('href', '#');
                    noavbut.removeClass('inform-unlogin');
                }
            }
            var src = ths.closest('.descript').siblings('.image-block').find('.main-img > img').attr('src');
            var name = ths.closest('.descript').find('h2 > a').html();
            var art = ths.closest('.descript').find('.data-left .line:first > .data-text').html();
            var size = ths.html();
            var color = ths.closest('.size').siblings('.color').find('a > span').css('background-color');
            if (ths)
                $('#inform-receipt .photo > img').attr('src', src);
            $('#inform-receipt .title').html(name);
            $('#inform-receipt .title').attr('offer-id', ths.attr('data-offer'));
            $('#inform-receipt .rec-art > span').html(art);
            $('#inform-receipt .rec-size > span').html(size);
            $('#inform-receipt .color > span > span').css('background-color', color);

            ths.closest('ul').siblings('.available').hide();
        }
        else
        {
            ths.closest('ul').siblings('.waiting').hide();
            ths.closest('ul').siblings('.available').show();
        }
        e.preventDefault();
    });
    $('.catalog-area').on("click", ".view .add-elected-btn", AddElected);
    $('.catalog-area').on("click", ".view .inform-button", AddInform);
    $('.content-no-indents').on("click", ".outros-produtos .prev, .outros-produtos .next", DetailQuickView);

    $('.outros-produtos').on("mouseenter", ".prev-preview,.next-preview", function () {
        $(this).find('.preview:hidden').fadeIn(200);
    });
    $('.outros-produtos').on("mouseleave", ".prev-preview,.next-preview", function () {
        $(this).find('.preview:visible').fadeOut(200);
    });

    $('.catalog-area').on("mouseenter", ".main-img", function () {
        ImageZoomInit($(this).closest('.zoom-right'), 'mouseenter');

    }).on("mouseleave", ".main-img", function () {
        ImageZoomInit($(this).closest('.zoom-right'), 'mouseleave');

    }).on("mousemove", ".main-img", function (move_pos) {
        ImageZoomInit($(this).closest('.zoom-right'), 'mousemove', move_pos);

    });

    $('.catalog-area').on('click', '.tabs-block .head a', function (e) {
        var ths = $(this);
        var ind = $(this).index();
        if (!ths.closest('.tabs-block').find('.tab').eq(ind).is(':visible')) {
            ths.addClass('active').siblings().removeClass('active');
            ths.closest('.tabs-block').find('.tab:visible').stop().fadeOut(200, function () {
                ths.closest('.tabs-block').find('.tab').eq(ind).fadeIn(200);
            });
        }
        ;
        e.preventDefault();
    });
});
//Funkcii bystrogo prosmotra
function QuickView(e)
{
    e.preventDefault();
    var prod = $(this).closest('.product-block').siblings('.view').find('.view-block');
    var ths = $(this);
    var type = 'normal';
    if (prod.html().length === 0)
        GetQuickView($(this).attr('data-id'), prod, type, ths);
    else
        ShowQuickView(ths);
    
}
function NextProd(e)
{
    e.preventDefault();
    var ths = $(this);
    var type = 'next';
    var act = ths.closest('.head').siblings('.slides_container').find('.product.active').next();
    var curact = ths.closest('.head').siblings('.slides_container').find('.product.active');
    $('.catalog-area').off('click', '.next');
    if (!act.length > 0 && curact.length > 0)
        act = ths.closest('.head').siblings('.slides_container').find('.product').first();
    if (act.length > 0)
    {
        var prod = act.find('.view-block');
        var nrm = act.find('.view-btn');
        if (prod.html().length === 0)
            GetQuickView(nrm.attr('data-id'), prod, type, ths);
        else
            NextQuickView(ths);
    }
    else
        InsBannRotatorNext(ths);
    
}
function PrevProd(e)
{
    e.preventDefault();
    var ths = $(this);
    var type = 'prev';
    var act = ths.closest('.head').siblings('.slides_container').find('.product.active').prev();
    var curact = ths.closest('.head').siblings('.slides_container').find('.product.active');
    $('.catalog-area').off('click', '.prev');
    if (!act.length > 0 && curact.length > 0)
        act = ths.closest('.head').siblings('.slides_container').find('.product').last();
    if (act.length > 0)
    {
        var prod = act.find('.view-block');
        var nrm = act.find('.view-btn');
        if (prod.html().length === 0)
            GetQuickView(nrm.attr('data-id'), prod, type, ths);
        else
            PrevQuickView(ths);
    }
    else
        InsBannRotatorPrev(ths);
    
}
function ViemNextProd(e)
{
    e.preventDefault();
    var ths = $(this);
    var type = 'vnext';
    var act = ths.closest('.product').next();
    var curact = ths.closest('.product');
    $('.catalog-area').off('click', '.viem-next');
    GetVeil(ths.closest('.view'), 'veil-quickview-' + ths.closest('.view').siblings('.product-block').find('.view-btn').attr('data-id'));
    $('#veil-quickview-' + ths.closest('.view').siblings('.product-block').find('.view-btn').attr('data-id')).spin('large', '#444');
    if (!act.length > 0 && curact.length > 0 && ths.closest('.catalog-area').find('.sl-in').length > 0)
        act = ths.closest('.slides_container').find('.product').first();

    if (act.length > 0)
    {
        var prod = act.find('.view-block');
        var nrm = act.find('.view-btn');
        if (prod.html().length === 0)
            GetQuickView(nrm.attr('data-id'), prod, type, ths);
        else
            ViemNextQuickView(ths);
    }
    else
        InsBannRotatorViemNext(ths);
    
}
function ViemPrevProd(e)
{
    e.preventDefault();
    var ths = $(this);
    var type = 'vprev';
    var act = ths.closest('.product').prev();
    var curact = ths.closest('.product');
    GetVeil(ths.closest('.view'), 'veil-quickview-' + ths.closest('.view').siblings('.product-block').find('.view-btn').attr('data-id'));
    $('#veil-quickview-' + ths.closest('.view').siblings('.product-block').find('.view-btn').attr('data-id')).spin('large', '#444');
    $('.catalog-area').off('click', '.viem-prev');
    if (!act.length > 0 && curact.length > 0 && ths.closest('.catalog-area').find('.sl-in').length > 0)
        act = ths.closest('.slides_container').find('.product').last();
    if (act.length > 0)
    {
        var prod = act.find('.view-block');
        var nrm = act.find('.view-btn');
        if (prod.html().length === 0)
            GetQuickView(nrm.attr('data-id'), prod, type, ths);
        else
            ViemPrevQuickView(ths);
    }
    else
        InsBannRotatorViemPrev(ths);
    
}
function GetQuickView(id, prod, type, ths)
{
    var ins = ths.html();
    var sab = $('#show-adv-block').attr('data-val');
    var el = "";
    if (type === 'detail')
    {
        GetVeil($('.view-block'), 'veil-detail');
        $('#veil-detail').spin('large', '#444');
    }
    if (type === 'normal')
    {
        GetVeil(ths.siblings('.product-link'), 'veil-paydel-' + id);
        $('#veil-paydel-' + id).spin('large', '#444');
    }
    if (type === 'vnext' || type === 'vprev')
    {

    }
    $.post("/bitrix/tools/igima.moddos/ajax/main.php", {'QUICK_VIEW': id, 'SHOW_ADV_BLOCK': sab, 'ELEMENT_ID': el},
    function (data) {
        if (data)
        {
            prod.html(data);
            ths.html(ins);
            if (type === 'detail')
            {
                prod.find('.poto-full').height(prod.find('.descript').height() - 14);
                $('#veil-detail').hide();
                plholder(prod);
            }
            if (type === 'normal')
            {
                $('.veil').spin(false).hide();
                ShowQuickView(ths);
            }
            if (type === 'prev')
                PrevQuickView(ths);
            if (type === 'next')
                NextQuickView(ths);
            if (type === 'vnext')
                ViemNextQuickView(ths);
            if (type === 'vprev')
                ViemPrevQuickView(ths);
        }
    }, "html");
}
function ShowQuickView(prod)
{
    var ths = prod;
    var txt = ths.text();
    var height = ths.closest('.product').find('.view').outerHeight() + 380;
    var similar = ths.closest('.catalog-area').siblings('.catalog-area').find('.view');
    var similarRow = ths.closest('.slides_container').siblings('.slides_container').find('.view');
    if (similar.is(':visible') || similarRow.is(':visible')) {
        function closeUp() {
            var scrTop = $(window).scrollTop();
            var top = ths.closest('.slides_container').offset().top + height + 30 - $(window).height();
            var viewTop = ths.closest('.slides_container').scrollTop();
            if (txt === BX.message('IGIMA_MODDOS_JS_QUICK_VIEW')) {
                ths.closest('.slides_container').find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_QUICK_VIEW'));
                ths.text(BX.message('IGIMA_MODDOS_JS_CLOSE_VIEW'));
                ths.closest('.slides_container').animate({height: height}, 100);
                ths.closest('.slides_container').find('.view').hide();
                ths.closest('.product').find('.view').show();
                ths.closest('.product').addClass('active').siblings().removeClass('active');
                if (scrTop < top || scrTop > viewTop) {
                    $(scrollTopElement + ':not(:animated)').stop(true, true).animate({scrollTop: top}, 400);
                }
                ;
                ths.closest('.product').find('.poto-full').height(ths.closest('.product').find('.descript').height() - 14);
            } else {
                ths.text(BX.message('IGIMA_MODDOS_JS_QUICK_VIEW'));
                ths.closest('.product').removeClass('active');
                ths.closest('.slides_container').stop(true, true).animate({height: '352px'}, 100, function () {
                    ths.closest('.product').find('.view').hide();
                });
            }
            ;
        }
        ;
        ths.closest('.catalog-area').siblings('.catalog-area').find('.slides_container').stop(true, true).animate({height: '352px'}, 300, function () {
            similar.hide();
            similar.closest('.product').removeClass('active').find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_QUICK_VIEW'));
            closeUp();
        });
        ths.closest('.slides_container').siblings('.slides_container').stop(true, true).animate({height: '352px'}, 300, function () {
            similarRow.hide();
            similarRow.closest('.product').removeClass('active').find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_QUICK_VIEW'));
            ;
            closeUp();
        });
    } else {
        var scrTop = $(window).scrollTop();
        var top = ths.closest('.slides_container').offset().top + height + 30 - $(window).height();
        if (txt === BX.message('IGIMA_MODDOS_JS_QUICK_VIEW')) {
            ths.closest('.slides_container').find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_QUICK_VIEW'));
            ths.text(BX.message('IGIMA_MODDOS_JS_CLOSE_VIEW'));
            ths.closest('.slides_container').stop(true, true).animate({height: height}, 100);
            ths.closest('.slides_container').find('.view').hide();
            ths.closest('.product').find('.view').show();
            ths.closest('.product').addClass('active').siblings().removeClass('active');
            if (scrTop < top) {
                $(scrollTopElement + ':not(:animated)').stop(true, true).animate({scrollTop: top}, 400);
            }
            ;
            ths.closest('.product').find('.poto-full').height(ths.closest('.product').find('.descript').height() - 14);
        } else {
            ths.text(BX.message('IGIMA_MODDOS_JS_QUICK_VIEW'));
            ths.closest('.product').removeClass('active');
            ths.closest('.slides_container').stop(true, true).animate({height: '352px'}, 100, function () {
                ths.closest('.product').find('.view').hide();
            });
            ths.closest('.product').find('.poto-full').height(ths.closest('.product').find('.descript').height() - 14);
        };
    };
}
function NextQuickView(ths)
{
    if (ths.closest('.catalog-area').find('.view').is(':visible')) {
        var active = ths.closest('.catalog-area').find('.product.active');
        if (active.next().length > 0)
            var next = active.next();
        else
            var next = ths.closest('.catalog-area').find('.product').first();
        var hgt = next.find('.view').outerHeight() + 380;
        next.addClass('active').siblings().removeClass('active');
        active.find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_QUICK_VIEW'));
        next.find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_CLOSE_VIEW'));
        ths.closest('.catalog-area').find('.view').hide();
        ths.closest('.catalog-area').find('.slides_container').css({'height': hgt});
        next.find('.view').show();
        next.find('.poto-full').height(next.find('.descript').height() - 14);
        InsBannRotatorNext(ths);
    }
}
function PrevQuickView(ths)
{
    if (ths.closest('.catalog-area').find('.view').is(':visible')) {
        var active = ths.closest('.catalog-area').find('.product.active');
        if (active.prev().length > 0)
            var prev = active.prev();
        else
            var prev = ths.closest('.catalog-area').find('.product').last();
        var hgt = prev.find('.view').outerHeight() + 380;
        prev.addClass('active').siblings().removeClass('active');
        active.find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_QUICK_VIEW'));
        prev.find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_CLOSE_VIEW'));
        ths.closest('.catalog-area').find('.view').hide();
        ths.closest('.catalog-area').find('.slides_container').css({'height': hgt});
        prev.find('.view').show();
        prev.find('.poto-full').height(prev.find('.descript').height() - 14);
        InsBannRotatorPrev(ths);

    }
}
function ViemNextQuickView(ths)
{
    if (ths.closest('.catalog-area').find('.sl-in').length > 0)
    {
        if (ths.closest('.catalog-area').find('.view').is(':visible'))
        {
            var active = ths.closest('.catalog-area').find('.product.active');
            if (active.next().length > 0)
                var next = active.next();
            else
                var next = ths.closest('.catalog-area').find('.product').first();
            var hgt = next.find('.view').outerHeight() + 380;
            next.addClass('active').siblings().removeClass('active');
            active.find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_QUICK_VIEW'));
            next.find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_CLOSE_VIEW'));
            ths.closest('.catalog-area').find('.view').hide();
            ths.closest('.catalog-area').find('.slides_container').css({'height': hgt});
            next.find('.view').show();
            next.find('.poto-full').height(next.find('.descript').height() - 14);
            InsBannRotatorViemNext(ths);
        }
    }
    else
        InsBannRotatorViemNext(ths);
}
function ViemPrevQuickView(ths)
{
    if (ths.closest('.catalog-area').find('.sl-in').length > 0)
    {
        if (ths.closest('.catalog-area').find('.view').is(':visible'))
        {
            var active = ths.closest('.catalog-area').find('.product.active');
            if (active.prev().length > 0)
                var prev = active.prev();
            else
                var prev = ths.closest('.catalog-area').find('.product').last();
            var hgt = prev.find('.view').outerHeight() + 380;
            prev.addClass('active').siblings().removeClass('active');
            active.find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_QUICK_VIEW'));
            prev.find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_CLOSE_VIEW'));
            ths.closest('.catalog-area').find('.view').hide();
            ths.closest('.catalog-area').find('.slides_container').css({'height': hgt});
            prev.find('.view').show();
            prev.find('.poto-full').height(prev.find('.descript').height() - 14);
            InsBannRotatorViemPrev(ths);
        }
    }
    else
        InsBannRotatorViemPrev(ths);
}
function ImageZoomInit(elem, type, move_pos) {
    var main = elem.closest('.view-block');
    var img_med = main.find('.main-img');
    var img_full = main.find('.poto-full');
    var pr_zoom_map = main.find('.product-zoom-map');
    var img_full_w = 0;
    var img_full_h = 0;
    var img_med_w = 0;
    var img_med_h = 0;
    var img_full_img_w = 0;
    var img_full_img_h = 0;
    var pr_zoom_map_w = 0;
    var pr_zoom_map_h = 0;
    var img_med_offsetX = 0;
    var img_med_offsetY = 0;
    var img_med_width_offsetX = 0;
    var img_med_height_offsetY = 0;
    function setSizes() {
        img_full_w = img_full.width();
        img_full_h = img_full.height();
        img_full_img_w = img_full.find('img').width();
        img_full_img_h = img_full.find('img').height();
        img_med_w = img_med.find('img').width();
        img_med_h = img_med.find('img').height();
        if (img_full_img_w < img_full_w)
            pr_zoom_map_w = img_med_w;
        else
            pr_zoom_map_w = parseInt(img_med_w / (img_full_img_w / img_full_w));
        if (img_full_img_h < img_full_h)
            pr_zoom_map_h = img_med_h;
        else
            pr_zoom_map_h = parseInt(img_med_h / (img_full_img_h / img_full_h));
        pr_zoom_map.css({width: pr_zoom_map_w, height: pr_zoom_map_h});
        img_med_offsetX = img_med.find('img').offset().left;
        img_med_offsetY = img_med.find('img').offset().top;
        img_med_width_offsetX = img_med_offsetX + img_med_w - pr_zoom_map_w;
        img_med_height_offsetY = img_med_offsetY + img_med_h - pr_zoom_map_h;

    }
    if (type === 'mouseenter')
    {
        img_full.stop(true, true).fadeIn(300);
        if (img_full_img_w === 0 || img_full_img_h === 0 || img_med_w !== img_med.find('img').width() || img_med_h !== img_med.find('img').height()) {
            setSizes();
        }
        pr_zoom_map.stop(true, true).fadeIn(300);
    }
    if (type === 'mouseleave')
    {
        img_full.stop(true, true).fadeOut(250);
        pr_zoom_map.stop(true, true).fadeOut(200);
    }
    if (type === 'mousemove')
    {
        if (img_full_img_w === 0 || img_full_img_h === 0 || img_med_w !== img_med.find('img').width() || img_med_h !== img_med.find('img').height()) {
            setSizes();
        }
        var zmap_left = move_pos.pageX - pr_zoom_map_w / 2;
        var zmap_top = move_pos.pageY - pr_zoom_map_h / 2;
        if (zmap_left < img_med_offsetX)
            zmap_left = img_med_offsetX;
        else if (zmap_left > img_med_width_offsetX)
            zmap_left = img_med_width_offsetX;
        if (zmap_top < img_med_offsetY)
            zmap_top = img_med_offsetY;
        else if (zmap_top > img_med_height_offsetY)
            zmap_top = img_med_height_offsetY;
        pr_zoom_map.css({top: zmap_top - img_med_offsetY, left: zmap_left - img_med_offsetX});
        img_full.find('img').css({top: 0 - img_full_img_h * (zmap_top - img_med_offsetY) / img_med_h,
            left: 0 - img_full_img_w * (zmap_left - img_med_offsetX) / img_med_w});
    }

}
function InsBannRotatorNext(ths)
{
    var curr = ths.closest('.catalog-area').find('.sl-in');
    var li_first = curr.find('.product:first');
    var li_last = curr.find('.product:last');
    li_first.clone(true).insertAfter(li_last);
    curr.stop(false, true).animate({marginLeft: -li_first.outerWidth(true) + "px"}, 'normal', function () {
        curr.css({marginLeft: 0 + "px"});
        li_first.remove();
        $('.catalog-area').on('click', '.next', NextProd);
        var zoom_r = curr.find('.product:last').find('.view .zoom-right');
        if (zoom_r.find('.poto-full').length) {
            zoom_r.find('.poto-full').height(zoom_r.closest('td').siblings('.descript').height() - 14);
        }
        ;
    });
    return false;
}
;
function InsBannRotatorPrev(ths)
{
    var curr = ths.closest('.catalog-area').find('.sl-in');
    var li_first = curr.find('.product:first');
    var li_last = curr.find('.product:last');
    li_last.clone(true).insertBefore(li_first);
    curr.css({marginLeft: -li_last.outerWidth(true) + "px"});
    curr.stop(false, true).animate({marginLeft: 0 + "px"}, 'normal', function () {
        li_last.remove();
        $('.catalog-area').on('click', '.prev', PrevProd);
        var zoom_r = curr.find('.product:first').find('.view .zoom-right');
        if (zoom_r.find('.poto-full').length) {
            zoom_r.find('.poto-full').height(zoom_r.closest('td').siblings('.descript').height() - 14);
        };
    });
    return false;
};
function InsBannRotatorViemNext(ths)
{
    $('.veil').spin(false).hide();
    var curr = ths.closest('.catalog-area').find('.sl-in');
    if (curr.length > 0)
    {
        var li_first = curr.find('.product:first');
        var li_last = curr.find('.product:last');
        li_first.clone(true).insertAfter(li_last);
        curr.stop(false, true).animate({marginLeft: -li_first.outerWidth(true) + "px"}, 'normal', function ()
        {
            curr.css({marginLeft: 0 + "px"});
            li_first.remove();
            $('.catalog-area').on('click', '.viem-next', ViemNextProd);
            var zoom_r = curr.find('.product:last').find('.view .zoom-right');
            if (zoom_r.find('.poto-full').length) {
                zoom_r.find('.poto-full').height(zoom_r.closest('td').siblings('.descript').height() - 14);
            }
            ;
        });
    }
    else
    {
        var next = ths.closest('.product').next();
        var nextRow = ths.closest('.slides_container').next('.row');
        var hgt = ths.closest('.product').next().find('.view').outerHeight() + 380;
        if (next.length > 0)
        {
            ths.closest('.product').find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_QUICK_VIEW'));
            next.addClass('active').siblings().removeClass('active');
            next.find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_CLOSE_VIEW'));
            ths.closest('.product').find('.view').hide();
            ths.closest('.slides_container').css({'height': hgt});
            next.find('.view').show();
            next.find('.poto-full').height(next.find('.descript').height() - 14);
        }
        else
        {
            nextRow.find('.product').filter(':first').find('.view-btn').click();
        }
        $('.catalog-area').on('click', '.viem-next', ViemNextProd);
    }
    return false;
};
function InsBannRotatorViemPrev(ths)
{
    $('.veil').spin(false).hide();
    var curr = ths.closest('.catalog-area').find('.sl-in');
    if (curr.length > 0)
    {
        var li_first = curr.find('.product:first');
        var li_last = curr.find('.product:last');
        li_last.clone(true).insertBefore(li_first);
        curr.css({marginLeft: -li_last.outerWidth(true) + "px"});
        curr.stop(false, true).animate({marginLeft: 0 + "px"}, 'normal', function () {
            li_last.remove();
            $('.catalog-area').on('click', '.viem-prev', ViemPrevProd);
            var zoom_r = curr.find('.product:first').find('.view .zoom-right');
            if (zoom_r.find('.poto-full').length) {
                zoom_r.find('.poto-full').height(zoom_r.closest('td').siblings('.descript').height() - 14);
            }
            ;
        });
    }
    else
    {
        var prev = ths.closest('.product').prev();
        var prevRow = ths.closest('.slides_container').prev('.row');
        var hgt = ths.closest('.product').prev().find('.view').outerHeight() + 380;
        if (prev.length > 0)
        {
            ths.closest('.product').find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_QUICK_VIEW'));
            prev.addClass('active').siblings().removeClass('active');
            prev.find('.view-btn').text(BX.message('IGIMA_MODDOS_JS_CLOSE_VIEW'));
            ths.closest('.product').find('.view').hide();
            ths.closest('.slides_container').css({'height': hgt});
            prev.find('.view').show();
            prev.find('.poto-full').height(prev.find('.descript').height() - 14);
        }
        else
        {
            prevRow.find('.product').filter(':last').find('.view-btn').click();
        }
        $('.catalog-area').on('click', '.viem-prev', ViemPrevProd);
    }
    return false;
}
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
function AddToCart(e)
{
    var obj = $(this);
    if ($(this).attr('offer-id') > 0 && $(this).attr('prod-id') > 0)
    {
        if ($("div").is(".cart-view"))
        {
            GetVeil(obj.closest('.catalog-area'), 'veil-detail');
            $('#veil-detail').spin('large', '#444');
        }
        else
        {
            GetVeil(obj.closest('.view'), 'veil-quickview-' + obj.closest('.view').siblings('.product-block').find('.view-btn').attr('data-id'));
            $('#veil-quickview-' + obj.closest('.view').siblings('.product-block').find('.view-btn').attr('data-id')).spin('large', '#444');
        }
        var txt = obj.find('.text').html();
        $.post("/bitrix/tools/igima.moddos/ajax/addtocart.php", {'PRODUCT_ID': $(this).attr('offer-id')},
        function (data) {
            if (data)
            {
                var curt_num = $('#bx_cart_num').html();
                if (curt_num === "0")
                {
                    $('#bx_cart_num').removeClass('grey');
                    $('#bx_cart_num').siblings('.ico').removeClass('empty');
                    $('#bx_cart_num').siblings('.grey').removeClass('grey');
                }
                obj.closest('.button-wrap').siblings('.size').find('.sizech').find('a').removeClass('active');
                obj.closest('.descript').find('.inform-button').attr('offer-id', '');
                obj.closest('.descript').find('.add-cart-btn').attr('offer-id', '');
                obj.closest('.descript').find('.add-elected-btn').attr('offer-id', '');
                obj.closest('.descript').find('.waiting').hide();
                obj.closest('.descript').find('.available').hide();
                var cartn = data.split('<span class="numb">');
                var carcnt = cartn[1].split('</span>');
                $('#bx_cart_num').html(carcnt[0]);
                $(".popup-product").html(data);
                obj.find('.text').html(txt);
                $('html').css({'margin-right': scrollbarWidth()});
                $('.fancybox-skin').addClass('fancybox-popup-product').find('.pop-cart').find('a').click();
                $('.button-up').css({'margin-left': 555 - scrollbarWidth() / 2});
                $('.products-viewed').css({'margin-left': -495 - scrollbarWidth() / 2});
                $('.pop-cart > a').closest('li').addClass('active').siblings().removeClass('active');
                $('.pop-cart > a').closest('.popup-product').find('.pop-tab').hide().eq($('.pop-cart > a').closest('li').index()).show();
                $('.pop-cart > a').closest('.popup-product').find('.pop-tab').hide().eq($('.pop-cart > a').closest('li').index()).show();
                $(".popup-product").on("click", ".head li a", function (e) {
                    $(this).closest('li').addClass('active').siblings().removeClass('active');
                    $(this).closest('.popup-product').find('.pop-tab').hide().eq($(this).closest('li').index()).show();
                    e.preventDefault();
                });
                $('header .cart-item>a').click();
            }
            $('.veil').spin(false).hide();
        }, "html");
    }
    else
    {
        var top = -(obj.closest('.button-wrap').find('.hints-right').height() + 24);
        var hints = obj.closest('.button-wrap').find('.hints-right');
        hints.css({'top': top}).toggle();
        setTimeout(function () {
            hints.fadeOut();
        }, 3000);
    }
    e.preventDefault();
}
function AddElected(e)
{
    var obj = $(this);
    if ($(this).attr('offer-id') > 0 && $(this).attr('prod-id') > 0)
    {
        var offerid = $(this).attr('offer-id');
        if ($(this).siblings('.inform-button').css('display') === "block" || $(this).siblings('.inform-button').css('display') === "inline")
        {
            $(this).siblings('.hints-left').html('<span class="hints-arrow"></span>'+BX.message('IGIMA_MODDOS_JS_CHOOSE_PROD'));
            var top = -($(this).closest('.button-wrap').find('.hints-left').height() + 24);
            var hints = $(this).closest('.button-wrap').find('.hints-left');
            hints.css({'top': top}).toggle();
            setTimeout(function () {
                hints.fadeOut();
            }, 3000);
        }
        else
        {
            if ($("div").is(".cart-view"))
            {
                GetVeil(obj.closest('.view'), 'veil-detail');
                $('#veil-detail').spin('large', '#444');
            }
            else
            {
                GetVeil(obj.closest('.view'), 'veil-quickview-' + obj.closest('.view').siblings('.product-block').find('.view-btn').attr('data-id'));
                $('#veil-quickview-' + obj.closest('.view').siblings('.product-block').find('.view-btn').attr('data-id')).spin('large', '#444');
            }
            var txt = obj.find('.text').html();
            $.post("/bitrix/tools/igima.moddos/ajax/addtocart.php", {'FAV_ID': $(this).attr('offer-id')},
            function (data) {
                if (data)
                {
                    var fav_num = $('#bx_fav_num').html();
                    if (fav_num === "0")
                    {
                        $('#bx_fav_num').siblings('.ico').addClass('full');
                    }
                    obj.closest('.button-wrap').siblings('.size').find('.sizech').find('a').removeClass('active');
                    obj.closest('.descript').find('.inform-button').attr('offer-id', '');
                    obj.closest('.descript').find('.add-cart-btn').attr('offer-id', '');
                    obj.closest('.descript').find('.add-elected-btn').attr('offer-id', '');
                    obj.closest('.descript').find('.waiting').hide();
                    obj.closest('.descript').find('.available').hide();
                    $(".tab-elected > .pop-tab-empty").removeClass('disbl');
                    $(".tab-elected").html(data);
                    obj.find('.text').html(txt);
                    $('html').css({'margin-right': scrollbarWidth()});
                    $('.pop-elected > a').closest('li').addClass('active').siblings().removeClass('active');
                    $('.pop-elected > a').closest('.popup-product').find('.pop-tab').hide().eq($('.pop-elected > a').closest('li').index()).show();
                    $(".popup-product .head li a").on("click", function (e) {
                        $(this).closest('li').addClass('active').siblings().removeClass('active');
                        $(this).closest('.popup-product').find('.pop-tab').hide().eq($(this).closest('li').index()).show();
                        e.preventDefault();
                    });
                    $('header .elected-item>a').click();
                    var len = $('.tab-cart .delete').length;
                    $('.tab-cart .delete').each(function () {
                        if ($(this).attr('prod-id') === offerid && len > 1)
                        {
                            $(this).closest('tr').remove();
                            ShowPrice('.tab-cart');
                        }
                        if ($(this).attr('prod-id') === offerid && len === 1)
                        {
                            $(this).closest('table').siblings('.discount-coupon-wrap').hide();
                            $(this).closest('table').siblings('.calculating').hide();
                            $(this).closest('table').siblings('.button-wrpap').hide();
                            $(this).closest('table').siblings('.pop-tab-empty').show();
                            $(this).closest('table').remove();
                        }


                    });
                }
                $('.veil').spin(false).hide();
            });
        }
    }
    else
    {
        $(this).siblings('hints-left').html('<span class="hints-arrow"></span>'+BX.message('IGIMA_MODDOS_JS_CHOOSE_SIZE'));
        var top = -($(this).closest('.button-wrap').find('.hints-left').height() + 24);
        var hints = $(this).closest('.button-wrap').find('.hints-left');
        hints.css({'top': top}).toggle();
        setTimeout(function () {
            hints.fadeOut();
        }, 3000);
    }
    e.preventDefault();
}
function AddInform(e)
{
    var obj = $(this);
    if ($(this).attr('offer-id') > 0 && $(this).attr('prod-id') > 0 && $(this).attr('user-auth') === "Y")
    {
        GetVeil(obj.closest('.view'), 'veil-quickview-' + obj.closest('.view').siblings('.product-block').find('.view-btn').attr('data-id'));
        $('#veil-quickview-' + obj.closest('.view').siblings('.product-block').find('.view-btn').attr('data-id')).spin('large', '#444');
        var txt = obj.html();
        $.post("/bitrix/tools/igima.moddos/ajax/addtocart.php", {'PRODUCT_ID': $(this).attr('offer-id'), 'SUBSCRIBE': 'Y'},
        function (data) {
            if (data)
            {
                obj.closest('.button-wrap').siblings('.size').find('.sizech').find('a').removeClass('active');
                obj.closest('.descript').find('.inform-button').attr('offer-id', '');
                obj.closest('.descript').find('.add-cart-btn').attr('offer-id', '');
                obj.closest('.descript').find('.add-elected-btn').attr('offer-id', '');
                obj.closest('.descript').find('.waiting').hide();
                obj.closest('.descript').find('.available').hide();
                $(".tab-expect-revenues > .pop-tab-empty").removeClass('disbl');
                $(".tab-expect-revenues").html(data);
                obj.html(txt);
                $('html').css({'margin-right': scrollbarWidth()});
                $('.pop-expect-revenues > a').closest('li').addClass('active').siblings().removeClass('active');
                $('.pop-expect-revenues > a').closest('.popup-product').find('.pop-tab').hide().eq($('.pop-expect-revenues > a').closest('li').index()).show();
                $(".popup-product .head li a").on("click", function (e) {
                    $(this).closest('li').addClass('active').siblings().removeClass('active');
                    $(this).closest('.popup-product').find('.pop-tab').hide().eq($(this).closest('li').index()).show();
                    e.preventDefault();
                });
                $('header .sub-item').click();

            }
            $('.veil').spin(false).hide();
        }, "html");
    }
    else
    {
        if (!$(this).attr('offer-id') > 0)
        {
            var top = -(obj.closest('.button-wrap').find('.hints-right').height() + 24);
            var hints = obj.closest('.button-wrap').find('.hints-right');
            hints.css({'top': top}).toggle();
            setTimeout(function () {
                hints.fadeOut();
            }, 3000);
        }
    }
    e.preventDefault();
}
function fixedBlock()
{
    var container = $('.catalog-area');
    if (container.html())
    {
        var containerTop = container.offset().top;
        var containerH = container.height();
        var subT = $('.subscribe-block').offset().top;
        $(window).scroll(function () {
            var doctop = $(document).scrollTop();
            var contSum = parseInt(doctop) + parseInt(containerH) + 50;
            if (doctop > containerTop)
            {
                container.css('position', 'fixed');
                container.css('top', '10px');
            }
            else
            {
                container.css('position', 'relative');
                container.css('top', '0px');
            }
            if (subT <= contSum)
            {
                container.css('position', 'relative');
                container.css('top', '0px');
            }
        });
    }
    clearTimeout(timeoutId);
}
function DetailQuickView()
{
    var prod = $('.catalog-area');
    var ths = $(this);
    var type = 'detail';
    GetVeil($('.outros-produtos'), 'veil-neighbor');
    $('#veil-neighbor').spin('small', '#444');
    GetQuickView(ths.attr('data-id'), prod, type, ths);
    $.post("/bitrix/tools/igima.moddos/ajax/main.php", {'ELEMENT_ID': ths.attr('data-id'), 'SECTION_CODE': $('.outros-produtos').attr('data-sec')},
    function (data) {
        if (data)
        {
            $('.outros-produtos').html(data);
            $('#veil-neighbor').hide();
        }
    });
}
function ViewedRefresh(pid, sid)
{
    var fil = {'PRODUCT_ID': pid, 'SITE_ID': sid, 'VIEWED_REF': "Y"};
    $.post("/bitrix/tools/igima.moddos/ajax/main.php", fil);
}