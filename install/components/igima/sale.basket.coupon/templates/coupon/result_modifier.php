<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
if (!empty($_REQUEST["COUPON"]) && !$arResult["VALID_COUPON"])
{
    $arResult["NOT_VALID_COUPON"] = $_REQUEST["COUPON"];
}
if (!empty($arResult['ITEMS']))
{
    foreach ($arResult['ITEMS'] as $typ => $arType)
    {
	foreach($arType as $cnt => $arCart)
        {
            $mxResult = CCatalogSku::GetProductInfo($arCart["PRODUCT_ID"]);
            $PROD_ID = $mxResult['ID'];
            if (!empty($PROD_ID))
            {
                $res = CIBlockElement::GetByID($PROD_ID);
                if($ar_res = $res->GetNext())
                {
                    $name = trim($arCart["NAME"]);
                    if (empty($name))
                        $arResult['ITEMS'][$typ][$cnt]["NAME"] = $ar_res["NAME"];
                    $arResult['ITEMS'][$typ][$cnt]["DATE_ACTIVE_FROM"] = $ar_res["DATE_ACTIVE_FROM"];

                }
            }
            
            $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_size')))->fetch();
            if (!isset($hlblock['ID']))
            continue;
            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();
            $rsPropEnums = $entity_data_class::getList(array());
            while ($arEnum = $rsPropEnums->fetch())
            {
                if ($arEnum["UF_XML_ID"] == $arCart["PROPERTY_SIZ_VALUE"])
                $arResult['ITEMS'][$typ][$cnt]["PROPERTY_SIZ_VALUE"] = $arEnum["UF_NAME"];
            }
            $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_color')))->fetch();
            if (!isset($hlblock['ID']))
            continue;
            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();
            $rsPropEnums = $entity_data_class::getList(array());
            while ($arEnum = $rsPropEnums->fetch())
            {
                if ($arEnum["UF_XML_ID"] == $arCart["PROPERTY_COL_VALUE"])
                {
                    $arResult['ITEMS'][$typ][$cnt]["PROPERTY_COL_VALUE"] = $arEnum["UF_COLCODE"];
                    $arResult['ITEMS'][$typ][$cnt]["PROPERTY_COL_NAME"] = $arEnum["UF_NAME"];
                }
            }
            $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_brand')))->fetch();
            if (!isset($hlblock['ID']))
            continue;
            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();
            $rsPropEnums = $entity_data_class::getList(array());
            while ($arEnum = $rsPropEnums->fetch())
            {
                if ($arEnum["UF_XML_ID"] == $arCart["PROPERTY_BRA_VALUE"])
                {
                    $arResult['ITEMS'][$typ][$cnt]["PROPERTY_BRA_VALUE"] = $arEnum["UF_LINK"];
                    $arResult['ITEMS'][$typ][$cnt]["PROPERTY_BRA_NAME"] = $arEnum["UF_NAME"];
                }
            }
        
        }
    }		
}
?>
