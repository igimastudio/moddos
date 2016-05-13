<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");
?>
<div class="step contacts-info">
    <div class="head main-head<?if ($arParams["STEP"] == 2 && !empty($arResult["ERROR"])):?> active<?endif;?>"<?if ($arParams["STEP"] >= 2 && empty($arResult["ERROR"])):?> style='display: none;'<?endif;?>>
        <?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CH_CONT")?>
        <a href="#" class="close-step"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CLOSE")?></a>
    </div>
    <div class="recipient-info"<?if ($arParams["STEP"] == 2 && !empty($arResult["ERROR"])):?> style='display: block;'<?endif;?>>
        <?
        if (!empty($arResult["ERROR"]))
        {
            foreach ($arResult["ERROR"] as $v)
                echo ShowError($v);
        }
        ?>
        <input type="hidden" id="person_type" name="PERSON_TYPE" value="<?=$arResult["USER_VALS"]["PERSON_TYPE_ID"]?>" />
<?
PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_N"],$arParams["TEMPLATE_LOCATION"]);
?>
        <a href="#" class="button-red"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_MOVE_TO_PAY")?></a>
        <a href="#" class="button-red button-green"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_SAVE_CONT")?></a>
        <div class="clear"></div>
    </div> <!-- end recipient-info -->
    <div class="contacts-compl<?if ($arParams["STEP"] >= 2 && empty($arResult["ERROR"])):?> complete-info<?endif;?>"<?if ($arParams["STEP"] >= 2 && empty($arResult["ERROR"])):?> style='display: block;'<?endif;?>>
        <div class="head compl">
            <?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CH_CONT")?>
            <a href="#" class="change"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CHANGE")?></a>
        </div>
<?$fst = true;?>
            <?foreach ($arResult["ORDER_PROP"]["USER_PROPS_N"] as $code => $arProperties):?>
                <?if (is_array($arProperties) && $arProperties["CODE"] != "flat" && $arProperties["CODE"] != "house"):?>
                    <?if ($fst && $arProperties["SHOW_GROUP_NAME"] == "Y"):?>
                    <div class="reciew-info">
                        <h6 class="reciew"><?=$arProperties["GROUP_NAME"]?></h6>
            <?$fst = false;?>
                    <?elseif (!$fst && $arProperties["SHOW_GROUP_NAME"] == "Y"):?>
                        <br />
                    </div> <!-- end reciew-info -->
                    <div class="address-reciew-infom">
                        <h6 class="address-reciew"><?=$arProperties["GROUP_NAME"]?></h6>
                        <?endif;?>
                    <?if ($arProperties["CODE"] == "street"):?>
                        <p><span class="param"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_ADRESS")?>:</span>
                            <?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_STREET")?><?=$arProperties["VALUE"]?><?if (strlen($arResult["ORDER_PROP"]["USER_PROPS_N"]["house"]["VALUE"]) > 0):?>, <?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_HOUSE")?><?=$arResult["ORDER_PROP"]["USER_PROPS_N"]["house"]["VALUE"]?><?endif;?>
                        <?if (strlen($arResult["ORDER_PROP"]["USER_PROPS_N"]["flat"]["VALUE"]) > 0):?>, <?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_ROOM")?><?=$arResult["ORDER_PROP"]["USER_PROPS_N"]["flat"]["VALUE"]?><?endif;?>
                        </p>
                    <?elseif ($arProperties["CODE"] == "zipcode"):?>
                        <p><span class="param"><?=$arProperties["NAME"]?>:</span> <?=$arResult["USER_VALS"]["ORDER_PROP"][$code]?></p>
                    <?else:?>
                        <p><span class="param"><?=$arProperties["NAME"]?>:</span> <?=$arProperties["VALUE"]?></p>
        <?endif;?>
    <?endif;?>
<?endforeach;?>
        </div> <!-- address-reciew-infom -->
    </div> <!-- end contacts-compl -->
</div> <!-- end contacts-info -->