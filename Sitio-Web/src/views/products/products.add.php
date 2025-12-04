<section class="product-section">
    <h3 class="product-title">Agregar producto</h3>

    <form action="<?= BASE_PATH ?>/products/create"method="POST" enctype="multipart/form-data" class="create-product-form">
        <fieldset class="product-fieldset">
            <div class="text-input-container">
                <label class="input-label" for="name">Nombre</label>
                <input class="bordered-input" type="text" name="name" required>
            </div>

            <div class="text-input-container">
                <label class="input-label" for="category">Categoría</label>
                <select class="bordered-input" id="category" name="category" required>
                    <option value="">Selecciona una categoría</option>
                    <option value="newart">Artículo nuevo</option>
                    <option value="bestsellingart">Artículo mejor vendido</option>
                    <option value="seasonalart">Artículo de temporada</option>
                </select>
            </div>

            <div class="text-input-container"> 
                <label class="input-label" for="price">Precio</label>
                <input class="bordered-input" type="number" step="0.01" min="0" name="price" class="input input-bordered w-full" required>
            </div>

            <div class="desc-container">
                <label class="input-label" for="description">Descripción</label>
                <textarea class="bordered-input" name="description" class="textarea textarea-bordered w-full h-28" required></textarea>
            </div>

            <div class="file-input-container">
                <label class="input-label" for="image">Imagen del producto</label>
                <input class="bordered-input" type="file" name="image" required>
            </div>

            <div class="action-container">
                <button class="action-button" type="submit">Agregar producto</button>
            </div>
        </fieldset>
    </form>
</section>
