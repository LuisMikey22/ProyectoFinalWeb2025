<?php
// Aquí ya existe la variable $product proveniente de public/products.mod.php
// NO volver a incluir modelos ni base de datos.
?>

<section class="product-section">
    <h3 class="product-title">Modificar producto</h3>

    <form action="<?= BASE_PATH ?>/products/update/<?= $product->id ?>" method="POST" enctype="multipart/form-data" class="create-product-form">
        <fieldset class="product-fieldset">
            <!-- Nombre -->
            <div class="name-input-container">
                <label class="input-label" for="name">Nombre</label>
                <input class="bordered-input" type="text" name="name" value="<?= htmlspecialchars($product->name) ?>" required>
            </div>

            <!-- Categoría -->
            <div class="text-input-container">
                <label class="input-label" for="category">Categoría</label>
                <input class="bordered-input" type="text" name="category" value="<?= htmlspecialchars($product->category) ?>" required>
            </div>

            <!-- Precio -->
            <div class="text-input-container">
                <label class="input-label" for="price">Precio</label>
                <input class="bordered-input" type="number" step="0.01" name="price" value="<?= htmlspecialchars($product->price) ?>" required>
            </div>

            <!-- Descripción -->
             <div class="desc-container">
                <label class="input-label" for="description">Descripción</label>
                <textarea class="bordered-input" name="description" required><?= htmlspecialchars($product->description) ?></textarea>
            </div>

            <!-- Imagen actual -->
            <div class="desc-container">
                <label class="input-label" for="image">Imagen actual</label>
                <figure class="art-item-image-container" name="image" style="box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);">
                    <img src="<?= ASSETS_PATH ?>/images/<?= $product->image ?>" >  
                </figure>
            </div>

            <!-- Nueva imagen -->
             <div class="file-input-container">
                <label class="input-label" for="image">Cambiar imagen (opcional)</label>
                <input class="bordered-input" type="file" name="image">
            </div>

            <!-- Botón -->
            <div class="action-container">
                <button class="action-button" type="submit">Guardar cambios</button>
            </div>
        </fieldset>
    </form>
</section>
