<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
?>
<?
foreach ($arResult["BASKET_ITEMS"] as $cnt => $arItems)
{
        if (CModule::IncludeModule('highloadblock')) 
        {
                $arHLBlock = \Bitrix\Highloadblock\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_size')))->fetch();
                $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                $strEntityDataClass = $obEntity->getDataClass();
                $resData = $strEntityDataClass::getList(array(
                        'select' => array('ID','UF_NAME'),
                        'filter' => array('UF_XML_ID'=>$arItems["PROPERTY_SIZE_VALUE"]),
                        'order' => array('ID' => 'ASC'),
                        'limit' => 1,
                ));
                while ($arItem = $resData->Fetch()) 
                {
                        $arResult["BASKET_ITEMS"][$cnt]["PROPERTY_SIZE_NAME"] = $arItem["UF_NAME"];
                }
                $arHLBlock = \Bitrix\Highloadblock\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_brand')))->fetch();
                $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                $strEntityDataClass = $obEntity->getDataClass();
                $resData = $strEntityDataClass::getList(array(
                        'select' => array('ID','UF_NAME'),
                        'filter' => array('UF_XML_ID'=>$arItems["PROPERTY_BRAND_VALUE"]),
                        'order' => array('ID' => 'ASC'),
                        'limit' => 1,
                ));
                while ($arItem = $resData->Fetch()) 
                {
                        $arResult["BASKET_ITEMS"][$cnt]["PROPERTY_BRAND_NAME"] = $arItem["UF_NAME"];
                }
                $arHLBlock = \Bitrix\Highloadblock\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_color')))->fetch();
                $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
                $strEntityDataClass = $obEntity->getDataClass();
                $resData = $strEntityDataClass::getList(array(
                        'select' => array('ID','UF_NAME','UF_COLCODE'),
                        'filter' => array('UF_XML_ID'=>$arItems["PROPERTY_COLOR_VALUE"]),
                        'order' => array('ID' => 'ASC'),
                        'limit' => 1,
                ));
                while ($arItem = $resData->Fetch()) 
                {
                        $arResult["BASKET_ITEMS"][$cnt]["PROPERTY_COLOR_NAME"] = $arItem["UF_NAME"];
                        if (!empty($arItem["UF_COLCODE"]))
                                $arResult["BASKET_ITEMS"][$cnt]["PROPERTY_COLOR_COLCODE"] = $arItem["UF_COLCODE"];
                }
        }
}
?>
