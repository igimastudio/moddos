$(document).ready(function () {
    if (window.location.hash.length > 0)
    {
        var arr = window.location.hash.split('#');
        pageShow(arr[1]);
    }

    $(document).keyup(function (e) {
        if (e.keyCode === 27) {
            $('.pagination-wrap .sorty-block ul').slideUp('normal');
        }
    });

    $(document).click(function (event) {
        if ($(event.target).closest('.sorty-block').length)
            return;
        $('.pagination-wrap .sorty-block ul').slideUp('normal');
        event.stopPropagation();
    });
    $('.catalog-area').on("click", ".sorty-block .text", function (e) {
        $(this).closest('.sorty').find('ul').slideToggle('normal');
        e.preventDefault();
    });
    $('.catalog-area').on("click", ".sorty-block .ico", function (e) {
        if ($(this).hasClass('sorty-reset'))
        {
            $('.sorty').find('.text').text(BX.message('IGIMA_MODDOS_JS_CATALOG_SORT_CHOOSE'));
            $('.sorty-block .ico').removeClass('sorty-reset');
            $(this).closest('.sorty').find('ul').slideUp('normal');
            $('.sorty-block').attr('data-sort', '');
            items = findFilter();
            items['CATALOG_SORT'] = "";
            var arr = $('.look-all').attr('href').split('#');
            if (arr[1] !== 'showall')
                items['SHOWALL_1'] = 1;
            else
            {
                var page = arr[1].split('page');
                items['PAGEN_1'] = page[1];
                items['SHOWALL_1'] = 0;
            }
            items['SECTION_CODE'] = $(this).closest('.sorty-block').attr('data-sec');
            items['FILTER_DISCOUNT'] = $('#show-discount-prod').attr('data-val');
            items['FILTER_NOVELTY'] = $('#show-novelty-prod').attr('data-val');
            items['FILTER_NOVELTY_COUNT'] = $('#show-novelty-prod-count').attr('data-val');
            $.post("/bitrix/tools/igima.moddos/ajax/showcase.php", items,
                    function (data) {
                        if (data)
                        {
                            $('#veil-showcase').hide();
                            $('.catalog-area').html(data);
                        }
                    }, "html");
        }
        else
        {
            $(this).closest('.sorty').find('ul').slideToggle('normal');
        }
        ;
        e.preventDefault();
    });
    $('.catalog-area').on("click", ".sorty-block ul a", function (e)
    {
        $('.sorty').find('.text').text($(this).text());
        $('.sorty').find('.ico').addClass('sorty-reset');
        $(this).closest('.sorty').find('ul').slideUp('normal');
        $('.sorty-block').attr('data-sort', $(this).attr('data-id'));
        items = findFilter();
        var arr = $('.look-all').attr('href').split('#');
        if (arr[1] !== 'showall')
            items['SHOWALL_1'] = 1;
        else
        {
            var page = arr[1].split('page');
            items['PAGEN_1'] = page[1];
            items['SHOWALL_1'] = 0;
        }
        items['CATALOG_SORT'] = $(this).attr('data-id');
        items['SECTION_CODE'] = $(this).closest('.sorty-block').attr('data-sec');
        items['FILTER_DISCOUNT'] = $('#show-discount-prod').attr('data-val');
        items['FILTER_NOVELTY'] = $('#show-novelty-prod').attr('data-val');
        items['FILTER_NOVELTY_COUNT'] = $('#show-novelty-prod-count').attr('data-val');
        $.post("/bitrix/tools/igima.moddos/ajax/showcase.php", items,
                function (data) {
                    if (data)
                    {
                        $('#veil-showcase').hide();
                        $('.catalog-area').html(data);
                    }
                }, "html");
        e.preventDefault();
    });
    $('.catalog-area').on("click", ".pagination a, .pagination-button a", function (e) {
        var arr = $(this).attr('href').split('#');
        pageShow(arr[1]);
        e.preventDefault();
    });
});
function findFilter()
{
    var min = $(".filter-catalogue #amount-min").val();
    var max = $(".filter-catalogue #amount-max").val();
    var minfid = $('.amount-min').attr('data-fid');
    var maxfid = $('.amount-max').attr('data-fid');
    var act = $('#slider-range').attr('data-act');
    var items = {};
    GetVeil($('.catalog-area'), 'veil-showcase');
    $('#veil-showcase').spin('large', '#444');
    if (act === "Y")
    {
        items[minfid] = min;
        items[maxfid] = max;
    }
    $(".filter-catalogue label.checkbox").each(function () {
        if ($(this).hasClass('checked'))
            items[$(this).closest('.checkbox').attr('data-fid')] = "Y";
    });
    items['SECTION_CODE'] = $('.filter-catalogue').attr('data-sec');
    items['set_filter'] = "Y";
    return items;
}
function pageShow(arr)
{
    items = findFilter();
    if (arr !== 'showall')
    {
        var page = arr.split('page');
        items['PAGEN_1'] = page[1];
        items['SHOWALL_1'] = 0;
    }
    else
        items['SHOWALL_1'] = 1;
    items['CATALOG_SORT'] = $('.sorty-block').attr('data-sort');
    items['AJAX_QUERY'] = "N";
    items['FILTER_DISCOUNT'] = $('#show-discount-prod').attr('data-val');
    items['FILTER_NOVELTY'] = $('#show-novelty-prod').attr('data-val');
    items['FILTER_NOVELTY_COUNT'] = $('#show-novelty-prod-count').attr('data-val');
    $.post("/bitrix/tools/igima.moddos/ajax/showcase.php", items,
            function (data) {
                if (data)
                {
                    $('#veil-showcase').hide();
                    $('.catalog-area').html(data);
                    $('.button-up').click();
                }
            }, "html");
}