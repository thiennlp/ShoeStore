<?php
global $mysqli;
if (isset($_POST['btn-insert'])) {
    $content	=	$_POST['dk-content'];

    if ($content) {
        if ($mysqli->query($content)) {
            $class_alert = "alert alert-success";
            $content_notice = "Done !";
            modalInfo($class_alert, $content_notice);
            ?>
                <script>
                    $('#modalNotice').modal('show');
                </script>
            <?php
        } else {
            $class_alert = "alert alert-danger";
            $content_notice = $mysqli->error;
            modalInfo($class_alert, $content_notice);
            ?>
                <script>
                    $('#modalNotice').modal('show');
                    $(document).on('hide.bs.modal','#modalNotice', function () {
                        history.back();
                    });
                </script>
            <?php
        }
    }
}
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="#">Trang chủ</a>
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<div class="panel panel-primary filterable">
    <div class="panel-heading">
        <h3 class="panel-title">Statlement SQL</h3>
    </div>
    <div>
        <form role="form" method="POST" class="form-horizontal">
            <div class="tab-pane info-register fade in active">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="dk-content">Sql :</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="15" name="dk-content" placeholder="" ></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="dk-plus"></label>
                    <div class="col-sm-5">
                        <button type="submit" name="btn-insert" class="btn btn-primary">Insert</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<hr class="hr-no-margin">