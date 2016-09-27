<?php

use yii\helpers\Html;

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
    </head>
    <body class="login">
        <?php $this->beginBody() ?>
        <div class="ui page grid">
            <div class="sixteen wide column">
                <?= $content ?>
            </div>
        </div>

        <?php $this->endBody() ?>
        <script type="text/javascript">
            var baseUrl = "<?= Yii::$app->request->baseUrl; ?>";
        </script>
    </body>
</html>
<?php $this->endPage() ?>