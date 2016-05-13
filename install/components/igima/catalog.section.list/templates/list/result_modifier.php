<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$cur_page = $APPLICATION->GetCurPage(true);
    $cur_page_no_index = $APPLICATION->GetCurPage(false);
foreach ($arResult['SECTIONS'] as $key => $arSection)
{

    $SELECTED = CMenu::IsItemSelected($arSection["SECTION_PAGE_URL"], $cur_page, $cur_page_no_index);
    if($SELECTED)
	$arResult['SECTIONS'][$key]['SELECTED'] = true;
}
?>