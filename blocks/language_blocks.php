<?php

require_once XOOPS_ROOT_PATH . '/class/xoopslists.php';

function b_language_select_show($options)
{
    global $xoopsConfig, $_SERVER;

    $block = [];

    $block['title'] = 'Select your language';

    $block['content'] = '';

    $languages = XoopsLists::getLangList();

    // Hack by dAWiLbY to prevent too long query strings in your URL.

    if (empty($_SERVER['QUERY_STRING'])) {
        $pagenquery = $_SERVER['PHP_SELF'] . '?sel_lang=';
    } elseif (isset($_SERVER['QUERY_STRING'])) {
        $query = explode('&', $_SERVER['QUERY_STRING']);

        $langquery = $_SERVER['QUERY_STRING'];

        // If the last parameter of the QUERY_STRING is sel_lang, delete it so we don't have repeating sel_lang=...

        if (0 === mb_strpos($query[count($query) - 1], 'sel_lang=')) {
            $langquery = str_replace('&' . $query[count($query) - 1], '', $langquery);
        }

        $pagenquery = $_SERVER['PHP_SELF'] . '?' . $langquery . '&sel_lang=';

        $pagenquery = str_replace('?&', '?', $pagenquery);
    }

    // End of hack by dAWiLbY

    if (is_array($languages)) {
        //show a list of flags to select language

        if ('images' == $options[0]) {
            $block['content'] .= '<div align="center">';

            $imagelist = '';

            $i = 0;

            foreach ($languages as $v => $n) {
                // hack to prevent to long query strings in your URL.

                $imagelist .= '<a href="' . $pagenquery . $v . '">' . "\n";

                // end hack

                if (file_exists(XOOPS_ROOT_PATH . "/modules/language/flags/$n.gif")) {
                    $imagelist .= '<img src="' . XOOPS_URL . "/modules/language/flags/$n.gif\" alt=\"$n\">";
                } else {
                    $imagelist .= '<img src="' . XOOPS_URL . "/modules/language/flags/noflag.gif\" alt=\"$n\">";
                }

                $imagelist .= '</a>';

                $i++;

                if ($i < count($languages)) {
                    if (is_numeric($options[2]) && ($options[2] > 0)) {
                        if (0 == ($i % $options[2])) {
                            $imagelist .= '<br>';
                        } else {
                            $imagelist .= $options[1];
                        }
                    } else {
                        $imagelist .= $options[1];
                    }
                }
            }

            $block['content'] .= $imagelist . '</div>';
        } else {
            //show a drop down list to select language

            // hack to prevent to long query string in your URL.

            $block['content'] = "<script type='text/javascript'>
<!--
function SelLang_jumpMenu(targ,selObj,restore){
  eval(targ+\".location='" . $pagenquery . "\"+selObj.options[selObj.selectedIndex].value+\"'\");
    if (restore) selObj.selectedIndex=0;
}
-->
</script>";

            // end hack

            $block['content'] .= "<div align=\"center\"><select name=\"sel_lang\" onChange='SelLang_jumpMenu(\"parent\",this,0)'>";

            foreach ($languages as $v => $n) {
                $block['content'] .= "<option value=\"$v\"";

                if ($xoopsConfig['language'] == $n) {
                    $block['content'] .= ' selected';
                }

                $block['content'] .= ">$n</option>";
            }

            $block['content'] .= '</select></div>';
        }
    }

    return $block;
}

function b_language_select_edit($options)
{
    $form = "Display method:&nbsp;<select name='options[]'>";

    $form .= "<option value='images'";

    if ('images' == $options[0]) {
        $form .= " selected='selected'";
    }

    $form .= ">Flag list</option>\n";

    $form .= "<option value='dropdown'";

    if ('dropdown' == $options[0]) {
        $form .= " selected='selected'";
    }

    $form .= ">Drop down list</option>\n";

    $form .= "</select>\n";

    $form .= "<br>Image separator (optional):&nbsp;<input type='text' name='options[]' value='" . $options[1] . "'>";

    $form .= "<br>Images per row (optional):&nbsp;<input type='text' name='options[]' value='" . $options[2] . "'>";

    return $form;
}
