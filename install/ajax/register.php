<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include.php");
?>
<?$APPLICATION->IncludeComponent(
    "igima:main.register",
    "empty",
    Array(
        "USER_PROPERTY_NAME" => "",
        "SHOW_FIELDS" => array("NAME", "LAST_NAME"),
        "REQUIRED_FIELDS" => array(),
        "AUTH" => "Y",
        "USE_BACKURL" => "N",
        "SUCCESS_PAGE" => "",
        "SET_TITLE" => "N",
        "USER_PROPERTY" => array()
    ),
    false
);?>
