<!--Breadcrumb-->
<?php include("./module/breadcrumb.php"); ?>

<!--Show data-->
<div class="row">
    <?php if ($act == 'add') : ?>

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
    <?php elseif ($act == 'del') : ?>
        <?php if ($result == TRUE) : ?>
            <?php modalConfirm("banner", "id_banner = '" . $id_banner . "'", "?page=banner"); ?>
            <script>
                $('#modalConfirm').modal('show');
            </script>
        <?php endif; ?>
    <?php else : ?>
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
                        <?php foreach ($data_banner as $key => $banner) : ?>
                            <tr class="<?php echo $key % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                <td><?php echo $banner['id_banner'] ?></td>
                                <td><img class="image-banner" src="<?php echo $banner['image'] ?>"></td>
                                <td>
                                    <?php if ($banner['is_display'] == 1) : ?>
                                        <form class="form-horizontal" role="form" method="POST" action="ajax-update-banner.php">
                                            <input class="change-banner" type="checkbox" checked data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                        </form>
                                    <?php else : ?>
                                        <form class="form-horizontal" role="form" method="POST" action="ajax-update-banner.php">
                                            <input class="change-banner" type="checkbox" data-toggle="toggle" value="<?php echo $data[$i][0] ?>">
                                        </form>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php $data_category = selectData("category", "id_category = '" . $banner['id_category'] . "'", "category"); ?>
                                    <?php echo $data_category[0]['category']; ?>
                                </td>
                                <td><a href="index.php?page=banner&act=del&id=<?php echo $banner['id_banner'] ?>">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <hr class="hr-no-margin">
        </div>
    <?php endif; ?>
</div>


<!--Notice error image or id_category-->
<?php if ($result['image'] || $result['id_category']): ?>
    <script>
        $('#modalNotice').modal('show');
        $(document).on('hide.bs.modal', '#modalNotice', function () {
            history.back();
        });
    </script>
<?php endif; ?>

<!--Notice error image_size-->
<?php if ($result['image_size']): ?>
    <script>
        $('#modalNotice').modal('show');
    </script>
<?php endif; ?>

<!--Notice success-->
<?php if ($result['success']): ?>
    <script>
        $('#modalNotice').modal('show');
        $(document).on('hide.bs.modal', '#modalNotice', function () {
            parent.location = "?page=banner";
        });
    </script>
<?php endif; ?>

<!--Notice fail-->
<?php if ($result['fail']): ?>
    <script>
        $('#modalNotice').modal('show');
        $(document).on('hide.bs.modal', '#modalNotice', function () {
            history.back();
        });
    </script>
<?php endif; ?>