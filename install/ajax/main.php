<?
use \Bitrix\Catalog\CatalogViewedProductTable as CatalogViewedProductTable;
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include.php");
IncludeTemplateLangFile(__FILE__);
CModule::IncludeModule("igima.moddos");
?>
<?
if (!empty($_REQUEST["submail"]))
{
    if(CModule::IncludeModule("subscribe"))
    {  
        $subscription = CSubscription::GetByEmail($_REQUEST["submail"]);

        if($subscription->ExtractFields("str_"))
            $ID = (integer)$str_ID;
        else
            $ID=0;
        if($ID == 0)
        {
            $arFields = Array(
                "USER_ID" => ($USER->IsAuthorized()? $USER->GetID():false),
                "FORMAT" => "html",
                "EMAIL" => $_REQUEST["submail"],
                "ACTIVE" => "Y",
                "RUB_ID" => $_REQUEST["rub"],
                "SEND_CONFIRM" => "N",
                "CONFIRMED" => "Y"
            );
            $subscr = new CSubscription;

            //can add without authorization
            $ID = $subscr->Add($arFields);
            if($ID>0)
                echo json_encode(array('ok'=>$ID)); 
            else
                echo json_encode(array('error'=>$subscr->LAST_ERROR));
        }
        else 
        {
            $arFields = Array(
                "USER_ID" => ($USER->IsAuthorized()? $USER->GetID():false),
                "FORMAT" => "html",
                "EMAIL" => $_REQUEST["submail"],
                "ACTIVE" => "Y",
                "RUB_ID" => $_REQUEST["rub"],
                "SEND_CONFIRM" => "N"
            );
            $subscr = new CSubscription;

            //can add without authorization
            if($subscr->Update($ID,$arFields))
                echo json_encode(array('ok'=>GetMessage("IGIMA_MODDOS_SUBS_EDIT"))); 
            else 
                echo json_encode(array('error'=>$subscr->LAST_ERROR)); 
        }
    }
}
if (!empty($_REQUEST["verif-email"]))
{
    $result = filter_var($_REQUEST["verif-email"], FILTER_VALIDATE_EMAIL);
    if ($_REQUEST["verif-user"] == "Y")
    {
        $rsUser = CUser::GetByLogin($_REQUEST["verif-email"]);
        if($arUser = $rsUser->Fetch())
            echo json_encode(array('result'=>'','error'=>GetMessage("IGIMA_MODDOS_VERIF_EMAIL"))); 
        else
            echo json_encode(array('result'=>$result)); 
    }
    else
    echo json_encode(array('result'=>$result)); 
        
}
if ($_REQUEST["NEW_PASW"] == "Y")
{
    $rsUser = CUser::GetByLogin($_REQUEST["USER_EMAIL"]);
    $arUser = $rsUser->Fetch();
    if ($arUser["ID"] > 0)
    {
        $password_chars = array(
            "abcdefghijklnmopqrstuvwxyz",
            "ABCDEFGHIJKLNMOPQRSTUVWXYZ",
            "0123456789",
            ",.<>/?;:'\"[]{}\|`~!@#\$%^&*()-_+="
        );
        $NEW_PASSWORD = $NEW_PASSWORD_CONFIRM = randString(8, $password_chars);
        global $USER;
        $user = new CUser;
        $fields = Array(
            "PASSWORD"          => $NEW_PASSWORD,
            "CONFIRM_PASSWORD"  => $NEW_PASSWORD_CONFIRM,
        );
        $user->Update($arUser["ID"], $fields);
        $strError .= $user->LAST_ERROR;
        if(!$strError)
        {
            echo json_encode(array('OK'=>"Y"));
            if (empty($arUser["NAME"]))
              $arUser["NAME"] = GetMessage("IGIMA_MODDOS_USER_NAME");  
            $arEventFields = array(
                "NAME"          => $arUser["NAME"],
                "EMAIL"         => $_REQUEST["USER_EMAIL"],
                "PASSWORD"      => $NEW_PASSWORD
            );
            CEvent::Send("NEW_PASSWORD", SITE_ID, $arEventFields);

        }
        else
            echo json_encode(array('error'=>$strError));  
    }
    else 
        echo json_encode(array('error'=>GetMessage("IGIMA_MODDOS_USER_NOT_FOUND")));
}
if (!empty($_REQUEST["QUICK_VIEW"]))
{
    $quick_view = filter_input(INPUT_POST, 'QUICK_VIEW', FILTER_SANITIZE_SPECIAL_CHARS);
    $GLOBALS['SHOW_ADV_BLOCK'] = filter_input(INPUT_POST, 'SHOW_ADV_BLOCK', FILTER_SANITIZE_SPECIAL_CHARS);
    $GLOBALS['arrFilter'] = array('ID'=>$_REQUEST["QUICK_VIEW"]);
    $GLOBALS['BY_LINK'] = "Y";
    $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/quickview.php");
}

if (!empty($_REQUEST["ELEMENT_ID"]) && empty($_REQUEST["QUICK_VIEW"]))
    $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/neighbor.php");
    
if (!empty($_REQUEST["GET_CITY"]) && CModule::IncludeModule("sale"))
{
   $db_vars = CSaleLocation::GetList(
        array(
                "SORT" => "ASC",
                "COUNTRY_NAME_LANG" => "ASC",
                "CITY_NAME_LANG" => "ASC"
            ),
        array("LID" => LANGUAGE_ID,"%CITY_NAME" => $_REQUEST["GET_CITY"]),
        false,
        array("nTopCount"=>30),
        array("CITY_NAME","REGION_NAME","COUNTRY_NAME","ID")
    );
    while ($vars = $db_vars->Fetch()):
      ?>
        <li><a href="#" data-id="<?=$vars["ID"]?>"><span class="city"><?=$vars["CITY_NAME"]?></span><span class="region"> <?if (!empty($vars["REGION_NAME"])):?><?=$vars["REGION_NAME"]?><?else:?><?=$vars["COUNTRY_NAME"]?><?endif;?></span></a></li>
      <?
    endwhile;
        
}
if (!empty($_REQUEST["DELIVERY_ID"]) && CModule::IncludeModule("sale"))
{
    if ($_REQUEST["STEP"]>0)
        $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/ordering.php");
    else
    {
        $GLOBALS['INC_BASKET'] = $_REQUEST["INC_CART"];
        $GLOBALS['PRODUCT_ID'] = $_REQUEST["PRODUCT_ID"];
        $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/delivery.php");
    }
}
if (isset($_POST['PRODUCT_ID']) && isset($_POST['SITE_ID']) && isset($_POST['VIEWED_REF']))
{
    $productID = (int)$_POST['PRODUCT_ID'];
    $siteID = substr((string)$_POST['SITE_ID'], 0, 2);
    if ($productID > 0 && $siteID !== '' && \Bitrix\Main\Loader::includeModule('catalog') && \Bitrix\Main\Loader::includeModule('sale'))
    {
	CatalogViewedProductTable::refresh(
            $productID,
            CSaleBasket::GetBasketUserID(),
            $siteID
        );
    }
}
?>