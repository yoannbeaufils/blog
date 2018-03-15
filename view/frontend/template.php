
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/jpg" href="favicon.jpg" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="public/css/style.css" rel="stylesheet" />
  <title><?= $title ?></title>
</head>
<body>
  <?php require('view/frontend/header.php') ?>
  <?= $content ?>
    <?php require('view/frontend/footer.php') ?>
</body>
</html>
