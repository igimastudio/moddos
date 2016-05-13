<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
foreach ($arResult['SECTIONS'] as $key => $arSection)
{
    if ($arSection["DEPTH_LEVEL"] == 1)
    {
        $arFilter = Array(
            "IBLOCK_ID"=>$arSection["IBLOCK_ID"],
            "SECTION_ID"=>$arSection["ID"]
        );
        $arResult['SECTIONS'][$key]["SECTIONS_COUNT"] = CIBlockSection::GetCount($arFilter);
    }
    for ($i=1;$i<5;$i++)
    {     
        if (!empty($arSection["UF_INNERBAN".$i.""]))
        {
            $res = CIBlockElement::GetByID($arSection["UF_INNERBAN".$i.""]);
            if($ar_res = $res->GetNext())
            {
                $arResult['SECTIONS'][$key]["UF_INNERBAN".$i.""] = $ar_res['DETAIL_TEXT'];
                $arResult['SECTIONS'][$key]["~UF_INNERBAN".$i.""] = $ar_res['~DETAIL_TEXT'];
            }
        }
    }
    for ($j=1;$j<4;$j++)
    {     
        if (!empty($arSection["UF_OUTER".$j.""]))
        {
            $res = CIBlockElement::GetByID($arSection["UF_OUTER".$j.""]);
            if($ar_res = $res->GetNext())
            {
                $arResult['SECTIONS'][$key]["UF_OUTER".$j.""] = $ar_res['DETAIL_TEXT'];
                $arResult['SECTIONS'][$key]["~UF_OUTER".$j.""] = $ar_res['~DETAIL_TEXT'];
            }
        }
    }
}
?>