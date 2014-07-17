<!--jumbotron-->
<div class="jumbotron top-margin-low">
    <h2><strong>Создайте новую категорию и сделайте первую запись</strong>  </h2>




</div>
<!--End jumbotron-->
<div class="container" >
    <!--Blog Start-->  
    <div class="row "> 
        <!--Categories and other -->            
        <div class="col-md-2 top-margin">





        </div>
        <!--End Categories and other --> 
        <!--Blog Listing--> 
        <div class="col-md-8">
            <?php
            if (isset($errorsInfo)) {
                echo ContentManager::renderRegErrors($errorsInfo);
            }
            if (isset($sucsess)) {
                echo ContentManager::renderSucsess('category');
            }
            ?>
            <form class="form-horizontal" action="index.php?page=createPost&&action=done"method="post">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Создание новой категории</legend>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="Login">Название категории:</label>
                        <div class="controls">
                            <input id="category_title" name="category_title" placeholder="" class="input-medium" required="" type="text">
                            <p class="help-block">Введите название категории</p>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="email">Заголовок сообщения:</label>
                        <div class="controls">
                            <input id="post_title" name="post_title" placeholder="" class="input-medium" required="" type="text">
                            <p class="help-block">Введите заголовок сообщения</p>
                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="control-group">
                        <label class="control-label" for="about">Текст сообщения</label>
                        <div class="controls">                     
                            <textarea id="about" cols="50" name="post_text"></textarea>
                        </div>
                    </div>

                    <!-- Prepended text-->
                    <div class="control-group">
                        <label class="control-label" for="captcha">Captcha</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><?php echo $captcha->generateCaptcha(); ?></span>
                                <input id="captcha" name="captcha" class="input-medium" placeholder="" required="" type="text">
                            </div>
                            <p class="help-block">Введите решение</p>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="control-group">
                        <label class="control-label" for="singlebutton"></label>
                        <div class="controls">
                            <button type="submit" name="Submit" class="btn btn-primary">Создать запись</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>

        <!--Blog Listing--> 

    </div>
    <!--Blog end-->  


</div>
<!-- /.container -->

