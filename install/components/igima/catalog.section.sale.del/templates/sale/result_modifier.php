<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
if (!empty($arResult['ITEMS']))
{
	foreach($arResult['ITEMS'] as $cnt => $arItems)
        {
            foreach ($arItems["PROPERTIES"]["OCO"]["VALUE"] as $col => $arOco)
            {
                $arFilter = Array(
                    "IBLOCK_ID"=>1, 
                    "ID"=>$arOco
                );
                $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array("ID","DETAIL_PAGE_URL", "PROPERTY_COL"));
                while($ar_fields = $res->GetNext())
                {
                    $arResult['ITEMS'][$cnt]["PROPERTIES"]["OCO"]["DETAIL_PAGE_URL"][$col] = $ar_fields["DETAIL_PAGE_URL"];
                    $arResult['ITEMS'][$cnt]["PROPERTIES"]["OCO"]["COLOR_ID"][$col] = $ar_fields["PROPERTY_COL_VALUE"];
                    $ar_res = CCatalogProduct::GetByID($ar_fields["ID"]);
                    $arResult['ITEMS'][$cnt]["PROPERTIES"]["OCO"]["QUANTITY"][$col] = $ar_res["QUANTITY"];
                }
            }
            $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => $arItems["DISPLAY_PROPERTIES"]["BRA"]['USER_TYPE_SETTINGS']['TABLE_NAME'])))->fetch();
            if (!isset($hlblock['ID']))
            continue;
            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();
            $rsPropEnums = $entity_data_class::getList(array());
            while ($arEnum = $rsPropEnums->fetch())
            {
                if ($arEnum["UF_XML_ID"] == $arItems["DISPLAY_PROPERTIES"]["BRA"]["VALUE"])
                $arResult['ITEMS'][$cnt]["DISPLAY_PROPERTIES"]["BRA"]["UF_LINK"] = $arEnum["UF_LINK"];				
            }
            $hlblock_off = \Bitrix\Highloadblock\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => $arItems["DISPLAY_PROPERTIES"]["COL"]['USER_TYPE_SETTINGS']['TABLE_NAME'])))->fetch();
            if (!isset($hlblock_off['ID']))
            continue;
            $entity_off = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock_off);
            $entity_data_class_off = $entity_off->getDataClass();
            $rsPropEnums_off = $entity_data_class_off::getList(array());
            while ($arEnum_off = $rsPropEnums_off->fetch())
            {
                if ($arEnum_off["UF_XML_ID"] == $arItems["DISPLAY_PROPERTIES"]["COL"]["VALUE"])
                $arResult['ITEMS'][$cnt]["DISPLAY_PROPERTIES"]["COL"]["UF_COLCODE"] = $arEnum_off["UF_COLCODE"];
                $arResult['COLORS'][$arEnum_off["UF_XML_ID"]] = $arEnum_off["UF_COLCODE"];
            }
        
        }
			
}
?>
