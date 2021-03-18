
<body>
    <div class="page-wrapper">

        <?php echo $this->getChild('header')->toHtml(); ?>
     <?php echo $this->getChild('left')->toHtml(); ?>
        <div class="page-container-1">
            <div class="main-content">

                <?php echo $this->createBlock('Block_Core_Layout_Message')->toHtml(); ?>
                <?php echo $this->getChild('content')->toHtml(); ?>

            </div>
        </div>
    </div>
    <?php echo $this->getChild('footer')->toHtml(); ?>
</body>

</html>
