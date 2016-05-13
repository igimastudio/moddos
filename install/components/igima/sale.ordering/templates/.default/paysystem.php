<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<div class="step pay-choose" data-step="3">
    <div class="head main-head<?if ($arParams["STEP"] == 3 || ($arParams["STEP"] == 2 && empty($arResult["ERROR"]))):?> active<?endif;?>">
        <?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CH_PAYMENT")?>
        <a href="#" class="close-step"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CLOSE")?></a>
    </div>
    <div class="pay-method"<?if ($arParams["STEP"] == 3 || ($arParams["STEP"] == 2 && empty($arResult["ERROR"]))):?> style='display: block;'<?endif;?>>
        <div class="pay-left">


            <?
            uasort($arResult["PAY_SYSTEM"],"cmpBySort");

            foreach ($arResult["PAY_SYSTEM"] as $arPaySystem)
            {

                if (count($arPaySystem["PSA_LOGOTIP"]) > 0):
                    $imgUrl = $arPaySystem["PSA_LOGOTIP"]["SRC"];
                else:
                    $imgUrl = $templateFolder."/images/logo-default-ps.gif";
                endif;
                if ($arPaySystem["CHECKED"] == "Y"):
                    $curPay["LOGO"] = $imgUrl;
                    $curPay["DESCRIPTION"] = $arPaySystem["DESCRIPTION"];
                endif;
                ?>
                <label class="radio<?if ($arPaySystem["CHECKED"] == "Y"):?> checked<?endif;?>" data-type="paysistem">
                    <input type="radio" value="<?=$arPaySystem["ID"];?>" name="PAY_SYSTEM_ID"<?if ($arPaySystem["CHECKED"] == "Y"):?> checked="checked"<?endif;?> />
                    <span class="photo" style='background: url(<?=$imgUrl?>) no-repeat 0 0;'></span>
                    <span class="arrow"></span>
                </label> <!-- end label.radio -->
                <?
            }
            ?>
        </div> <!-- end pay-left -->
        <div class="wrapper-pay-right">
            <div class="pay-right">
                <?
                foreach ($arResult["PAY_SYSTEM"] as $arPaySystem)
                {
                    ?>
                    <div class="pay-item"<?if ($arPaySystem["CHECKED"] == "Y"):?> style="display: block;"<?endif;?>>
                        <div class="left"><?=$arPaySystem["DESCRIPTION"]?></div> <!-- end left -->
                        <div class="clear"></div>
                        <div class="left border">
                            <?
                            $APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "".SITE_TEMPLATE_PATH."/include_areas/paysystem.php",
                                "EDIT_TEMPLATE" => "standard.php"
                                    ),false
                            );
                            ?>
                        </div> <!-- end left -->
                    </div> <!-- end pay-item -->
                    <?
                }
                ?>
            </div> <!-- end pay-rigth -->
        </div> <!-- end wrapper-pay-right -->
        <div class="clear"></div>
        <a href="#" class="button-red"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CHECK")?></a>
        <a href="#" class="button-green"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_SAVE_CONT")?></a>
        <div class="clear"></div>
    </div> <!-- end pay method -->
    <div class="pay-compl">
        <div class="head compl">
            <?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CH_PAYMENT_BIG")?>
            <a href="#" class="change"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_CHANGE")?></a>
        </div>
        <div class="pay-info-method">
            <span class="photo" style='background: url(<?=$curPay["LOGO"]?>) no-repeat 0 -39px;'></span>
            <?=$curPay["DESCRIPTION"]?>
        </div> <!-- end pay-info-method -->
        <div class="pay-infom">
            <?
            $APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => "".SITE_TEMPLATE_PATH."/include_areas/paysystem.php",
                "EDIT_TEMPLATE" => "standard.php"
                    ),false
            );
            ?>
        </div> <!-- end pay-infom -->
    </div> <!-- end pay-compl -->
</div><!-- end step pay-choose-->
<div class="veil" id="veil-paydel"></div>