<?php

require_once __DIR__ . '/config.php';

$url = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$url = (empty($url) ? 'index' : $url);
$url = explode('/', $url);

?><!DOCTYPE>
<html lang="pt_br">
<head>
    <title>Sistema Slave</title>
    <link rel="stylesheet" href="_cdn/css/style.css">
</head>
<body>

<?php

require_once __DIR__ . '/_theme/main/header.php';

if(!empty($url[0]) && $url[0] == 'list'){
    require __DIR__ . '/_theme/main/list.php';
} else {
    require __DIR__ . '/_theme/main/index.php';
}

require_once __DIR__ . '/_theme/main/footer.php';

?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" crossorigin="anonymous"></script>
<script src="_cdn/js/script.js"></script>
</body>
</html>