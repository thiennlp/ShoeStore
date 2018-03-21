<?php
include_once("../../server/connect.php");
include_once("../../server/common.php");
global $mysqli;
$id_product	=	intval($_POST['id_product']);
$is_campaign	=	intval($_POST['is_campaign']);

$row_campaign =  selectData("campaign", "id_product = '".$id_product."'", "id_campaign");
if ($row_campaign) {
    $update_campaign =  updateData("campaign", "is_campaign='".$is_campaign."'", "id_campaign = '".$row_campaign[0][0]."'");
    if ($update_campaign) {
        echo 1;
    } else {
        echo 0;
    }
}
?>