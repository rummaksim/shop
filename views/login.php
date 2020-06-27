<?php include ROOT.'/views/layouts/header.php';?>


<div class="login">
    <div class="container">
        <h2 class="section-title">Вход</h2>
        <form class="login-from clearfix" action="#" method="post">
            <p class="warning "><?php
                if (isset($error_list)&&is_array($error_list))  {
                    foreach ($error_list as $error){
                        echo $error.'<br>';
                    }
                }
                ?>
            </p>
            <div class="login-form-group">
                <label for="email">Электронная почта:</label>
                <input type="text" name="email" id="email" required>
            </div>

            <div class="login-form-group">
                <label for="password">Пароль:</label>
                <input type="password" name="password" id="password" required autocomplete="off">
            </div>

            <p class="password-match-warning invisible">Неверный логин и/или пароль!</p>

            <input class="btn" type="submit" name="submit" id="submit" value="Войти">
            <a class="btn btn-reg-redirect" href="/register">Зарегистироваться</a>
        </form>
    </div>
</div>

<?php include ROOT.'/views/layouts/footer.php';?>