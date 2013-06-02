<?php

include "framework/front/functions.php";
include "framework/admin/admin.php";

require "framework/update.php";
$update_checker = new ThemeUpdateChecker(
    'simplest',
    'http://theme.fundesigner.net/simplest/info.json'
);

?>