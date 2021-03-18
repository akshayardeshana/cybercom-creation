<!DOCTYPE html>

<html lang="en">

<head>

    <!-- Bootstrap CSS-->
    <link href="../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="../css/theme.css" rel="stylesheet" media="all">

    <script type="text/javascript" src="<?php echo $this->baseUrl('skin/Admin/JS/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $this->baseUrl('skin/Admin/JS/mage.js'); ?>"></script>

</head>



<link rel="icon" >
<header class="header-desktop">

    
    <div class="logo">
        <a href="http://localhost/project/Application/View/index.php?c=index&a=index">
            <img src="../images/icon/questecom.png" width="250px" />
        </a>
    </div>

    <div class="section__content section__content--p0">
        <div class="container-fluid">
            <div class="header-wrap">
                <form class="form-header" action="" method="POST">
                </form>
                <!-- admin profile -->
                <div class="header-button">
                    <div class="noti-wrap">
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="topnav">
                                <a href="http://localhost/project/Application/View/index.php?c=index&a=index">Dashboard</a>

                                <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('gridHtml', 'admin') ?>').resetParams().load(); ">Admin</a>

                                <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('gridHtml', 'customer') ?>').resetParams().load(); ">Customer</a>

                                <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('gridHtml', 'Payment') ?>').resetParams().load(); ">Payment</a>

                                <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('gridHtml', 'Category') ?>').resetParams().load(); ">Category</a>

                                <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('gridHtml', 'customerGroup') ?>').resetParams().load(); ">Customer Group</a>

                               
                                <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('gridHtml', 'Product') ?>').resetParams().load(); ">Product</a>

               
                                <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('gridHtml', 'Shipment') ?>').resetParams().load(); ">Shipment</a>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<script>
var object = new Base();
// $(document).ready(function () {
//    object.setUrl('http://localhost/project/Application/View/index.php?c=product&a=gridHtml');
//    object.load();
// });
</script>