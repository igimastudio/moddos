<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include.php");
if (!empty($_REQUEST["show_review"]))
{
    if(!CModule::IncludeModule("igima.moddos")) return;
    if(!CModule::IncludeModule("sale")) return;
    if (strlen($_REQUEST["PROPERTY_RECOMEND"])>0)
        $GLOBALS['arrFilter'] = array('PROPERTY_RECOMEND_VALUE'=>$_REQUEST["PROPERTY_RECOMEND"]);
    ?>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/reviews.php");?>
    <?
}
if (!empty($_REQUEST["add_review"]))
{
    if(!CModule::IncludeModule("igima.moddos")) return;
    if(!CModule::IncludeModule("sale")) return;
    ?>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/reviews-add.php");?>
    <?
}