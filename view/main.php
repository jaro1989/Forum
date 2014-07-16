<!--jumbotron-->
<div class="jumbotron top-margin-low">
    <h2><strong>Добро пожаловать на наш форум</strong>  </h2>
    <p>Здесь вы можете поделиться последними новостями</p>



</div>
<!--End jumbotron-->
<div class="container" >
    <!--Blog Start-->  
    <div class="row "> 
        <!--Categories and other -->            
        <div class="col-md-4 top-margin">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Список категорий
                </div>
                <div class="panel-body">
                    <ul>
                        <?php echo ContentManager::renderCategories($categories, "messNum"); ?>
                    </ul>
                </div>

            </div>

        </div>
        <!--End Categories and other --> 
        <!--Blog Listing--> 
        <div class="col-md-8 top-margin" >
            <div >
                <ul class="timeline">
                    <?php echo ContentManager::renderPost($posts); ?>
                </ul>
            </div>
        </div>
        <!--Blog Listing--> 

    </div>
    <!--Blog end-->  


</div>
<!-- /.container -->
