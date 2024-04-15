<?php

    require_once __DIR__ . '/php_vendor/helpers.php';
    check_guest();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/login_style.css">
    <?php
        require ("img/favicons/favicons.php")
    ?>
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="container"> 
                <a href="index.php"><div class="logo">LawNotes</div></a>
            </div>
        </header>

        <div class="content">
            <div class="reg_container">
                <div class="reg_title">Вход</div>
                <div class="reg_subtitle">Если у вас нет аккаунта</div>
                <div class="reg_subtitle_second">Вы можете <a href="registration.php">создать его здесь</a></div>

                <?php if (has_message('error')): ?>
                    <div class="error"> <?php echo get_message('error'); ?> </div>
                <?php endif; ?>

                <form action="../php_vendor/actions/logins.php" class="form_box" method="POST" enctype="multipart/form-data">
                    <div class="input_box">
                        <div class="reg_input_box">
                            <label class="input_box_info" for="email">Email</label>
                            <label class="input_box_icon" for="email"><img src="../svg/message.svg" alt="email"></label>
                            <input 
                                type="text"
                                id="email"
                                class="email"
                                name = "email"
                                value = "<?php echo old('email'); ?>"
                                placeholder="Введите свой email"
                                <?php
                                    validation_error_attr('email');
                                ?>
                            >
                        </div>
                        <div class="reg_input_box">
                            <label class="input_box_info" for="password">Пароль</label>
                            <label class="input_box_icon" for="password"><img src="../svg/padlock.svg" alt="password"></label>
                            <input 
                                type="password"
                                id="password"
                                class="password"
                                name = "password"
                                placeholder="Введите свой пароль"
                                <?php
                                    validation_error_attr('email');
                                ?>
                            >
                        </div>
                        <button class="reg_button">Войти</button>  
                    </div>

                </form >    

            </div>
            <div class="main_img"></div>
        </div>

    <footer>    
        <div class="container"> 
            <div class="footer_text">© 2023 - 2024. LawNotes. Все права защищены</div>
        </div>
    </footer>
    </div>

</body>
</html>