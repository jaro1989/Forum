<div class="container" >
    <div class="row "> 
        <div class="col-md-3 top-margin">  
        </div>
        <!--Categories and other -->
        <?php if (isset($_SESSION['userName'])) { ?>
            <div class="col-md-4 top-margin">   
                <form class="form-control-static" action="index.php?page=forum_in&&action=done&&cat_id=<? echo $_GET['cat_id'];?>"method="post">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Добавить запись</legend>

                        <!-- Text input-->
                        <div class="control-group">
                            <div>       
                                <label class="control-label" for="title">Заголовок сообщения:</label>
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
                                <label class="control-label" for="tags">Тэги:</label>
                            </div>
                            <div>
                                <input id="tags" name="tags" placeholder="" class="input-medium" required="" type="text">
                                <p class="help-block">Введите тэги через запятую (Пример: работа, бизнес)</p>
                            </div>
                            <div>
                                <button type="submit" name="Submit" class="btn btn-primary">Создать запись</button>
                            </div>
                        </div>
                        </div>
                        </div>

                    </fieldset>
                </form>
            <?php } else { ?>
                <h2>Зарегистрируйтесь, чтобы добавить запись</h2>
            <?php } ?>
        </div>
    </div>
</div>
<!--End jumbotron-->
<div class="container">
    <!--Blog Start-->  
    <div class="row "> 
        <!--Categories and other -->   

        <div class="col-md-4 top-margin">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Список категорий
                </div>
                <div class="panel-body">

                    <?php echo ContentManager::renderCategories($categories, "messNum"); ?>

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
</div>
<!--Blog end-->  


</div>
<!-- /.container -->
