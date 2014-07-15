<!--jumbotron-->
<div class="jumbotron top-margin-low">
    <h2><strong>Пройдите регистрацию</strong>  </h2>
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
                    Последние зарегестрировавшиеся
                </div>
                <div class="panel-body">
                    <ul>
                        <?php echo ContentManager::renderUsers($listUsers, 'dateAdd'); ?>
                    </ul>

                </div>

            </div>



        </div>
        <!--End Categories and other --> 
        <!--Blog Listing--> 
        <div class="col-md-8">

            <form class="form-horizontal" action="index.php?page=reg_done"method="post">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Регистрация</legend>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="Login">Login:</label>
                        <div class="controls">
                            <input id="user" name="user" placeholder="Ваш Логин" class="input-medium" required="" type="text">
                            <p class="help-block">Введите логин</p>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="email">Email:</label>
                        <div class="controls">
                            <input id="email" name="email" placeholder="" class="input-xlarge" required="" type="text">
                            <p class="help-block">Введите email</p>
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="control-group">
                        <label class="control-label" for="password">Пароль:</label>
                        <div class="controls">
                            <input id="password" name="password" placeholder="" class="input-medium" required="" type="password">
                            <p class="help-block">Введите ваш пароль</p>
                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="control-group">
                        <label class="control-label" for="about">О себе:</label>
                        <div class="controls">                     
                            <textarea id="about" name="about"></textarea>
                        </div>
                    </div>

                    <!-- Prepended text-->
                    <div class="control-group">
                        <label class="control-label" for="captcha">Captcha</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><?php echo $form->generateCaptcha(); ?></span>
                                <input id="captcha" name="captcha" class="input-medium" placeholder="" required="" type="text">
                            </div>
                            <p class="help-block">Введите решение</p>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="control-group">
                        <label class="control-label" for="singlebutton">Single Button</label>
                        <div class="controls">
                            <button type="submit" name="Submit" class="btn btn-primary">Зарегестрироваться</button>
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

