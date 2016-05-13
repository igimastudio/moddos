<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
?>
<?if (count($arResult["ITEMS"]) > 0):?>
    <div class="product-carousel">
        <div class="head">
            <div class="title"><?=GetMessage('IGIMA_MODDOS_CATALOG_'.$arParams["PROPERTY_LINK"].'_TITLE');?></div>
            <div class="clear"></div>
        </div>
        <div class="fullslide">
            <div class="carousel">
                        <?foreach ($arResult["ITEMS"] as $arItems):?>
                    <a href="<?=$arItems["DETAIL_PAGE_URL"]?>" class="slide">
                        <span class="photo">
                            <?if ($arItems['NOVELTY'] == "Y"):?><span class="new"><?=GetMessage('IGIMA_MODDOS_CATALOG_NOVELTY');?></span><?endif;?>
                            <?if (!empty($arItems["PRICES"][$arParams["PRICE_CODE"][0]]["DISCOUNT_DIFF_PERCENT"])):?>
                                <span class="discount">-<?=$arItems["PRICES"][$arParams["PRICE_CODE"][0]]["DISCOUNT_DIFF_PERCENT"]?>%</span>
        <?endif;?>
                            <img src="<?=$arItems["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItems["NAME"]?>" />
                        </span>
                        <span class="title"><?=$arItems["NAME"]?></span>
                        <span class="brand"><?=$arItems["DISPLAY_PROPERTIES"]["BRAND"]["UF_NAME"]?></span>
                                <?if ($arItems["PRICES"][$arParams["PRICE_CODE"][0]]["DISCOUNT_DIFF_PERCENT"] > 0):?>
                            <span class="price">
                                <span class="price-new">
            <?=$arItems["PRICES"][$arParams["PRICE_CODE"][0]]["PRINT_DISCOUNT_VALUE"]?>
                                    <span class="rur">i</span>
                                </span>
                                <span class="price-old">
                                    <span class="erase">
                                        <span>
            <?=$arItems["PRICES"][$arParams["PRICE_CODE"][0]]["PRINT_VALUE"]?>
                                        </span>
                                    </span>
                                    <span class="rur">i</span>
                                </span>
                            </span>
                            <?else:?>
                            <span class="price">
                            <?=$arItems["PRICES"][$arParams["PRICE_CODE"][0]]["PRINT_VALUE"]?>
                                <span class="rur">i</span>
                            </span>
                    <?endif;?>
                    </a>
    <?endforeach;?>
            </div> <!-- end carousel -->
        </div>
        <div class="clear"></div>
    </div> <!-- end product-carousel -->
<?endif;?>