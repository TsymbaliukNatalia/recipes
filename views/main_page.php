<?php
include_once "main.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/66c6a599dc.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Lobster&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
</head>

<body>

    <div class="wraper">
        <header>
            <div class="main_menu blur_conteiner">

                <!-- SEARCH -->

                <div class="simple_search">
                    <div class="search">
                        <input type="checkbox" id="check">
                        <div class="box">
                            <input type="text" placeholder="Пошук рецепту...">
                            <label for="check"><i class="fas fa-search"></i></label>
                        </div>
                    </div>
                </div>

                <!-- //SEARCH -->

                <!-- MENU -->

                <nav class="menu">
                    <li class="menu_item menu_week"><a href="#">Створити меню на тиждень</a></li>
                    <li class="menu_item menu_book"><a href="#">Моя кулінарна книга</a></li>
                    <li class="menu_item menu_user"><a href="#"><i class="fas fa-user-circle"></i></a>
                        <ul id="hover_menu">
                            <li><a href="#" class="blur_conteiner">Увійти</a></li>
                            <li><a href="#" class="blur_conteiner">Зареєструватись</a></li>
                        </ul>
                    </li>
                </nav>

                <!-- //MENU -->

            </div>
            
            <!-- <div class="log_in">
                <form method="POST" action="user_auth.php">
                    <p><input type="text" name="login" placeholder="E-mail адреса"></p>
                    <p><input type="password" name="password" placeholder="Пароль"></p>
                    <p><button type="submit" name="submit_log_in">Увійти</button></p>
                </form>
            </div> -->
        </header>

        <!-- SITE NAME CONTEINER -->

        <div class="site_name_box blur_conteiner">
            <div class="site_name">
                <h1>Твої кулінарні шедеври</h1>
                <p>Ділись... Надихайся... Зберігай...</p>
            </div>
        </div>

        <!-- //SITE NAME CONTEINER -->

        <main>

            <!-- FILTER BLOCK -->

            <button class="filter_block blur_conteiner">Фільтри</button>

            <!-- //FILTER BLOCK -->

            <!-- RECIPE LIST -->

            <section class="recipe_list blur_conteiner">
                <div class="recipes">
                    <div class="recipe">
                        Зображення
                        <h3>Назва</h3>
                        Час приготування
                        Інгердієнти
                        короткий опис
                        Переглянути рецепт
                        Категорії і сердечко
                    </div>

                </div>
                <div class="pagination">

                </div>
            </section>

            <!-- //RECIPE LIST -->

        </main>

    </div>
    <script src="../js/script.js"></script>
</body>

</html>