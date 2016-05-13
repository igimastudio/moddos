<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>
<div class="popup-entrance-right">
    <span class="entry-form">
        <input type="text" name="NAME" placeholder="<?=GetMessage("IGIMA_MODDOS_REG_NAME")?>" value="<?=GetMessage("IGIMA_MODDOS_REG_NAME")?>" />
        <span class="entry-ico" id="x-reg-name"></span>
        <span class="hint-error" id="err-reg-name"><i></i><?=GetMessage("IGIMA_MODDOS_AUTH_ERROR_NAME")?></span>
    </span> <!-- end entry-form-->
    <span class="entry-form">
        <input type="text" name="EMAIL" placeholder="E-mail" value="E-mail" />
        <span class="entry-ico"id="x-reg-email"></span>
        <span class="hint-error" id="err-reg-email"><i></i><?=GetMessage("IGIMA_MODDOS_AUTH_ERROR_LOGIN")?></span>
    </span> <!-- end entry-form-->
    <p class="text"><?=GetMessage("IGIMA_MODDOS_REG_DESC")?></p>
    <a href="#" class="button-green" id="but-reg"><?=GetMessage("IGIMA_MODDOS_REGISTER")?></a>
</div> <!-- end popup-entrance-right -->
<div class="clear"></div>
<input type="hidden" name="register_submit_button" value="<?=GetMessage("IGIMA_MODDOS_AUTH_REGISTER")?>" />