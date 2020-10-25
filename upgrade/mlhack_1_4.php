<?php

require_once '../../../mainfile.php';
require_once XOOPS_ROOT_PATH . '/header.php';

global $xoopsDB;

// Add the field user_lang in users table
echo '<u><b>XOOPS Multilanguages v1.4 upgrade script</b></u><br><br>';

$sql = 'SHOW COLUMNS FROM ' . $xoopsDB->prefix('users') . " LIKE 'user_lang' ";

$result = $xoopsDB->queryF($sql);

if (!$result) {
    // Problem with the query

    echo '- An error occured while retreiving table users structure.';

    echo "<br>\n";

    echo $GLOBALS['xoopsDB']->errno() . ': ' . $GLOBALS['xoopsDB']->error() . "<br>\n";
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
        $sql = 'ALTER TABLE ' . $xoopsDB->prefix('users') . ' ADD `user_lang` VARCHAR( 50 )
				NOT NULL ';

        if ($xoopsDB->queryF($sql)) {
            echo '- Users table was updated successfully.';

            echo '<br><br>XOOPS Multilanguages v1.4 was successfully upgraded ! <br>
			 <br>Please delete this file : modules/language/upgrade/mlhack_1_4.php';

            echo '<br><br><b>Enjoy this hack ;-)</b>';
        } else {
            echo '- An error occured while updating the table users.';

            echo "<br>\n";

            echo $GLOBALS['xoopsDB']->errno() . ': ' . $GLOBALS['xoopsDB']->error() . "<br>\n";
        }
    } else {
        echo '- Users table do not need any modification.';

        echo '<br><br>XOOPS Multilanguages v1.4 was successfully upgraded ! <br>
		 <br>Please delete this file : modules/language/upgrade/mlhack_1_4.php';

        echo '<br><br><b>Enjoy this hack ;-)</b>';
    }
}

require_once XOOPS_ROOT_PATH . '/footer.php';
