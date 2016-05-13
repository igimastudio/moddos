<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
$stmp = AddToTimeStamp(array("DD" => -30));
$favcnt = count($arResult["ITEMS"]["DelDelCanBuy"]);
$cartcnt = count($arResult["ITEMS"]["AnDelCanBuy"]);
?>

<script>
    $('#bx_cart_num').html('<?=$cartcnt?>');
    $('.pop-cart > a > .numb').html('<?=$cartcnt?>');
    $('#bx_fav_num').html('<?=$favcnt?>');
    $('.pop-elected > a > .numb').html('<?=$favcnt?>');
</script>
<?if ($favcnt):?>
    <table>
        <thead>
            <tr>
                <th><?=GetMessage("IGIMA_MODDOS_SALE_NAME")?></th>
                <th class="price"><?=GetMessage("IGIMA_MODDOS_SALE_PRICE")?></th>
                <th class="status"><?=GetMessage("IGIMA_MODDOS_SALE_STATUS")?></th>
            </tr>
        </thead>
        <tbody>
            <?foreach ($arResult["ITEMS"]["DelDelCanBuy"] as $ctd => $arDel):?>
                <tr>
                    <td>
                        <a href="#" class="photo"><?if ($arDel["DATE_ACTIVE_FROM"] > date("d.m.Y H:i:s",$stmp)):?><span class="new-product"><?=GetMessage("IGIMA_MODDOS_NOVEL")?></span><?endif;?><?if (!empty($arDel["DISCOUNT_PRICE_PERCENT"])):?><span class="discount">-<?=$arDel["DISCOUNT_PRICE_PERCENT_FORMATED"]?></span><?endif;?><?if (!empty($arDel["PREVIEW_PICTURE"])):?><img src="<?=CFile::GetPath($arDel["PREVIEW_PICTURE"]);?>" alt="" /><?endif;?></a>
                        <div class="pop-product-data">
                            <p class="prod-title"><a href="<?=$arDel["DETAIL_PAGE_URL"]?>"><?=$arDel["NAME"]?></a></p>
                            <p class="brand"><?=GetMessage("IGIMA_MODDOS_BRAND")?>: <?=$arDel["PROPERTY_BRAND_NAME"]?></p>
                            <?if ($arDel["PROPERTY_SIZE_VALUE"]):?><p><?=GetMessage("IGIMA_MODDOS_SIZE")?>: <?=$arDel["PROPERTY_SIZE_VALUE"]?></p><?endif;?>
                            <div class="pop-list-colors">
                                <span class="list-title"><?=GetMessage("IGIMA_MODDOS_COLOR")?>:</span>
                                <span class="pop-colors"><span style="background: <?=$arDel["PROPERTY_COLOR_VALUE"]?>"></span></span>
                            </div>
                        </div> <!-- end pop-product-data -->
                        <div class="clear"></div>
                        <div class="bottom-wrap">
                            <a href="#" class="delete" offer-id="<?=$arDel["ID"]?>" prod-id="<?=$arDel["PRODUCT_ID"]?>"><?=GetMessage("IGIMA_MODDOS_DELETE")?></a>
                        </div> <!-- end bottom-wrap -->
                    </td>
                    <td class="price">
                        <?if ($arDel["DISCOUNT_PRICE_PERCENT"]):?>
                            <span class="new-price"><?=$arDel["PRICE_FORMATED"]?> <span class="rur">i</span></span><br />
                            <span class="price-old">
                                <span class="erase">
                                    <span><?=$arDel["FULL_PRICE_FORMATED"]?></span>
                                </span>
                                <span class="rur">i</span>
                            </span>
                        <?else:?>
                            <?=$arDel["PRICE_FORMATED"]?> <span class="rur">i</span>
                        <?endif;?>
                    </td>
                    <td class="status"> <a href="#" class="button-green send-to-cart" offer-id="<?=$arDel["ID"]?>"><?=GetMessage("IGIMA_MODDOS_SEND_TO_CART")?></a> </td>
                </tr>
            <?endforeach;?>
        </tbody>
    </table>
    <a href="#" class="continue-btn"><span class="continue-brd"><i></i><?=GetMessage("IGIMA_MODDOS_GO_TO_CAT")?></span></a>
    <div class="clear"></div>
<?endif;?>
<div class="pop-tab-empty<?if (!$favcnt):?> disbl<?endif;?>">
    <p class="pop-text"><?=GetMessage("IGIMA_MODDOS_NO_FAVORITE")?></p>
    <p><?=GetMessage('IGIMA_MODDOS_GO_TO_CATALOG')?></p>
    <?
    $APPLICATION->IncludeComponent("bitrix:catalog.section.list","main",array(
        "IBLOCK_TYPE" => "mds",
        "IBLOCK_ID" => "1",
        "SECTION_ID" => "",
        "SECTION_CODE" => "",
        "COUNT_ELEMENTS" => "N",
        "TOP_DEPTH" => "1",
        "SECTION_FIELDS" => array(
            0 => "PICTURE",
            1 => "",
        ),
        "SECTION_USER_FIELDS" => array(
            0 => "",
        ),
        "SECTION_URL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "ADD_SECTIONS_CHAIN" => "N"
            ),false
    );
    ?>
    <div class="clear"></div>
</div> <!-- end  pop-tab-empty-->