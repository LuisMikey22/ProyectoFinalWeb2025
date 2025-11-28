<?php
// Aquí ya existe la variable $product proveniente de public/products.mod.php
// NO volver a incluir modelos ni base de datos.
?>

<section class="bg-base-100 rounded-3xl p-8 max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-teal-950 mb-6">Modificar producto</h2>

    <form action="<?= BASE_PATH ?>/products/update/<?= $product->id ?>" 
          method="POST" enctype="multipart/form-data" 
          class="flex flex-col gap-6">

        <!-- Nombre -->
        <div>
            <label class="text-teal-950 font-semibold">Nombre</label>
            <input type="text" 
                   name="name" 
                   class="input input-bordered w-full"
                   value="<?= htmlspecialchars($product->name) ?>" required>
        </div>

        <!-- Categoría -->
        <div>
            <label class="text-teal-950 font-semibold">Categoría</label>
            <input type="text" 
                   name="category" 
                   class="input input-bordered w-full"
                   value="<?= htmlspecialchars($product->category) ?>" required>
        </div>

        <!-- Precio -->
        <div>
            <label class="text-teal-950 font-semibold">Precio</label>
            <input type="number" 
                   step="0.01" 
                   name="price" 
                   class="input input-bordered w-full"
                   value="<?= htmlspecialchars($product->price) ?>" required>
        </div>

        <!-- Descripción -->
        <div>
            <label class="text-teal-950 font-semibold">Descripción</label>
            <textarea name="description" 
                      class="textarea textarea-bordered w-full h-28"
                      required><?= htmlspecialchars($product->description) ?></textarea>
        </div>

        <!-- Imagen actual -->
        <div>
            <label class="text-teal-950 font-semibold">Imagen actual</label>
            <img src="<?= ASSETS_PATH ?>/images/<?= $product->image ?>" 
                 class="w-40 rounded-xl mt-2">
        </div>

        <!-- Nueva imagen -->
        <div>
            <label class="text-teal-950 font-semibold">Cambiar imagen (opcional)</label>
            <input type="file" name="image" class="file-input w-full">
        </div>

        <!-- Botón -->
        <button class="btn bg-teal-950 text-white rounded-2xl w-full">
            Guardar cambios
        </button>
    </form>
</section>
