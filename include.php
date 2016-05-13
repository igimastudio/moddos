<?php
if (!function_exists('htmlspecialcharsbx')) 
{
    function htmlspecialcharsbx($string, $flags=ENT_COMPAT) 
    {
	return htmlspecialchars($string, $flags, (defined('BX_UTF')? 'UTF-8' : 'ISO-8859-1'));
    }
}
CModule::AddAutoloadClasses(
	'igima.moddos',
	array(
		'IgimaTools' => 'classes/general/igima_tools.php'
	)
);
$arScriptReg = array(
        'main' => array(
		"js" =>    "/bitrix/js/igima.moddos/main.js",
                "lang" =>   "/bitrix/modules/igima.moddos/lang/".LANGUAGE_ID."/main.php",
                "rel" =>   array('jquery')
	),
	'quick_view' => array(
		"js" =>    "/bitrix/js/igima.moddos/quick_view.js",
                "lang" =>   "/bitrix/modules/igima.moddos/lang/".LANGUAGE_ID."/quick_view.php",
                "rel" =>   array('jquery','admin_interface')
	),
	'catalog_sort' => array(
		"js" =>    "/bitrix/js/igima.moddos/catalog_sort.js",
                "lang" =>   "/bitrix/modules/igima.moddos/lang/".LANGUAGE_ID."/catalog_sort.php",
                "rel" =>   array('jquery')
	),
        'smart_filter' => array(
		"js" =>    "/bitrix/js/igima.moddos/smart_filter.js",
                "rel" =>   array('jquery')
	)
);

foreach ($arScriptReg as $ext => $arExt) 
{
    CJSCore::RegisterExt($ext, $arExt);
}