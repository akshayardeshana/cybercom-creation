
<body>
    <div class="page-wrapper">

        <!--HEADER-->
        <?php echo $this->getChild('header')->toHtml(); ?>


        <!-- PAGE CONTAINER-->
        <div class="page-container">
        
            <!-- HEADER DESKTOP-->
            <div class="main-content">

                <?php echo $this->createBlock('Block_Core_Layout_Message')->toHtml(); ?>
                <?php echo $this->getChild('content')->toHtml(); ?>

            </div>
        </div>
    </div>

    <!--FOOTER-->
    <?php echo $this->getChild('footer')->toHtml(); ?>
</body>

</html>
<!-- end document-->