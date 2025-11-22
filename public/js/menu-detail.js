document.addEventListener('DOMContentLoaded', function () {
    const quantityInput = document.getElementById('quantity');
    const incrementBtn = document.querySelector('button[onclick="incrementQty()"]');
    const decrementBtn = document.querySelector('button[onclick="decrementQty()"]');

    // Ambil stok dari backend (misal data-stock disimpan di input hidden)
    const stock = parseInt(quantityInput.dataset.stock || '100'); // default 100

    updateButtons();

    window.incrementQty = function() {
        let current = parseInt(quantityInput.value);
        if (current < stock) {
            quantityInput.value = current + 1;
            updateButtons();
        }
    }

    window.decrementQty = function() {
        let current = parseInt(quantityInput.value);
        if (current > 1) {
            quantityInput.value = current - 1;
            updateButtons();
        }
    }

    function updateButtons() {
        const qty = parseInt(quantityInput.value);

        // Disable style untuk tombol increment / decrement
        if (qty <= 1) {
            decrementBtn.classList.add('opacity-50', 'cursor-not-allowed');
            decrementBtn.disabled = true;
        } else {
            decrementBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            decrementBtn.disabled = false;
        }

        if (qty >= stock) {
            incrementBtn.classList.add('opacity-50', 'cursor-not-allowed');
            incrementBtn.disabled = true;
        } else {
            incrementBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            incrementBtn.disabled = false;
        }
    }
});