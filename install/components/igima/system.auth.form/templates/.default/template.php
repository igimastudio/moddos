<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?foreach ($arResult["POST"] as $key => $value):?>
    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
<input type="hidden" name="AUTH_FORM" value="Y" />
<input type="hidden" name="TYPE" value="AUTH" />
<div class="popup-wrap" id="popup-entrance" >
    <div class="popup popup-entrance">
        <div class="head">
            <div class="border">
                <div class="popup-entrance-left">
                    <div class="pop-entrance pop-entrance"><span class="head-ico"></span><?=GetMessage("IGIMA_MODDOS_AUTH_ENTER_PROFILE")?></div>
                    <div class="pop-password-reminder"><span class="head-ico"></span><?=GetMessage("IGIMA_MODDOS_AUTH_FORGOT_PASSWORD")?></div>
                </div> <!-- end popup-entrance-left -->
                <div class="popup-entrance-right"><span class="head-ico"></span><?=GetMessage("IGIMA_MODDOS_QUICK_REGISTER")?></div> <!-- end popup-entrance-right -->
                <div class="clear"></div>
            </div> <!-- end border -->
        </div> <!-- end head -->
        <div class="pop-content">
            <div class="popup-entrance-left pop-entrance">
                <span class="entry-form">
                    <input type="text" name="USER_LOGIN" placeholder="E-mail" value="E-mail" />
                    <span class="entry-ico" id="x-email"></span>
                    <span class="hint-error" id="error-email"><i></i><?=GetMessage("IGIMA_MODDOS_AUTH_ERROR_LOGIN")?></span>
                </span> <!-- end entry-form-->
                <span class="entry-form">
                    <input type="password" name="USER_PASSWORD" placeholder="<?=GetMessage("IGIMA_MODDOS_AUTH_PASSWORD")?>" value="<?=GetMessage("IGIMA_MODDOS_AUTH_PASSWORD")?>" />
                    <span class="entry-ico" id="x-pasw"></span>
                    <span class="hint-error" id="wrong-pasw"><i></i><?=GetMessage("IGIMA_MODDOS_AUTH_ERROR_PASW")?></span>
                </span> <!-- end entry-form-->
                <a href="#" class="password-reminder"><?=GetMessage("IGIMA_MODDOS_AUTH_FORGOT_PASS")?></a>
                <a href="#" class="button-green" id="profile-entr"><?=GetMessage("IGIMA_MODDOS_AUTH_LOGIN_BUTTON")?></a>
            </div><!-- end popup-entrance-left pop-entrance -->
            <div class="popup-entrance-left pop-password-reminder">
                <p class="text"><?=GetMessage("IGIMA_MODDOS_AUTH_FORGOT_MESS")?></p>
                <span class="entry-form">
                    <input type="text" name="YOUR_EMAIL" placeholder="<?=GetMessage("IGIMA_MODDOS_ENTER_YOUR_EMAIL")?>" value="<?=GetMessage("IGIMA_MODDOS_ENTER_YOUR_EMAIL")?>" />
                    <span class="entry-ico" id="x-new-pas"></span>
                    <span class="hint-error" id="not-new-pas"><i></i><?=GetMessage("IGIMA_MODDOS_NEW_PASS_ERROR")?></span>
                </span> <!-- end entry-form-->
                <a href="#" class="button-green" id="send-new-pasw"><?=GetMessage("IGIMA_MODDOS_SEND_PASS_TO_EMAIL")?></a>
                <a href="#" class="back"><?=GetMessage("IGIMA_MODDOS_GET_BACK")?></a>
            </div> <!-- end popup-entrance-left -->
            <?
            $APPLICATION->IncludeComponent(
                    "igima:main.register","mds",Array(
                "USER_PROPERTY_NAME" => "",
                "SHOW_FIELDS" => array("NAME","LAST_NAME"),
                "REQUIRED_FIELDS" => array(),
                "AUTH" => "Y",
                "USE_BACKURL" => "N",
                "SUCCESS_PAGE" => "",
                "SET_TITLE" => "N",
                "USER_PROPERTY" => array()
                    ),false
            );
            ?>
            <p class="pop-line"><span class="line-middle"></span><span><?=GetMessage("IGIMA_MODDOS_OR")?></span></p>
            <div class="pop-social">
                <?foreach ($arResult["AUTH_SERVICES"] as $serv_id => $service):?>
                    <a href="#" class="<?=$serv_id?>" data-url='<?=$service["URL"];?>'><span></span><?=GetMessage("IGIMA_MODDOS_AUTH_".$serv_id."");?></a>
                <?endforeach?>
            </div> <!-- end pop-social -->
            <div class="clear"></div>
        </div> <!-- end pop-content -->
    </div> <!-- end popup-->
</div> <!-- end popup-wrap  popup-entrance -->