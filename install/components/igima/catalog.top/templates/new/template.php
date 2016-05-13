<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<div class="head">
    <div class="title"><?if ($arParams['FILTER_NOVELTY'] == "Y"):?><?=GetMessage('IGIMA_MODDOS_NOVELTY_THIS_WEEK');?><?elseif ($arParams['FILTER_DISCOUNT'] == "Y"):?><?=GetMessage('IGIMA_MODDOS_DISCOUNTS_THIS_WEEK');?><?endif;?></div>
    <div class="all"><?if ($arParams['FILTER_NOVELTY'] == "Y"):?><a href="<?=SITE_DIR?>catalog/novelty/"><?=GetMessage('IGIMA_MODDOS_ALL_NOVELTY');?><?elseif ($arParams['FILTER_DISCOUNT'] == "Y"):?><a href="<?=SITE_DIR?>catalog/sales/"><?=GetMessage('IGIMA_MODDOS_ALL_DISCOUNTS');?><?endif;?></a></div>
    <?if (count($arResult['ITEMS']) > 5):?>
        <div class="rotator-button">
            <a class="prev" href="javascript:void(0);"><span></span></a>
            <a class="next" href="javascript:void(0);"><span></span></a>
        </div> <!-- end rotator-button -->
    <?endif;?>
</div> <!-- end head -->
<div class="slides_container">
    <div class="sl-in">
        <?
        foreach ($arResult['ITEMS'] as $key => $arItem):
            $this->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],$strElementEdit);
            $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],$strElementDelete,$arElementDeleteParams);
            $strMainID = $this->GetEditAreaId($arItem['ID']);
            ?>
            <div class="product" id="prod_<?=$arItem['ID']?>">
                <div class="product-block" id="<?=$strMainID?>">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="product-link">
                        <span class="photo">
                            <?if ($arParams['FILTER_NOVELTY'] == "Y"):?>
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
                    <a href="javascript:void(0);" class="view-btn" data-id="<?=$arItem["ID"]?>" data-adv="<?=$arParams['SHOW_ADV_BLOCK']?>"><?=GetMessage('IGIMA_MODDOS_QUICK_VIEW');?></a>
                    <span class="arrow"></span>
                </div> <!-- end  product-block -->
                <div class="view">
                    <div class="view-head">
                        <a href="javascript:void(0);" class="viem-prev"><i></i><?=GetMessage('IGIMA_MODDOS_PREVIEW_MODEL');?></a> |
                        <a href="javascript:void(0);" class="viem-next"><?=GetMessage('IGIMA_MODDOS_NEXT_MODEL');?><i></i></a>
                        <a href="#" class="close"></a>
                    </div> <!-- end view-head -->
                    <div class="view-block"></div> <!-- end view-block -->
                    <div class="veil" id="veil-quickview-<?=$arItem['ID']?>"></div>
                </div> <!-- end veiw -->
            </div> <!-- end product -->
        <?endforeach;?>
    </div> <!-- end sl-in -->
</div> <!-- end slides_container -->
<div class="clear">
    <span id="show-adv-block" data-val="<?=$arParams["SHOW_ADV_BLOCK"]?>"></span>
</div>