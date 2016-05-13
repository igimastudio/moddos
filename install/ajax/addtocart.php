<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include.php");
?>
<? 
if (!empty($_REQUEST["PRODUCT_ID"]))
{
    CModule::IncludeModule("catalog");
        if ($_REQUEST["SUBSCRIBE"] == "Y")
            Add2BasketByProductID($_REQUEST["PRODUCT_ID"],1,array('CAN_BUY'=>'N','SUBSCRIBE'=>'Y'),array());
        else
            Add2BasketByProductID($_REQUEST["PRODUCT_ID"]);   


    if ($_REQUEST["SUBSCRIBE"] == "Y")
    {
        $APPLICATION->IncludeComponent("igima:sale.basket.basket", "sub", array(
            "COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "QUANTITY",
		2 => "PRICE",
		3 => "PROPERTY_BRAND",
		4 => "PROPERTY_COLOR",
		5 => "PROPERTY_SIZE",
            ),
            "PATH_TO_ORDER" => "/ordering/",
            "HIDE_COUPON" => "N",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
            "USE_PREPAYMENT" => "N",
            "QUANTITY_FLOAT" => "N",
            "SET_TITLE" => "N"
            ),
            false
        );
    }
    else 
    {
        $APPLICATION->IncludeComponent("igima:sale.basket.basket", "mds", array(
            "COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "QUANTITY",
		2 => "PRICE",
		3 => "PROPERTY_BRAND",
		4 => "PROPERTY_COLOR",
		5 => "PROPERTY_SIZE",
            ),
            "PATH_TO_ORDER" => "/ordering/",
            "HIDE_COUPON" => "N",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
            "USE_PREPAYMENT" => "N",
            "QUANTITY_FLOAT" => "N",
            "SET_TITLE" => "N"
            ),
            false
        );
    }
}
if (!empty($_REQUEST["FAV_ID"]))
{
    CModule::IncludeModule("catalog");
    Add2BasketByProductID($_REQUEST["FAV_ID"],1,array('CAN_BUY'=>'Y','DELAY'=>'Y'),array());
    $APPLICATION->IncludeComponent("igima:sale.basket.basket", "fav", array(
            "COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "QUANTITY",
		2 => "PRICE",
		3 => "PROPERTY_BRAND",
		4 => "PROPERTY_COLOR",
		5 => "PROPERTY_SIZE",
            ),
            "PATH_TO_ORDER" => "/ordering/",
            "HIDE_COUPON" => "N",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
            "USE_PREPAYMENT" => "N",
            "QUANTITY_FLOAT" => "N",
            "SET_TITLE" => "N"
            ),
            false
        );

}
if (!empty($_REQUEST["BASKET_ITEM_ID"]) && $_REQUEST["DELETE"] == "Y" && CModule::IncludeModule("sale"))
{
    if (CSaleBasket::Delete($_REQUEST["BASKET_ITEM_ID"]))
        echo json_encode(array('DEL'=>"Y"));  
    else
        echo json_encode(array('DEL'=>"N")); 
}
if (!empty($_REQUEST["OFFER_ID"]) && !empty($_REQUEST["QNT"]) && CModule::IncludeModule("sale"))
{
    $arFields = array(
        "QUANTITY" => $_REQUEST["QNT"]
    );
    $result = CSaleBasket::Update($_REQUEST["OFFER_ID"], $arFields);
    if ($result)
     echo json_encode(array('OK'=>"Y"));    
}
if (!empty($_REQUEST["COUPON"]))
{
    $APPLICATION->IncludeComponent("igima:sale.basket.coupon", "coupon", array(
            "COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "QUANTITY",
		2 => "PRICE",
		3 => "PROPERTY_BRAND",
		4 => "PROPERTY_COLOR",
		5 => "PROPERTY_SIZE",
            ),
            "PATH_TO_ORDER" => "/ordering/",
            "HIDE_COUPON" => "N",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
            "USE_PREPAYMENT" => "N",
            "QUANTITY_FLOAT" => "N",
            "SET_TITLE" => "N"
            ),
            false
    );
}
if (!empty($_REQUEST["OFFER_ID"]) && $_REQUEST["SEND_TO_CART"] == "Y" && CModule::IncludeModule("sale"))
{
    $arFields = array(
        "DELAY" => "N",
        "SUBSCRIBE" => "N"
    );
    if (CSaleBasket::Update($_REQUEST["OFFER_ID"], $arFields))
    {
        $APPLICATION->IncludeComponent("igima:sale.basket.basket", "cart", array(
            "COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "QUANTITY",
		2 => "PRICE",
		3 => "PROPERTY_BRAND",
		4 => "PROPERTY_COLOR",
		5 => "PROPERTY_SIZE",
            ),
            "PATH_TO_ORDER" => "/ordering/",
            "HIDE_COUPON" => "N",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
            "USE_PREPAYMENT" => "N",
            "QUANTITY_FLOAT" => "N",
            "SET_TITLE" => "N"
            ),
            false
        );
    }
}
if (!empty($_REQUEST["OFFER_ID"]) && $_REQUEST["SEND_TO_FAV"] == "Y" && CModule::IncludeModule("sale"))
{
    $arFields = array(
        "DELAY" => "Y",
        "SUBSCRIBE" => "N"
    );
    if (CSaleBasket::Update($_REQUEST["OFFER_ID"], $arFields))
    {
        $APPLICATION->IncludeComponent("igima:sale.basket.basket", "fav", array(
            "COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "QUANTITY",
		2 => "PRICE",
		3 => "PROPERTY_BRAND",
		4 => "PROPERTY_COLOR",
		5 => "PROPERTY_SIZE",
            ),
            "PATH_TO_ORDER" => "/ordering/",
            "HIDE_COUPON" => "N",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
            "USE_PREPAYMENT" => "N",
            "QUANTITY_FLOAT" => "N",
            "SET_TITLE" => "N"
            ),
            false
        );
    }
}
?>