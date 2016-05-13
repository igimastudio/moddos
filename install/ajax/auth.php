<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include.php");
?>
<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "empty", Array(
	"REGISTER_URL" => "",
	"FORGOT_PASSWORD_URL" => "",
	"PROFILE_URL" => "",
	"SHOW_ERRORS" => "Y"
	),
	false
);?>
