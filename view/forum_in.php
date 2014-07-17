<!--jumbotron-->

<div class="jumbotron top-margin-low">
<div class="container" >
		<div class="row "> 
        <div class="col-md-3 top-margin">  
        </div>
        <!--Categories and other -->            
        <div class="col-md-4 top-margin">   
 <form class="form-control-static" action="index.php?page=forum_in&&action=done&&cat_id=<? echo $_GET['cat_id'];?>"method="post">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Добавить запись</legend>

                    <!-- Text input-->
                    <div class="control-group">
                            <div>       
                            <label class="control-label" for="email">Заголовок сообщения:</label>
                            </div>
                            <div>
                            <input id="post_title" name="post_title" placeholder="" class="input-medium" required="" type="text">
                            </div>
                            <div>
                            <label class="control-label" for="about">Текст сообщения</label>
                            </div>
                            <div>
                            <textarea id="about" cols="50" name="post_text"></textarea>
                            </div>
                            <div>
                            <button type="submit" name="Submit" class="btn btn-primary">Создать запись</button>
                            </div>
                        </div>
                        </div>
                    </div>

                </fieldset>
            </form>
		</div>
	</div>
</div>
<!--End jumbotron-->

    <!--Blog Start-->  
    <div class="row "> 
        <!--Categories and other -->   
        <div class="col-md-2 top-margin">
        </div>         
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
        <div class="col-md-4 top-margin" >
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
