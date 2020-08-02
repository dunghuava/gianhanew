<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Pham Quoc Hieu - 0949.133.224 - quochieuhcm@gmail.com" />
    <link rel="stylesheet" href="<?php echo $root_site.'public/'; ?>/admin/admin/css/login.css" />
    <title>Admin Panel :: Đăng Nhập</title>
</head>
<body>
    <form role="form" method="POST" action="<?php echo $root_site; ?>login.html">
        <div id="layout">
            <div id="login-box">
                <h3>Đăng nhập vào Admin Panel</h3>
                <div class="content">
                    <?php echo validation_errors('<div class="input-group"><div class="error_msg">','</div></div>'); ?>
                    <?php 
                        if(isset($error) && $error !=""){
                            ?>
                            <div class="input-group">
                                <div class="error_msg"><?php echo $error; ?></div>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="input-group">
                        <label class="input-label username" for="email"></label>
                        <div class="input-item">
                            <input class="user-info" tabindex="1" placeholder="Tên đăng nhập" type="text" name="username" id="email" value="" />
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="input-label password" for="password"></label>
                        <div class="input-item">
                            <input class="user-info" tabindex="2" placeholder="Mật khẩu" type="password" name="password" id="password" />
                        </div>
                    </div>
                    <div class="input-group">
                        <input tabindex="3" type="submit" name="btnLogin" class="login-button" value="Đăng nhập" />
                        <a href="<?php echo $root_site ;?>" class="back-to-home" target="_blank">Quay về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>