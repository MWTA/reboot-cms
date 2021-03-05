<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * Repository: https://github.com/shaack/reboot-cms
 * License: MIT, see file 'LICENSE'
 */

/** @var \Shaack\Reboot\Block $this */

/*
 * https://devhints.io/xpath
 */
?>
<section class="block block-jumbotron">
    <div class="container">
        <div class="jumbotron">
            <!-- convert the text of the <h1> in part 1 to a display-4 -->
            <h1 class="display-4"><?= $this->xpath("/h1[part(1)]/text()") ?></h1>
            <!-- the lead will be the text of the <p> of part 1 -->
            <p class="lead"><?= $this->xpath("/p[part(1)]/text()") ?></p>
            <hr class="my-4">
            <!-- print everything in part 2 -->
            <?= $this->xpath("/*[part(2)]") ?>
            <p>
                <!-- the link in part 3 will be used as the primary button -->
                <a class="btn btn-primary btn-lg" href="<?= $this->xpath("//a[part(3)]/@href") ?>"
                   role="button"><?= $this->xpath("//a[part(3)]/text()") ?></a>
            </p>
        </div>
    </div>
</section>