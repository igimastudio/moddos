<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<?
if (!empty($arResult['ITEMS']))
{
    foreach ($arResult['ITEMS'] as $cnt => $arItems)
    {
        $count = 0;
        foreach ($arItems['OFFERS'] as $arOffers)
        {
            $count = $count + $arOffers["CATALOG_QUANTITY"];
        }
        $arResult['ITEMS'][$cnt]["OFFERS_QUANTITY"] = $count;
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => $arItems["DISPLAY_PROPERTIES"]["BRAND"]['USER_TYPE_SETTINGS']['TABLE_NAME'])))->fetch();
        if (!isset($hlblock['ID']))
            continue;
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $rsPropEnums = $entity_data_class::getList(array());
        while ($arEnum = $rsPropEnums->fetch())
        {
            if ($arEnum["UF_XML_ID"] == $arItems["DISPLAY_PROPERTIES"]["BRAND"]["VALUE"])
            {
                $arResult['ITEMS'][$cnt]["DISPLAY_PROPERTIES"]["BRAND"]["UF_LINK"] = $arEnum["UF_LINK"];
                if ($arEnum["UF_FULLDESC"] > 0)
                {
                    $res = CIBlockElement::GetByID($arEnum["UF_FULLDESC"]);
                    if ($ar_res = $res->GetNext())
                        $arResult['ITEMS'][$cnt]["DISPLAY_PROPERTIES"]["BRAND"]["UF_FULLDESC"] = $ar_res;
                }
            }
        }
        $hlblock_off = \Bitrix\Highloadblock\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => $arItems["DISPLAY_PROPERTIES"]["COLOR"]['USER_TYPE_SETTINGS']['TABLE_NAME'])))->fetch();
        if (!isset($hlblock_off['ID']))
            continue;
        $entity_off = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock_off);
        $entity_data_class_off = $entity_off->getDataClass();
        $rsPropEnums_off = $entity_data_class_off::getList(array());
        while ($arEnum_off = $rsPropEnums_off->fetch())
        {
            if ($arEnum_off["UF_XML_ID"] == $arItems["DISPLAY_PROPERTIES"]["COLOR"]["VALUE"])
                $arResult['ITEMS'][$cnt]["DISPLAY_PROPERTIES"]["COLOR"]["UF_COLCODE"] = $arEnum_off["UF_COLCODE"];
            $arResult['COLORS'][$arEnum_off["UF_XML_ID"]] = $arEnum_off["UF_COLCODE"];
        }
        if (is_array($arItems["SECTION"]["PATH"]))
        {
            foreach ($arItems["SECTION"]["PATH"] as $sec_cnt => $arPath)
            {
                $uf_arresult = CIBlockSection::GetList(Array("SORT" => "­­ASC"),Array("IBLOCK_ID" => $arPath["IBLOCK_ID"],"ID" => $arPath["ID"]),false,Array("UF_QVIEW_ADV"));
                if ($uf_value = $uf_arresult->GetNext())
                {
                    if ($uf_value["UF_QVIEW_ADV"] > 0)
                    {
                        $res = CIBlockElement::GetByID($uf_value["UF_QVIEW_ADV"]);
                        if ($ar_res = $res->GetNext())
                        {
                            if (strlen($ar_res['DETAIL_TEXT'])>0)
                                $arResult['ITEMS'][$cnt]["SECTION"]["UF_QVIEW_ADV"] = $ar_res['DETAIL_TEXT'];
                        }
                    }
                }
            }
        }
    }
}
?>