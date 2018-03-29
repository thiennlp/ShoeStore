<!--Breadcrumb-->
<?php include("./module/breadcrumb.php"); ?>
<?php if ($result['image'] || $result['id_category']): ?>
    <script>
        $('#modalNotice').modal('show');
        $(document).on('hide.bs.modal', '#modalNotice', function () {
            history.back();
        });
    </script>
<?php endif; ?>
<?php if ($result['image_size']): ?>
    <script>
        $('#modalNotice').modal('show');
    </script>
<?php endif; ?>
<?php if ($result['success']): ?>
    <script>
        $('#modalNotice').modal('show');
    </script>
<?php endif; ?>
<?php if ($result['fail']): ?>
    <script>
        $('#modalNotice').modal('show');
        $(document).on('hide.bs.modal', '#modalNotice', function () {
            history.back();
        });
    </script>
<?php endif; ?>
<?php ?>
<?php ?>
<?php ?>

<div class="row">
    <?php if ($act == 'add') { ?>

        <div class="col-md-12">
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">BANNER</h3>
                </div>
                <div>
                    <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="tab-pane info-register fade in active">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-image">Image :</label>
                                <div class="col-sm-5">
                                    <input type="file" name="dk-image" id="dk-image" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-category">Category :</label>
                                <div class="col-sm-5">
                                    <select class="item-cbb" name="dk-category">
                                        <?php foreach ($data_category as $category) : ?>
                                            <option value="<?php echo $category['id_category'] ?>"><?php echo $category['category'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-save"></label>
                                <div class="col-sm-5">
                                    <button type="submit" name="btn-plus" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="hr-no-margin">
        </div>
        <?php
    } elseif ($act == 'del') {
        if ($id_banner > 0) {
            modalConfirm("banner", "id_banner = '" . $id_banner . "'", "?page=banner");
            ?>
            <script>
                $('#modalConfirm').modal('show');
            </script>
            <?php
        }
    } else {
        ?>
        <div class="col-md-12">
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title"><a class="link-plus" href="?page=banner&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST BANNER</h3>
                </div>

                <table class="table">
                    <thead>
                        <tr class="tr-title">
                            <th style="width: 10%">ID</th>
                            <th style="width: 35%">IMAGE</th>
                            <th style="width: 20%">DISPLAY</th>
                            <th style="width: 20%">CATEGORY</th>
                            <th style="width: 15%">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = selectData("banner", "1=1", "*");
                        for ($i = 0; $i < count($data); $i++) {
                            ?>
                            <tr class="<?php echo $i % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                <td><?php echo $data[$i][0] ?></td>
                                <td><img class="image-banner" src="<?php echo $data[$i][1]; ?>"></td>
                                <td>
                                    <?php
                                    if ($data[$i][2] == 1) {
                                        ?>
                                        <form class="form-horizontal" role="form" method="POST" action="ajax-update-banner.php">
                                            <input class="change-banner" type="checkbox" checked data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                        </form>
                                        <?php
                                    } else {
                                        ?>
                                        <form class="form-horizontal" role="form" method="POST" action="ajax-update-banner.php">
                                            <input class="change-banner" type="checkbox" data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                        </form>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $datadm = selectData("category", "id_category = '" . $data[$i][3] . "'", "category");
                                    echo $datadm[0][0];
                                    ?>
                                </td>
                                <td><a href="index.php?page=banner&act=del&id=<?php echo $data[$i][0]; ?>">Delete</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <hr class="hr-no-margin">
        </div>
        <?php
    }
    ?>
</div>
<!-- /.row -->