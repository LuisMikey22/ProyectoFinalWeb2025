<section class="bg-base-100 rounded-3xl p-8 max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-teal-950 mb-6">Agregar producto</h2>

    <form action="<?= BASE_PATH ?>/products/create"
          method="POST" 
          enctype="multipart/form-data"
          class="flex flex-col gap-6">

        <!-- Nombre -->
        <div>
            <label class="font-semibold text-teal-950">Nombre</label>
            <input type="text" name="name" class="input input-bordered w-full" required>
        </div>

        <!-- Categoría -->
        <div>
            <label class="font-semibold text-teal-950">Categoría</label>
            <input type="text" name="category" class="input input-bordered w-full" required>
        </div>

        <!-- Precio -->
        <div>
            <label class="font-semibold text-teal-950">Precio</label>
            <input type="number" step="0.01" name="price" class="input input-bordered w-full" required>
        </div>

        <!-- Descripción -->
        <div>
            <label class="font-semibold text-teal-950">Descripción</label>
            <textarea name="description" class="textarea textarea-bordered w-full h-28" required></textarea>
        </div>

        <!-- Imagen -->
        <div>
            <label class="font-semibold text-teal-950">Imagen del producto</label>
            <input type="file" name="image" class="file-input w-full" required>
        </div>

        <!-- Botón -->
        <button class="btn bg-teal-950 text-white rounded-2xl w-full">
            Agregar producto
        </button>
    </form>
</section>
