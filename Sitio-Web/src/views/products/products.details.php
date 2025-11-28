<?php 
    $productDesc = explode(',', htmlspecialchars($product->description)); //separar el string cada ',', se crea un arreglo
    $fiberContent = end($productDesc); //obtener primer elemento (nombre)
?>

<section class="bg-base-100 rounded-3xl product">
    <div class="max-w-6xl mx-auto bg-base-100 p-6 flex flex-col lg:flex-row gap-8 product-container">
        <figure class="lg:w-1/2 w-full">
            <img class="w-full h-full rounded-2xl object-cover" src="<?=ASSETS_PATH?>/images/<?=$product->image?>" alt="product">
        </figure>

        <div class="lg:w-1/2 w-full flex flex-col justify-center gap-8">
            <h2 class="text-3xl font-bold text-teal-950"><?=$product->name?></h2>
            <p class="text-sm text-teal-950"><?=$fiberContent?></p>

            <div class="flex items-center gap-4">
                <span class="text-2xl font-bold text-teal-950">$<?=$product->price?> MXN</span>
            </div>

            <button class="btn bg-teal-950 text-white w-full max-w-xs mt-2 rounded-2xl">Añadir al carrito</button>

            <a href="<?= BASE_PATH ?>/products/mod/<?= $product->id ?>"
                class="btn bg-teal-950 text-white w-full max-w-xs mt-2 rounded-2xl">
                Modificar producto
            </a>

            <a href="<?= BASE_PATH ?>/products/delete/<?= $product->id ?>"
                class="btn bg-teal-950 text-white w-full max-w-xs mt-2 rounded-2xl"
                onclick="return confirm('¿Seguro que quieres eliminar este producto?')">
                Eliminar producto
            </a>

            <p class="text-teal-950 font-semibold mt-4">
                <?=$product->description?>
            </p>
        </div>
    </div>
</section>