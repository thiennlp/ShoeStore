<?php include("./module/breadcrumb.php"); ?>
<?php
$id_bill = intval($_GET['id']);
$state = intval($_GET['state']);
?>
<div class="row">
    <div class="col-md-12">
        <?php
        if ($act == 'del') {
            if ($id_bill > 0) {
                $data_detail_bill = selectData("detail_bill", "id_bill = '" . $id_bill . "'", "id_bill, id_product");
                for ($i = 0; $i < count($data_detail_bill); $i++) {
                    deleteData("detail_bill", "id_bill = '" . $id_bill . "' AND id_product = '" . $id_product . "'");
                }

                modalConfirm("bill", "id_bill = '" . $id_bill . "'", "?page=bill");
                ?>
                <script>
                    $('#modalConfirm').modal('show');
                </script>
                <?php
            }
        } elseif ($act == 'detail') {
            //----------------------Form for input information--------------------------------------
            echo '
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">DETAIL BILL</h3>
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="tr-title">
                                <th style="width: 10%">ID</th>
                                <th style="width: 45%">PRODUCT</th>
                                <th style="width: 10%">SIZE</th>
                                <th style="width: 15%">COLOR</th>
                                <th style="width: 10%">QUANLITY</th>
                                <th style="width: 10%">PRICE</th>
                            </tr>
                        </thead>
                        <tbody>';
            $data = selectData("detail_bill", "id_bill='" . $id_bill . "'", "*");
            for ($i = 0; $i < count($data); $i++) {
                $data_product = selectData("product", "id_product = '" . $data[$i][1] . "'", "product");
                echo '
                                    <tr>
                                        <td>' . $data[$i][0] . '</td>
                                        <td>' . $data_product[0][0] . '</td>
                                        <td>' . $data[$i][2] . '</td>
                                        <td>' . $data[$i][3] . '</td>
                                        <td>$' . $data[$i][4] . '</td>
                                        <td>$' . number_format($data[$i][5]) . '</td>
                                    </tr>
                                    ';
            }
            echo '
                        </tbody>
                    </table>
                </div>
                <hr class="hr-no-margin">
                ';
        } else {
            ?>
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title"> LIST BILL</h3>
                </div>

                <table class="table">
                    <thead>
                        <tr class="tr-title">
                            <th style="width: 5%">ID</th>
                            <th style="width: 20%">CUSTOMER</th>
                            <th style="width: 10%">DETAIL</th>
                            <th style="width: 15%">DATE ORDER</th>
                            <th style="width: 10%">PRICE</th>
                            <th style="width: 15%">STATUS</th>
                            <th style="width: 15%">NOTE</th>
                            <th style="width: 10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($state == 0) {
                            $data = selectData("bill", "1=1", "*");
                        } elseif ($state == 1) {
                            $data = selectData("bill", "status=0", "*");
                        } elseif ($state == 2) {
                            $data = selectData("bill", "status=1", "*");
                        } elseif ($state == 3) {
                            $data = selectData("bill", "status=2", "*");
                        }
                        for ($i = 0; $i < count($data); $i++) {
                            ?>
                            <tr class="<?php echo $i % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                <td><?php echo $data[$i][0] ?></td>
                                <td>
                                    <?php
                                    $datakh = selectData("customer", "id_customer = '" . $data[$i][1] . "'", "name");
                                    echo $datakh[0][0];
                                    ?>
                                </td>
                                <td><a href="index.php?page=bill&act=detail&id=<?php echo $data[$i][0]; ?>">Detail</a></td>
                                <td><?php echo date('Y/m/d', $data[$i][2]); ?></td>
                                <td><?php echo number_format($data[$i][3]) ?> VND</td>
                                <td>
                                    <?php
                                    if ($data[$i][4] == 0) {
                                        ?>
                                        <form class="form-horizontal" role="form" method="POST" action="ajax-update-bill.php">
                                            <div class="radio">
                                                <label><input type="radio" name="opt_status" checked onclick="changeStatus(<?php echo $data[$i][0]; ?>, 0);">NEW</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="opt_status" onclick="changeStatus(<?php echo $data[$i][0]; ?>, 1);">SHIPPING</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="opt_status" onclick="changeStatus(<?php echo $data[$i][0]; ?>, 2);">DONE</label>
                                            </div>
                                        </form>
                                        <?php
                                    } elseif ($data[$i][4] == 1) {
                                        ?>
                                        <form class="form-horizontal" role="form" method="POST" action="ajax-update-bill.php">
                                            <div class="radio">
                                                <label><input type="radio" name="opt_status" onclick="changeStatus(<?php echo $data[$i][0]; ?>, 0);">NEW</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="opt_status" checked onclick="changeStatus(<?php echo $data[$i][0]; ?>, 1);">SHIPPING</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="opt_status" onclick="changeStatus(<?php echo $data[$i][0]; ?>, 2);">DONE</label>
                                            </div>
                                        </form>
                                        <?php
                                    } elseif ($data[$i][4] == 2) {
                                        ?>
                                        <form class="form-horizontal" role="form" method="POST" action="ajax-update-bill.php">
                                            <div class="radio">
                                                <label><input type="radio" name="opt_status" onclick="changeStatus(<?php echo $data[$i][0]; ?>, 0);">NEW</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="opt_status" onclick="changeStatus(<?php echo $data[$i][0]; ?>, 1);">SHIPPING</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="opt_status" checked onclick="changeStatus(<?php echo $data[$i][0]; ?>, 2);">DONE</label>
                                            </div>
                                        </form>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $data[$i][5] ?></td>
                                <td><a href="index.php?page=bill&act=del&id=<?php echo $data[$i][0]; ?>">Del</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <hr class="hr-no-margin">
            <?php
        }
        ?>
    </div>
</div>
<!-- /.row -->