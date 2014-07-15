        <!--jumbotron-->
<div class="jumbotron top-margin-low">
    <h2><strong>Введите логин и пароль</strong>  </h2>
    <p>Если, вы еще не зарегестрированы, пройтиде по <a href="index.php?page=registration">ссылке</a></p>



</div>
<!--End jumbotron-->
<div class="container" >
    <!--Blog Start-->  
    <div class="row "> 
        <!--Categories and other -->            
        <div class="col-md-1 top-margin">

        </div>
        <!--End Categories and other --> 
        <!--Blog Listing--> 
        <div class="col-md-10 top-margin" >
            <div >
                <!--login modal-->


                <p><?php
                    if (isset($authMessage)) {
                        echo $authMessage;
                    }
                    ?></p><br />
                <form class="form col-md-12 center-block" action="index.php?page=login" method="post">
                    <div class="form-group">
                        <input class="form-control input-lg" placeholder="Login" name='login' type="text">
                    </div>
                    <div class="form-group">
                        <input class="form-control input-lg" placeholder="Пароль" name='password' type="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Зарегестрироваться</button>
                    </div>
                </form>

            </div>
        </div>
        <!--Blog Listing--> 

    </div>
    <!--Blog end-->  


</div>
<!-- /.container -->


