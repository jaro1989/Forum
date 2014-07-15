<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Forum</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- Fontawesome core CSS -->
        <link href="css/font-awesome.min.css" rel="stylesheet" />
        <!--GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <!-- blog css -->
        <link href="css/blog.css" rel="stylesheet" />
        <!-- custom CSS here -->
        <link href="css/style.css" rel="stylesheet" />
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <p>FORUM</p>
                </div>
                <!-- Collect the nav links for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php?page=main">Главная</a>
                        </li>
                        <li><a href="index.php?page=forum">Форум</a>
                        </li>
                        <li><a href="index.php?page=contacts">Контакты</a>
                        </li>

                        <?php if (!isset($_SESSION['userName'])) { ?>
                            <li><a href="index.php?page=registration">Регистрация</a>
                            </li>
                            <li><a href="index.php?page=login">Login</a>
                            </li>
                        <?php } else { ?>
                            <li><a href="index.php?page=user">Ваш Аккаунт</a>
                            </li>
                            <li><a href="index.php?page=logout">Logout, <?php echo $_SESSION['userName']; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>