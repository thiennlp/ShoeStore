<?php

include_once("../../server/connect.php");
include_once("../../server/common.php");
global $mysqli;
$id_object = $_POST['id_object'];

$data_age = selectData("age", "id_object = '" . $id_object . "'", "id_age, age");
if ($data_age) {
    for ($i = 0; $i < count($data_age); $i++) {
        $option_age .= '<option value="' . $data_age[$i][0] . '">' . $data_age[$i][1] . '</option>';
    }
    echo $option_age;
}
?>