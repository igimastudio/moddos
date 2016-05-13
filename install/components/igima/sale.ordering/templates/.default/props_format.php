<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
if (!function_exists("showFilePropertyField"))
{
    function showFilePropertyField($name,$property_fields,$values,$max_file_size_show = 50000)
    {
        $res = "";

        if (!is_array($values) || empty($values))
            $values = array(
                "n0" => 0,
            );

        if ($property_fields["MULTIPLE"] == "N")
        {
            $res = "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[0]\" id=\"".$name."[0]\"></label>";
        } else
        {
            $res = '
			<script type="text/javascript">
				function addControl(item)
				{
					var current_name = item.id.split("[")[0],
						current_id = item.id.split("[")[1].replace("[", "").replace("]", ""),
						next_id = parseInt(current_id) + 1;

					var newInput = document.createElement("input");
					newInput.type = "file";
					newInput.name = current_name + "[" + next_id + "]";
					newInput.id = current_name + "[" + next_id + "]";
					newInput.onchange = function() { addControl(this); };

					var br = document.createElement("br");
					var br2 = document.createElement("br");

					BX(item.id).parentNode.appendChild(br);
					BX(item.id).parentNode.appendChild(br2);
					BX(item.id).parentNode.appendChild(newInput);
				}
			</script>
			';

            $res .= "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[0]\" id=\"".$name."[0]\"></label>";
            $res .= "<br/><br/>";
            $res .= "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[1]\" id=\"".$name."[1]\" onChange=\"javascript:addControl(this);\"></label>";
        }

        return $res;
    }
}

