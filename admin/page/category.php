<!--Breadcrumb-->
<?php include("./module/breadcrumb.php"); ?>

<!--List data-->
<div class="row">
    <div class="col-md-12">
        <?php if ($act == 'add' || $act == 'edit') : ?>
            <!--Form add-->          
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title">CATEGORY</h3>
                </div>
                <div>
                    <form role="form" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="tab-pane info-register fade in active">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-category">Category:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control required" name="dk-category" value="<?php echo $act == 'edit' ? $data_category[0]['category'] : '' ?>" placeholder="Vietnamese">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="dk-category-english" value="<?php echo $act == 'edit' ? $data_category[0]['category_english'] : '' ?>" placeholder="English">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-image">Poster:</label>
                                <div class="col-sm-8">
                                    <input type="file" name="dk-image" id="dk-image"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="dk-level">Level:</label>
                                <div class="col-sm-8">
                                    <select class="item-cbb" name="dk-level">
                                        <option value="0">-- Danh mục gốc --</option>
                                        <?php foreach ($arr_option_category as $option) : ?>
                                            <option value="<?php echo $option['id_category'] ?>"  <?php echo $data_category[0]['level'] == $option['id_category'] ? 'selected' : ''; ?>>-- <?php echo $option['category'] ?> --</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="<?php echo $act == 'edit' ? 'dk-update' : 'dk-plus' ?>"></label>
                                <div class="col-sm-8">
                                    <button type="submit" name="<?php echo $act == 'edit' ? 'btn-update' : 'btn-plus' ?>" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="hr-no-margin">
            <!--/Form add-->
        <?php elseif ($act == 'del') : ?>
            <?php if ($id_category > 0) : ?>
                <?php modalConfirm("category", "id_category = '" . $id_category . "'", "?page=category"); ?>
                <script>
                    $('#modalConfirm').modal('show');
                </script>
            <?php endif; ?> 
        <?php else : ?>
            <?php if ($level == 1 || $level == 2) : ?>
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a class="link-plus" href="?page=category&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST CATEGORY</h3>
                    </div>

                    <table class="table">
                        <thead>
                            <tr class="tr-title">
                                <th style="width: 5%">ID</th>
                                <th style="width: 15%">CATEGORY (VN)</th>
                                <th style="width: 15%">CATEGORY (ENG)</th>
                                <th style="width: 45%">BANNER</th>
                                <th style="width: 10%">DISPLAY</th>
                                <th style="width: 10%">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_category as $category) : ?>
                                <tr>
                                    <td><?php echo $category['id_category'] ?></td>
                                    <td><?php echo $category['category'] ?></td>
                                    <td><?php echo $category['category_english'] ?></td>
                                    <td><img class="image-category" src="<?php echo $category['image'] ? $category['image'] : "http://placehold.it/800x300"; ?>"></td>
                                    <td>
                                        <?php if ($category['is_display'] == 1) : ?>
                                            <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                <input class="change-display" type="checkbox" checked data-toggle="toggle" value="<?php echo $category['id_category'] ?>">
                                            </form>
                                        <?php else : ?>
                                            <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                <input class="change-display" type="checkbox" data-toggle="toggle" value="<?php echo $category['id_category'] ?>">
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                    <td><a href="index.php?page=category&act=edit&id=<?php echo $category['id_category']; ?>">Edit</a> || 
                                        <a href="index.php?page=category&act=del&id=<?php echo $category['id_category']; ?>">Del</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <hr class="hr-no-margin">
            <?php else : ?>
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a class="link-plus" href="?page=category&act=add"><span class="glyphicon glyphicon-plus-sign"></span></a> LIST CATEGORY</h3>
                    </div>

                    <table class="table">
                        <thead>
                            <tr class="tr-title">
                                <th style="width: 5%">ID</th>
                                <th style="width: 60%">CATEGORY</th>
                                <th style="width: 15%">DISPLAY</th>
                                <th style="width: 10%">LEVEL</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_category as $category) : ?>
                                <tr>
                                    <td><?php echo $category['id_category'] ?></td>
                                    <td><?php echo $category['category'] ?>
                                        <?php $data_category_sub = selectData("category", "level = '" . $category['id_category'] . "'", "*"); ?>
                                        <?php if (count($data_category_sub) > 0) : ?>
                                            </br></br>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%">ID</th>
                                                        <th style="width: 60%">Category</th>
                                                        <th style="width: 15%">Display</th>
                                                        <th style="width: 10%">Level</th>
                                                        <th style="width: 10%">ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($data_category_sub as $key => $category_sub) : ?>
                                                        <tr class="<?php echo $key % 2 == 0 ? 'row-chan' : 'row-le' ?>">
                                                            <td><?php echo $category_sub['id_category'] ?></td>
                                                            <td><?php echo $category_sub['category'] ?></td>
                                                            <td>
                                                                <?php if ($category_sub['is_display'] == 1) : ?>
                                                                    <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                                        <input class="change-display" type="checkbox" checked data-toggle="toggle" value="<?php echo $category_sub['id_category'] ?>">
                                                                    </form>
                                                                <?php else : ?>
                                                                    <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                                        <input class="change-display" type="checkbox" data-toggle="toggle" value="<?php echo $category_sub['id_category'] ?>">
                                                                    </form>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?php echo $category_sub['level'] ?></td>
                                                            <td>
                                                                <a href="index.php?page=category&act=edit&id=<?php echo $category_sub['id_category'] ?>">Edit</a> || 
                                                                <a href="index.php?page=category&act=del&id=<?php echo $category_sub['id_category'] ?>">Del</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($category['is_display'] == 1) : ?>
                                            <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                <input class="change-display" type="checkbox" checked data-toggle="toggle" value="<?php echo $category['id_category'] ?>">
                                            </form>
                                        <?php else : ?>
                                            <form class="form-horizontal" role="form" method="POST" action="ajax-update-category.php">
                                                <input class="change-display" type="checkbox" data-toggle="toggle" value="<?php echo $category['id_category'] ?>">
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $category['level'] ?></td>
                                    <td>
                                        <a href="index.php?page=category&act=edit&id=<?php echo $category['id_category'] ?>">Edit</a> || 
                                        <a href="index.php?page=category&act=del&id=<?php echo $category['id_category'] ?>">Del</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <hr class="hr-no-margin">
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<!--Notice error category or image-->
<?php if ($result['category'] || $result['image']) : ?>
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
            parent.location = "?page=category";
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
