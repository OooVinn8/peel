// public/js/admin.js
document.addEventListener('DOMContentLoaded', function() {

    // ===== Filter status orders =====
    const statusFilter = document.getElementById('statusFilter');
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            const params = new URLSearchParams(window.location.search);

            if (this.value) {
                params.set('status', this.value);
            } else {
                params.delete('status');
            }

            // Keep search parameter
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput && searchInput.value) {
                params.set('search', searchInput.value);
            }

            window.location.search = params.toString();
        });
    }

    // ===== Pastikan harga bulat dan kelipatan 50 =====
    const productForm = document.getElementById('product-form');
    const priceInput = document.getElementById('price');

    if (productForm && priceInput) {
        productForm.addEventListener('submit', function() {
            // Hilangkan titik
            priceInput.value = priceInput.value.replace(/\./g,'');

            // Bulatkan ke kelipatan 50
            priceInput.value = Math.round(priceInput.value / 50) * 50;
        });
    }

});
