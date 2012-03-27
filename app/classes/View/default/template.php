<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>{{title}}</title>
  <meta name="description" content="{{description}}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php foreach ($styles as $file => $type) print ('<link rel="stylesheet" href="' . $file . '" media="' . $type . '">'. PHP_EOL) ?>
</head>
<body>
  <div id = 'wrap'>
     <div id = 'header'></div>
     <div id = 'content'>{{content}}</div>
     <div id = 'footer'></div>
  </div>
  <?php foreach ($scripts as $file) print ('<script src="' . $file . '"></script>'. PHP_EOL) ?>
</body>
</html>
