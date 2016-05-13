<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

class CBitrixSelectComponent extends CBitrixComponent
{
	public function setSelectedItems($bMultiSelect = false)
	{
		/** @global CMain $APPLICATION */
		global $APPLICATION;

		$cur_page = $APPLICATION->GetCurPage(true);
		$cur_page_no_index = $APPLICATION->GetCurPage(false);

		foreach($this->arResult["SECTIONS"] as $iMenuItem => $MenuItem)
		{
                    if (strlen($MenuItem["SECTION_PAGE_URL"])>0)
                        $SELECTED = CMenu::IsItemSelected($MenuItem["SECTION_PAGE_URL"], $cur_page, $cur_page_no_index);
                    if($SELECTED)
			$this->arResult["SECTIONS"][$iMenuItem]['SELECTED'] = true;
		}
	}
}
