<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
if (!CModule::IncludeModule("igima.moddos"))
    return;
CJSCore::Init(array("quick_view"));
global $USER;
$stmp = AddToTimeStamp(array("DD" => -30));
?>
<div class="head">
    <ul>
        <li class="pop-cart"><a href="#"><span class="ico"></span><?=GetMessage("IGIMA_MODDOS_CART")?><span class="numb"><?=$arResult["cartcnt"]?></span></a></li>
        <li class="pop-elected"><a href="#"><span class="ico"></span><?=GetMessage("IGIMA_MODDOS_FAVORITE")?><span class="numb"><?=count($arResult["ITEMS"]["DelDelCanBuy"]);?></span></a></li>
        <?if ($USER->IsAuthorized()):?><li class="pop-expect-revenues"><a href="#"><span class="ico"></span><?=GetMessage("IGIMA_MODDOS_WAITING")?><span class="numb"><?=count($arResult["ITEMS"]["ProdSubscribe"]);?></span></a></li><?endif;?>
    </ul>
    <div class="clear"></div>
</div> <!-- end head -->
<div class="pop-tab tab-cart">
    <?if ($arResult["cartcnt"]):?>
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
                            <a href="<?=$arCart["DETAIL_PAGE_URL"]?>" class="photo"><?if ($arCart["DATE_ACTIVE_FROM"] > date("d.m.Y H:i:s",$stmp)):?><span class="new-product"><?=GetMessage("IGIMA_MODDOS_NOVEL")?></span><?endif;?><?if (!empty($arCart["DISCOUNT_PRICE_PERCENT"])):?><span class="discount">-<?=round($arCart["DISCOUNT_PRICE_PERCENT"]);?>%</span><?endif;?><?if (!empty($arCart["PREVIEW_PICTURE"])):?><img src="<?=CFile::GetPath($arCart["PREVIEW_PICTURE"]);?>" alt="" /><?endif;?></a>
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
    <?endif;?>
    <div class="discount-coupon-wrap<?if (!$arResult["cartcnt"]):?> nodisp<?endif;?>">
        <div class="discount-coupon">
            <span class="discount-arrow"></span>
            <input class="coupon-inp" type="text" value="<?=GetMessage('IGIMA_MODDOS_COUPON_TEXT')?>" name="" placeholder="<?=GetMessage('IGIMA_MODDOS_COUPON_TEXT')?>">
            <a href="#" class="apply-btn"><span class="continue-brd"><?=GetMessage('IGIMA_MODDOS_COUPON_ENTER')?></span></a>
            <div class="clear"></div>
        </div> <!-- end discount-coupon -->
        <div class="used-coupon">

            <span><?=GetMessage('IGIMA_MODDOS_COUPON_USED')?>:</span>
            <ul>
                <?if (!empty($arResult["NOT_VALID_COUPON"])):?>
                    <li><a href="#" class="number-coupon wrong-coupon"><?=$arResult["NOT_VALID_COUPON"]?> <?=GetMessage('IGIMA_MODDOS_WRONG_COUPON')?></a></li>
                <?endif;?>
                <?if (!empty($arResult["VALID_COUPON"])):?>
                    <li><a href="#" class="number-coupon"><?=$arResult["VALID_COUPON"]?></a></li>
                <?endif;?>
            </ul>

            <div class="clear"></div>
        </div> <!-- end used-coupon -->
    </div> <!-- end <discount-coupon-wrap-->
    <div class="calculating<?if (!$arResult["cartcnt"]):?> nodisp<?endif;?>">
        <table>
            <tr>
                <td><?=GetMessage('IGIMA_MODDOS_SALE_AMOUNT')?></td>
                <td class="sale-amount"></td>
            </tr>
            <tr>
                <td><?=GetMessage('IGIMA_MODDOS_SALE_DISCOUNT')?></td>
                <td class="sale-disc"></td>
            </tr>
            <tr class="total">
                <td><?=GetMessage('IGIMA_MODDOS_SALE_TOTAL')?></td>
                <td class="sale-total"></td>
            </tr>
        </table>
    </div> <!-- end calculating -->
    <div class="clear"></div>
    <div class="button-wrpap<?if (!$arResult["cartcnt"]):?> nodisp<?endif;?>">
        <a href="<?=$arParams["PATH_TO_ORDER"]?>" class="ordering-btn"><i></i><?=GetMessage('IGIMA_MODDOS_GO_TO_ORDER')?></a>
        <a href="#" class="continue-btn"><span class="continue-brd"><i></i><?=GetMessage('IGIMA_MODDOS_GO_TO_CAT')?></span></a>
        <div class="clear"></div>
    </div> <!-- end button-wrap -->
    <div class="clear"></div>

    <div class="pop-tab-empty<?if ($arResult["cartcnt"] == 0):?> disbl<?endif;?>">
        <p class="pop-text"><?=GetMessage('IGIMA_MODDOS_EMPTY_CART')?></p>
        <p><?=GetMessage('IGIMA_MODDOS_GO_TO_CATALOG')?></p>
        <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/section-list.php");?>
        <div class="clear"></div>
    </div> <!-- end  pop-tab-empty-->

