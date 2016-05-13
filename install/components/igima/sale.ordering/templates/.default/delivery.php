<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");
?>
<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>" />
<div class="step delivery" data-step="1">
    <div class="head main-head<?if ($arParams["STEP"] == 1 || (empty($arParams["STEP"]) && $USER->IsAuthorized())):?> active<?endif;?>"<?if ($arParams["STEP"] >= 2):?> style='display: none;'<?endif;?>>
        <?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CH_DELIV")?>
        <a href="#" class="close-step"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CLOSE")?></a>
    </div>
    <div class="delivery-info"<?if ($arParams["STEP"] == 1 || (empty($arParams["STEP"]) && $USER->IsAuthorized())):?> style='display: block;'<?endif;?>>
        <?
        PrintPropsForm($arResult["ORDER_PROP"]["LOCATION"],$arParams["TEMPLATE_LOCATION"]);
        ?>

        <div class="bx_section delivery-method"<?if ($arParams["STEP"] == 1):?> style='display: block;'<?endif;?>>
            <div class="delivery-left">
                <?
                if (!empty($arResult["DELIVERY"]))
                {

                    foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery)
                    {
                        if ($delivery_id !== 0 && intval($delivery_id) <= 0)
                        {
                            foreach ($arDelivery["PROFILES"] as $profile_id => $arProfile)
                            {
                                ?>
                                <?
                                if (count($arDelivery["LOGOTIP"]) > 0):

                                    $deliveryImgURL = $arDelivery["LOGOTIP"]["SRC"];
                                else:
                                    $deliveryImgURL = $templateFolder."/images/logo-default-d.gif";
                                endif;
                                if ($arProfile["CHECKED"] == "Y")
                                    $curDel["LOGO"] = $deliveryImgURL;
                                ?>

                                <label class="radio<?if ($arProfile["CHECKED"] == "Y"):?> checked<?endif;?>" for="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>" data-type="delivery">
                                    <input type="radio" name="delivery-method"
                                           id="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>"
                                           name="<?=htmlspecialcharsbx($arProfile["FIELD_NAME"])?>"
                                           value="<?=$delivery_id.":".$profile_id;?>"
                                           <?if ($arProfile["CHECKED"] == "Y"):?> checked="checked"<?endif;?>
                                           />
                                    <span class="photo bx_logotype" style='background: url(<?=$deliveryImgURL?>) no-repeat 0 0;'></span>
                                    <span class="arrow"></span>
                                </label> <!-- end label.radio -->


                                <?
                            } // endforeach
                        }
                        else // stores and courier
                        {
                            if (count($arDelivery["STORE"]) > 0)
                                $clickHandler = "onClick = \"fShowStore('".$arDelivery["ID"]."','".$arParams["SHOW_STORES_IMAGES"]."','".$width."','".SITE_ID."')\";";
                            else
                                $clickHandler = "onClick = \"BX('ID_DELIVERY_ID_".$arDelivery["ID"]."').checked=true;submitForm();\"";
                            ?>
                            <?
                            if (count($arDelivery["LOGOTIP"]) > 0):

                                $deliveryImgURL = $arDelivery["LOGOTIP"]["SRC"];
                            else:
                                $deliveryImgURL = $templateFolder."/images/logo-default-d.gif";
                            endif;
                            if ($arDelivery["CHECKED"] == "Y")
                                $curDel["LOGO"] = $deliveryImgURL;
                            ?>

                            <label class="radio<?if ($arDelivery["CHECKED"] == "Y"):?> checked<?endif;?>" for="ID_DELIVERY_ID_<?=$arDelivery["ID"]?>" data-type="delivery">
                                <input type="radio" name="delivery-method"
                                       id="ID_DELIVERY_ID_<?=$arDelivery["ID"]?>"
                                       name="<?=htmlspecialcharsbx($arDelivery["FIELD_NAME"])?>"
                                       value="<?=$arDelivery["ID"]?>"
                                       <?if ($arDelivery["CHECKED"] == "Y"):?> checked="checked"<?endif;?>
                                       />
                                <span class="photo bx_logotype" style='background: url(<?=$deliveryImgURL?>) no-repeat 0 0;'></span>
                                <span class="arrow"></span>
                            </label> <!-- end label.radio -->
                            <?
                        }
                    }
                }
                ?>
            </div>
            <?
            if (!empty($arResult["DELIVERY"]))
            {
                ?>
                <div class="delivery-right-wrapper">
                    <div class="delivery-right">
                        <?
                        foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery)
                        {
                            if ($delivery_id !== 0 && intval($delivery_id) <= 0)
                            {
                                foreach ($arDelivery["PROFILES"] as $profile_id => $arProfile)
                                {
                                    ?>
                                    <?if ($arProfile["CHECKED"] == "Y"):?>			
                                        <div class="delivery-item" style="display: block;">
                                            <div class="left">
                                                <ul>
                                                    <?
                                                    if (!empty($arResult["ERROR"]) && $arParams["STEP"] != 2)
                                                        echo "<li>".ShowError($arResult["ERROR"][0])."</li>";
                                                    ?>
                                                    <?if (!empty($arResult["DELIVERY_PRICE"])):?><li><span class="ico"><img src="<?=SITE_TEMPLATE_PATH?>/images/delivery-options-price.png" alt="" /></span><span class="name-option"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_PRICE")?>:</span><span class="price"><?=$curDel["PRICE_FORMATED"] = $arResult["DELIVERY_PRICE_FORMATED"]?><span class="rur">i</span></span></li><?endif;?>
                                                    <?if (!empty($arDelivery["PERIOD_TEXT"])):?><li><span class="ico"><img src="<?=SITE_TEMPLATE_PATH?>/images/delivery-options.png" alt="" /></span><span class="name-option"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_DELIVERY_BIG")?>:</span><?=$curDel["PERIOD_TEXT"] = $arDelivery["PERIOD_TEXT"]?></li><?endif;?>

                                                </ul>
                                            </div> <!-- end left -->

                                            <div class="clear"></div>
                                            <div class="left border">
                                                <p><?if (strlen($arProfile["DESCRIPTION"]) > 0):?>
                                                        <?=$curDel["DESCRIPTION"] = nl2br($arProfile["DESCRIPTION"])?>
                                                    <?else:?>
                                                        <?=$curDel["DESCRIPTION"] = nl2br($arDelivery["DESCRIPTION"])?>
                                                    <?endif;?></p>
                                            </div> <!-- end left -->
                                        </div> <!-- end delivery-item -->
                                    <?endif;?>

                                    <?
                                } // endforeach
                            }
                            else // stores and courier
                            {
                                ?>
                                <?if ($arDelivery["CHECKED"] == "Y"):?>
                                    <div class="delivery-item" style="display:block;">
                                        <div class="left">
                                            <ul>
                                                <?
                                                if (!empty($arResult["ERROR"]) && $arParams["STEP"] != 2)
                                                    echo "<li>".ShowError($arResult["ERROR"][0])."</li>";
                                                ?>
                                                <?if (!empty($arDelivery["PRICE"])):?><li><span class="ico"><img src="<?=SITE_TEMPLATE_PATH?>/images/delivery-options-price.png" alt="" /></span><span class="name-option"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_PRICE")?>:</span><span class="price"><?=$curDel["PRICE_FORMATED"] = $arDelivery["PRICE_FORMATED"]?><span class="rur">i</span></span></li><?endif;?>
                                                <?if (!empty($arDelivery["PERIOD_TEXT"])):?><li><span class="ico"><img src="<?=SITE_TEMPLATE_PATH?>/images/delivery-options.png" alt="" /></span><span class="name-option"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_DELIVERY_BIG")?>:</span><?=$curDel["PERIOD_TEXT"] = $arDelivery["PERIOD_TEXT"]?></li><?endif;?>
                                            </ul>
                                        </div> <!-- end left -->
                                        <div class="clear"></div>
                                        <div class="left border">
                                            <p><?if (strlen($arProfile["DESCRIPTION"]) > 0):?>
                                                    <?=$curDel["DESCRIPTION"] = nl2br($arProfile["DESCRIPTION"])?>
                                                <?else:?>
                                                    <?=$curDel["DESCRIPTION"] = nl2br($arDelivery["DESCRIPTION"])?>
                                                <?endif;?></p>
                                        </div> <!-- end left -->

                                    </div> <!-- end delivery-item -->
                                <?endif;?>
                                <?
                            }
                        }
                        ?>
                    </div>
                </div> <!-- end delivery-right-wrapper -->
                <div class="clear"></div>
                <?if (empty($arResult["ERROR"]) && $arResult["ORDER_TOTAL_PRICE_FORMATED"] > 0):?>
                    <a href="#" class="button-red"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CONT_WR")?></a>
                    <a href="#" class="button-green"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_SAVE_CONT")?></a>
                <?endif;?>
                <div class="clear"></div>
                <?
            }
            ?>
        </div>
    </div> <!-- end delivery-info -->
    <div class="delivery-compl<?if ($arParams["STEP"] >= 2):?> complete-info<?endif;?>"<?if ($arParams["STEP"] >= 2):?> style='display: block;'<?endif;?>>
        <div class="head compl">
            <?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CH_DELIV")?>
            <a href="#" class="change"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CHANGE")?></a>
        </div>
        <div class="delivery-info-method">
            <span class="photo" style='background: url(<?=$curDel["LOGO"]?>) no-repeat 0 -39px;'></span>
        </div> <!-- end delivery-info-method -->
        <div class="delivery-infom">
            <?if (strlen($curDel["PRICE_FORMATED"]) > 0):?><p><span class="param"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_PRICE")?>:</span> <span class="red"><?=$curDel["PRICE_FORMATED"]?> <span class="rur">i</span></span></p><?endif;?>
            <?if (strlen($curDel["PERIOD_TEXT"]) > 0):?><p><span class="param"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_DELIVERY_BIG")?>:</span> <?=$curDel["PERIOD_TEXT"]?></p><?endif;?>
        </div> <!-- end delivery-infom -->
    </div> <!-- end delivery-compl -->
</div><!-- end step delivery-->