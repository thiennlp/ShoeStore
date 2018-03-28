<?php
switch ($page) {
    case 'about':
        $label = 'About';
        $class = 'fa-question-circle-o';
        break;
    case 'banner':
        $label = 'Banner';
        $class = 'fa-fw fa-picture-o';
        break;
    case 'bill':
        $label = 'Bill';
        $class = 'fa-usd';
        break;
    case 'category':
        $label = 'Category';
        $class = 'fa-fw fa-wrench';
        break;
    case 'customer':
        $label = 'Customer';
        $class = 'fa-file';
        break;
    case 'help':
        $label = 'Help';
        $class = 'fa-leanpub';
        break;
    case 'object':
        $label = 'Object';
        $class = 'fa-users';
        break;
    case 'product':
        $label = 'Product';
        $class = 'fa-fw fa-bar-chart-o';
        break;
    case 'size':
        $label = 'Size';
        $class = 'fa-fw fa-wrench';
        break;
    case 'store':
        $label = 'Store';
        $class = 'fa-university';
        break;
    case 'title':
        $label = 'Title';
        $class = 'fa-audio-description';
        break;
    case 'user':
        $label = 'User';
        $class = 'fa-user-secret';
        break;
    default:
        $label = '';
        $class = '';
        break;
}
?>
<?php if ($label != '' && $class != '') : ?>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb bc-no-margin">
                <li><i class="fa fa-dashboard"></i><a href="/admin/"> Home</a></li>
                <li class="active"><i class="fa <?php echo $class ?>"></i> <?php echo $label ?></li>
            </ol>
        </div>
    </div>
    <hr class="hr-no-margin">
<?php endif; ?>
