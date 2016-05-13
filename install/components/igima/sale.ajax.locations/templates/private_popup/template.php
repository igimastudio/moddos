<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<input class="choice-location-inp search-suggest" autocomplete="off" type="text" name="cityname" value="<?=$arResult["LOCATION_STRING"]?>" />
<input type="hidden" name="city" value="<?=$arResult['LOCATION_DEFAULT']?>">
<?if ($arParams["SHOW_INC_BASKET"] != "N"):?>
    <label class="checkbox<?if ($arParams["INC_BASKET"] == "Y"):?> checked<?endif?>">
        <input type="checkbox" value="" name=""<?if ($arParams["INC_BASKET"] == "Y"):?> checked<?endif?> />
        <?=GetMessage('IGIMA_MODDOS_INC_CART');?>
    </label>
<?endif;?>
<ul class="choice-location"></ul>
