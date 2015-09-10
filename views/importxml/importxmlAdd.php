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
                <div class="panel panel-primary xml-form">
                    <div class="panel-heading">Загрузка XML</div>
                    <div class="panel-body">
                        <form class="form-horizontal" accept-charset="UTF-8"
                              method="POST" action="/importxml/add" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputXml">Выберете файл XML</label>
                                <input type="file" id="exampleInputXml" name="newXml">
                            </div>
                            <button type="submit" class="btn btn-primary">Начать импорт данных</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>