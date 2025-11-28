<section class="bg-base-100 rounded-3xl p-8 max-w-3xl mx-auto mt-10">
    <div class="alert alert-success shadow-lg p-4">
        <span class="text-green-900 font-semibold">
            ✔ El producto "<?= htmlspecialchars($name) ?>" fue eliminado correctamente.
        </span>
    </div>

    <a href="<?= BASE_PATH ?>/products" 
       class="btn bg-teal-950 text-white rounded-xl mt-6">
       Volver al listado de productos
    </a>
</section>