<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
$frame = $this->createFrame()->begin();
if (count($arResult['ITEMS']) >= $arParams["LINE_ELEMENT_COUNT"])
{
    ?>
    <div class="products-viewed">
        <a href="#" class="button-top"><span class="arrow"></span><?=GetMessage('CVP_TPL_MESS_YOU_LOOKED');?> <span class="total"><?=count($arResult['ITEMS']);?></span></a>
        <div class="clear"></div>
        <div class="product-carousel">
            <div class="products-viewed-carousel">
                <?
                foreach ($arResult['ITEMS'] as $key => $arItem)
                {
                    ?>
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="slide">
                        <span class="photo">
                            <?if ($arItem['NOVELTY'] == "Y"):?><span class="new"><?=GetMessage('IGIMA_MODDOS_CATALOG_NOVELTY');?></span><?endif;?>
                            <?if (!empty($arItem["PRICES"][$arParams["PRICE_CODE"][0]]["DISCOUNT_DIFF_PERCENT"])):?>
                                <span class="discount">-<?=$arItem["PRICES"][$arParams["PRICE_CODE"][0]]["DISCOUNT_DIFF_PERCENT"]?>%</span>
                            <?endif;?>
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" />
                        </span>
                        <span class="title"><?=$arItem["NAME"]?></span>
                        <span class="brand"><?=$arItem["DISPLAY_PROPERTIES"]["BRAND"]["UF_NAME"]?></span>
                        <?if ($arItem["PRICES"][$arParams["PRICE_CODE"][0]]["DISCOUNT_DIFF_PERCENT"] > 0):?>
                            <span class="price">
                                <span class="price-new">
                                    <?=$arItem["PRICES"][$arParams["PRICE_CODE"][0]]["PRINT_DISCOUNT_VALUE"]?>
                                    <span class="rur">i</span>
                                </span>
                                <span class="price-old">
                                    <span class="erase">
                                        <span>
                                            <?=$arItem["PRICES"][$arParams["PRICE_CODE"][0]]["PRINT_VALUE"]?>
                                        </span>
                                    </span>
                                    <span class="rur">i</span>
                                </span>
                            </span>
                        <?else:?>
                            <span class="price">
                                <?=$arItem["PRICES"][$arParams["PRICE_CODE"][0]]["PRINT_VALUE"]?>
                                <span class="rur">i</span>
                            </span>
                        <?endif;?>
        <!--<span class="remove"></span>-->
                    </a>
                    <?
                }
                ?>
            </div> <!-- end carousel -->
            <!--<a href="#" class="remove-all"><?=GetMessage('IGIMA_MODDOS_REMOVE_ALL');?></a>-->
        </div> <!-- end product-carousel -->
    </div> <!-- end products-viewed -->
    <?
}
?>
<?$frame->beginStub();?>
<?$frame->end();?>