
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= SITE_NAME ?></title>
        <meta name="description" content=<?= SITE_DESCRIPTION ?>>
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/front.css">
    </head>
    <?php
    $setting = new \App\Models\Settings();
    if($setting->findOneById(1)) {
        $currentSetting = $setting->findOneById(1);
        $backgroundColor = $currentSetting->getBackgroundColor();
        $fontColor = $currentSetting->getFontColor();
        $fontStyle = $currentSetting->getFontStyle();
    } else {
        $backgroundColor = $_ENV["BACKGROUND_COLOR"];
        $fontColor = $_ENV["FONT_COLOR"];
        $fontStyle = $_ENV["FONT_STYLE"];
    }
    ?>
    <body>
    <?php include 'front-nav.php'; ?>
    <div id="theme">
        <a id="themelink" href="#">
            <img id="themeIcon" src="" alt="Theme Icon">
        </a>
    </div>

    <main id="main" class="light-theme" style="font-family: <?= $fontStyle ?>; margin-top: 10vh">
        <!-- intégration de la vue -->
        <?php include "../Views/".$this->view.".php";?>
    </main>
    <?php include 'front-footer.php'; ?>
    </body>
    <script src="/js/theme.js" ></script>
</html>