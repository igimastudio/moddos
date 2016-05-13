<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
$stmp = AddToTimeStamp(array("DD" => -30));
$cartcnt = count($arResult["ITEMS"]["AnDelCanBuy"]);
$favcnt = count($arResult["ITEMS"]["DelDelCanBuy"]);
$subcnt = count($arResult["ITEMS"]["ProdSubscribe"]);
?>
<script>
    $('#bx_cart_num').html('<?=$cartcnt?>');
    $('.pop-cart > a > .numb').html('<?=$cartcnt?>');
    $('#bx_fav_num').html('<?=$favcnt?>');
    $('.pop-elected > a > .numb').html('<?=$favcnt?>');
    $('.pop-expect-revenues > a > .numb').html('<?=$subcnt?>');
</script>
<table>
    <thead>
        <tr>
            <th><?=GetMessage("IGIMA_MODDOS_SALE_NAME")?></th>
            <th class="number"><?=GetMessage("IGIMA_MODDOS_SALE_QUANTITY")?></th>
            <th class="price"><?=GetMessage("IGIMA_MODDOS_SALE_PRICE")?></th>
        </tr>
    </thead>
    <tbody>
        <?foreach ($arResult["ITEMS"]["AnDelCanBuy"] as $ctc => $arCart):?>
            <tr>
                <td class="prim">
                    <a href="#" class="photo"><?if ($arCart["DATE_ACTIVE_FROM"] > date("d.m.Y H:i:s",$stmp)):?><span class="new-product"><?=GetMessage("IGIMA_MODDOS_NOVEL")?></span><?endif;?><?if (!empty($arCart["DISCOUNT_PRICE_PERCENT"])):?><span class="discount">-<?=$arCart["DISCOUNT_PRICE_PERCENT_FORMATED"]?></span><?endif;?><?if (!empty($arCart["PREVIEW_PICTURE"])):?><img src="<?=CFile::GetPath($arCart["PREVIEW_PICTURE"]);?>" alt="" /><?endif;?></a>
                    <div class="pop-product-data">
                        <p class="prod-title"><a href="<?=$arCart["DETAIL_PAGE_URL"]?>"><?=$arCart["NAME"]?></a></p>
                        <p class="brand"><?=GetMessage("IGIMA_MODDOS_BRAND")?>: <?=$arCart["PROPERTY_BRAND_NAME"]?></p>
                        <?if ($arCart["PROPERTY_SIZE_VALUE"]):?><p><?=GetMessage("IGIMA_MODDOS_SIZE")?>: <?=$arCart["PROPERTY_SIZE_VALUE"]?></p><?endif;?>
                        <div class="pop-list-colors">
                            <span class="list-title"><?=GetMessage("IGIMA_MODDOS_COLOR")?>:</span>
                            <span class="pop-colors"><span style="background: <?=$arCart["PROPERTY_COLOR_VALUE"]?>"></span></span>
                        </div>
                    </div> <!-- end pop-product-data -->
                    <div class="clear"></div>
                    <div class="bottom-wrap">
                        <div class="to-favorites"><a href="#" offer-id="<?=$arCart["ID"]?>"><?=GetMessage("IGIMA_MODDOS_TO_FAVORITE")?></a></div><a href="#" class="delete" offer-id="<?=$arCart["ID"]?>" prod-id="<?=$arCart["PRODUCT_ID"]?>"><?=GetMessage("IGIMA_MODDOS_DELETE")?></a>
                    </div> <!-- end bottom-wrap -->
                </td>
                <td class="number">
                    <div class="inp-count" offer-id="<?=$arCart["ID"]?>">
                        <a class="minus" title="minus" href="#"></a>
                        <input class="count" type="text" value="<?=$arCart["QUANTITY"]?>" name="">
                        <a class="plus" title="plus" href="#"></a>
                    </div> <!-- end inp-count -->
                </td>
                <td class="price" data-price="<?=$arCart["PRICE"]?>" data-disc="<?=$arCart["DISCOUNT_PRICE"]?>">
                    <?if ($arCart["DISCOUNT_PRICE_PERCENT"]):?>
                        <span class="new-price"></span><br />
                        <span class="price-old">
                            <span class="erase">
                                <span></span>
                            </span>
                            <span class="rur">i</span>
                        </span>
                    <?else:?>

                    <?endif;?>
                </td>
            </tr>
        <?endforeach;?>
    </tbody>
</table>