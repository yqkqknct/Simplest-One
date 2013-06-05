<?php

include "framework/front/functions.php";
include "framework/admin/admin.php";

require "framework/update.php";
$update_checker = new ThemeUpdateChecker(
    'simplestone',
    'http://theme.fundesigner.net/simplestone/info.json'
);

?>