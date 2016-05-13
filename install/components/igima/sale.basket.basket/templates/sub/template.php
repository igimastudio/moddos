<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
$stmp = AddToTimeStamp(array("DD" => -30));
$subcnt = count($arResult["ITEMS"]["ProdSubscribe"]);
?>
<script>
    $('.pop-expect-revenues > a > .numb').html('<?=$subcnt?>');
</script>
<?if ($subcnt):?>
    <table>
        <thead>
            <tr>
                <th><?=GetMessage("IGIMA_MODDOS_SALE_NAME")?></th>
                <th class="price"><?=GetMessage("IGIMA_MODDOS_SALE_PRICE")?></th>
                <th class="status"><?=GetMessage("IGIMA_MODDOS_SALE_STATUS")?></th>
            </tr>
        </thead>
        <tbody>
            <?foreach ($arResult["ITEMS"]["ProdSubscribe"] as $cts => $arSub):?>
                <tr>
                    <td>
                        <a href="#" class="photo"><?if ($arSub["DATE_ACTIVE_FROM"] > date("d.m.Y H:i:s",$stmp)):?><span class="new-product"><?=GetMessage("IGIMA_MODDOS_NOVEL")?></span><?endif;?><?if (!empty($arSub["DISCOUNT_PRICE_PERCENT"])):?><span class="discount">-<?=$arSub["DISCOUNT_PRICE_PERCENT_FORMATED"]?></span><?endif;?><?if (!empty($arSub["PREVIEW_PICTURE"])):?><img src="<?=CFile::GetPath($arSub["PREVIEW_PICTURE"]);?>" alt="" /><?endif;?></a>
                        <div class="pop-product-data">
                            <p class="prod-title"><a href="<?=$arSub["DETAIL_PAGE_URL"]?>"><?=$arSub["NAME"]?></a></p>
                            <p class="brand"><?=GetMessage("IGIMA_MODDOS_BRAND")?>: <?=$arSub["PROPERTY_BRAND_NAME"]?></p>
                            <?if ($arSub["PROPERTY_SIZE_VALUE"]):?><p><?=GetMessage("IGIMA_MODDOS_SIZE")?>: <?=$arSub["PROPERTY_SIZE_VALUE"]?></p><?endif;?>
                            <div class="pop-list-colors">
                                <span class="list-title"><?=GetMessage("IGIMA_MODDOS_COLOR")?>:</span>
                                <span class="pop-colors"><span style="background: <?=$arSub["PROPERTY_COLOR_VALUE"]?>"></span></span>
                            </div>
                        </div> <!-- end pop-product-data -->
                        <div class="clear"></div>
                        <div class="bottom-wrap">
                            <a href="#" class="delete" offer-id="<?=$arSub["ID"]?>"><?=GetMessage("IGIMA_MODDOS_DELETE")?></a>
                        </div> <!-- end bottom-wrap -->
                    </td>
                    <td class="price">
                        <?if ($arSub["DISCOUNT_PRICE_PERCENT"]):?>
                            <span class="new-price"><?=$arSub["PRICE_FORMATED"]?> <span class="rur">i</span></span><br />
                            <span class="price-old">
                                <span class="erase">
                                    <span><?=$arSub["FULL_PRICE_FORMATED"]?></span>
                                </span>
                                <span class="rur">i</span>
                            </span>
                        <?else:?>
                            <?=$arSub["PRICE_FORMATED"]?> <span class="rur">i</span>
                        <?endif;?>
                    </td>
                    <?if ($arSub["CAN_BUY"] == "Y"):?>
                        <td class="status">
                            <?=GetMessage("IGIMA_MODDOS_PROD_AVAIL")?>
                            <a href="#" class="button-green send-to-cart" offer-id="<?=$arSub["ID"]?>"><?=GetMessage("IGIMA_MODDOS_SEND_TO_CART")?></a>
                        </td>
                    <?else:?>
                        <td class="status not-available"><?=GetMessage("IGIMA_MODDOS_PROD_NOT_AVAIL")?></td>
                    <?endif;?>
                </tr>
            <?endforeach;?>
        </tbody>
    </table>
    <a href="#" class="continue-btn"><span class="continue-brd"><i></i><?=GetMessage("IGIMA_MODDOS_GO_TO_CAT")?></span></a>
    <div class="clear"></div>
<?endif;?>
<div class="pop-tab-empty<?if (!$subcnt):?> disbl<?endif;?>">
    <p class="pop-text"><?=GetMessage("IGIMA_MODDOS_NO_SUB")?></p>
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