<?php
include_once("../../server/connect.php");
include_once("../../server/common.php");
global $mysqli;
$id_category	=	intval($_POST['id_category']);
$display	=	intval($_POST['display']);

$update_category =  updateData("category", "is_display='".$display."'", "id_category = '".$id_category."'");
if ($update_category) {
    echo 1;
} else {
    echo 0;
}
?>