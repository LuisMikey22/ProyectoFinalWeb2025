document.querySelectorAll('.item-container').forEach(cont => {
    let currentIndex = 0;
    const tarjetas = cont.querySelectorAll('.tarjeta');
    const totalTarjetas = tarjetas.length;

    document.querySelector('.next-element-button').addEventListener('click', () => {
        if (currentIndex < totalTarjetas - 1) {
            currentIndex++;
            updateTransform(tarjetas, currentIndex);
        }
    });

    document.querySelector('.previous-element-button').addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateTransform(tarjetas, currentIndex);
        }
    });
});

function updateTransform(tarjetas, index) {
    tarjetas.forEach((tarjeta, i) => {
        const offset = (i - index) * 220; // Ajustar el desplazamiento
        tarjeta.style.transform = `translateX(${offset}px)`;
    });
}