</div> <!-- end pop-tab -->
<div class="pop-tab tab-elected">
    <?if ($arResult["favcnt"]):?>
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
                            <a href="<?=$arDel["DETAIL_PAGE_URL"]?>" class="photo"><?if ($arDel["DATE_ACTIVE_FROM"] > date("d.m.Y H:i:s",$stmp)):?><span class="new-product"><?=GetMessage("IGIMA_MODDOS_NOVEL")?></span><?endif;?><?if (!empty($arDel["DISCOUNT_PRICE_PERCENT"])):?><span class="discount">-<?=$arDel["DISCOUNT_PRICE_PERCENT_FORMATED"]?></span><?endif;?><?if (!empty($arDel["PREVIEW_PICTURE"])):?><img src="<?=CFile::GetPath($arDel["PREVIEW_PICTURE"]);?>" alt="" /><?endif;?></a>
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
                        <?if ($arDel["CAN_BUY"] == "Y"):?>
                            <td class="status">
                                <?=GetMessage("IGIMA_MODDOS_PROD_AVAIL")?>
                                <a href="#" class="button-green send-to-cart" offer-id="<?=$arDel["ID"]?>"><?=GetMessage("IGIMA_MODDOS_SEND_TO_CART")?></a>
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
    <div class="pop-tab-empty<?if ($arResult["favcnt"] == 0):?> disbl<?endif;?>">
        <p class="pop-text"><?=GetMessage("IGIMA_MODDOS_NO_FAVORITE")?></p>
        <p><?=GetMessage('IGIMA_MODDOS_GO_TO_CATALOG')?></p>
        <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/section-list.php");?>
        <div class="clear"></div>
    </div> <!-- end  pop-tab-empty-->
</div> <!-- end pop-tab -->
<?if ($USER->IsAuthorized()):?>
    <div class="pop-tab tab-expect-revenues">
        <?if ($arResult["subcnt"]):?>
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
                                <a href="<?=$arSub["DETAIL_PAGE_URL"]?>" class="photo"><?if ($arSub["DATE_ACTIVE_FROM"] > date("d.m.Y H:i:s",$stmp)):?><span class="new-product"><?=GetMessage("IGIMA_MODDOS_NOVEL")?></span><?endif;?><?if (!empty($arSub["DISCOUNT_PRICE_PERCENT"])):?><span class="discount">-<?=$arSub["DISCOUNT_PRICE_PERCENT_FORMATED"]?></span><?endif;?><?if (!empty($arSub["PREVIEW_PICTURE"])):?><img src="<?=CFile::GetPath($arSub["PREVIEW_PICTURE"]);?>" alt="" /><?endif;?></a>
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
        <div class="pop-tab-empty<?if ($arResult["subcnt"] == 0):?> disbl<?endif;?>">
            <p class="pop-text"><?=GetMessage("IGIMA_MODDOS_NO_SUB")?></p>
            <p><?=GetMessage('IGIMA_MODDOS_GO_TO_CATALOG')?></p>
            <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/section-list.php");?>
            <div class="clear"></div>
        </div> <!-- end  pop-tab-empty-->
    </div> <!-- end pop-tab -->
<?endif;?>