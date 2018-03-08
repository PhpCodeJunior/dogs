<?php
include_once(dirname(__FILE__) . '/../class/classRegister.php');
$delete = new Register($conn);
$delete->returnDelete();