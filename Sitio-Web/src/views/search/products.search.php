<?php
    $searchValue = $searchResult[0];
    $foundQuantity = $searchResult[1];
    $foundProducts = end($searchResult);
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
        <div class="search-art-item-container item-container">
            <?php foreach($foundProducts as $foundProductCard) : ?>
                <div class="card bg-base-100 shadow-sm art-item item">
                    <a class="image-link" href="<?=BASE_PATH?>/products/<?=$foundProductCard->id?>">
                        <figure class="art-item-image-container">
                            <img src="<?=ASSETS_PATH?>/images/<?=$foundProductCard->image?>">  
                        </figure>

                        <div class="card-body art-desc-container">
                            <p><h4 class="card-title art-desc"><?=$foundProductCard->name?></h4></p>
                            <p><h4 class="card-actions art-price">$<?=$foundProductCard->price?> MXN</h4></p> 
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>  
</section>