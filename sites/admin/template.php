<?php

/** @var Shaack\Reboot\Reboot $reboot */
/** @var Shaack\Reboot\Page $page */

?>
<!doctype html>
<html lang="en">
<head>
    <base href="<?= $reboot->getBaseWebPath() ?>"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reboot CMS</title>
    <?php if($reboot->getAdminSession()->getUser()) { ?>
        <link href="/vendor/simplemde-markdown-editor/simplemde.min.css" rel="stylesheet">
    <?php } ?>
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/theme/assets/style/screen.css" rel="stylesheet">

</head>
<body>
<?php $navbarConfig = $reboot->getGlobals()['navbar']; ?>
<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="/"><?php echo $navbarConfig["brand"] ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <?php
            $structure = $navbarConfig['structure'];
            if ($structure) {
                foreach ($structure as $label => $path) {
                    ?>
                    <li class="nav-item <?= $reboot->getRequest()->getPath() == $path ? "active" : "" ?>">
                        <a class="nav-link" href="<?= $reboot->getBaseWebPath() . $path ?>"><?= $label ?></a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <?php if ($reboot->getAdminSession() && $reboot->getAdminSession()->getUser()) { ?>
            <span class="mr-3 navbar-text">
                Logged in as <?= $reboot->getAdminSession()->getUser() ?>
            </span>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/admin/logout" class="btn btn-outline-secondary">
                        Logout
                    </a>
                </li>
            </ul>
        <?php } ?>
    </div>
</nav>
<?php
echo($page->render());
?>
<script src="/vendor/components/jquery/jquery.js"></script>
<script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<?php if($reboot->getAdminSession()->getUser()) { ?>
<script src="/theme/assets/scripts/simplemde-markdown-editor/simplemde.min.js"></script>
<script>
    setTimeout(function() {
        $(".fade-out").fadeOut(250);
    }, 1000)
    var simplemde = new SimpleMDE();
</script>
<?php } ?>
</body>
</html>