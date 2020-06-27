<?php include ROOT.'/views/layouts/header.php';?>

<div class="admin-panel">
    <div class="container">
        <h2 class="section-title">Добавление товара</h2>
        <p class="warning "><?php
            if (isset($error_list)&&is_array($error_list))  {
                foreach ($error_list as $error){
                    echo $error.'<br>';
                }
            }
            ?>
        </p>
        <form class="admin-panel-from" enctype="multipart/form-data" action="#" method="post">
            <div class="admin-panel-form-group">
                <label for="tovarname">Наименование товара:</label>
                <input type="text" name="tovarname" id="tovarname" required value="<?php echo $params['name']?>">
            </div>

            <div class="admin-panel-form-group">
                <label for="tovarcategory">Категория товара:</label>
                <select name="tovarcategory" id="tovarcategory">
                    <option value="1" <?php if ($category==1) echo 'selected'?>>Линейка Mi</option>
                    <option value="2" <?php if ($category==2) echo 'selected'?>>Линейка Redmi</option>
                    <option value="3" <?php if ($category==3) echo 'selected'?>>Линейка Pocophone</option>
                </select>
            </div>
            <div class="admin-panel-form-group">
                <label for="message">Описание товара:</label>
                <textarea name="message" id="message" required ><?php echo $params['description']?></textarea>
            </div>
            <div class="admin-panel-form-group">
                <label for="tovarcost">Цена товара:</label>
                <input type="number" name="tovarcost" id="tovarcost" required min="1" max="999999" value="<?php echo $params['cost']?>">
            </div>
            <div class="admin-panel-form-group">
                <label for="tovarpic">Изображение товара:</label>
                <input type="file" name="tovarpic" id="tovarpic" required>
            </div>
            <input class="btn" type="submit" name = "submit" value="Добавить">
        </form>
    </div>
</div>

<?php include ROOT.'/views/layouts/footer.php';?>