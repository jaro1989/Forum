<!--jumbotron-->
<div class="jumbotron top-margin-low">
    <?php if (!isset($_SESSION['userID'])) { ?>
        <h2><strong>Зарегестрируйтесь для создания новых категорий и постов</strong>  </h2>
    <?php } else { ?>

        <h2><strong>Выберите категорию или <a href="index.php?page-create_category"> создайте новую </a></strong>  </h2>

    <?php } ?>


</div>
<!--End jumbotron-->
<div class="container" >
    <!--Blog Start-->  
    <div class="row "> 
        <!--Categories and other -->            
        <div class="col-md-12 top-margin">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Список категорий
                </div>
                <div class="panel-body">
                    <?php echo ContentManager::renderCategories($categories, "messNum"); ?>
                </div>

            </div>

            <!--End Categories and other --> 
            <!--Blog Listing--> 
        </div>
    </div>
    <!--Blog end-->  


</div>
<!-- /.container -->

