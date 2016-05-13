<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<div class="ordering-auth">
    <div class="already-buy">
        <h6><?=GetMessage("IGIMA_MODDOS_AUTH_ALREADY_BUY")?></h6>
        <div class="pop-entrance">
            <p class="text"><?=GetMessage("IGIMA_MODDOS_AUTH_IF_BUY")?></p>
            <span class="entry-form">
                <input type="text" name="USER_LOGIN" value="" placeholder="E-mail" />
                <span id="x-email" class="entry-ico"></span>
                <span id="error-email" class="hint-error"><i></i><?=GetMessage("IGIMA_MODDOS_AUTH_ERROR_LOGIN")?></span>
            </span> <!-- end entry-form -->
            <span class="entry-form">
                <input type="password" name="USER_PASSWORD" value="" placeholder="<?=GetMessage("IGIMA_MODDOS_AUTH_PASSWORD")?>" style="color: rgb(165, 165, 165);">
                <span id="x-pasw" class="entry-ico"></span>
                <span id="wrong-pasw" class="hint-error"><i></i><?=GetMessage("IGIMA_MODDOS_AUTH_ERROR_LOGIN")?></span>
            </span> <!-- end entry-form -->
            <a href="#" class="password-reminder"><?=GetMessage("IGIMA_MODDOS_AUTH_FORGOT_PASS")?></a>
            <div class="clear"></div>
            <a href="#" class="button-green" id="profile-entr"><?=GetMessage("IGIMA_MODDOS_AUTH_ENTER_ORDER")?></a>

        </div> <!-- end pop-entrance -->
        <div class="pop-password-reminder">
            <p class="text"><?=GetMessage("IGIMA_MODDOS_AUTH_FORGOT_MESS")?></p>
            <span class="entry-form">
                <input type="text" name="YOUR_EMAIL" placeholder="<?=GetMessage("IGIMA_MODDOS_ENTER_YOUR_EMAIL")?>" value="" />
                <span class="entry-ico" id="x-new-pas"></span>
                <span class="hint-error" id="not-new-pas"><i></i><?=GetMessage("IGIMA_MODDOS_AUTH_ERROR_LOGIN")?></span>
            </span> <!-- end entry-form-->
            <a href="#" class="button-green" id="send-new-pasw"><?=GetMessage("IGIMA_MODDOS_SEND_PASS_TO_EMAIL")?></a>
            <a href="#" class="back"><?=GetMessage("IGIMA_MODDOS_GET_BACK")?></a>
        </div> <!-- end pop-password-reminder -->
    </div> <!-- end alredy-buy -->
    <div class="first-buy">
        <h6><?=GetMessage("IGIMA_MODDOS_FIRST_ORDER")?></h6>
        <p class="text"><?=GetMessage("IGIMA_MODDOS_ORDER_TEXT")?></p>
        <a href="#" class="button-green"><?=GetMessage("IGIMA_MODDOS_AUTH_TO_ENTER_ORDER")?></a>
    </div> <!-- end first-buy -->
    <div class="clear"></div>
    <div class="pop-social">
        <span class='ors'><?=GetMessage("IGIMA_MODDOS_OR")?></span>
        <?foreach ($arResult["AUTH_SERVICES"] as $serv_id => $service):?>
            <a href="#" class="<?=$serv_id?>" data-url='<?=$service["URL"];?>'><span></span><?=GetMessage("IGIMA_MODDOS_AUTH_".$serv_id."");?></a>
        <?endforeach?>
    </div>
</div> <!-- end ordering-auth -->