<?php include ROOT.'/views/layouts/header.php';?>

<div class="popular-phones categories-section">
    <div class="container">
        <h2 class="section-title">Линейки смартфонов</h2>
        <div class="categories clearfix">
            <?php $i=1; foreach ($categories as $category): ?>
                <a href="/catalog/<?php echo $category['id'] ?>">
                    <div class="category-item category-item-<?php echo $i ?>">
                        <h3>Линейка <?php echo $category['name'] ?></h3>
                    </div>
                </a>
             <?php $i++; endforeach; ?>
           <!-- <a href="#">
                <div class="category-item category-item-2">
                    <h3>Серия Redmi</h3>
                </div>
            </a>
            <a href="#">
                <div class="category-item category-item-3">
                    <h3>Серия Pocophone</h3>
                </div>
            </a>-->
        </div>
    </div>
</div>

<?php include ROOT.'/views/layouts/footer.php';?>