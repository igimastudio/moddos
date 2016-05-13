<?
if (count($arResult["ITEMS"]) < (($arParams["PAGE_ELEMENT_COUNT"] * 2) + 1))
{
    $arFilter = Array(
        "IBLOCK_ID" => $arResult["IBLOCK_ID"],
        "SECTION_ID" => $arResult["ID"],
        "INCLUDE_SUBSECTIONS" => "Y",
        "ACTIVE" => "Y"
    );
    $arNavParams = array(
        "nPageSize" => 0,
        "bShowAll" => "Y",
    );
    $res = CIBlockElement::GetList(Array($arParams["ELEMENT_SORT_FIELD"] => $arParams["ELEMENT_SORT_ORDER"]),$arFilter,false,$arNavParams,Array("ID","PREVIEW_PICTURE"));
    while ($ar_fields = $res->GetNext())
    {
        $arItems[] = $ar_fields;
    }
    if ($arResult["ITEMS"][0]["RANK"] == 1)
    {

        $cnt = count($arItems);
        array_unshift($arResult["ITEMS"],array_pop($arItems));
        $arResult["ITEMS"][0]["RANK"] = $cnt;
        $arResult["ITEMS"][0]["PREVIEW_PICTURE"] = (0 < $arResult["ITEMS"][0]["PREVIEW_PICTURE"] ? CFile::GetFileArray($arResult["ITEMS"][0]["PREVIEW_PICTURE"]) : false);
    } elseif ($arResult["ITEMS"][0]["RANK"] == ($arResult["ELEMENT_CNT"] - $arParams["PAGE_ELEMENT_COUNT"]))
    {
        $nct = array_push($arResult["ITEMS"],array_shift($arItems));
        $arResult["ITEMS"][$nct - 1]["RANK"] = 1;
        $arResult["ITEMS"][$nct - 1]["PREVIEW_PICTURE"] = (0 < $arResult["ITEMS"][$nct - 1]["PREVIEW_PICTURE"] ? CFile::GetFileArray($arResult["ITEMS"][$nct - 1]["PREVIEW_PICTURE"]) : false);
    }
}
?>