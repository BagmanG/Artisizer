<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Artisizer - сервис для пакетного сжатия картинок</title>
    <meta name="description" content="Если у вас есть папка с множеством картинок, изображений, фотографий, и нужно уменьшить ее размер, Artisizer спешит на помощь!">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<body class="premium-gray" style="
    margin: 0;
    overflow: hidden;
">
<main>

        <div id="drop-zone" class="drop-zone">
            <div class="dropFormWin">
            <p class="no_news">Переместите сюда zip архив с папкой или выберите файл в ручную>>></p>
            <input type="file" id="file-input" style="display: none" accept=".zip">
            <div id="file-list"></div>
            <div id="form-container">
                <form action="artisizer/handler.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="zipfile" id="zipfile" accept=".zip" style="display:none;" required>
                    <button onclick="uploadZip();" type="button" class="button">Выбрать файл</button>
                    <button id="submit-button" type="submit" class="button" disabled>Сжать</button>
                </form>
            </div>
            </div>

        </div>

</main>

<div class="popup" style="display: none; z-index: 1">
    <div class="popup-content">
        <h2>Мы вам рады!</h2>
        <p>Используя наш сервис вы получаете возможность пакетно сжимать все изображения в папке, Artisizer с легостью найдет и сожмет все картинки даже в дочерних папках!</p>
        <button class="close">Закрой меня и приступай!</button>
    </div>
</div>
<script>
        document.getElementById('zipfile').addEventListener('change', function(){
          if( this.value ){
            document.getElementById('submit-button').disabled = false;
          } else {
            console.log( "Файл не выбран" ); 
          }
        });
    function uploadZip(){
        document.getElementById('zipfile').click();
    }
    document.addEventListener("DOMContentLoaded", function(event) {
        const popup = document.querySelector('.popup');
        const closePopupButton = document.querySelector('.popup .close');

        popup.style.display = 'flex';

        closePopupButton.addEventListener('click', function() {
            popup.style.display = 'none';
        });


    });
</script>

</body></html>