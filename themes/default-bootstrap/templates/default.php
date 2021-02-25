<?php
/** @var $this Page */
$navbarConfig = $this->reboot->website['navbar'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reboot CMS</title>

    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $this->reboot->themePath() ?>/assets/style/default.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="<?= $this->reboot->baseUrl ?>/"><?php echo $navbarConfig["brand"] ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <?php
            $structure = $navbarConfig['structure'];
            foreach ($structure as $label => $path) {
                ?>
                <li class="nav-item <?= $this->reboot->requestUri == $path ? "active" : "" ?>">
                    <a class="nav-link" href="<?= $this->reboot->baseUrl . $path ?>"><?= $label ?></a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>
<?php
echo($this->article->render());
?>
<script src="/vendor/components/jquery/jquery.slim.js"></script>
<script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
