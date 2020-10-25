<?php

function xoops_module_install_language(&$module)
{
    global $xoopsDB;

    $ret = false;

    $sql = 'SHOW COLUMNS FROM ' . $xoopsDB->prefix('users') . " LIKE 'user_lang' ";

    $result = $xoopsDB->queryF($sql);

    if (!$result) {
        // Problem with the query

        $ret = false;
    } else {
        // No problem in the query, let's continue

        $user_lang_exists = 0;

        $rowCount = $xoopsDB->getRowsNum($result);

        if (0 == $rowCount) {
            $user_lang_exists = 0;
        } else {
            $user_lang_exists = 1;
        }

        if (0 == $user_lang_exists) {
            $sql = 'ALTER TABLE ' . $xoopsDB->prefix('users') . ' ADD `user_lang` VARCHAR( 50 ) NOT NULL ';

            if ($xoopsDB->queryF($sql)) {
                // We successfully added the field user_lang

                $ret = true;
            } else {
                // an error occured while altering the table

                $ret = false;
            }
        } else {
            $ret = true;
        }
    }

    return $ret;
}
