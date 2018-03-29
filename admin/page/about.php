<!--Breadcrumb-->
<?php include("./module/breadcrumb.php"); ?>

<!--Notice error about or content-->
<?php if ($result['about'] || $result['content'] || $result['fail']) : ?>
    <script>
        $('#modalNotice').modal('show');
        $(document).on('hide.bs.modal', '#modalNotice', function () {
            history.back();
        });
    </script>
<?php endif; ?>

<!--Notice error image or image size-->
<?php if ($result['image_size'] || $result['image']) : ?>
    <script>
        $('#modalNotice').modal('show');
    </script>
<?php endif; ?>

<!--Notice success-->
<?php if ($result['success']) : ?>
    <script>
        $('#modalNotice').modal('show');
        $(document).on('hide.bs.modal', '#modalNotice', function () {
            parent.location = "?page=about";
        });
    </script>
<?php endif; ?>

<!--Show data-->
<div class="row">
    <?php if ($act == 'add' || $act == 'edit') : ?>
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">ABOUT</h3>
            </div>
            <div>
                <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="tab-pane info-register fade in active">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="dk-about">About :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control required" name="dk-about" value="<?php echo $act == 'edit' ? $data_about[0][1] : '' ?>" placeholder="Vietnamese">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="dk-about-english" value="<?php echo $act == 'edit' ? $data_about[0][2] : '' ?>" placeholder="English">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="dk-image">Image :</label>
                            <div class="col-sm-6">
                                <input type="file" name="dk-image" id="dk-image" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="dk-content">Content (VN) :</label>
                            <div class="col-sm-8">
                                <textarea name="dk-content" style="height: 300px; "><?php echo $act == 'edit' ? $data_about[0][4] : '' ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="dk-content-english">Content (ENG) :</label>
                            <div class="col-sm-8">
                                <textarea name="dk-content-english" style="height: 300px; "><?php echo $act == 'edit' ? $data_about[0][5] : '' ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="<?php echo $act == 'edit' ? 'dk-update' : 'dk-plus' ?>"></label>
                            <div class="col-sm-5">
                                <button type="submit" name="<?php echo $act == 'edit' ? 'btn-update' : 'btn-plus' ?>" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr class="hr-no-margin">
    <?php elseif ($act == 'del') : ?>
        <?php if ($result) : ?>
            <script>
                $('#modalConfirm').modal('show');
            </script>
        <?php endif; ?>
    <?php else : ?>
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title"><a class="link-plus" href="?page=about&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST ABOUT</h3>
            </div>
            <table class="table">
                <thead>
                    <tr class="tr-title">
                        <th style="width: 10%">ID</th>
                        <th style="width: 25%">ABOUT (VN)</th>
                        <th style="width: 25%">ABOUT (ENG)</th>
                        <th style="width: 30%">IMAGE</th>
                        <th style="width: 10%">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_about as $key => $about) : ?>
                        <tr class="<?php echo $key % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                            <td><?php echo $about['id_about'] ?></td>
                            <td><?php echo $about['about'] ?></td>
                            <td><?php echo $about['about_english'] ?></td>
                            <td><img class="image-banner" src="<?php echo $about['image']; ?>"></td>
                            <td>
                                <a href="index.php?page=about&act=edit&id=<?php echo $about['id_about']; ?>">Edit</a> ||
                                <a href="index.php?page=about&act=del&id=<?php echo $about['id_about']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <hr class="hr-no-margin">
    <?php endif; ?>
</div>