<br><br>
<div class="container-fluid well col-md-14 span4">
    <div class="row">
        <div class="col-md-4 ">

        </div>
        <div class="col-md-4">
            <div class="span8">
                <?php echo ContentManager::renderUserAccountInfo($userInfo); ?>


            </div>
        </div>
        <div class="col-md-2">

            <div class="span2">
                <div class="btn-group">
                    <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                        Action 
                        <span class="icon-cog icon-white"></span><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                    <?php if(isset($_SESSION['userID']) and !isset($_GET['user_id'])){?>
                        <li><a href="index.php?page=user&action=modify"><span class="icon-wrench"></span> Modify</a></li>
                    <?php } else { ?>
                        
                        <li><a href="index.php?page=user&action=mail&user_id=<?php echo $_GET['user_id'];?>"><span class="icon-wrench"></span> Написать сообщение</a></li>
                    <?php } ?> 
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4 ">
        </div>
        <div class="col-md-4">
            <div class="span8">

                <?php
                if ($_GET['page'] == 'user' and isset($_GET['action']) and $_GET['action'] == 'modify') {
                    echo ContentManager::renderUserUpdateTable($userInfo);
                }
                ?>
                                <?php
                if ($_GET['page'] == 'user' and isset($_GET['action']) and $_GET['action'] == 'mail') {
                    echo ContentManager::renderUserMailTable($userInfo);
                }
                ?>

            </div>
        </div>
    </div>
</div>