<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?if (strlen($arParams["ELEMENT_CODE"]) > 0 || strlen($arParams["ELEMENT_ID"]) > 0):?>
    <div class="view cart-view">
        <div class="view-block">
        <?endif;?>
        <?
        foreach ($arResult['ITEMS'] as $key => $arItem):
            ?>
            <table>
                <tr>
                    <td class="image-block">
                        <div class="zoom-block">
                            <?if (!empty($arItem["PROPERTIES"]["ADDIMG"]["VALUE"])):?>
                                <div class="zoom-left">
                                    <?if (!empty($arItem["PREVIEW_PICTURE"]["SRC"])):?>
                                        <a href="#" class="active"><i></i>
                                            <span>
                                                <img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="" />
                                            </span>
                                        </a>
                                    <?endif;?>
                                    <?foreach ($arItem["PROPERTIES"]["ADDIMG"]["VALUE"] as $dopPhoto):?>
                                        <?$srcPhoto = CFile::GetPath($dopPhoto);?>
                                        <a href="#"><i></i>
                                            <span>
                                                <img src="<?=$srcPhoto?>" alt="" />
                                            </span>
                                        </a>
                                    <?endforeach;?>
                                </div> <!-- end zoom-left -->
                            <?endif;?>
                            <div class="zoom-right">
                                <div class="main-img">
                                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" />
                                    <div class="product-zoom-map"></div>
                                </div>
                                <?if ($arItem["NOVELTY"] == "Y"):?>
                                    <span class="new"><?=GetMessage('IGIMA_MODDOS_NOVELTY');?></span>
                                <?endif;?>
                                <?if (!empty($arItem["PRICES"][$arParams["PRICE_CODE"][0]]["DISCOUNT_DIFF_PERCENT"])):?>
                                    <span class="discount">-<?=$arItem["PRICES"][$arParams["PRICE_CODE"][0]]["DISCOUNT_DIFF_PERCENT"]?>%</span>
                                <?endif;?>
                                <div class="poto-full">
                                    <div>
                                        <img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="" />
                                    </div>
                                </div>
                            </div> <!-- end  zoom-right-->
                            <div class="clear"></div>
                        </div> <!-- end zoom-block -->
                        <div class="share">
                            <span class="text"><?=GetMessage('IGIMA_MODDOS_QUICK_LIKE');?>:</span>
                            <div class="social" data-url="<?=SITE_SERVER_NAME?><?=$arItem["DETAIL_PAGE_URL"]?>">
                                <a class="vk" data-id="vk" href="#"></a>
                                <a class="facebook" href="#" data-id="fb"></a>
                                <a class="twitter" href="#" data-id="tw"></a>
                                <a class="google" href="#" data-id="gp"></a>
                                <a class="od" data-id="ok" href="#"></a>
                                <a class="mail" data-id="mr" href="#"></a>
                            </div>
                            <div class="clear"></div>
                        </div> <!-- end share -->
                    </td>
                    <td class="descript">
                        <?if ($GLOBALS['NOT_LINK_HEADER'] != "Y"):?>
                            <h2><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem["NAME"]?></a></h2>
                        <?else:?>
                            <h1><?=$arItem["NAME"]?></h1>
                        <?endif;?>
                        <div class="data">
                            <div class="data-left">
                                <?foreach ($arItem["DISPLAY_PROPERTIES"] as $pcod => $arProp):?>
                                    <?if ($pcod != "COLOR"):?>
                                        <?if ($pcod == "BRAND"):?>
                                            <p class="line">
                                                <span class="data-name"><?=$arProp["NAME"]?>:</span>
                                                <?if (strlen($arProp["UF_LINK"]) > 0):?>
                                                    <a href="<?=$arProp["UF_LINK"]?>"><?=$arProp["DISPLAY_VALUE"]?></a>
                                                <?else:?>
                                                    <span class="data-text"><?=$arProp["DISPLAY_VALUE"]?></span>
                                                <?endif;?>
                                            </p>
                                        <?else:?>
                                            <p class="line">
                                                <span class="data-name"><?=$arProp["NAME"]?>:</span>
                                                <span class="data-text"><?=$arProp["DISPLAY_VALUE"]?></span>
                                            </p>
                                        <?endif;?>
                                    <?endif;?>
                                <?endforeach;?>
                            </div> <!-- end data-left -->
                            <?if ($arItem["PRICES"][$arParams["PRICE_CODE"][0]]["DISCOUNT_DIFF_PERCENT"] > 0):?>
                                <div class="data-price data-price-old">
                                    <?=$arItem["PRICES"][$arParams["PRICE_CODE"][0]]["PRINT_DISCOUNT_VALUE"]?><span class="rur">i</span>
                                    <span class="price-old">
                                        <span class="erase">
                                            <span><?=$arItem["PRICES"][$arParams["PRICE_CODE"][0]]["PRINT_VALUE"]?></span>
                                        </span>
                                        <span class="rur">i</span>
                                    </span>
                                </div>
                            <?else:?>
                                <div class="data-price"><?=$arItem["PRICES"][$arParams["PRICE_CODE"][0]]["PRINT_VALUE"]?>
                                    <span class="rur">i</span>
                                </div>
                            <?endif;?>
                            <div class="clear"></div>
                        </div> <!-- end data -->
                        <?if (strlen($arItem["DETAIL_TEXT"]) > 0 || strlen($arItem["PREVIEW_TEXT"]) > 0):?>
                            <div class="description-block">
                                <?if (strlen($arParams["ELEMENT_CODE"]) > 0 || strlen($arParams["ELEMENT_ID"]) > 0):?>
                                    <?if (!empty($arItem["DETAIL_TEXT"])):?>
                                        <p><?=$arItem["DETAIL_TEXT"]?></p>
                                    <?else:?>
                                        <p><?=$arItem["PREVIEW_TEXT"]?></p>
                                    <?endif;?>
                                <?else:?>
                                    <p><?=$arItem["PREVIEW_TEXT"]?>
                                        <?if (strlen($arItem["DETAIL_TEXT"]) > 0):?>
                                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                                <?=GetMessage('IGIMA_MODDOS_DETAIL_TEXT');?>
                                            </a>
                                        <?endif;?>
                                    </p>
                                <?endif;?>
                            </div>
                        <?endif;?>
                        <div class="size">
                            <?if ($arItem["PROPERTIES"]["SCHEME"]["VALUE"] > 0):?>
                                <a href="#pop-choose-size" class="choose"><?=GetMessage('IGIMA_MODDOS_HOW_TO_SIZE');?></a>
                                <div class="popup-wrap" id="pop-choose-size" >
                                    <?
                                    $APPLICATION->IncludeComponent(
                                            "bitrix:catalog.element","mds",array(
                                        "TEMPLATE_THEME" => "blue",
                                        "ADD_PICT_PROP" => "-",
                                        "LABEL_PROP" => "-",
                                        "OFFER_ADD_PICT_PROP" => "-",
                                        "OFFER_TREE_PROPS" => array(
                                            0 => "SIZE",
                                            1 => "PARAMS",
                                        ),
                                        "DISPLAY_NAME" => "Y",
                                        "DETAIL_PICTURE_MODE" => "IMG",
                                        "ADD_DETAIL_TO_SLIDER" => "N",
                                        "DISPLAY_PREVIEW_TEXT_MODE" => "E",
                                        "PRODUCT_SUBSCRIPTION" => "N",
                                        "SHOW_DISCOUNT_PERCENT" => "N",
                                        "SHOW_OLD_PRICE" => "N",
                                        "SHOW_MAX_QUANTITY" => "N",
                                        "DISPLAY_COMPARE" => "N",
                                        "MESS_BTN_BUY" => GetMessage("IGIMA_MODDOS_KUPITQ"),
                                        "MESS_BTN_ADD_TO_BASKET" => GetMessage("IGIMA_MODDOS_V_KORZINU"),
                                        "MESS_BTN_SUBSCRIBE" => GetMessage("IGIMA_MODDOS_PODPISATQSA"),
                                        "MESS_BTN_COMPARE" => GetMessage("IGIMA_MODDOS_SRAVNENIE"),
                                        "MESS_NOT_AVAILABLE" => GetMessage("IGIMA_MODDOS_NET_V_NALICII"),
                                        "USE_VOTE_RATING" => "N",
                                        "USE_COMMENTS" => "N",
                                        "BRAND_USE" => "N",
                                        "IBLOCK_TYPE" => "mds",
                                        "IBLOCK_ID" => "8",
                                        "ELEMENT_ID" => $arItem["PROPERTIES"]["SCHEME"]["VALUE"],
                                        "ELEMENT_CODE" => "",
                                        "SECTION_ID" => "",
                                        "SECTION_CODE" => "",
                                        "SECTION_URL" => "",
                                        "DETAIL_URL" => "",
                                        "SECTION_ID_VARIABLE" => "SECTION_ID",
                                        "SET_TITLE" => "N",
                                        "SET_BROWSER_TITLE" => "N",
                                        "BROWSER_TITLE" => "-",
                                        "SET_META_KEYWORDS" => "N",
                                        "META_KEYWORDS" => "-",
                                        "SET_META_DESCRIPTION" => "N",
                                        "META_DESCRIPTION" => "-",
                                        "SET_STATUS_404" => "N",
                                        "ADD_SECTIONS_CHAIN" => "N",
                                        "ADD_ELEMENT_CHAIN" => "N",
                                        "PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "OFFERS_FIELD_CODE" => array(
                                            0 => "DETAIL_PICTURE",
                                            1 => "",
                                        ),
                                        "OFFERS_PROPERTY_CODE" => array(
                                            0 => "SIZE",
                                            1 => "PARAMS",
                                            2 => "MEASURE",
                                            3 => "",
                                        ),
                                        "OFFERS_SORT_FIELD" => "sort",
                                        "OFFERS_SORT_ORDER" => "asc",
                                        "OFFERS_SORT_FIELD2" => "id",
                                        "OFFERS_SORT_ORDER2" => "asc",
                                        "OFFERS_LIMIT" => "0",
                                        "PRICE_CODE" => array(
                                        ),
                                        "USE_PRICE_COUNT" => "N",
                                        "SHOW_PRICE_COUNT" => "1",
                                        "PRICE_VAT_INCLUDE" => "Y",
                                        "PRICE_VAT_SHOW_VALUE" => "N",
                                        "BASKET_URL" => "/personal/basket.php",
                                        "ACTION_VARIABLE" => "action",
                                        "PRODUCT_ID_VARIABLE" => "id",
                                        "USE_PRODUCT_QUANTITY" => "N",
                                        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                                        "PRODUCT_PROPS_VARIABLE" => "prop",
                                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                        "PRODUCT_PROPERTIES" => array(
                                        ),
                                        "LINK_IBLOCK_TYPE" => "",
                                        "LINK_IBLOCK_ID" => "",
                                        "LINK_PROPERTY_SID" => "",
                                        "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
                                        "CACHE_TYPE" => "A",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_GROUPS" => "Y",
                                        "USE_ELEMENT_COUNTER" => "N",
                                        "HIDE_NOT_AVAILABLE" => "N",
                                        "CONVERT_CURRENCY" => "N",
                                        "OFFERS_CART_PROPERTIES" => array(
                                        )
                                            ),false
                                    );
                                    ?>
                                </div> <!-- end popup-wrap choose-size -->
                            <?endif;?>
                            <?=GetMessage('IGIMA_MODDOS_SIZE');?> <span class="available"> <?=GetMessage('IGIMA_MODDOS_AVAIL');?></span>
                            <span class="waiting"> <?=GetMessage('IGIMA_MODDOS_WAITING');?></span>
                            <ul class="sizech">
                                <?foreach ($arItem["OFFERS"] as $arOffers):?>
                                    <?if ($arOffers["CATALOG_QUANTITY"] > 0):?>
                                        <li>
                                            <a data-offer="<?=$arOffers["ID"]?>" href="#"><?=$arOffers["DISPLAY_PROPERTIES"]["SIZE"]["DISPLAY_VALUE"]?></a>
                                        </li>
                                    <?else:?>
                                        <li>
                                            <a class="no-available" data-offer="<?=$arOffers["ID"]?>" href="#"><?=$arOffers["DISPLAY_PROPERTIES"]["SIZE"]["DISPLAY_VALUE"]?></a>
                                            <div class="hints">
                                                <span class="hints-arrow"></span>
                                                <?=GetMessage('IGIMA_MODDOS_CHOOSE_SIZE');?>
                                            </div>
                                        </li>
                                    <?endif;?>
                                <?endforeach;?>
                            </ul>
                            <div class="clear"></div>
                        </div> <!-- end size -->
                        <div class="color">
                            <?=GetMessage('IGIMA_MODDOS_COLOR');?>
                            <?if ($arItem["OFFERS_QUANTITY"] > 0):?>
                                <span class="available disin"> <?=GetMessage('IGIMA_MODDOS_AVAIL');?></span>
                            <?else:?>
                                <span class="waiting disin"> <?=GetMessage('IGIMA_MODDOS_WAITING');?></span>
                            <?endif;?>
                            <ul>
                                <?if ($arItem["OFFERS_QUANTITY"] > 0):?>
                                    <li>
                                        <a href="javascript:void(0);" class="active">
                                            <span style="background-color: <?=$arItem["DISPLAY_PROPERTIES"]["COLOR"]["UF_COLCODE"]?>"></span>
                                        </a>
                                        <?if (!empty($arItem["DISPLAY_PROPERTIES"]["COLOR"]["DISPLAY_VALUE"])):?>
                                            <div class="hints">
                                                <span class="hints-arrow"></span>
                                                <?=$arItem["DISPLAY_PROPERTIES"]["COLOR"]["DISPLAY_VALUE"]?>
                                            </div>
                                        <?endif;?>
                                    </li>
                                <?else:?>
                                    <li>
                                        <a class="no-available active" href="javascript:void(0);">
                                            <span style="background-color: <?=$arItem["DISPLAY_PROPERTIES"]["COLOR"]["UF_COLCODE"]?>"></span><i class="diagonal"></i>
                                        </a>
                                        <div class="hints">
                                            <span class="hints-arrow"></span>
                                            <?=$arItem["DISPLAY_PROPERTIES"]["COLOR"]["DISPLAY_VALUE"]?>
                                        </div> <!-- end hints -->
                                    </li>
                                <?endif;?>
                            </ul>
                            <div class="clear"></div>
                        </div> <!-- end color -->
                        <div class="button-wrap">
                            <div class="hints hints-right">
                                <span class="hints-arrow"></span>
                                <?=GetMessage('IGIMA_MODDOS_NO_SIZE');?>
                            </div>
                            <div class="hints hints-left">
                                <span class="hints-arrow"></span>
                                <?=GetMessage('IGIMA_MODDOS_NO_SIZE');?>
                            </div>
                            <a href="javascript:void(0);" class="add-elected-btn" prod-id="<?=$arItem["ID"]?>" offer-id="">
                                <span class="ico"><i></i></span><span class="text"><?=GetMessage('IGIMA_MODDOS_ADD_TO_FAV');?></span>
                            </a>
                            <?if ($arItem["OFFERS_QUANTITY"] > 0):?>
                                <a href="javascript:void(0);" class="add-cart-btn" prod-id="<?=$arItem["ID"]?>" offer-id="">
                                    <span class="ico"><i></i></span><span class="text"><?=GetMessage('IGIMA_MODDOS_ADD_TO_CART');?></span>
                                </a>
                                <a href="#<?if (!$USER->IsAuthorized()):?>inform-receipt<?endif;?>" class="inform-button<?if (!$USER->IsAuthorized()):?> inform-unlogin<?endif;?>" prod-id="<?=$arItem["ID"]?>" offer-id="" user-auth="<?if ($USER->IsAuthorized()):?>Y<?else:?>N<?endif;?>"><span class="ico"><i></i></span><?=GetMessage('IGIMA_MODDOS_REP_TO_COL');?></a>
                            <?else:?>
                                <a href="javascript:void(0);" class="inform-button disbl" prod-id="<?=$arItem["ID"]?>" offer-id="" user-auth="<?if ($USER->IsAuthorized()):?>Y<?else:?>N<?endif;?>"><span class="ico"><i></i></span><?=GetMessage('IGIMA_MODDOS_REP_TO_COL');?></a>
                            <?endif;?>
                            <div class="clear"></div>
                        </div> <!-- end button-wrap -->
                    </td>
                    <?if ($arParams['SHOW_ADV_BLOCK'] == 'Y'):?>
                        <td class="edit"><?if (strlen($arItem["SECTION"]["UF_QVIEW_ADV"]) > 0):?><?=$arItem["SECTION"]["UF_QVIEW_ADV"]?><?endif;?></td>
                    <?endif;?>
                </tr>
            </table>                                          
        <?endforeach;?>
        <?if (strlen($arParams["ELEMENT_CODE"]) > 0 || strlen($arParams["ELEMENT_ID"]) > 0):?>
        </div> <!-- end view-block -->
    </div> <!-- end veiw -->
    <span id="viewed-cnt" data-pid="<?=$arItem["ID"]?>" data-sid="<?=SITE_ID?>"></span>
    <div class="tabs-block">
        <div class="head">
            <a class="active" href="#"><?=GetMessage('IGIMA_MODDOS_ABOUT_BRAND_TAB');?></a>
            <a href="#"><?=GetMessage('IGIMA_MODDOS_DELIVERY_TAB');?></a>
            <a href="#"><?=GetMessage('IGIMA_MODDOS_RETURN_TAB');?></a>
            <div class="clear"></div>
        </div> <!-- end head -->
        <div class="tabs">
            <div class="tab about-brands">
                <?if (is_array($arItem["DISPLAY_PROPERTIES"]["BRAND"]["UF_FULLDESC"])):?>
                    <div class="tab-left">
                        <?if (strlen($arItem["DISPLAY_PROPERTIES"]["BRAND"]["UF_FULLDESC"]["PREVIEW_PICTURE"]) > 0):?>
                            <img src="<?=CFile::GetPath($arItem["DISPLAY_PROPERTIES"]["BRAND"]["UF_FULLDESC"]["PREVIEW_PICTURE"]);?>" alt="" />
                        <?endif;?>
                        <?if (strlen($arItem["DISPLAY_PROPERTIES"]["BRAND"]["UF_LINK"]) > 0):?>
                            <a href="<?=$arItem["DISPLAY_PROPERTIES"]["BRAND"]["UF_LINK"]?>" class="look-all"><?=GetMessage('IGIMA_MODDOS_BRAND_SHOW_ALL');?></a>
                        <?endif;?>
                    </div> <!-- end left -->
                    <div class="tab-right">
                        <?if (strlen($arItem["DISPLAY_PROPERTIES"]["BRAND"]["UF_FULLDESC"]["PREVIEW_TEXT"]) > 0):?>
                            <?=$arItem["DISPLAY_PROPERTIES"]["BRAND"]["UF_FULLDESC"]["PREVIEW_TEXT"];?>
                        <?else:?>
                            <?=$arItem["DISPLAY_PROPERTIES"]["BRAND"]["UF_FULLDESC"]["DETAIL_TEXT"];?>
                        <?endif;?>
                    </div> <!-- end right -->
                <?else:?>
                    <div class="tab-left"><span class="look-all"><?=GetMessage('IGIMA_MODDOS_NO_BRAND_DESC');?></span></div>
                <?endif;?>
                <div class="clear"></div>
            </div><!-- end tab -->
            <div class="tab delivery">
                <?
                $GLOBALS['INC_BASKET'] = "N";
                $GLOBALS['PRODUCT_ID'] = $arItem["ID"];
                $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/delivery.php");
                ?>			
            </div><!-- end tab -->
            <div class="tab returns">
                <div class="tab-left">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => "".SITE_TEMPLATE_PATH."/include_areas/return-left.php",
                        "EDIT_TEMPLATE" => "standard.php"
                            ),false
                    );
                    ?>
                </div> <!-- end left -->
                <div class="tab-right">
                    <?
                    $APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => "".SITE_TEMPLATE_PATH."/include_areas/return-right.php",
                        "EDIT_TEMPLATE" => "standard.php"
                            ),false
                    );
                    ?>
                </div> <!-- end right -->
                <div class="clear"></div>
            </div><!-- end tab -->

        </div>
        <div class="veil" id="veil-paydel"></div>
    </div> <!-- end tabs-block -->
    <?
    $APPLICATION->IncludeComponent(
            "igima:catalog.recommended.products",".default",array(
        "LINE_ELEMENT_COUNT" => "5",
        "IBLOCK_TYPE" => "mds",
        "IBLOCK_ID" => "1",
        "ID" => "",
        "CODE" => $_REQUEST["ELEMENT_CODE"],
        "PROPERTY_LINK" => "RECOMMEND",
        "OFFERS_PROPERTY_LINK" => "RECOMMEND",
        "FILTER_NOVELTY_COUNT" => "120",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "86400",
        "CACHE_NOTES" => "",
        "DETAIL_URL" => "",
        "BASKET_URL" => "/personal/basket.php",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "SHOW_OLD_PRICE" => "Y",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "PRICE_CODE" => array(
            0 => "BASE",
        ),
        "SHOW_PRICE_COUNT" => "1",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "PRICE_VAT_INCLUDE" => "Y",
        "USE_PRODUCT_QUANTITY" => "N",
        "SHOW_NAME" => "Y",
        "SHOW_IMAGE" => "Y",
        "MESS_BTN_BUY" => GetMessage("IGIMA_MODDOS_KUPITQ"),
        "MESS_BTN_DETAIL" => GetMessage("IGIMA_MODDOS_PODROBNEE"),
        "MESS_NOT_AVAILABLE" => GetMessage("IGIMA_MODDOS_NET_V_NALICII"),
        "MESS_BTN_SUBSCRIBE" => GetMessage("IGIMA_MODDOS_PODPISATQSA"),
        "PAGE_ELEMENT_COUNT" => "50",
        "SHOW_PRODUCTS_1" => "Y",
        "PROPERTY_CODE_1" => array(
            0 => "BRAND",
            1 => "",
        ),
        "CART_PROPERTIES_1" => array(
            0 => "",
            1 => "",
        ),
        "ADDITIONAL_PICT_PROP_1" => "ADDIMG",
        "LABEL_PROP_1" => "-",
        "PROPERTY_CODE_2" => array(
            0 => "",
            1 => "",
        ),
        "CART_PROPERTIES_2" => array(
            0 => "",
            1 => "",
        ),
        "ADDITIONAL_PICT_PROP_2" => "",
        "OFFER_TREE_PROPS_2" => array(
            0 => "-",
        ),
        "HIDE_NOT_AVAILABLE" => "N",
        "CONVERT_CURRENCY" => "N"
            ),false
    );
    ?>
    <?
    $APPLICATION->IncludeComponent(
            "igima:catalog.recommended.products",".default",array(
        "LINE_ELEMENT_COUNT" => "5",
        "IBLOCK_TYPE" => "mds",
        "IBLOCK_ID" => "1",
        "ID" => "",
        "CODE" => $_REQUEST["ELEMENT_CODE"],
        "PROPERTY_LINK" => "SIMILLAR",
        "OFFERS_PROPERTY_LINK" => "SIMILLAR",
        "FILTER_NOVELTY_COUNT" => "120",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "86400",
        "CACHE_NOTES" => "",
        "DETAIL_URL" => "",
        "BASKET_URL" => "/personal/basket.php",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "SHOW_OLD_PRICE" => "Y",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "PRICE_CODE" => array(
            0 => "BASE",
        ),
        "SHOW_PRICE_COUNT" => "1",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "PRICE_VAT_INCLUDE" => "Y",
        "USE_PRODUCT_QUANTITY" => "N",
        "SHOW_NAME" => "Y",
        "SHOW_IMAGE" => "Y",
        "MESS_BTN_BUY" => GetMessage("IGIMA_MODDOS_KUPITQ"),
        "MESS_BTN_DETAIL" => GetMessage("IGIMA_MODDOS_PODROBNEE"),
        "MESS_NOT_AVAILABLE" => GetMessage("IGIMA_MODDOS_NET_V_NALICII"),
        "MESS_BTN_SUBSCRIBE" => GetMessage("IGIMA_MODDOS_PODPISATQSA"),
        "PAGE_ELEMENT_COUNT" => "50",
        "SHOW_PRODUCTS_1" => "Y",
        "PROPERTY_CODE_1" => array(
            0 => "BRAND",
            1 => "",
        ),
        "CART_PROPERTIES_1" => array(
            0 => "",
            1 => "",
        ),
        "ADDITIONAL_PICT_PROP_1" => "ADDIMG",
        "LABEL_PROP_1" => "-",
        "PROPERTY_CODE_2" => array(
            0 => "",
            1 => "",
        ),
        "CART_PROPERTIES_2" => array(
            0 => "",
            1 => "",
        ),
        "ADDITIONAL_PICT_PROP_2" => "",
        "OFFER_TREE_PROPS_2" => array(
            0 => "-",
        ),
        "HIDE_NOT_AVAILABLE" => "N",
        "CONVERT_CURRENCY" => "N"
            ),false
    );
    ?>
<?endif;?>