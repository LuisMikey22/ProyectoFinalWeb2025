<?php 
    $productDesc = explode(',', htmlspecialchars($product->description)); //separar el string cada ',', se crea un arreglo
    $fiberContent = end($productDesc); //obtener primer elemento (nombre)
?>

<section class="bg-base-100 rounded-3xl product">
    <div class="max-w-6xl mx-auto bg-base-100 flex flex-col lg:flex-row justify-between 
            gap-12 lg:gap-20 p-8 product-container">

        <figure class="flex items-center justify-center 
                lg:w-[50%] w-fit h-fit mx-auto lg:mx-0 
                shadow-lg rounded-3xl bg-white"
                style="margin: auto 0;">
            
            <img class="w-full h-full object-contain rounded-3xl" 
                src="<?=ASSETS_PATH?>/images/<?=$product->image?>" 
                alt="product">
        </figure>

        <div class="w-[320px] flex flex-col justify-center gap-8 lg:w-2/3 w-full">
            <h2 class="text-3xl font-bold text-teal-950"><?=$product->name?></h2>
            <p class="text-sm text-teal-950"><?=$fiberContent?></p>
            <p class="text-2xl font-bold text-teal-950">$<?=$product->price?> MXN</p>

            <button class="add-button">Añadir al carrito</button>

            <p class="text-teal-950 font-semibold mt-4"><?=$product->description?></p>

            <a href="<?= BASE_PATH ?>/products/mod/<?= $product->id ?>" class="edit-button">Modificar producto</a>
            <a href="<?= BASE_PATH ?>/products/delete/<?= $product->id ?>" class="delete-button"
                onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar producto
            </a>
        </div>
    </div>

</section>