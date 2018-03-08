<?php
include_once(dirname(__FILE__) . '/../class/classLogin.php');
$f = new Login($conn);
$f->getForgotPassword();