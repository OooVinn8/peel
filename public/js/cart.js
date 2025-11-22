document.addEventListener("DOMContentLoaded", function () {
    // Select all checkbox
    document
        .getElementById("select-all")
        ?.addEventListener("change", function () {
            document
                .querySelectorAll(".item-checkbox")
                .forEach((cb) => (cb.checked = this.checked));
        });

    // Quantity update
    document.querySelectorAll(".quantity-form").forEach((container) => {
        const decreaseBtn = container.querySelector(".decrease-btn");
        const increaseBtn = container.querySelector(".increase-btn");
        const quantityDisplay = container.querySelector(".quantity");
        const id = container.dataset.id;
        const stock = parseInt(container.dataset.stock);

        // Disable tombol jika perlu saat load
        updateButtons();

        decreaseBtn.addEventListener("click", () => updateQuantity(-1));
        increaseBtn.addEventListener("click", () => updateQuantity(1));

        function updateQuantity(change) {
            let quantity = parseInt(quantityDisplay.textContent) + change;

            // Validasi kuantitas
            if (quantity < 1) {
                if (
                    confirm(
                        "Kuantitas akan menjadi 0. Apakah kamu ingin menghapus produk ini?",
                    )
                ) {
                    window.location.href = `/cart/delete/${id}`;
                }
                return;
            }

            if (quantity > stock) {
                alert("Jumlah tidak boleh melebihi stok yang tersedia!");
                quantity = stock;
            }

            // Update tampilan kuantitas & total item
            quantityDisplay.textContent = quantity;
            const row = container.closest(".cart-row");
            const price = parseInt(
                row.querySelector(".unit-price").dataset.price,
            );
            const totalEl = row.querySelector(".item-total");
            totalEl.textContent =
                "Rp" + (price * quantity).toLocaleString("id-ID");

            // Update tombol disable
            updateButtons();

            // Update subtotal keseluruhan
            updateSubtotal();

            // Simpan ke backend (tanpa reload)
            fetch(`/cart/update/${id}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'input[name="_token"]',
                    ).value,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ quantity }),
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.error) {
                        alert(data.error);
                    }
                })
                .catch((err) => console.error(err));
        }

        function updateButtons() {
            const qty = parseInt(quantityDisplay.textContent);
            decreaseBtn.disabled = qty <= 1;
            increaseBtn.disabled = qty >= stock;
        }
    });

    function updateSubtotal() {
        let subtotal = 0;
        document.querySelectorAll(".item-total").forEach((el) => {
            const value = parseInt(el.textContent.replace(/[^\d]/g, "")) || 0;
            subtotal += value;
        });
        document.getElementById("cart-subtotal").textContent =
            "Rp" + subtotal.toLocaleString("id-ID");
    }
});
