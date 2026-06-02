<section class="new-art">
    <h3 class="new-art-title">Catálogo de Productos</h3>

    <a href="<?= BASE_PATH ?>/admin/products/add">
        <button class="add-button">Añadir Producto</button>
    </a>

    <?php foreach($products as $product) : ?>
        <div class="product-action-container">
            <a class="image-link" href="<?= BASE_PATH ?>/admin/products/<?= $product->id_product ?>">
                <figure class="art-item-image-container">
                    <img src="<?= ASSETS_PATH ?>/images/<?= htmlspecialchars($product->image) ?>" alt="<?= htmlspecialchars($product->name) ?>">  
                </figure>

                <div style="margin: auto;">
                    <h4 class="card-title art-desc"><?= htmlspecialchars($product->name) ?></h4>
                    <p class="art-price">$<?= number_format($product->price, 2) ?> MXN</p>
                </div>
            </a>

            <div class="operation-container">
                <a href="<?= BASE_PATH ?>/admin/products/<?= $product->id_product ?>" class="action-button">Ver detalles</a>
                <a href="<?= BASE_PATH ?>/admin/products/mod/<?= $product->id_product ?>" class="edit-button">Modificar</a>
                <a href="<?= BASE_PATH ?>/admin/products/delete/<?= $product->id_product ?>" class="delete-button" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</a>
            </div>
        </div>
    <?php endforeach; ?>
</section>