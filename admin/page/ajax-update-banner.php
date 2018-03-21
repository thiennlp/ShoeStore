<?php
include_once("../../server/connect.php");
include_once("../../server/common.php");
global $mysqli;
$id_banner	=	intval($_POST['id_banner']);
$display	=	intval($_POST['display']);

$update_banner =  updateData("banner", "is_display='".$display."'", "id_banner = '".$id_banner."'");
if ($update_banner) {
    echo 1;
} else {
    echo 0;
}
?>