if (!function_exists("PrintPropsForm"))
{
    function PrintPropsForm($arSource = array(),$locationTemplate = ".default")
    {
        global $USER;
        $rsUser = CUser::GetByID($USER->GetID());
        $arUser = $rsUser->Fetch();
        if (strlen($arUser["PERSONAL_ZIP"]) > 0)
            $zipcode = $arUser["PERSONAL_ZIP"];
        if (!empty($arSource))
        {
            $first = true;
            foreach ($arSource as $arProperties)
            {

                if ($arProperties["TYPE"] == "CHECKBOX")
                {
                    ?>
                    <input type="hidden" name="<?=$arProperties["FIELD_NAME"]?>" value="">

                    <div class="bx_block r1x3 pt8">
                        <?=$arProperties["NAME"]?>
                        <?if ($arProperties["REQUIED_FORMATED"] == "Y"):?>
                            <span class="bx_sof_req">*</span>
                        <?endif;?>
                    </div>

                    <div class="bx_block r1x3 pt8">
                        <input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"] == "Y") echo " checked";?>>

                        <?
                        if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
                            ?>
                            <div class="bx_description">
                                <?=$arProperties["DESCRIPTION"]?>
                            </div>
                            <?
                        endif;
                        ?>
                    </div>

                    <div style="clear: both;"></div>
                    <?
                }
                elseif ($arProperties["TYPE"] == "TEXT")
                {
                    ?>
                    <?if ($first && $arProperties["SHOW_GROUP_NAME"] == "Y"):?>
                        <h6 class="reciew"><?=$arProperties["GROUP_NAME"]?></h6>
                        <div class="pop-content">
                            <?$first = false;?>
                        <?elseif (!$first && $arProperties["SHOW_GROUP_NAME"] == "Y"):?>
                        </div> <!-- end pop-content -->
                        <div class="line"></div>
                        <h6 class="address-reciew"><?=$arProperties["GROUP_NAME"]?></h6>
                    <?endif;?>
                    <?if ($arProperties["CODE"] == "phone"):?>
                        <div class="entry-form phone-inp">
                            <?if ($arProperties['WORK_PHONE'] == "ru"):?>

                                <span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt="" class="flag"></span>
                                <input class="mask-input phone-ru" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165);" value="<?=$arProperties["VALUE"]?>">
                                <input class="mask-input phone-ua" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+380 (___) ___-__-__" style="color: rgb(165, 165, 165);">
                                <input class="mask-input phone-kz" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165);">
                                <input class="mask-input phone-by" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+375 (___) ___-__-__" style="color: rgb(165, 165, 165);">

                                <ul class="list-country">
                                    <li class="first"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt=""><?=GetMessage("IGIMA_MODDOS_RUSSIA");?></a></li>
                                    <li><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt=""><?=GetMessage("IGIMA_MODDOS_UKRAINE");?></a></li>
                                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt=""><?=GetMessage("IGIMA_MODDOS_KAZAKHSTAN");?></a></li>
                                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt=""><?=GetMessage("IGIMA_MODDOS_BYLARUS");?></a></li>
                                </ul>

                            <?endif?>
                            <?if ($arProperties['WORK_PHONE'] == "ua"):?>
                                <span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt="" class="flag"></span>
                                <input class="mask-input phone-ru" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165); display: none;" >
                                <input class="mask-input phone-ua" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+380 (___) ___-__-__" style="color: rgb(165, 165, 165); display: inline" value="<?=$arProperties["VALUE"]?>">
                                <input class="mask-input phone-kz" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165);">
                                <input class="mask-input phone-by" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+375 (___) ___-__-__" style="color: rgb(165, 165, 165);">

                                <ul class="list-country">
                                    <li class="first" style="display:inline"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt=""><?=GetMessage("IGIMA_MODDOS_RUSSIA");?></a></li>
                                    <li style="display:none"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt=""><?=GetMessage("IGIMA_MODDOS_UKRAINE");?></a></li>
                                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt=""><?=GetMessage("IGIMA_MODDOS_KAZAKHSTAN");?></a></li>
                                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt=""><?=GetMessage("IGIMA_MODDOS_BYLARUS");?></a></li>
                                </ul>
                            <?endif?>

                            <?if ($arProperties['WORK_PHONE'] == "kz"):?>
                                <span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt="" class="flag"></span>
                                <input class="mask-input phone-ru" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165); display: none;" >
                                <input class="mask-input phone-ua" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+380 (___) ___-__-__" style="color: rgb(165, 165, 165); display: none">
                                <input class="mask-input phone-kz" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165); display: inline" value="<?=$arProperties["VALUE"]?>" >
                                <input class="mask-input phone-by" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+375 (___) ___-__-__" style="color: rgb(165, 165, 165);">

                                <ul class="list-country">
                                    <li class="first" style="display:inline"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt=""><?=GetMessage("IGIMA_MODDOS_RUSSIA");?></a></li>
                                    <li><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt=""><?=GetMessage("IGIMA_MODDOS_UKRAINE");?></a></li>
                                    <li style="display:none"><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt=""><?=GetMessage("IGIMA_MODDOS_KAZAKHSTAN");?></a></li>
                                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt=""><?=GetMessage("IGIMA_MODDOS_BYLARUS");?></a></li>
                                </ul>
                            <?endif?>

                            <?if ($arProperties['WORK_PHONE'] == "by"):?>
                                <span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt="" class="flag"></span>
                                <input class="mask-input phone-ru" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165); display: none;" >
                                <input class="mask-input phone-ua" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+380 (___) ___-__-__" style="color: rgb(165, 165, 165); display: none">
                                <input class="mask-input phone-kz" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165); display: none">
                                <input class="mask-input phone-by" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+375 (___) ___-__-__" style="color: rgb(165, 165, 165); display: inline" value="<?=$arProperties["VALUE"]?>" >

                                <ul class="list-country">
                                    <li class="first" style="display:inline"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt=""><?=GetMessage("IGIMA_MODDOS_RUSSIA");?></a></li>
                                    <li><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt=""><?=GetMessage("IGIMA_MODDOS_UKRAINE");?></a></li>
                                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt=""><?=GetMessage("IGIMA_MODDOS_KAZAKHSTAN");?></a></li>
                                    <li style="display:none"><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt=""><?=GetMessage("IGIMA_MODDOS_BYLARUS");?></a></li>
                                </ul>
                            <?endif?>

                            <?if (empty($arProperties['WORK_PHONE'])):?>

                                <span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt="" class="flag"></span>
                                <input class="mask-input phone-ru" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165);" value="<?=$arProperties["VALUE"]?>">
                                <input class="mask-input phone-ua" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+380 (___) ___-__-__" style="color: rgb(165, 165, 165);">
                                <input class="mask-input phone-kz" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+7 (___) ___-__-__" style="color: rgb(165, 165, 165);">
                                <input class="mask-input phone-by" type="text" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+375 (___) ___-__-__" style="color: rgb(165, 165, 165);">

                                <ul class="list-country">
                                    <li class="first"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt=""><?=GetMessage("IGIMA_MODDOS_RUSSIA");?></a></li>
                                    <li><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt=""><?=GetMessage("IGIMA_MODDOS_UKRAINE");?></a></li>
                                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt=""><?=GetMessage("IGIMA_MODDOS_KAZAKHSTAN");?></a></li>
                                    <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt=""><?=GetMessage("IGIMA_MODDOS_BYLARUS");?></a></li>
                                </ul>

                            <?endif?>

                                                                                                                                        <!--span class="desc-inp"><i></i> <span class="arrow"></span><img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt="" class="flag" /></span>
                                                                                                                                        <input class="mask-input phone-ru" type="text" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+7 (___) ___-__-__" />
                                                                                                                                        <input class="mask-input phone-ua" type="text" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+380 (___) ___-__-__" />
                                                                                                                                        <input class="mask-input phone-kz" type="text" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+7 (___) ___-__-__" />
                                                                                                                                        <input class="mask-input phone-by" type="text" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" placeholder="+375 (___) ___-__-__" />
                                                                                                                                        <span class="hint-error" id="error-phone">
                                                                                                                                            <i></i>
                                                                                                                                        </span>
                                                                                                                                        <ul class="list-country">
                                                                                                                                                <li class="first"><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ru.png" alt="" /></a></li>
                                                                                                                                                <li><span class="list-country-arrow"></span><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-ua.png" alt="" /></a></li>
                                                                                                                                                <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-kz.png" alt="" /></a></li>
                                                                                                                                                <li><a href="#"> <img src="<?=SITE_TEMPLATE_PATH?>/images/flag-by.png" alt="" /></a></li>
                                                                                                                                        </ul-->
                            <span class="entry-ico"></span>
                            <?if (strlen(trim($arProperties["DESCRIPTION"])) > 0):?><span class="tool-tip"><?=$arProperties["DESCRIPTION"]?></span><?endif;?>
                            <span class="clear"></span>
                        </div> <!-- end entry-form phone-inp --> <br />
                    <?else:?>
                        <span class="entry-form user-name-inp
                        <?if ($arProperties['CODE'] == 'country' || $arProperties['CODE'] == 'city'):?>
                                  inactive ok
                              <?endif;?>
                              <?if ($arProperties['CODE'] == 'flat' || $arProperties['CODE'] == 'house'):?>
                                  short
                              <?endif;?>
                              <?if ($arProperties['CODE'] == 'house'):?>
                                  short1
                              <?endif;?>
                              ">
                            <span class="desc-inp<?if ($arProperties['CODE'] == 'flat'):?> office<?endif;?>">
                                <i></i><?=$arProperties["NAME"]?><?if ($arProperties["REQUIED_FORMATED"] == "Y"):?><span class="red">*</span><?endif;?>
                            </span>
                            <input<?if ($arProperties["REQUIED_FORMATED"] != "Y"):?> class="no-error"<?endif;?> type="text" maxlength="250" size="<?=$arProperties["SIZE1"]?>" value="<?if ($arProperties['CODE'] == 'country'):?><?=$arSource["COUNTRY"]?><?elseif ($arProperties['CODE'] == 'city'):?><?=$arSource["CITY"]?><?elseif ($arProperties['CODE'] == 'zipcode' && $zipcode > 0):?><?=$zipcode?><?else:?><?=$arProperties["VALUE"]?><?endif;?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>"<?if ($arProperties['CODE'] == 'country' || $arProperties['CODE'] == 'city'):?> disabled<?endif;?>> <span class="entry-ico"></span>
                            <?if ($arProperties["REQUIED_FORMATED"] == "Y"):?>
                                <span class="hint-error">
                                    <i></i><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_ERROR_FIELD")?>
                                </span>
                            <?endif;?>
                            <?if (strlen(trim($arProperties["DESCRIPTION"])) > 0):?><span class="tool-tip"><?=$arProperties["DESCRIPTION"]?></span><?endif;?>
                            <span class="clear"></span>
                        </span> <!-- end entry-form user-name-inp --> <?if ($arProperties['CODE'] != 'house'):?><br /><?endif;?>
                    <?endif;?>
                    <?
                }
                elseif ($arProperties["TYPE"] == "SELECT")
                {
                    ?>
                    <br/>
                    <div class="bx_block r1x3 pt8">
                        <?=$arProperties["NAME"]?>
                        <?if ($arProperties["REQUIED_FORMATED"] == "Y"):?>
                            <span class="bx_sof_req">*</span>
                        <?endif;?>
                    </div>

                    <div class="bx_block r3x1">
                        <select name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
                            <?
                            foreach ($arProperties["VARIANTS"] as $arVariants):
                                ?>
                                <option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
                                <?
                            endforeach;
                            ?>
                        </select>

                        <?
                        if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
                            ?>
                            <div class="bx_description">
                                <?=$arProperties["DESCRIPTION"]?>
                            </div>
                            <?
                        endif;
                        ?>
                    </div>
                    <div style="clear: both;"></div>
                    <?
                }
                elseif ($arProperties["TYPE"] == "MULTISELECT")
                {
                    ?>
                    <br/>
                    <div class="bx_block r1x3 pt8">
                        <?=$arProperties["NAME"]?>
                        <?if ($arProperties["REQUIED_FORMATED"] == "Y"):?>
                            <span class="bx_sof_req">*</span>
                        <?endif;?>
                    </div>

                    <div class="bx_block r3x1">
                        <select multiple name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
                            <?
                            foreach ($arProperties["VARIANTS"] as $arVariants):
                                ?>
                                <option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
                                <?
                            endforeach;
                            ?>
                        </select>

                        <?
                        if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
                            ?>
                            <div class="bx_description">
                                <?=$arProperties["DESCRIPTION"]?>
                            </div>
                            <?
                        endif;
                        ?>
                    </div>
                    <div style="clear: both;"></div>
                    <?
                }
                elseif ($arProperties["TYPE"] == "TEXTAREA")
                {
                    $rows = ($arProperties["SIZE2"] > 10) ? 4 : $arProperties["SIZE2"];
                    ?>
                    <br/>
                    <div class="bx_block r1x3 pt8">
                        <?=$arProperties["NAME"]?>
                        <?if ($arProperties["REQUIED_FORMATED"] == "Y"):?>
                            <span class="bx_sof_req">*</span>
                        <?endif;?>
                    </div>

                    <div class="bx_block r3x1">
                        <textarea rows="<?=$rows?>" cols="<?=$arProperties["SIZE1"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["VALUE"]?></textarea>

                        <?
                        if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
                            ?>
                            <div class="bx_description">
                                <?=$arProperties["DESCRIPTION"]?>
                            </div>
                            <?
                        endif;
                        ?>
                    </div>
                    <div style="clear: both;"></div>
                    <?
                }
                elseif ($arProperties["TYPE"] == "LOCATION")
                {
                    $value = 0;
                    if (is_array($arProperties["VARIANTS"]) && count($arProperties["VARIANTS"]) > 0)
                    {
                        foreach ($arProperties["VARIANTS"] as $arVariant)
                        {
                            if ($arVariant["SELECTED"] == "Y")
                            {
                                $value = $arVariant["ID"];
                                break;
                            }
                        }
                    }
                    ?>

                    <?
                    if (strlen($arUser["PERSONAL_CITY"]) > 0)
                        $value = $arUser["PERSONAL_CITY"];
                    $GLOBALS["APPLICATION"]->IncludeComponent(
                            "igima:sale.ajax.locations",$locationTemplate,array(
                        "AJAX_CALL" => "N",
                        "COUNTRY_INPUT_NAME" => "COUNTRY",
                        "REGION_INPUT_NAME" => "REGION",
                        "CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
                        "CITY_OUT_LOCATION" => "N",
                        "LOCATION_VALUE" => $value,
                        "ORDER_PROPS_ID" => $arProperties["ID"],
                        "ONCITYCHANGE" => ($arProperties["IS_LOCATION"] == "Y" || $arProperties["IS_LOCATION4TAX"] == "Y") ? "submitForm()" : "",
                        "SIZE1" => $arProperties["SIZE1"],
                        "SHOW_INC_BASKET" => "N"
                            ),null,array('HIDE_ICONS' => 'Y')
                    );
                    ?>

                    <?
                }
                elseif ($arProperties["TYPE"] == "RADIO")
                {
                    ?>
                    <div class="bx_block r1x3 pt8">
                        <?=$arProperties["NAME"]?>
                        <?if ($arProperties["REQUIED_FORMATED"] == "Y"):?>
                            <span class="bx_sof_req">*</span>
                        <?endif;?>
                    </div>

                    <div class="bx_block r3x1">
                        <?
                        if (is_array($arProperties["VARIANTS"]))
                        {
                            foreach ($arProperties["VARIANTS"] as $arVariants):
                                ?>
                                <input
                                    type="radio"
                                    name="<?=$arProperties["FIELD_NAME"]?>"
                                    id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"
                                    value="<?=$arVariants["VALUE"]?>" <?if ($arVariants["CHECKED"] == "Y") echo " checked";?> />

                                <label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"><?=$arVariants["NAME"]?></label></br>
                                <?
                            endforeach;
                        }
                        ?>

                        <?
                        if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
                            ?>
                            <div class="bx_description">
                                <?=$arProperties["DESCRIPTION"]?>
                            </div>
                            <?
                        endif;
                        ?>
                    </div>
                    <div style="clear: both;"></div>
                    <?
                }
                elseif ($arProperties["TYPE"] == "FILE")
                {
                    ?>
                    <br/>
                    <div class="bx_block r1x3 pt8">
                        <?=$arProperties["NAME"]?>
                        <?if ($arProperties["REQUIED_FORMATED"] == "Y"):?>
                            <span class="bx_sof_req">*</span>
                        <?endif;?>
                    </div>

                    <div class="bx_block r3x1">
                        <?=showFilePropertyField("ORDER_PROP_".$arProperties["ID"],$arProperties,$arProperties["VALUE"],$arProperties["SIZE1"])?>

                        <?
                        if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
                            ?>
                            <div class="bx_description">
                                <?=$arProperties["DESCRIPTION"]?>
                            </div>
                            <?
                        endif;
                        ?>
                    </div>

                    <div style="clear: both;"></div><br/>
                    <?
                }
            }
        }
    }
}
?>