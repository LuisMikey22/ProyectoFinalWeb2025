<section class="bg-base-100 rounded-3xl p-8 max-w-4xl mx-auto mt-10">

    <div class="alert alert-success mb-6">
        <span class="text-emerald-900 font-semibold">
            ✔ El producto se actualizó correctamente
        </span>
    </div>

    <h2 class="text-3xl font-bold text-teal-950 mb-6">Detalles del producto actualizado</h2>

    <div class="flex gap-6">
        
        <!-- Imagen -->
        <div>
            <img src="<?= ASSETS_PATH ?>/images/<?= $product->image ?>" 
                 class="w-48 rounded-xl shadow">
        </div>

        <!-- Datos -->
        <div class="flex flex-col gap-3">
            <p><strong>Nombre:</strong> <?= htmlspecialchars($product->name) ?></p>
            <p><strong>Categoría:</strong> <?= htmlspecialchars($product->category) ?></p>
            <p><strong>Precio:</strong> $<?= number_format($product->price, 2) ?></p>
            <p><strong>Descripción:</strong><br><?= nl2br(htmlspecialchars($product->description)) ?></p>
        </div>
    </div>

    <!-- Botón para volver al detalle normal -->
    <a href="<?= BASE_PATH ?>/products/<?= $product->id ?>" 
       class="btn mt-8 bg-teal-950 text-white rounded-xl">
        Volver a vista de detalles
    </a>
</section>
