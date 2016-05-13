<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include.php");
?>
<?
if (CModule::IncludeModule("catalog"))
{
    if (!empty($_REQUEST["AJAX_QUERY"]))
        $ajax_query = $_REQUEST["AJAX_QUERY"];
    else
        $ajax_query = "Y";
    ob_start();
    ?>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/filter-showcase.php");?>
    <?
    $filter = ob_get_contents();
    ob_end_clean();
    switch ($_REQUEST["CATALOG_SORT"]) 
    {
        case "SHOWS":
            $SORT = "shows";
            $ORDER = "asc";
        break;
        case "PRICE_ASC":
            $BASE_PRICE = CCatalogGroup::GetBaseGroup();
            $SORT = "catalog_PRICE_".$BASE_PRICE["ID"]."";
            $ORDER = "asc";
        break;
        case "PRICE_DESC":
            $BASE_PRICE = CCatalogGroup::GetBaseGroup();
            $SORT = "catalog_PRICE_".$BASE_PRICE["ID"]."";
            $ORDER = "desc";
        break;
        case "NOVELTY":
            $SORT = "active_from";
            $ORDER = "desc";
        break;
        case "RAND":
            $SORT = "rand";
            $ORDER = "asc";
        break;
        case "DISCOUNT":
            $SORT = "PROPERTY_SALE";
            $ORDER = "desc";
        break;
        default:
            $SORT = "name";
            $ORDER = "asc";
    }
    $GLOBALS["SHOWCASE_SORT"] = $SORT;
    $GLOBALS["SHOWCASE_ORDER"] = $ORDER;
    $GLOBALS["FILTER_DISCOUNT"] = $_REQUEST["FILTER_DISCOUNT"];
    $GLOBALS["FILTER_NOVELTY"] = $_REQUEST["FILTER_NOVELTY"];
    $GLOBALS["FILTER_NOVELTY_COUNT"] = $_REQUEST["FILTER_NOVELTY_COUNT"];
    ?>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/showcase.php");?>
    <?
}