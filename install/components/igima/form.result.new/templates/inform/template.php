<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
?>
<?
if ($arResult["isFormNote"] != "Y")
{
    ?>
    <?
    if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
    {
        ?>

        <?
        /*         * *********************************************************************************
          form header
         * ********************************************************************************* */
        if ($arResult["isFormTitle"])
        {
            ?>
            <div class="popup-wrap" id="inform-receipt" >
                <?=$arResult["FORM_HEADER"]?>
                <div class="popup inform-receipt">
                    <div class="head">
                        <div class="border"><span class="head-ico"></span><?=$arResult["FORM_TITLE"]?></div>
                    </div> <!-- end head -->
                    <?
                } //endif ;
                ?>
                <?
            } // endif
            ?>
            <?
            /*             * *********************************************************************************
              form questions
             * ********************************************************************************* */
            ?>
            <div class="pop-content">
                <div class="selected-product">
                    <div class="photo"><img src="<?=SITE_TEMPLATE_PATH?>/images/selected-product-img.jpg" alt="" /></div>
                    <div class="right">
                        <p class="title"></p>
                        <p class="rec-art"><?=GetMessage("IGIMA_MODDOS_FORM_ARTICUL")?>: <span></span></p>
                        <p class="rec-size"><?=GetMessage("IGIMA_MODDOS_FORM_SIZE")?>: <span></span></p>
                        <p class="color"><?=GetMessage("IGIMA_MODDOS_FORM_COLOR")?> <span><span></span></span></p>
                    </div> <!-- end right -->
                    <div class="clear"></div>
                </div> <!-- end selected-product -->
                <?foreach ($arResult["arQuestions"] as $FIELD_SID => $arQuestion):?>
                    <?if ($arQuestion["ID"] == 4):?>
                        <span class="entry-form user-name-inp">
                            <span class="desc-inp"><i></i><?=$arQuestion["TITLE"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><span class="red">*</span><?endif;?></span>
                            <input class="callback-name" name="INFORM_NAME" type="text" placeholder="<?=$arQuestion["TITLE"]?>" value="<?=$arQuestion["TITLE"]?>" />
                            <span class="entry-ico" id="f-reg-name"></span>
                            <span class="clear"></span>
                        </span>              
                    <?endif;?>
                    <?if ($arQuestion["ID"] == 7):?>
                        <span class="entry-form user-email-inp user-name-inp">
                            <span class="desc-inp"><i></i><?=$arQuestion["TITLE"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><span class="red">*</span><?endif;?></span>
                            <input class="callback-email" name="INFORM_EMAIL" type="text" placeholder="<?=$arQuestion["TITLE"]?>" value="<?=$arQuestion["TITLE"]?>" />
                            <span class="entry-ico" id="f-email"></span>
                            <span class="hint-error" id="error-femail"><i></i><?=GetMessage("IGIMA_MODDOS_AUTH_ERROR_LOGIN")?></span>
                            <span class="clear"></span>
                        </span>              
                    <?endif;?>
                    <?if ($arQuestion["ID"] == 5):?>
                        <div class="entry-form phone-inp">
                            <span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt="" class="flag" /></span>
                            <input class="mask-input phone-ru" type="text" name="" placeholder="+7 (___) ___-__-__" />
                            <input class="mask-input phone-ua" type="text" name="" placeholder="+380 (___) ___-__-__" />
                            <input class="mask-input phone-kz" type="text" name="" placeholder="+7 (___) ___-__-__" />
                            <input class="mask-input phone-by" type="text" name="" placeholder="+375 (___) ___-__-__" />
                            <ul class="list-country">
                                <li class="first"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt="" /><?=GetMessage("IGIMA_MODDOS_FORM_PHONE_RUS")?></a></li>
                                <li><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt="" /><?=GetMessage("IGIMA_MODDOS_FORM_PHONE_UKR")?></a></li>
                                <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt="" /><?=GetMessage("IGIMA_MODDOS_FORM_PHONE_KAZ")?></a></li>
                                <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt="" /><?=GetMessage("IGIMA_MODDOS_FORM_PHONE_BEL")?></a></li>
                            </ul>
                            <span class="entry-ico"></span>
                            <span id="error-phone-inf" class="hint-error">
                                <i></i>
                                <?=GetMessage("IGIMA_MODDOS_FORM_FORMAT_ERROR")?>
                            </span>
                            <span class="clear"></span>
                        </div>            
                    <?endif;?>
                    <?if ($arQuestion["ID"] == 6):?>
                        <span class="entry-form">
                            <textarea cols="30" rows="10" placeholder="<?=$arQuestion["COMMENTS"]?>" ></textarea>
                        </span>              
                    <?endif;?>
                    <?if ($arQuestion["ID"] == 8):?>
                        <div class="hints hints-left">
                            <span class="hints-arrow"></span>
                            <?=GetMessage("IGIMA_MODDOS_FORM_CHOOSE_SIZE")?>
                        </div>
                        <a href="#" class="button-green" id="inform-but"><?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("IGIMA_MODDOS_FORM_ADD") : $arResult["arForm"]["BUTTON"]);?></a>
                        <div class="bottom">
                            <label class="checkbox checked">
                                <input type="checkbox" value="" name="" checked />
                                <?=$arQuestion["COMMENTS"]?>
                            </label>
                        </div> <!-- end bottom -->
                    <?endif;?>
                <?endforeach;?>
                <?
                if ($arResult["isUseCaptcha"] == "Y")
                {
                    ?>
                    <tr>
                        <th colspan="2"><b><?=GetMessage("IGIMA_MODDOS_FORM_CAPTCHA_TABLE_TITLE")?></b></th>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
                    </tr>
                    <tr>
                        <td><?=GetMessage("IGIMA_MODDOS_FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
                        <td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
                    </tr>
                    <?
                } // isUseCaptcha
                ?>

            </div> <!-- end pop-content -->
        </div> <!-- end popup-->
    </div> <!-- end popup-wrap  callback-popup-->

    <?
} //endif (isFormNote)
?>