<?php

    require_once __DIR__ . '/php_vendor/helpers.php';

    check_auth();

    $user = current_user();

    $id_user= $_SESSION['user']['id'];
    $id_note = $_GET['note_id'];

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рабочая страница</title>
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/home_style.css">
    <?php
        require ("img/favicons/favicons.php")
    ?>
</head>
<body>
    <div class="wrapper">
        
        <header>
            <div class="container"> 
                <a href="home.php"><div class="logo">LawNotes</div></a>
                <ul class="menu list_reset">
                    <li class="menu__item">
                        <button class="menu__btn"> <img class="menu__img" src="../svg/profile.svg" alt="профиль">   <?php echo $user['login']; ?></button>
                        <div class="dropdown">
                            <ul class="dropdown__list list_reset">
                                <li class="dropdown__item">
                                    <a href="login.php" class="dropdown__link"><form action="php_vendor/actions/logout.php" method="POST"><button class="logout_btn">Выход</button></form></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul> 
            </div>    
        </header> 
        <!-- Модальное окно -->
        

        <div class="content">
                <div class="left_menu">
                    <div class="left_menu__container">
                        <div class="left_menu__title">
                            <button class="create_note__btn" id="create_note__btn" name ="create_note__btn" > <img class="create_note__img" src="../svg/add.svg" alt="добавить" size="18">  Добавить заметку</button>
                            <p class="title">Список заметок</p>
                        </div>

                        <div class="left_menu__content">




                        <?php foreach (get_notes($id_user) as $note):   ?>
                            <div class="note_list"> 
                                <div class="note_list__container"> 
                                    <div class="note_title"><a class="note_title" href="/single_note.php?note_id=<?= $note['id']?>"><?= $note['note_name']?></a></div>
                                    <div class="note_text">
                                        <?=mb_substr($note['note_text'], 0, 35, 'UTF-8') . '...'?>
                                    </div>
                                    <div class="note_date">Дата создания - <?= $note['note_date']?></div>
                                    <div class="note_status">Статус - <?= $note['note_status']?></div>                                   
                                </div>
                            </div>
                        <?php endforeach; ?>


                        </div>

                    </div>
                </div>
                <div class="work_space">
                    <div class="work_space__container">
                        <?php foreach (get_single_note($id_note) as $note):   ?>
                                <form action="" method="POST" >
                            <div class="reg_input_box" id="reg_input_box">

                                <label class="input_box_info" for="note_name">Название</label>

                                <?php if (has_validation('note_name')): ?>
                                    <div class="error"> <?php echo validation_error_message('note_name'); ?> </div> 
                                <?php endif; ?>

                                <input 
                                    type="text"
                                    id="note_name"
                                    class="note_name"
                                    name = "note_name"
                                    placeholder="Название"
                                    value = "<?= $note['note_name']?>"
                                >
                            </div>

                            <div class="reg_input_box" id="reg_input_box">
                                <label class="input_box_info" for="note_text_1">Текст</label>

                                <?php if (has_validation('note_text_1')): ?>
                                    <div class="error"> <?php echo validation_error_message('note_text_1'); ?> </div> 
                                <?php endif; ?>

                                <textarea
                                    id="note_text_1"
                                    class="note_text_1"
                                    name = "note_text_1"
                                    rows="5"
                                    cols="33"
                                    placeholder="Текст вашей заметки (не более 255 символов)"
                                    wrap="hard"                                
                                ><?= $note['note_text']?></textarea>
                            </div>

                            <div class="reg_input_box" id="reg_input_box">

                                <label class="input_box_info" for="date">Дата</label>

                                <?php if (has_validation('date')): ?>
                                    <div class="error"> <?php echo validation_error_message('date'); ?> </div> 
                                <?php endif; ?>

                                <input 
                                    type="date"
                                    id="date"
                                    class="date"
                                    name = "date"
                                    placeholder="Название"
                                    value = "<?= $note['note_date']?>"
                                >

                            </div>

                                <div class="reg_input_box" id="reg_input_box">

                                <label class="input_box_info" for="status">Статус</label>

                                <?php if (has_validation('date')): ?>
                                    <div class="error"> <?php echo validation_error_message('date'); ?> </div> 
                                <?php endif; ?>

                                <input 
                                    type="input"
                                    id="status"
                                    class="status"
                                    name = "status"
                                    placeholder="Статус"
                                    value = "<?= $note['note_status'] ?>"
                                >

                            </div>

                            <button class="save_button">Сохранить</button>
                        </form>
                        <?php endforeach; ?>
                    </div>
                </div>
        </div>
        <footer>    
            <div class="container"> 
                <div class="footer_text">© 2023 - 2024. LawNotes. Все права защищены</div>
            </div>
        </footer>

        <div class="modal" id="modal-1">
            <div class="modal__content">
                <button class="modal__close-button"> <img src="../svg/close.svg" width="18" alt="Закрыть"> </button>      
                <!-- контент содального окна -->
                <h1 class="modal__title">Новая заметка</h1>
                <form action="../php_vendor/actions/add_note.php" method="POST" >
                        <div class="reg_input_box" id="reg_input_box">

                            <label class="input_box_info" for="note_name">Название</label>

                            <?php if (has_validation('note_name')): ?>
                                <div class="error"> <?php echo validation_error_message('note_name'); ?> </div> 
                            <?php endif; ?>

                            <input 
                                type="text"
                                id="note_name"
                                class="note_name"
                                name = "note_name"
                                placeholder="Название"
                                value = "<?php echo old('note_name'); ?>"
                            >
                        </div>

                        <div class="reg_input_box" id="reg_input_box">
                            <label class="input_box_info" for="note_text_1">Текст</label>

                            <?php if (has_validation('note_text_1')): ?>
                                <div class="error"> <?php echo validation_error_message('note_text_1'); ?> </div> 
                            <?php endif; ?>

                            <textarea
                                id="note_text_1"
                                class="note_text_1"
                                name = "note_text_1"
                                rows="5"
                                cols="33"
                                placeholder="Текст вашей заметки (не более 255 символов)"
                                wrap="hard"                                
                            ><?php echo old('note_text_1'); ?></textarea>
                        </div>

                        <div class="reg_input_box" id="reg_input_box">

                            <label class="input_box_info" for="date">Дата</label>

                            <?php if (has_validation('date')): ?>
                                <div class="error"> <?php echo validation_error_message('date'); ?> </div> 
                            <?php endif; ?>

                            <input 
                                type="date"
                                id="date"
                                class="date"
                                name = "date"
                                placeholder="Название"
                                value = "<?php echo old('date'); ?>"
                            >

                        </div>

                        <button class="save_button">Сохранить</button>
                </form>
            </div> 
        </div>
        <script src="../js/script.js"></script>
</body>
</html>


