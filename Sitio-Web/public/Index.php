<?php 
    include '../src/views/partials/nav.php'; 
    $newArts = getNewArt();
    $bestSellingArts = getBestSellingArt();
    $seasonalArts = getSeasonalArt();
?>

<section class="new-art">
    <h3 class="new-art-title">Nuevos artículos</h3>

    <section class="new-art-carousel">
        <span class="previous-element-button-container">
            <button aria-label="previous" class="previous-element-button" alt="seeMore"></button>
        </span>

        <!-- tarjetas -->
        <div class="new-art-item-container item-container">
            <?php foreach($newArts as $newest) : ?>
                <div class="card bg-base-100 shadow-sm art-item item">
                    <a href="<?=SRC_PATH?>/views/product.php?productId=">
                        <figure class="art-item-image-container">
                            <img src="<?=ASSETS_PATH?>/images/<?=$newest['image']?>">  
                        </figure>

                        <div class="card-body art-desc-container">
                            <p><h4 class="card-title art-desc"><?=$newest['description']?></h4></p>
                            <p><h4 class="card-actions art-price">$<?=$newest['price']?>.00 MXN</h4></p> 
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <span class="next-element-button-container">
            <button aria-label="next" class="next-element-button" alt="seeMore"></button>
        </span>
    </section>

    <div role="tablist" class="carousel-indicator"></div>
</section>

<section class="best-selling-art">
    <h3 class="best-selling-art-title">Mejor vendidos</h3>

    <section class="best-selling-art-carousel">
        <span class="previous-element-button-container">
            <button aria-label="previous" class="previous-element-button" alt="seeMore"></button>
        </span>

        <!-- tarjetas -->
        <div class="best-selling-art-item-container item-container">
            <?php foreach($bestSellingArts as $bestSeller) : ?>
                <div class="card bg-base-100 shadow-sm art-item item">
                    <a href="<?=SRC_PATH?>/views/product.php?productId=">
                        <figure class="art-item-image-container">
                            <img src="<?=ASSETS_PATH?>/images/<?=$bestSeller['image']?>">  
                        </figure>

                        <div class="card-body art-desc-container">
                            <p><h4 class="card-title art-desc"><?=$bestSeller['description']?></h4></p>
                            <p><h4 class="card-actions art-price">$<?=$bestSeller['price']?>.00 MXN</h4></p> 
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <span class="next-element-button-container">
            <button aria-label="next" class="next-element-button" alt="seeMore"></button>
        </span>
    </section>

    <div role="tablist" class="carousel-indicator"></div>
</section>

<section class="seasonal-art">
    <h3 class="seasonal-art-title">Artículos de temporada</h3>

    <section class="seasonal-art-carousel">
        <span class="previous-element-button-container">
            <button aria-label="previous" class="previous-element-button" alt="seeMore"></button>
        </span>

        <!-- tarjetas -->
        <div class="seasonal-art-item-container item-container">
            <?php foreach($seasonalArts as $seasonal) : ?>
                <div class="card bg-base-100 shadow-sm art-item item">
                    <a href="<?=SRC_PATH?>/views/product.php?productId=">
                        <figure class="art-item-image-container">
                            <img src="<?=ASSETS_PATH?>/images/<?=$seasonal['image']?>">  
                        </figure>

                        <div class="card-body art-desc-container">
                            <p><h4 class="card-title art-desc"><?=$seasonal['description']?></h4></p>
                            <p><h4 class="card-actions art-price">$<?=$seasonal['price']?>.00 MXN</h4></p> 
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <span class="next-element-button-container">
            <button aria-label="next" class="next-element-button" alt="seeMore"></button>
        </span>
    </section>

    <div role="tablist" class="carousel-indicator"></div>
</section>

<section class="shipping-info-banner">
    <div class="info-banner-statement">
        <span class="star-review-icon">
            <img src="<?=ASSETS_PATH?>/images/starIcon.svg" alt="star-review-icon">
        </span>

        <h4 class="banner-text">
            4,000+ reseñas positivas
        </h4>
    </div>

    <div class="info-banner-statement">
        <span class="shipping-icon">
            <img src="<?=ASSETS_PATH?>/images/truckIcon.svg" alt="shipping-icon">
        </span>

        <h4 class="banner-text"> 
            Envío gratis en México en compras mayores a $500
        </h4> 
    </div>
    
    <div class="info-banner-statement">
        <span class="return-icon">
            <img src="<?=ASSETS_PATH?>/images/boxIcon.svg" alt="return-icon">
        </span>

        <h4 class="banner-text">
            Cambios o devoluciones 
        </h4> 
    </div>
</section>

<?php 
    include '../src/views/partials/footer.php';
?>