<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
?>
<div class="change-password">
    <h6 class="change-pass-titl"><?=GetMessage("IGIMA_MODDOS_CHANGE_PASSWORD");?></h6>
    <span class="entry-form user-name-inp">
        <span class="desc-inp new-pass"><i></i></span>
        <input type="password" name="enpass" value=""> <span class="entry-ico"></span>
        <span class="tool-tip"><?=GetMessage("IGIMA_MODDOS_ENTER_PASSWORD");?></span>
        <span class="clear"></span>
    </span><br />
    <span class="entry-form user-name-inp">
        <span class="desc-inp confirm-pass"><i></i></span>
        <input type="password" name="enpassagain" value=""> <span class="entry-ico"></span>
        <span class="hint-error"><i></i><?=GetMessage("IGIMA_MODDOS_ERROR_TYPE");?></span>
        <span class="tool-tip"><?=GetMessage("IGIMA_MODDOS_ENTER_PASSWORD_AGAIN");?></span>
        <span class="clear"></span>
    </span> <br />

    <a href="#" class="button-green" name="password-save"><?=GetMessage("IGIMA_MODDOS_CHANGE_PASSWORD");?></a>
    <div class="tip-confirm-pass"><?=GetMessage("IGIMA_MODDOS_PASSWORD_CHANGED");?></div>
    <div class="tip-confirm-pass-nchanged"><?=GetMessage("IGIMA_MODDOS_PASSWORD_NOT_CHANGED");?></div>
</div> <!-- end change-password -->