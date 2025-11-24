<?php
    require __DIR__.'/partials/nav.php';

    //3 categorías de artículos y todos sus productos en un arreglo

    $result = getFoundArt();

    $searchValue = $result[0];
    $foundQuantity = $result[1];
    $foundProducts = end($result);
?>

<section class="search-art">
    <?php
        $carouselClass = "";
        if(!empty($foundProducts)) { //si encuentra productos según la búsqueda
            if($foundQuantity>1) {
                echo '<h3 class="search-art-title">'.$foundQuantity.' resultados de “'.$searchValue.'“</h3>';
            }else {
                echo '<h3 class="search-art-title">'.$foundQuantity.' resultado de “'.$searchValue.'“</h3>';
            }
            $carouselClass = "search-art-carousel-visible";
        }else {
            echo '<h3 class="search-art-title">0 resultados</h3>';
            echo '<h5 class="search-art-subtitle">Tu búsqueda de “'.$searchValue.'“ no dio ningún resultado.</h5>';
            $carouselClass = "search-art-carousel-hidden";
        }
    ?>
    
    <section class="<?=$carouselClass?>">
        <span class="previous-element-button-container">
            <button aria-label="previous" class="previous-element-button" alt="seeMore"></button>
        </span>

        <div class="search-art-item-container item-container">
            <?php foreach($foundProducts as $foundProductCard) : ?>
                <div class="card bg-base-100 shadow-sm art-item item">
                    <a href="<?=SRC_PATH?>/views/product.php?productId=<?=$foundProductCard['id']."-".$foundProductCard['category']?>">
                        <figure class="art-item-image-container">
                            <img src="<?=ASSETS_PATH?>/images/<?=$foundProductCard['image']?>">  
                        </figure>

                        <div class="card-body art-desc-container">
                            <p><h4 class="card-title art-desc"><?=$foundProductCard['description']?></h4></p>
                            <p><h4 class="card-actions art-price">$<?=$foundProductCard['price']?>.00 MXN</h4></p> 
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <span class="next-element-button-container">
            <button aria-label="next" class="next-element-button" alt="seeMore"></button>
        </span>
    </section>
</section>

<?php
    include __DIR__.'/partials/footer.php';
?>