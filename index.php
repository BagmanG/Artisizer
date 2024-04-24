<html><head><style>

    body.premium-gray {
        background-color: #f5f5f5;
    }

    @font-face {
        font-family: "Open Sans";
        src: local("Open Sans"), url("fonts/open-sans.woff2") format("truetype");
        font-weight: 100;
        font-style: normal;
        font-display: swap;
    }
    *{
        font-family: "Open Sans",sans-serif;
    }

    header {
        background-color: #333;
        color: #fff;
        padding: 1rem;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
    }

    header .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    header .logo {
        flex-basis: 33.33%;
    }

    header nav {
        flex-basis: 33.33%;
        text-align: center;
    }

    header nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
    }

    header nav ul li {
        margin: 0 1rem;
    }

    header nav ul li a {
        color: #fff;
        text-decoration: none;
    }

    .no_news{

        text-align: center;
        font-weight: 900;
        font-size: 40px;
        margin: 0;
        margin-bottom: 10px;
    }

    header .buttons {
        flex-basis: 33.33%;
        text-align: right;
    }

    header .buttons button {
        background-color: #fff;
        border: none;
        padding: 0.5rem 1rem;
        margin: 0 0.5rem;
        border-radius: 0.2rem;
        cursor: pointer;
    }



    footer {
        background-color: #333;
        color: #fff;
        padding: 1rem;
        text-align: center;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
    }

    .popup {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
    }

    .popup .popup-content {
        background-color: #fff;
        padding: 2rem;
        border-radius: 0.5rem;
        text-align: center;
    }

    .popup .popup-content h2 {
        margin-bottom: 1rem;
    }

    .popup .popup-content p {
        margin-bottom: 1rem;
    }

    .popup .popup-content button {
        background-color: #333;
        border: none;
        padding: 0.5rem 1rem;
        color: #fff;
        border-radius: 0.2rem;
        cursor: pointer;
    }
    .drop-zone {

        padding: 20px;
        text-align: center;
        cursor: pointer;
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
    }



    .drop-zone.active {
        transition: 0.3s;
        backdrop-filter: grayscale(1);
    }



    #file-list {
        list-style-type: none;

        padding: 0;
    }

    #file-list li {
        padding: 5px 0;

        list-style-type: none;
        margin-bottom: 5px;
    }

    #form-container {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;

    }

    #form-container button {
        margin-top: 10px;
    }
    .button{
        width: 150px;
        padding: 10px;
        border: none;
        border-radius: 10px;
        margin: 10px;
    }
    .dropFormWin{
        padding: 40px;
        border-radius: 20px;


    }
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<body class="premium-gray" style="
    margin: 0;
    overflow: hidden;
">

<main>
    <div class="content" style="
    color: #333333;
    height: 100vh;
    z-index: 1;
    position: absolute;
    display: flex;
    width: 100%;
    margin: 0 auto;
    flex-direction: column;
    align-items: center;
    justify-content: center;
">

        <div id="drop-zone" class="drop-zone">
            <div class="dropFormWin">
            <p class="no_news">Переместите сюда архив с папкой...</p>
            <input type="file" id="file-input" style="display: none" accept=".zip">
            <div id="file-list"></div>
            <div id="form-container">
                <form action="artisizer/handler.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="zipfile" id="zipfile" accept=".zip" style="display:none;" required>
                    <button onclick="uploadZip();" type="button" class="button">Загрузить</button>
                    <button id="submit-button" type="submit" class="button" disabled>Сжать</button>
                </form>
            </div>
            </div>

        </div>

    </div>
</main>

<div style="position: absolute;height: 100vh;width: 100vw;
        -webkit-backdrop-filter: blur(5px);
    backdrop-filter: blur(5px);"></div>
<div class="popup" style="display: none; z-index: 2">
    <div class="popup-content">
        <h2>Мы вам рады!</h2>
        <p>Используя наш сервис вы получаете возможность пакетно сжимать все изображения в папке, Artisizer с легостью найдет и сожмет все картинки даже в дочерних папках!</p>
        <h2>Инструкция</h2>
        <h3>Шаг 1:</h3>
        <p>Прочитайте и закройте инструкцию :)</p>
        <h3>Шаг 2:</h3>
        <p>Сожмите свою папку с картинками файлами и подпапками в zip или rar архив.</p>
        <h3>Шаг 3:</h3>
        <p>Возьмите файл с рабочего стола и переместите его в область Artisizer, или нажмите на кнопку загрузить, а затем выбирете файл.</p>
        <p>Успех! Теперь у вас в загрузках архив, который содержит в себе исходную папку с сжатыми изображениями!</p>
        <button class="close">Закрыть</button>
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