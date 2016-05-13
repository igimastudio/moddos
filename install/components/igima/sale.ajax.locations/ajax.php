<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include.php");
CModule::IncludeModule("igima.moddos");
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