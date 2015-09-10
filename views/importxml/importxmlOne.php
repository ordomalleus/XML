<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?php echo $this->base; ?>"/>
    <link href="/views/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/views/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="/views/css/colorbox.css" rel="stylesheet" type="text/css"/>
    <link href="/views/css/my.css" rel="stylesheet" type="text/css"/>
    <script src="/views/js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="/views/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/views/js/jquery.colorbox-min.js" type="text/javascript"></script>
    <script src="/views/js/my.js" type="text/javascript"></script>
</head>
<body>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <p>Файл</p>
                    <a class="btn btn-primary" role="button" href="/importxml/addform">Загрузить новый XML</a>
                </div>
                <div>
                    <p class="well">Добавленно в базу: <?= $xml['addBd'];?></p>
                    <p class="well">Обновленно имен в базе: <?= $xml['updateName'];?></p>
                    <p class="well">Обновленно пароллей в базе: <?= $xml['updatePassword'];?></p>
                    <p class="well">Обновленно емайлов в базе: <?= $xml['updateEmail'];?></p>
                    <p class="well">Удаленно из базы: <?= $xml['delBd'];?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
</section>
</body>
</html>