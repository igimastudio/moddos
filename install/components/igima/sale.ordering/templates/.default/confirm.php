<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
if (!empty($arResult["ORDER"]))
{
    if (count($arResult["PAY_SYSTEM"]["LOGOTIP"]) > 0)
        $pimgUrl = $arResult["PAY_SYSTEM"]["LOGOTIP"]["SRC"];
    else
        $pimgUrl = $templateFolder."/images/logo-default-ps.gif";
    if (is_array($arResult["DELIVERY"]["LOGOTIP"]))
        $dimgUrl = $arResult["DELIVERY"]["LOGOTIP"]["SRC"];
    else
    {
        if ($arResult["DELIVERY"]["LOGOTIP"] > 0)
            $dimgUrl = CFile::GetPath($arResult["DELIVERY"]["LOGOTIP"]);
        else
            $dimgUrl = $templateFolder."/images/logo-default-ps.gif";
    }
    ?>
    <div class="cofirmation-banner">
        <?
        $APPLICATION->IncludeComponent(
                "bitrix:main.include","",Array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => "".SITE_TEMPLATE_PATH."/include_areas/ordering-banner.php",
            "EDIT_TEMPLATE" => "standard.php"
                ),false
        );
        ?>
    </div> <!-- end cofirmation-banner -->
    <div class="message-confirmation">
        <h5><?=GetMessage("SOA_TEMPL_ORDER_COMPLETE")?></h5>
        <p><?=GetMessage("SOA_TEMPL_ORDER_SUC")?></p>
        <div class="order">
            <div class="title-order">
                <div class="order-number"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_ORDER_NUMBER")?> <?=$arResult["ORDER"]["ACCOUNT_NUMBER"]?></div>
                <div class="order-date"><?=$arResult["ORDER"]["DATE_INSERT"]?></div>
            </div>
            <div class="black-line"></div>
            <table>
                <tr>
                    <th><span class="status-option"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_ORDER_STATUS")?></span></th>
                    <th class="deliv-tabl"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_DELIVERY_NOP")?></th>
                    <th class="pay-tabl"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_PAYMENT")?></th>
                    <th class="summ-tabl"><span class="sunn-table-title"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_SUMM")?></span></th>
                </tr>
                <tr>
                    <td class="order-status"><span class="status-option"><?=$arResult["ORDER"]["STATUS_NAME"]?></span></td>
                    <td><span class="deliv" style='background: url(<?=$dimgUrl?>) no-repeat 0 -39px;'></span></td>
                    <td><span class="paysys" style='background: url(<?=$pimgUrl?>) no-repeat 0 -39px;'></span></td>
                    <td class="cost-order"><?=$arResult["ORDER"]["PRICE_FORMATED"]?><span class="rur">i</span></td>
                </tr>
            </table>
            <div class="order-composition">
                <a href="#" class="composition-title"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_COMP")?></a>
                <div class="order-full">
                    <?foreach ($arResult["BASKET_ITEMS"] as $cnt => $arItems):?>
                        <div class="item">
                            <a href="<?=$arItems["DETAIL_PAGE_URL"]?>" class="image">
                                <img src="<?=$arItems["DETAIL_PICTURE_SRC"]?>" alt="">
                                <?if (!empty($arItems["DISCOUNT_PRICE_PERCENT"])):?>
                                    <div class="discount-item">
                                        -<?=$arItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?>
                                    </div>
                                <?endif;?>
                            </a>
                            <div class="item-info">
                                <p><a href="<?=$arItems["DETAIL_PAGE_URL"]?>" class="bl-color title-item"><?=$arItems["NAME"]?></a></p>
                                <p><?=GetMessage("IGIMA_MODDOS_BREND")?><span class="bl-color"><?=$arItems["PROPERTY_BRAND_NAME"]?></span></p>
                                <p><?=GetMessage("IGIMA_MODDOS_RAZMER")?><span class="bl-color"><?=$arItems["PROPERTY_SIZE_NAME"]?></span></p>
                                <span class="color-line">
                                    <p><?=GetMessage("IGIMA_MODDOS_CVET")?></p>
                                    <span class="color">
                                        <span style='background-color: <?=$arItems["PROPERTY_COLOR_COLCODE"]?>'></span>
                                    </span>
                                </span> <!-- end color-line -->
                                <p class="number-item"><?=GetMessage("IGIMA_MODDOS_KOL_VO")?><span class="bl-color"><?=$arItems["QUANTITY"]?></span></p>
                                <div class="cost-info">
                                    <?if ($arItems["DISCOUNT_PRICE_PERCENT"] > 0):?>
                                        <span class="new-cost">
                                            <?=$arItems["SUM"]?><span class="rur">i</span>
                                        </span>
                                        <span class="old-cost">
                                            <?=SaleFormatCurrency(($arItems["PRICE"] * $arItems["QUANTITY"]) + ($arItems["DISCOUNT_PRICE"] * $arItems["QUANTITY"]),$arItems["CURRENCY"]);?><span class="rur">i</span>
                                            <span class="cost-line"></span>
                                        </span>
                                    <?else:?>
                                        <span class="old-cost">
                                            <?=$arItems["SUM"]?><span class="rur">i</span>
                                        </span>
                                    <?endif;?>
                                </div> <!-- end cost-info -->
                            </div> <!-- end item-info -->
                            <?if (count($arResult["BASKET_ITEMS"]) > $cnt + 1):?><div class="item-line"></div><?endif;?>
                        </div>
                    <?endforeach?>
                </div> <!-- end order-full -->
                <div class="grey-line"></div>
                <div class="order-information">
                    <p><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_INFO")?></p>
                    <?if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0):?>
                        <?
                        $act = explode("/",$arResult["PAY_SYSTEM"]["ACTION_FILE"]);
                        ?>
                        <?if (in_array("sberbank_new",$act) || in_array("sberbank",$act)):?>
                            <a target="_blank" href="<?=$arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));?>" class="print-pay-info"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_PRINT")?></a>
                        <?else:?>
                            <a target="_blank" href="<?=$arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));?>" class="pay-order-info"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_PAY")?></a>
                        <?endif;?>
                    <?endif;?>
                </div>
            </div> <!-- end order-composition -->
        </div> <!-- end order -->
    </div> <!-- end message-confirmation -->
    <div class="clear"></div>
    <div class="catalog-area">
        <div class="catalog-rotator-main catalog-rotator catalog-rotator-discount">
            <?
            $APPLICATION->IncludeComponent("igima:catalog.top","new",array(
                "IBLOCK_TYPE" => "mds",
                "IBLOCK_ID" => "1",
                "SECTION_ID" => "",
                "SECTION_CODE" => "",
                "SECTION_USER_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "ELEMENT_SORT_FIELD" => "rand",
                "ELEMENT_SORT_ORDER" => "asc",
                "ELEMENT_SORT_FIELD2" => "id",
                "ELEMENT_SORT_ORDER2" => "desc",
                "FILTER_NAME" => "arrFilters",
                "INCLUDE_SUBSECTIONS" => "Y",
                "SHOW_ALL_WO_SECTION" => "Y",
                "HIDE_NOT_AVAILABLE" => "N",
                "PAGE_ELEMENT_COUNT" => "10",
                "LINE_ELEMENT_COUNT" => "10",
                "PROPERTY_CODE" => array(
                    0 => "ART",
                    1 => "BRAND",
                    2 => "COMPOSIT",
                    3 => "COUNTRY",
                    4 => "COLOR",
                    5 => "",
                ),
                "OFFERS_FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "OFFERS_PROPERTY_CODE" => array(
                    0 => "SIZE",
                    1 => "",
                ),
                "OFFERS_SORT_FIELD" => "sort",
                "OFFERS_SORT_ORDER" => "asc",
                "OFFERS_SORT_FIELD2" => "id",
                "OFFERS_SORT_ORDER2" => "desc",
                "OFFERS_LIMIT" => "5",
                "PRODUCT_DISPLAY_MODE" => "Y",
                "ADD_PICT_PROP" => "-",
                "LABEL_PROP" => "-",
                "OFFER_ADD_PICT_PROP" => "-",
                "OFFER_TREE_PROPS" => array(
                    0 => "SIZE",
                    1 => "",
                ),
                "PRODUCT_SUBSCRIPTION" => "N",
                "SHOW_DISCOUNT_PERCENT" => "Y",
                "SHOW_OLD_PRICE" => "Y",
                "MESS_BTN_BUY" => GetMessage("IGIMA_MODDOS_KUPITQ"),
                "MESS_BTN_ADD_TO_BASKET" => GetMessage("IGIMA_MODDOS_V_KORZINU"),
                "MESS_BTN_SUBSCRIBE" => GetMessage("IGIMA_MODDOS_PODPISATQSA"),
                "MESS_BTN_DETAIL" => GetMessage("IGIMA_MODDOS_PODROBNEE"),
                "MESS_NOT_AVAILABLE" => GetMessage("IGIMA_MODDOS_NET_V_NALICII"),
                "SECTION_URL" => "",
                "DETAIL_URL" => "",
                "BASKET_URL" => "/personal/basket.php",
                "ACTION_VARIABLE" => "action",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_GROUPS" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "META_KEYWORDS" => "-",
                "SET_META_DESCRIPTION" => "Y",
                "META_DESCRIPTION" => "-",
                "BROWSER_TITLE" => "-",
                "ADD_SECTIONS_CHAIN" => "N",
                "DISPLAY_COMPARE" => "N",
                "SET_TITLE" => "N",
                "SET_STATUS_404" => "N",
                "CACHE_FILTER" => "N",
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
                "USE_PRICE_COUNT" => "N",
                "SHOW_PRICE_COUNT" => "1",
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_PROPERTIES" => array(
                ),
                "USE_PRODUCT_QUANTITY" => "N",
                "CONVERT_CURRENCY" => "N",
                "OFFERS_CART_PROPERTIES" => array(
                    0 => "SIZE",
                ),
                "FILTER_NOVELTY" => "N",
                "FILTER_NOVELTY_COUNT" => "30",
                "FILTER_DISCOUNT" => "Y",
                "PAGER_TEMPLATE" => ".default",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => GetMessage("IGIMA_MODDOS_TOVARY"),
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "SHOW_ADV_BLOCK" => "Y",
                "AJAX_OPTION_ADDITIONAL" => ""
                    ),false
            );
            ?> 
        </div>
    </div>
    <?
}
else
{
    ?>
    <div class="step confirm-data">
        <div class="head main-head"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CONFIRM")?></div>
        <div class="confirm-info">
            <p><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CONFIRM_INFO")?></p>
            <label>
                <span class="comment"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_COMMENT")?></span>
                <textarea cols="30" rows="10" name='ORDER_DESCRIPTION'></textarea>
            </label>
            <?if (!IgimaTools :: GetUserSubs($USER->GetEmail())):?>
                <label class="sent-news checked">
                    <span class="styly-check"></span>
                    <input type="checkbox" name="" value=""  checked="checked"/>
                    <?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_SUBS")?>
                </label>
            <?endif;?>
            <div class="clear"></div>
            <a href="#" class="button-red"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_OK")?></a>
            <div class="clear"></div>
        </div> <!-- end confirm-info -->
    </div> <!-- end step confirm-data -->
    <?
}
?>
