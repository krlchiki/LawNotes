<?php

    require_once __DIR__ . '/php_vendor/helpers.php';
    check_guest();
?>



<!DOCTYPE html> 
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/registration_style.css">
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
                <div class="reg_title">Регистрация</div>
                <div class="reg_subtitle">Если у вас уже есть аккаунт</div>
                <div class="reg_subtitle_second">Вы можете <a href="login.php">войти здесь</a></div>

                <form action="../php_vendor/actions/register.php" class="form_box" method="POST" enctype="multipart/form-data">
                    <div class="input_box">
                        <div class="reg_input_box" id="reg_input_box">
                            <?php if (has_validation('email')): ?>
                                <div class="error"> <?php echo validation_error_message('email'); ?> </div> 
                            <?php endif; ?>

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

                        <div class="reg_input_box"  id="reg_input_box">

                            <?php if (has_validation('login')): ?>
                                    <div class="error"> <?php echo validation_error_message('login'); ?> </div> 
                            <?php endif; ?>

                            <label class="input_box_info" for="login">Логин</label>
                            <label class="input_box_icon" for="login"><img src="../svg/user.svg" alt="login"></label>
                            <input 
                                type="text"
                                id="login"
                                class="login"
                                name = "login"
                                value = "<?php echo old('login'); ?>"
                                placeholder="Введите свой логин"
                                <?php
                                    validation_error_attr('login');
                                ?>
                                
                            >
                        </div>

                        <div class="reg_input_box"  id="reg_input_box">
                            
                            <?php if (has_validation('password')): ?>
                                    <div class="error"> <?php echo validation_error_message('password'); ?> </div> 
                            <?php endif; ?>

                            <label class="input_box_info" for="password">Пароль</label>
                            <label class="input_box_icon" for="password"><img src="../svg/padlock.svg" alt="password"></label>
                            <input 
                                type="password"
                                id="password"
                                class="password"
                                name = "password"
                                placeholder="Введите свой пароль"
                                <?php
                                    validation_error_attr('password');
                                ?>    
                            >
                        </div>
                        <div class="reg_input_box" id="reg_input_box">
                            <label class="input_box_info" for="password_again">Повторите пароль</label>
                            <label class="input_box_icon" for="password_again"><img src="../svg/padlock.svg" alt="password_again"></label>
                            <input 
                                type="password"
                                id="password_again"
                                class="password_again"
                                name = "password_again"
                                placeholder="Повторите свой пароль"
                                
                            >
                        </div>
                        <button class="reg_button">Зарегистрироваться</button>  
                    </div>

                </form>                     
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