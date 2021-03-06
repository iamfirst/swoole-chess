﻿<?php echo $this->partial('public/header'); ?>
<title>登录 - Swoole中国象棋</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo $this->url->getStatic('public/css/reg_login/reset.css'); ?>">
    <link rel="stylesheet" href="<?php echo $this->url->getStatic('public/css/reg_login/supersized.css'); ?>">
    <link rel="stylesheet" href="<?php echo $this->url->getStatic('public/css/reg_login/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo $this->url->getStatic('public/css/reg_login/tipso.min.css'); ?>">
    </head>

    <body>
        <div class="page-container">
            <h1>登录</h1>
            <form id="login_form" method="post">
                <input type="text" name="username" class="username" placeholder="用户名" />
                <input type="password" name="password" id="password" class="password" placeholder="密码" />
                <button type="button" onclick="doLogin();" id="submitBtn">提交</button><span id="msg"></span>
            </form>
            <div class="connect">
                <p>还没有账号？<?= $this->tag->linkTo("index/register", "点击注册") ?></p>
            </div>
        </div>

        <!-- Javascript -->
        <script src="<?php echo $this->url->getStatic('public/js/jquery-1.8.2.min.js'); ?>"></script>
        <script src="<?php echo $this->url->getStatic('public/js/supersized.3.2.7.min.js'); ?>"></script>
        <script src="<?php echo $this->url->getStatic('public/js/supersized-init.js'); ?>"></script>
        <script src="<?php echo $this->url->getStatic('public/js/scripts.js'); ?>"></script>
        <script src="<?php echo $this->url->getStatic('public/js/tipso.min.js'); ?>"></script>
        <script>
        $("#password").on("focus", function()
        {
            $(document).on("keydown",function(event)
            {
                if( event.keyCode == 13 )
                {
                    $('#submitBtn').click();
                }
            });
        });

        function doLogin()
        {
            $('#submitBtn').attr('disabled','disabled');
            $('#submitBtn').html('登录中，请稍后...');
            var post_url = "<?php echo $this->url->get('index/doLogin'); ?>";
            $.post(post_url, $('#login_form').serialize(), function(data){
                data = eval("("+data+")");
                if( data.status == 1 )
                {
                    $('#submitBtn').html('登录成功，正在跳转...');
                    setTimeout( skipPlay, 1000 );
                }
                else
                {
                    $('#msg').tipso({background: 'tomato',useTitle:false,position: 'right',content:data.msg});
                    $('#msg').tipso('update', 'content', data.msg);
                    $('#msg').tipso('show');
                    $('#submitBtn').removeAttr('disabled');
                    $('#submitBtn').html('提交');
                }
            });
        }

        function skipPlay()
        {
            location.href = "<?php echo $this->url->get('play/'); ?>";
        }
        </script>
    </body>
</html>
