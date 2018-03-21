<?php
include_once("../../server/connect.php");
include_once("../../server/common.php");
global $mysqli;
$id_bill	=	intval($_POST['id']);
$status	=	intval($_POST['value']);

$update_bill =  updateData("bill", "status='".$status."'", "id_bill = '".$id_bill."'");
if ($update_bill) {
    echo 1;
} else {
    echo 0;
}
?>