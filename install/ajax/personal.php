<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include.php");

	global $USER;
?>
<?
if (!empty($_REQUEST["avatar-remove"]))
{
         $arFile['del'] = "Y";           
         $arFile['old_file'] = $UI['PERSONAL_PHOTO']; 

        $fields = array(
	    "PERSONAL_PHOTO" => $arFile,
        );


	$user = new CUser;
        $user->Update($USER->GetID(), $fields);
}
if (!empty($_REQUEST["avatar-save"]))
{
$filename = $_FILES["file"]["name"];

        $fields = array(
	    "PERSONAL_PROFESSION" => $filename
        );
	$user = new CUser;
        $user->Update($USER->GetID(), $fields);
}

if (!empty($_REQUEST["general-save"]))
{
$name = $_REQUEST["name"];
$names = explode(" ", $name);

if(!empty($_REQUEST["phoneru"]))
{
	$phones = $_REQUEST["phoneru"];
	$phonecountry = "ru";
}
else if(!empty($_REQUEST["phoneua"]))
{
	$phones = $_REQUEST["phoneua"];
	$phonecountry = "ua";
}
else if(!empty($_REQUEST["phonekz"]))
{
	$phones = $_REQUEST["phonekz"];
	$phonecountry = "kz";
}
else if(!empty($_REQUEST["phoneby"]))
{
	$phones = $_REQUEST["phoneby"];
	$phonecountry = "by";
}

        $fields = array(
	    "NAME" => $names[1],
	    "LAST_NAME" => $names[0],
	    "SECOND_NAME" => $names[2],
	    "EMAIL" => $_REQUEST["email"],
	    "LOGIN" => $_REQUEST["email"],
	    "PERSONAL_MOBILE" => $phones,
	    "PERSONAL_BIRTHDAY" => $_REQUEST["birthday"],
	    "WORK_PHONE" => $phonecountry
        );
	$user = new CUser;
        $user->Update($USER->GetID(), $fields);
}

if (!empty($_REQUEST["address-save"]))
{
        $fields = array(
	    "PERSONAL_CITY" => $_REQUEST["city"],
	    "PERSONAL_ZIP" => $_REQUEST["zip"],
	    "PERSONAL_STREET" => $_REQUEST["street"],
	    "UF_HOUSE" => $_REQUEST["house"],
	    "UF_APARTAMENTS" => $_REQUEST["apartaments"],
        );
	$user = new CUser;
        $user->Update($USER->GetID(), $fields);
}

if (!empty($_REQUEST["password-save"]))
{
if($_REQUEST["enpass"] == $_REQUEST["enpassagain"])
{
        $fields = array(
	    "PASSWORD" => $_REQUEST["enpass"]
        );
	$user = new CUser;
        $user->Update($USER->GetID(), $fields);
}
}

if (!empty($_REQUEST["order-cancel"]))
{
if (CModule::IncludeModule("sale"))
{
$arOrder = CSaleOrder::GetByID($_REQUEST["orderid"]);
if ($arOrder)
{
   $arFields = array(
      "CANCELED" => "Y",
       "STATUS_ID" => "C"
   );
   CSaleOrder::Update($_REQUEST["orderid"], $arFields);
}
}
}
?>