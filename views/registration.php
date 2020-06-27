<?php include ROOT.'/views/layouts/header.php';?>

<div class="registration">
    <div class="container">

        <?php if ($registration): ?>
        <h2 class="section-title">Регистрация прошла успешно!</h2>
        <?php else: ?>
        <h2 class="section-title">Регистрация</h2>
        <form class="registration-from" action="#" method="post">
            <p class="warning "><?php
                 if (isset($error_list)&&is_array($error_list))  {
                     foreach ($error_list as $error){
                         echo $error.'<br>';
                     }
                 }
                ?>
            </p>
            <div class="registration-form-group">
                <label for="email">Электронная почта:</label>
                <input type="text" name="email" id="email" required value = "<?php echo $email?>">
            </div>

            <div class="registration-form-group">
                <label for="text">Имя:</label>
                <input type="text" name="name" id="name" required minlength=4 value = "<?php echo $name?>">
            </div>

            <div class="registration-form-group">
                <label for="password">Пароль:</label>
                <input type="password" name="password" id="password" required minlength=6>
            </div>
            <input class="btn" type="submit" name="submit" id = "submit" value="Зарегистрироваться">
        </form>
        <?php endif ?>
    </div>
</div>

<?php include ROOT.'/views/layouts/footer.php';?>
