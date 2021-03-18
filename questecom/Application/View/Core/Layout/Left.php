<aside class="menu-sidebar d-none d-lg-block">
    <div id="leftHtml">
        <?php

        $children = $this->getChildren();
        foreach ($children as $child) {
            echo $child->toHtml();
        }
        ?>
    </div>

</aside>