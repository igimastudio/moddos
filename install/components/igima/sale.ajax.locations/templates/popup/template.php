<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->AddHeadScript("/bitrix/js/main/cphttprequest.js");

if ($arParams["AJAX_CALL"] != "Y"
	&& count($arParams["LOC_DEFAULT"]) > 0
	&& $arParams["PUBLIC"] != "N"
	&& $arParams["SHOW_QUICK_CHOOSE"] == "Y"):

	$isChecked = "";
	foreach ($arParams["LOC_DEFAULT"] as $val):
		$checked = "";
		if ((($val["ID"] == IntVal($_REQUEST["NEW_LOCATION_".$arParams["ORDER_PROPS_ID"]])) || ($val["ID"] == $arParams["CITY"])) && (!isset($_REQUEST["CHANGE_ZIP"]) || $_REQUEST["CHANGE_ZIP"] != "Y"))
		{
			$checked = "checked";
			$isChecked = "Y";
		}?>
		<div><input onChange="<?=$arParams["ONCITYCHANGE"]?>;" <?=$checked?> type="radio" name="NEW_LOCATION_<?=$arParams["ORDER_PROPS_ID"]?>" value="<?=$val["ID"]?>" id="loc_<?=$val["ID"]?>" /><label for="loc_<?=$val["ID"]?>"><?=$val["LOC_DEFAULT_NAME"]?></label></div>
	<?endforeach;?>
	<div><input <? if($isChecked!="Y") echo 'checked';?> type="radio" onclick="clearLocInput();" name="NEW_LOCATION_<?=$arParams["ORDER_PROPS_ID"]?>" value="0" id="loc_0" /><label for="loc_0"><?=GetMessage("IGIMA_MODDOS_LOC_DEFAULT_NAME_NULL")?>:</label></div>
<?endif;?>
<div class="search">
    <div class="wrap">
        <input class="choice-location-inp search-suggest" autocomplete="off" type="text" placeholder="<?=GetMessage('IGIMA_MODDOS_CITY_PLHOLDER');?>" name="<?echo $arParams["CITY_INPUT_NAME"]?>_val" id="<?echo $arParams["CITY_INPUT_NAME"]?>_val" value="<?=$arResult["LOCATION_STRING"]?>" />
        <input type="hidden" name="<?echo $arParams["CITY_INPUT_NAME"]?>" id="<?echo $arParams["CITY_INPUT_NAME"]?>" value="<?=$arResult["LOCATION_DEFAULT"]?>">
        <?if ($arParams["SHOW_INC_BASKET"] != "N"):?>
        <label class="checkbox<?if ($arParams["INC_BASKET"] == "Y"):?> checked<?endif?>">
            <input type="checkbox" value="" name=""<?if ($arParams["INC_BASKET"] == "Y"):?> checked<?endif?> />
            <?=GetMessage('IGIMA_MODDOS_INC_CART');?>
	</label>
        <?endif;?>
        <ul class="choice-location"></ul>
    </div> <!-- end wrap -->
    <a href="#" class="button-green"><?=GetMessage('IGIMA_MODDOS_CALC_DELIVERY');?></a>
    <div class="clear"></div>
</div> <!-- end search -->
<script type="text/javascript">

	if (typeof oObject != "object")
		window.oObject = {};

	document.loc_sug_CheckThis = function(oObj, id)
	{
		try
		{
			if(SuggestLoadedSale)
			{
				window.oObject[oObj.id] = new JsSuggestSale(oObj, '<?echo $arResult["ADDITIONAL_VALUES"]?>', '', '', '<?=CUtil::JSEscape($arParams["ONCITYCHANGE"])?>');
				return;
			}
			else
			{
				setTimeout(loc_sug_CheckThis(oObj, id), 10);
			}
		}
		catch(e)
		{
			setTimeout(loc_sug_CheckThis(oObj, id), 10);
		}
	}
	
	clearLocInput = function()
	{				
		var inp = BX("<?echo $arParams["CITY_INPUT_NAME"]?>_val");			
		if(inp)
		{
			inp.value = "";
			inp.focus();
		}
	}	
</script>