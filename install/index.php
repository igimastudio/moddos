<?
global $MESS;
$strPath2Lang = str_replace("\\", "/", __FILE__);
$strPath2Lang = substr($strPath2Lang, 0, strlen($strPath2Lang)-strlen("/install/index.php"));
include(GetLangFileName($strPath2Lang."/lang/", "/install/index.php"));

Class igima_moddos extends CModule
{
	var $MODULE_ID = "igima.moddos";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = "Y";

	function igima_moddos()
	{
		$arModuleVersion = array();

		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php");

		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

		$this->MODULE_NAME = GetMessage("IGIMA_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("IGIMA_MODULE_DESC");
		
		$this->PARTNER_NAME = GetMessage("IGIMA_COMPANY_NAME");
		$this->PARTNER_URI = "http://igima.ru";
	}
        function InstallFiles()
	{
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/igima.moddos/install/js", $_SERVER["DOCUMENT_ROOT"]."/bitrix/js/igima.moddos", true, true);
                CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/igima.moddos/install/images", $_SERVER["DOCUMENT_ROOT"]."/bitrix/images/igima.moddos", true, true);
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/igima.moddos/install/ajax", $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/igima.moddos/ajax", true, true);
                CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/igima.moddos/install/components/igima", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/igima", true, true);
		return true;
	}
        function UnInstallFiles()
	{
		DeleteDirFilesEx("/bitrix/js/igima.moddos");
                DeleteDirFilesEx("/bitrix/images/igima.moddos");
		DeleteDirFilesEx("/bitrix/tools/igima.moddos");
                DeleteDirFilesEx("/bitrix/components/igima");
		return true;
	}
	function DoInstall()
	{
		RegisterModule('igima.moddos');
                $this->InstallFiles();
	}

	function DoUninstall()
	{
		UnRegisterModule('igima.moddos');
                $this->UnInstallFiles();
	}
}
?>