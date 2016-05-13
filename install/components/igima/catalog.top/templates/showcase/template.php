<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?if (count($arResult['ITEMS']) > 0):?>
    <?if ($arParams["AJAX_QUERY"] != "Y"):?>
        <div class="pagination-wrap">
            <?
            $APPLICATION->IncludeComponent("igima:catalog.sort",".default",Array(
                "SORT_LIST" => array(
                    0 => "SHOWS",
                    1 => "PRICE_ASC",
                    2 => "PRICE_DESC",
                    3 => "NOVELTY",
                    4 => "DISCOUNT"
                )
                    ),false
            );
            ?>
            <div class="pagination">				
                <?if ($arParams["DISPLAY_TOP_PAGER"]):?>
                    <?=$arResult["NAV_STRING"]?>
                <?endif;?>
            </div> <!-- end  pagination-->
            <div class="clear"></div>
        </div> <!-- end pagination-wrap -->
        <div id="showcase-product" class="catalog-rotator showcase-product">
        <?endif;?>
        <?
        foreach ($arResult['ITEMS'] as $key => $arItem):
            $this->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],$strElementEdit);
            $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],$strElementDelete,$arElementDeleteParams);
            $strMainID = $this->GetEditAreaId($arItem['ID']);
            ?>
            <?if ($cell % $arParams["LINE_ELEMENT_COUNT"] == 0):?>
                <div class="slides_container row">
                <?endif;?>
                <div class="product" id="prod_<?=$arItem['ID']?>">
                    <div class="product-block" id="<?=$strMainID?>">
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="product-link">
                            <span class="photo">
                                <?if ($arParams['FILTER_NOVELTY'] == "Y" || $arItem["NOVELTY"] == "Y"):?>
                                    <span class="new"><?=GetMessage('IGIMA_MODDOS_NOVELTY');?></span>
                                <?endif;?>
                                <?if (!empty($arItem["PRICES"][$arParams["PRICE_CODE"][0]]["DISCOUNT_DIFF_PERCENT"])):?>
                                    <span class="discount">-<?=$arItem["PRICES"][$arParams["PRICE_CODE"][0]]["DISCOUNT_DIFF_PERCENT"]?>%</span>
                                <?endif;?>
                                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" />
                            </span>
                            <span class="title"><?=$arItem["NAME"]?></span>
                            <span class="brand"><?=$arItem["DISPLAY_PROPERTIES"]["BRAND"]["DISPLAY_VALUE"]?></span>
                            <?if ($arItem["PRICES"][$arParams["PRICE_CODE"][0]]["DISCOUNT_DIFF_PERCENT"] > 0):?>
                                <span class="price">
                                    <span class="price-new"><?=$arItem["PRICES"][$arParams["PRICE_CODE"][0]]["PRINT_DISCOUNT_VALUE"]?><span class="rur">i</span></span>
                                    <span class="price-old">
                                        <span class="erase"><span><?=$arItem["PRICES"][$arParams["PRICE_CODE"][0]]["PRINT_VALUE"]?></span></span><span class="rur">i</span>
                                    </span>
                                </span>
                            <?else:?>
                                <span class="price"><?=$arItem["PRICES"][$arParams["PRICE_CODE"][0]]["PRINT_VALUE"]?><span class="rur">i</span></span>
                            <?endif;?>
                        </a> <!-- end product-link -->
                        <div class="veil" id="veil-paydel-<?=$arItem['ID']?>"></div>
                        <a href="#" class="view-btn" data-id="<?=$arItem["ID"]?>" data-adv="<?=$arParams['SHOW_ADV_BLOCK']?>"><?=GetMessage('IGIMA_MODDOS_QUICK_VIEW');?></a>
                        <span class="arrow"></span>
                    </div> <!-- end  product-block -->
                    <div class="view">
                        <div class="view-head">
                            <a href="#" class="viem-prev"><i></i><?=GetMessage('IGIMA_MODDOS_PREVIEW_MODEL');?></a> |
                            <a href="#" class="viem-next"><?=GetMessage('IGIMA_MODDOS_NEXT_MODEL');?><i></i></a>
                            <a href="#" class="close"></a>
                        </div> <!-- end view-head -->
                        <div class="view-block"></div> <!-- end view-block -->
                        <div class="veil" id="veil-quickview-<?=$arItem['ID']?>"></div>
                    </div> <!-- end veiw -->
                </div> <!-- end product -->
                <?
                $cell++;
                if ($cell % $arParams["LINE_ELEMENT_COUNT"] == 0):
                    ?>
                </div> <!-- end slides_container -->
            <?endif?>
        <?endforeach;?>
    <?if ($cell % $arParams["LINE_ELEMENT_COUNT"] != 0):?>
        </div> <!-- end slides_container -->
    <?endif?>
    <div class="clear">
        <span id="show-adv-block" data-val="<?=$arParams["SHOW_ADV_BLOCK"]?>"></span>
        <span id="show-discount-prod" data-val="<?=$arParams["FILTER_DISCOUNT"]?>"></span>
        <span id="show-novelty-prod" data-val="<?=$arParams["FILTER_NOVELTY"]?>"></span>
        <span id="show-novelty-prod-count" data-val="<?=$arParams["FILTER_NOVELTY_COUNT"]?>"></span>
    </div>
    <?if ($arParams["AJAX_QUERY"] != "Y"):?>
        </div> <!-- end catalog-rotator -->
        <div class="pagination-wrap">
                <?if ($arResult["NAV_RESULT"]->NavPageCount > 1):?>
                <div class="pagination-button">
                    <?if ($arResult["NAV_RESULT"]->NavPageNomer > 1):?><a href="#page<?=$arResult["NAV_RESULT"]->NavPageNomer - 1?>" class="prev-page"><i></i><?=GetMessage('IGIMA_MODDOS_PREV_PAGE');?></a><?endif;?>
            <?if ($arResult["NAV_RESULT"]->NavPageNomer != $arResult["NAV_RESULT"]->NavPageCount):?><a href="#page<?=$arResult["NAV_RESULT"]->NavPageNomer + 1?>" class="next-page"><?=GetMessage('IGIMA_MODDOS_NEXT_PAGE');?><i></i></a><?endif;?>
                    <div class="clear"></div>
                </div> <!-- end  pagination-button -->
            <?endif;?>
            <?
            $APPLICATION->IncludeComponent("igima:catalog.sort",".default",Array(
                "SORT_LIST" => array(
                    0 => "SHOWS",
                    1 => "PRICE_ASC",
                    2 => "PRICE_DESC",
                    3 => "NOVELTY",
                    4 => "DISCOUNT"
                )
                    ),false
            );
            ?>
            <div class="pagination">				
                <?if ($arParams["DISPLAY_BOTTOM_PAGER"]):?>
                    <?=$arResult["NAV_STRING"]?>
        <?endif;?>
            </div> <!-- end  pagination-->
            <div class="clear"></div>
        </div> <!-- end pagination-wrap -->
    <?endif;?>
    <div class="veil" id="veil-showcase"></div>
<?else:?>
    <?=GetMessage('IGIMA_MODDOS_NO_ITEMS');?>
<?endif;?>
