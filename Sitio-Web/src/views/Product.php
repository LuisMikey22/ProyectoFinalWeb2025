<?php 
    require __DIR__.'/partials/nav.php';

    $product = getProductDetails();

    $productDesc = explode(',', htmlspecialchars($product['description'])); //separar el string cada ',', se crea un arreglo
    $productName = $productDesc[0]; //obtener primer elemento (nombre)
?>

    <section class="bg-base-100 rounded-3xl product">
        <div class="max-w-6xl mx-auto bg-base-100 p-6 flex flex-col lg:flex-row gap-8 product-container">
            <figure class="lg:w-1/2 w-full">
                <img class="w-full h-full rounded-2xl object-cover" src="<?=ASSETS_PATH?>/images/<?=htmlspecialchars($product['image'])?>" alt="product">
            </figure>

            <div class="lg:w-1/2 w-full flex flex-col justify-center gap-8">
                <h2 class="text-3xl font-bold text-teal-950"><?=$productName?></h2>
                <p class="text-sm text-teal-950">100% Algodón</p>

                <div class="flex items-center gap-4">
                    <span class="text-2xl font-bold text-teal-950">$<?=htmlspecialchars($product['price'])?>.00 MXN</span>
                </div>

                <button class="btn bg-teal-950 text-white w-full max-w-xs mt-2 rounded-2xl">Añadir al carrito</button>

                <p class="text-teal-950 font-semibold mt-4">
                    <?=htmlspecialchars($product['description'])?>
                </p>
            </div>
        </div>
    </section>

<?php 
    include __DIR__.'/partials/footer.php';
?>