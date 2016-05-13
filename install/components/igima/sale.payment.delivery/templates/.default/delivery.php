<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<script type="text/javascript">
    function fShowStore(id, showImages, formWidth, siteId)
    {
        var strUrl = '<?=$templateFolder?>' + '/map.php';
        var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId;

        var storeForm = new BX.CDialog({
            'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
            head: '',
            'content_url': strUrl,
            'content_post': strUrlPost,
            'width': formWidth,
            'height': 450,
            'resizable': false,
            'draggable': false
        });

        var button = [
            {
                title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
                id: 'crmOk',
                'action': function ()
                {
                    GetBuyerStore();
                    BX.WindowManager.Get().Close();
                }
            },
            BX.CDialog.btnCancel
        ];
        storeForm.ClearButtons();
        storeForm.SetButtons(button);
        storeForm.Show();
    }

    function GetBuyerStore()
    {
        BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
        //BX('ORDER_DESCRIPTION').value = '<?=GetMessage("SOA_ORDER_GIVE_TITLE")?>: '+BX('POPUP_STORE_NAME').value;
        BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
        BX.show(BX('select_store'));
    }

    function showExtraParamsDialog(deliveryId)
    {
        var strUrl = '<?=$templateFolder?>' + '/delivery_extra_params.php';
        var formName = 'extra_params_form';
        var strUrlPost = 'deliveryId=' + deliveryId + '&formName=' + formName;

        if (window.BX.SaleDeliveryExtraParams)
        {
            for (var i in window.BX.SaleDeliveryExtraParams)
            {
                strUrlPost += '&' + encodeURI(i) + '=' + encodeURI(window.BX.SaleDeliveryExtraParams[i]);
            }
        }

        var paramsDialog = new BX.CDialog({
            'title': '<?=GetMessage('SOA_ORDER_DELIVERY_EXTRA_PARAMS')?>',
            head: '',
            'content_url': strUrl,
            'content_post': strUrlPost,
            'width': 500,
            'height': 200,
            'resizable': true,
            'draggable': false
        });

        var button = [
            {
                title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
                id: 'saleDeliveryExtraParamsOk',
                'action': function ()
                {
                    insertParamsToForm(deliveryId, formName);
                    BX.WindowManager.Get().Close();
                }
            },
            BX.CDialog.btnCancel
        ];

        paramsDialog.ClearButtons();
        paramsDialog.SetButtons(button);
        //paramsDialog.adjustSizeEx();
        paramsDialog.Show();
    }

    function insertParamsToForm(deliveryId, paramsFormName)
    {
        var orderForm = BX("ORDER_FORM"),
                paramsForm = BX(paramsFormName);
        wrapDivId = deliveryId + "_extra_params";

        var wrapDiv = BX(wrapDivId);
        window.BX.SaleDeliveryExtraParams = {};

        if (wrapDiv)
            wrapDiv.parentNode.removeChild(wrapDiv);

        wrapDiv = BX.create('div', {props: {id: wrapDivId}});

        for (var i = paramsForm.elements.length - 1; i >= 0; i--)
        {
            var input = BX.create('input', {
                props: {
                    type: 'hidden',
                    name: 'DELIVERY_EXTRA[' + deliveryId + '][' + paramsForm.elements[i].name + ']',
                    value: paramsForm.elements[i].value
                }
            }
            );

            window.BX.SaleDeliveryExtraParams[paramsForm.elements[i].name] = paramsForm.elements[i].value;

            wrapDiv.appendChild(input);
        }

        orderForm.appendChild(wrapDiv);

        BX.onCustomEvent('onSaleDeliveryGetExtraParams', [window.BX.SaleDeliveryExtraParams]);
    }
</script>
<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>" />
<div class="bx_section delivery-method">
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
                        ?>

                        <label class="radio<?if ($arProfile["CHECKED"] == "Y"):?> checked<?endif;?>" for="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>">
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
                    ?>

                    <label class="radio<?if ($arDelivery["CHECKED"] == "Y"):?> checked<?endif;?>" for="ID_DELIVERY_ID_<?=$arDelivery["ID"]?>">
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
                            <?if (!empty($arResult["DELIVERY_PRICE"])):?><li><span class="ico"><img src="<?=SITE_TEMPLATE_PATH?>/images/delivery-options-price.png" alt="" /></span><span class="name-option"><?=GetMessage("IGIMA_MODDOS_PAYMENT_DELIVERY_BIG")?>:</span><span class="price"><?=$arResult["DELIVERY_PRICE_FORMATED"]?><span class="rur">i</span></span></li><?endif;?>
                            <?if (!empty($arDelivery["PERIOD_TEXT"])):?><li><span class="ico"><img src="<?=SITE_TEMPLATE_PATH?>/images/delivery-options.png" alt="" /></span><span class="name-option"><?=GetMessage("IGIMA_MODDOS_PAYMENT_DELIVERY_PRICE")?>:</span><?=$arDelivery["PERIOD_TEXT"]?></li><?endif;?>

                                    </ul>
                                </div> <!-- end left -->
                                <div class="right">
                                        <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");?>
                                </div>
                                <div class="clear"></div>
                                <div class="left border">
                                    <p><?if (strlen($arProfile["DESCRIPTION"]) > 0):?>
                                        <?=nl2br($arProfile["DESCRIPTION"])?>
                                    <?else:?>
                        <?=nl2br($arDelivery["DESCRIPTION"])?>
                    <?endif;?></p>
                                </div> <!-- end left -->
                                <div class="right border">
                                        <?
                                        $APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => "".SITE_TEMPLATE_PATH."/include_areas/paydel.php",
                                            "EDIT_TEMPLATE" => "standard.php"
                                                ),false
                                        );
                                        ?>
                                </div>
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
                        <?if (!empty($arDelivery["PRICE"])):?><li><span class="ico"><img src="<?=SITE_TEMPLATE_PATH?>/images/delivery-options-price.png" alt="" /></span><span class="name-option"><?=GetMessage("IGIMA_MODDOS_PAYMENT_DELIVERY_BIG")?>:</span><span class="price"><?=$arDelivery["PRICE_FORMATED"]?><span class="rur">i</span></span></li><?endif;?>
                        <?if (!empty($arDelivery["PERIOD_TEXT"])):?><li><span class="ico"><img src="<?=SITE_TEMPLATE_PATH?>/images/delivery-options.png" alt="" /></span><span class="name-option"><?=GetMessage("IGIMA_MODDOS_PAYMENT_DELIVERY_PRICE")?>:</span><?=$arDelivery["PERIOD_TEXT"]?></li><?endif;?>

                                </ul>
                            </div> <!-- end left -->
                            <div class="right">
                                    <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");?>
                            </div>
                            <div class="clear"></div>
                            <div class="left border">
                                <p><?if (strlen($arProfile["DESCRIPTION"]) > 0):?>
                                    <?=nl2br($arProfile["DESCRIPTION"])?>
                <?else:?>
                    <?=nl2br($arDelivery["DESCRIPTION"])?>
                <?endif;?></p>
                            </div> <!-- end left -->
                            <div class="right border">
                                    <?
                                    $APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => "".SITE_TEMPLATE_PATH."/include_areas/paydel.php",
                                        "EDIT_TEMPLATE" => "standard.php"
                                            ),false
                                    );
                                    ?>
                            </div>
                        </div> <!-- end delivery-item -->
                            <?endif;?>
                            <?
                        }
                    }
                    ?>
        </div>
            <?
        }
        ?>
</div>