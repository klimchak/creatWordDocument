<?php

$arrSet = array(
        'd_org' => '"ООО" Реммастер',
        'd_address' => 'пер. Козлова, д. 14, к. 33',
        'd_index' => '222100',
        'd_name' => 'Договор № ',
        'd_nameS' => 'Иванов А.А.',
        'd_year' => 'г. Минск-2019',
        'footer5' => '19.12.2019 г.',
);

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Index page</title>


    <!-- Bootstrap core CSS -->
    <link href="/node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/node_modules/cover.css" rel="stylesheet">
</head>

<body class="text-center">
    <div class="cover-container d-flex h-auto p-5 flex-column justify-content-center">
    <div class="row">
        <main role="main" class="inner cover">
            <form enctype="multipart/form-data" class="form-signin" action="work.php" method="post">
                <div class="accordion" id="accordionMni">
                    <div class="card">
                        <div class="card-header" id="headOne">
                            <h5 class="m-0 p-0">
                                <button class="btn btn-link text-decoration-none text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Изменить первичные данные документа
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse " aria-labelledby="headOne" data-parent="#accordionMni">
                            <div class="card-body text-dark">
                                <div class="input-group mb-2">
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'>Организация:</span>
                                    </div>
                                    <input type="text" class="form-control" id="InputRank" name="v1" aria-describedby="inputSerialHelp" value="<?echo $arrSet['d_org']?>" required>
                                </div>
                                <div class="input-group mb-2">
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'>Адрес:</span>
                                    </div>
                                    <input type="text" class="form-control" id="InputRank" name="v2" aria-describedby="inputSerialHelp" value="<?echo $arrSet['d_address']?>" required>
                                </div>
                                <div class="input-group mb-2">
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'>Индекс:</span>
                                    </div>
                                    <input type="text" class="form-control" id="InputRank" name="v3" aria-describedby="inputSerialHelp" value="<?echo $arrSet['d_index']?>" required>
                                </div>
                                <div class="input-group mb-2">
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'>Название документа:</span>
                                    </div>
                                    <input type="text" class="form-control" id="InputRank" name="v4" aria-describedby="inputSerialHelp" value="<?echo $arrSet['d_name']?>" required>
                                </div>
                                <div class="input-group mb-2">
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'>Вторая строчка названия:</span>
                                    </div>
                                    <input type="text" class="form-control" id="InputRank" name="v5" aria-describedby="inputSerialHelp" value="<?echo $arrSet['d_nameS']?>" required>
                                </div>
                                <div class="input-group mb-2">
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'>Город и год:</span>
                                    </div>
                                    <input type="text" class="form-control" id="InputRank" name="v6" aria-describedby="inputSerialHelp" value="<?echo $arrSet['d_year']?>" required>
                                </div>
                                <label for="InputRank">Пятка документа</label>
                                <div class="input-group mb-2">
                                    <div class='input-group-prepend'>
                                        <span class='input-group-text'>Доп поле (истинность):</span>
                                    </div>
                                    <input type="text" class="form-control" id="InputRank" name="v11" aria-describedby="inputSerialHelp" value="<?echo $arrSet['footer5']?>" required>
                                </div>


                            </div>
                        </div>
                    </div>
                     <div class="card">
                        <div class="card-header" id="headTwo">
                            <h5 class="m-0 p-0">
                                <button class="btn btn-link text-decoration-none text-dark " type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Загрузка файла слов
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headTwo" data-parent="#accordionMni">
                            <div class="card-body text-dark">
                                <h3 class="h3 mb-3 font-weight-normal">Выберете файл со словарем</h3>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Укажите файл</span>
                                    </div>
                                    <input type="file" name="file" class="form-control ">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Укажите дату</span>
                                    </div>
                                    <input type="date" name="date" id="inputDate" class="form-control" placeholder="Укажите дату" required>
                                </div>
                                <button class="btn btn-lg btn-dark btn-block mb-4" type="submit">Создать документ</button>
                            </div>
                        </div>
                    </div>
                </div>



            </form>



        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">

<? if (isset($_GET["err"])) {
    if ($_GET['err'] == 1) {
        print '<script>alert("Ошибка загрузки")</script>';
    }
}
    if (isset($_GET["ok"])){
    if ($_GET['ok'] == 1){
        print '<script>alert("Ранее загруженный файл удален. Кэш очищен.")</script>';
    }

} ?>

<script src="node_modules/jquery/dist/jquery.js"></script>
<script>window.jQuery || document.write('<script src="node_modules/jquery/dist/jquery.js"><\/script>')</script>
<script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>


</body>

</html>