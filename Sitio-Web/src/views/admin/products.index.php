<section class="new-art">
    <h3 class="new-art-title">Artículos</h3>

    <a href="<?= BASE_PATH ?>/admin/products/add">
        <button class="add-button">Añadir Producto</button>
    </a>

    <?php foreach($products as $product) : ?>
        <div class="product-action-container">
            <a class="image-link" href="<?=BASE_PATH?>/products/<?=$product->id?>">
                <figure class="art-item-image-container">
                    <img src="<?=ASSETS_PATH?>/images/<?=$product->image?>" alt="<?=$product->name?>">  
                </figure>

                <div style="margin: auto;">
                    <p><h4 class="card-title art-desc"><?=$product->name?></h4></p>
                    <p class="art-price">$<?=$product->price?> MXN</p>
                </div>
            </a>

            <div class="operation-container">
                <a href="<?=BASE_PATH?>/products/<?=$product->id?>" class="action-button">Ver detalles</a>
                <a href="<?= BASE_PATH ?>/admin//products/mod/<?= $product->id ?>" class="edit-button">Modificar</a>
                <a href="<?= BASE_PATH ?>/admin/products/delete/<?= $product->id ?>" class="delete-button"
                onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</a>
            </div>
        </div>
    <?php endforeach; ?>
</section>