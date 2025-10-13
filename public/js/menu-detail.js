function incrementQty() {
    const qty = document.getElementById('quantity');
    qty.value = parseInt(qty.value) + 1;
}

function decrementQty() {
    const qty = document.getElementById('quantity');
    if (parseInt(qty.value) > 1) qty.value = parseInt(qty.value) - 1;
}