<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
?>
<div class="address-info">
    <h6 class="address-reciew"><?=GetMessage("IGIMA_MODDOS_ADDRESS_OF_DELIVERY")?></h6>
    <span class="entry-form user-name-inp input-dropdown" style="position:relative">
        <span class="desc-inp"><i></i><?=GetMessage("IGIMA_MODDOS_USER_CITY")?></span>
        <?
        $APPLICATION->IncludeComponent(
                "igima:sale.ajax.locations","private_popup",Array(
            "CITY_OUT_LOCATION" => "Y",
            "ALLOW_EMPTY_CITY" => "Y",
            "COUNTRY_INPUT_NAME" => "COUNTRY",
            "REGION_INPUT_NAME" => "REGION",
            "CITY_INPUT_NAME" => "LOCATION",
            "LOCATION_VALUE" => $arResult["arUser"]['PERSONAL_CITY'],
            "ONCITYCHANGE" => "",
            "NAME" => "q",
            "SHOW_INC_BASKET" => "N"
                )
        );
        ?>
        <span class="entry-ico"></span>
        <span class="clear"></span>
    </span><br />
    <span class="entry-form user-name-inp">
        <span class="desc-inp"><i></i><?=GetMessage("IGIMA_MODDOS_USER_ZIP")?></span>
        <input type="text" name="zippriv" value="<?=$arResult["arUser"]['PERSONAL_ZIP']?>"> <span class="entry-ico"></span>
        <span class="tool-tip"><?=GetMessage("IGIMA_MODDOS_USER_ENTER_ZIP")?></span>
        <span class="clear"></span>
    </span><br />
    <span class="entry-form user-name-inp">
        <span class="desc-inp"><i></i><?=GetMessage("IGIMA_MODDOS_USER_STREET")?></span>
        <input type="text" name="streetpriv" value="<?=$arResult["arUser"]['PERSONAL_STREET']?>"> <span class="entry-ico"></span>
        <span class="hint-error"><i></i><?=GetMessage("IGIMA_MODDOS_USER_ENTER_ERROR")?></span>
        <span class="tool-tip"><?=GetMessage("IGIMA_MODDOS_USER_ENTER_STREET")?></span>
        <span class="clear"></span>
    </span> <br />
    <span class="entry-form user-name-inp short short1">
        <span class="desc-inp"><i></i><?=GetMessage("IGIMA_MODDOS_USER_HOUSE")?></span>
        <input type="text" name="housepriv" value="<?=$arResult["arUser"]['UF_HOUSE']?>"> <span class="entry-ico"></span>
        <span class="hint-error"><i></i><?=GetMessage("IGIMA_MODDOS_USER_ENTER_ERROR")?></span>
        <span class="tool-tip"><?=GetMessage("IGIMA_MODDOS_USER_ENTER_HOUSE")?></span>
        <span class="clear"></span>
    </span>
    <span class="entry-form user-name-inp short">
        <span class="desc-inp office"><i></i><?=GetMessage("IGIMA_MODDOS_USER_APARTAMENTS")?></span>
        <input type="text" name="aparpriv" value="<?=$arResult["arUser"]['UF_APARTAMENTS']?>"> <span class="entry-ico"></span>
        <span class="tool-tip"><?=GetMessage("IGIMA_MODDOS_USER_ENTER_APARTAMENTS")?></span>
        <span class="clear"></span>
    </span>

    <a href="#" class="button-green" name="address-save"><?=GetMessage("IGIMA_MODDOS_SAVE")?></a>
    <div class="wrapper-tip-confirm">
        <div class="tip-confirm" style="display: none;"><?=GetMessage("IGIMA_MODDOS_PROFILE_DATA_SAVED")?></div>
    </div>
</div> <!-- end address-info -->
