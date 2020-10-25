<?php

$modversion['name'] = _MI_ML_MD_NAME;
$modversion['version'] = 1.4;
$modversion['description'] = _MI_ML_MD_DESC;
$modversion['credits'] = 'Adi Chiributa - webmaster@artistic.ro';
$modversion['author'] = 'marcan';
$modversion['help'] = 'http://www.notrevie.ca';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = 'languages_slogo.png';
$modversion['dirname'] = 'language';
$modversion['onInstall'] = 'installscript.php';
$modversion['onUninstall'] = 'uninstallscript.php';

//Admin things
$modversion['hasAdmin'] = 0;
$modversion['adminmenu'] = '';

//language selection block
$modversion['blocks'][1]['file'] = 'language_blocks.php';
$modversion['blocks'][1]['name'] = _MI_ML_SELLANG;
$modversion['blocks'][1]['description'] = _MI_ML_SELLANG_DSC;
$modversion['blocks'][1]['show_func'] = 'b_language_select_show';
$modversion['blocks'][1]['edit_func'] = 'b_language_select_edit';
$modversion['blocks'][1]['options'] = 'images| |5';

// Menu
$modversion['hasMain'] = 0;
