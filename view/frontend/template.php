
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="../blog/public/image/icon.jpg" />
  <link href="public/css/style.css" rel="stylesheet" />
  <title><?= $title ?></title>
</head>
<body>
  <?php require('view/frontend/header.php') ?>
  <?= $content ?>
    <?php require('view/frontend/footer.php') ?>
</body>
</html>
