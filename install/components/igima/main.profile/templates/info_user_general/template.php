<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
?>
<div class="recipient-info">
    <h6 class="reciew"><?=GetMessage("IGIMA_MODDOS_ORDER_RECEIVER");?></h6>
    <div class="pop-content">
        <span class="entry-form user-name-inp">
            <span class="desc-inp"><i></i><?=GetMessage("IGIMA_MODDOS_NAME");?></span>
            <input type="text" name="namels" value="<?=$arResult["arUser"]['LAST_NAME']." ".$arResult["arUser"]['NAME']." ".$arResult["arUser"]['SECOND_NAME']?>"> <span class="entry-ico"></span>
            <span class="tool-tip"><?=GetMessage("IGIMA_MODDOS_ENTER_NAME");?></span>
            <span class="clear"></span>
        </span> <!-- end entry-form user-name-inp --> <br>
        <span class="entry-form user-name-inp">
            <span class="desc-inp"><i></i><?=GetMessage("IGIMA_MODDOS_EMAIL");?></span>
            <input type="text" name="emailprivate" value="<?=$arResult["arUser"]['EMAIL']?>" > <span class="entry-ico"></span>
            <span class="hint-error"><i></i><?=GetMessage("IGIMA_MODDOS_ERROR_TYPE");?></span>
            <span class="tool-tip"><?=GetMessage("IGIMA_MODDOS_ENTER_EMAIL");?></span>
            <span class="clear"></span>
        </span> <!-- end entry-form user-name-inp --> <br>
        <div class="entry-form phone-inp">
                <!--span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt="" class="flag"></span-->
            <?if ($arResult["arUser"]['WORK_PHONE'] == "ru"):?>

                <span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt="" class="flag"></span>
                <input class="mask-input phone-ru" type="text" name="pmobileru" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165);" value="<?=$arResult["arUser"]['PERSONAL_MOBILE']?>">
                <input class="mask-input phone-ua" type="text" name="pmobileua" placeholder="+380 (___) ___-__-__" style="color: rgb(165, 165, 165);">
                <input class="mask-input phone-kz" type="text" name="pmobilekz" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165);">
                <input class="mask-input phone-by" type="text" name="pmobileby" placeholder="+375 (___) ___-__-__" style="color: rgb(165, 165, 165);">

                <ul class="list-country">
                    <li class="first"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt=""><?=GetMessage("IGIMA_MODDOS_RUSSIA");?></a></li>
                    <li><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt=""><?=GetMessage("IGIMA_MODDOS_UKRAINE");?></a></li>
                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt=""><?=GetMessage("IGIMA_MODDOS_KAZAKHSTAN");?></a></li>
                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt=""><?=GetMessage("IGIMA_MODDOS_BYLARUS");?></a></li>
                </ul>

            <?endif?>
            <?if ($arResult["arUser"]['WORK_PHONE'] == "ua"):?>
                <span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt="" class="flag"></span>
                <input class="mask-input phone-ru" type="text" name="pmobileru" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165); display: none;" >
                <input class="mask-input phone-ua" type="text" name="pmobileua" placeholder="+380 (___) ___-__-__" style="color: rgb(165, 165, 165); display: inline" value="<?=$arResult["arUser"]['PERSONAL_MOBILE']?>">
                <input class="mask-input phone-kz" type="text" name="pmobilekz" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165);">
                <input class="mask-input phone-by" type="text" name="pmobileby" placeholder="+375 (___) ___-__-__" style="color: rgb(165, 165, 165);">

                <ul class="list-country">
                    <li class="first" style="display:block"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt=""><?=GetMessage("IGIMA_MODDOS_RUSSIA");?></a></li>
                    <li style="display:none"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt=""><?=GetMessage("IGIMA_MODDOS_UKRAINE");?></a></li>
                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt=""><?=GetMessage("IGIMA_MODDOS_KAZAKHSTAN");?></a></li>
                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt=""><?=GetMessage("IGIMA_MODDOS_BYLARUS");?></a></li>
                </ul>
            <?endif?>

            <?if ($arResult["arUser"]['WORK_PHONE'] == "kz"):?>
                <span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt="" class="flag"></span>
                <input class="mask-input phone-ru" type="text" name="pmobileru" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165); display: none;" >
                <input class="mask-input phone-ua" type="text" name="pmobileua" placeholder="+380 (___) ___-__-__" style="color: rgb(165, 165, 165); display: none">
                <input class="mask-input phone-kz" type="text" name="pmobilekz" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165); display: inline" value="<?=$arResult["arUser"]['PERSONAL_MOBILE']?>" >
                <input class="mask-input phone-by" type="text" name="pmobileby" placeholder="+375 (___) ___-__-__" style="color: rgb(165, 165, 165);">

                <ul class="list-country">
                    <li class="first" style="display:block"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt=""><?=GetMessage("IGIMA_MODDOS_RUSSIA");?></a></li>
                    <li><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt=""><?=GetMessage("IGIMA_MODDOS_UKRAINE");?></a></li>
                    <li style="display:none"><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt=""><?=GetMessage("IGIMA_MODDOS_KAZAKHSTAN");?></a></li>
                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt=""><?=GetMessage("IGIMA_MODDOS_BYLARUS");?></a></li>
                </ul>
            <?endif?>

            <?if ($arResult["arUser"]['WORK_PHONE'] == "by"):?>
                <span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt="" class="flag"></span>
                <input class="mask-input phone-ru" type="text" name="pmobileru" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165); display: none;" >
                <input class="mask-input phone-ua" type="text" name="pmobileua" placeholder="+380 (___) ___-__-__" style="color: rgb(165, 165, 165); display: none">
                <input class="mask-input phone-kz" type="text" name="pmobilekz" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165); display: none">
                <input class="mask-input phone-by" type="text" name="pmobileby" placeholder="+375 (___) ___-__-__" style="color: rgb(165, 165, 165); display: inline" value="<?=$arResult["arUser"]['PERSONAL_MOBILE']?>" >

                <ul class="list-country">
                    <li class="first" style="display:block"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt=""><?=GetMessage("IGIMA_MODDOS_RUSSIA");?></a></li>
                    <li><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt=""><?=GetMessage("IGIMA_MODDOS_UKRAINE");?></a></li>
                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt=""><?=GetMessage("IGIMA_MODDOS_KAZAKHSTAN");?></a></li>
                    <li style="display:none"><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt=""><?=GetMessage("IGIMA_MODDOS_BYLARUS");?></a></li>
                </ul>
            <?endif?>

            <?if (empty($arResult["arUser"]['WORK_PHONE'])):?>

                <span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt="" class="flag"></span>
                <input class="mask-input phone-ru" type="text" name="pmobileru" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165);" value="<?=$arResult["arUser"]['PERSONAL_MOBILE']?>">
                <input class="mask-input phone-ua" type="text" name="pmobileua" placeholder="+380 (___) ___-__-__" style="color: rgb(165, 165, 165);">
                <input class="mask-input phone-kz" type="text" name="pmobilekz" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165);">
                <input class="mask-input phone-by" type="text" name="pmobileby" placeholder="+375 (___) ___-__-__" style="color: rgb(165, 165, 165);">

                <ul class="list-country">
                    <li class="first"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt=""><?=GetMessage("IGIMA_MODDOS_RUSSIA");?></a></li>
                    <li><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt=""><?=GetMessage("IGIMA_MODDOS_UKRAINE");?></a></li>
                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt=""><?=GetMessage("IGIMA_MODDOS_KAZAKHSTAN");?></a></li>
                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt=""><?=GetMessage("IGIMA_MODDOS_BYLARUS");?></a></li>
                </ul>

            <?endif?>

            <span class="entry-ico"></span>
            <span class="tool-tip"><?=GetMessage("IGIMA_MODDOS_ENTER_PHONE");?></span>
            <span class="clear"></span>
        </div> <!-- end entry-form phone-inp --> <br>
        <span class="entry-form user-name-inp born-date">
            <span class="desc-inp"><i></i><?=GetMessage("IGIMA_MODDOS_BIRTHDAY");?></span>
            <input type="text" name="your-birthdate" value="<?=$arResult["arUser"]['PERSONAL_BIRTHDAY']?>" class="datepicker" /> <span class="entry-ico"></span>
            <span class="clear"></span>
        </span> <!-- end entry-form user-name-inp -->
        <div class="question">
            <span class="tool-tip ofquestion"><?=GetMessage("IGIMA_MODDOS_ENTER_BIRTHDAY");?></span>
        </div>
        <a href="#" class="button-green" name="general-save"><?=GetMessage("IGIMA_MODDOS_SAVE_CHANGES");?></a>
        <div class="wrapper-tip-confirm">
            <div class="tip-confirm" style="display: none;"><?=GetMessage("IGIMA_MODDOS_CHANGES_SAVED");?></div>
            <div class="tip-confirm-nchanged" style="display: none;"><?=GetMessage("IGIMA_MODDOS_CHANGES_NOT_SAVED");?></div>
        </div>
    </div> <!-- end pop-content -->
    <div class="sing-in-menu">
        <?if ($arResult["arUser"]["UF_AUTH_SERVICE"] == NULL):?>
            <div class="about-profile modd"><?=GetMessage("IGIMA_MODDOS_AUTH_PROFILE");?></div>
        <?endif?>
        <?if ($arResult["arUser"]["UF_AUTH_SERVICE"] == "tw"):?>
            <div class="about-profile twit"><?=GetMessage("IGIMA_MODDOS_AUTH_tw");?></div>
        <?endif?>
        <?if ($arResult["arUser"]["UF_AUTH_SERVICE"] == "vk"):?>
            <div class="about-profile vkon"><?=GetMessage("IGIMA_MODDOS_AUTH_vk");?></div>
        <?endif?>
        <?if ($arResult["arUser"]["UF_AUTH_SERVICE"] == "fb"):?>
            <div class="about-profile face"><?=GetMessage("IGIMA_MODDOS_AUTH_fb");?></div>
        <?endif?>
        <a href="/?logout=yes" class="exit-priv-office"><?=GetMessage("IGIMA_MODDOS_LOGOUT");?></a>
    </div> <!-- end sing-in-menu -->
    <div class="clear"></div>
</div> <!-- end recipient-info -->