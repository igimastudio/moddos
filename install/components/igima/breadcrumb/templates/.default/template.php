<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
//delayed function must return a string
if (empty($arResult))
    return "";

$strReturn = '<div class="breadcrumbs">';

for ($index = 0,$itemSize = count($arResult); $index < $itemSize; $index++)
{
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    if ($arResult[$index + 1]["LINK"] <> "")
        $strReturn .= '<a href="'.$arResult[$index]["LINK"].'" rel="nofollow">'.$title.'</a>';
    else
    {
        if (empty($_REQUEST["ELEMENT_CODE"]))
            $strReturn .= '<a href="" class="active" rel="nofollow">'.$title.'</a>';
        else
            $strReturn .= '<a href="'.$arResult[$index]["LINK"].'" rel="nofollow">'.$title.'</a>';
    }
}

$strReturn .= '</div> <!-- end breadcrumbs -->';
return $strReturn;
?>
