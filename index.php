<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/main_style.css">
    <?php
        require ("img/favicons/favicons.php")
    ?>
</head>
<body>

        <header>
            <div class="container"> 
                <a href="index.php"><div class="logo">LawNotes</div></a>
                <a href="login.php"><div class="button_login">Войти</div></a>
            </div>
        </header>

        <div class="content">
            <div class="main_text">
                <div class="main_text_title">Управляйте своими заметками и делами уже сейчас !</div>
                <a href="registration.php"> <div class="main_button">Начать <div class ="arrow"> </div> </div></a>
            </div>
            <div class="main_img"></div>
        </div>
        
        <footer>    
            <div class="container"> 
                <div class="footer_text">© 2023 - 2024. LawNotes. Все права защищены</div>
            </div>
        </footer>

</body>
</html>