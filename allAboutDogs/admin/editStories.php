<?php
include_once(dirname(__FILE__) . '/../class/classDogs.php');
$edit = new Dogs($conn);
$edit->editTableBooks();
