function showProductDeleteModal(button) {
    const modal = document.getElementById('productDeleteModal');
    const message = document.getElementById('productDeleteMessage');
    const form = document.getElementById('deleteProductForm');

    if (!modal || !message || !form) return;

    const productName = button.dataset.productName;
    const deleteUrl = button.dataset.deleteUrl;

    if (!deleteUrl) return;

    message.textContent =
        `Are you sure you want to delete "${productName}"? This action cannot be undone.`;

    form.action = deleteUrl;
    modal.hidden = false;
}

function closeProductDeleteModal() {
    const modal = document.getElementById('productDeleteModal');

    if (modal) {
        modal.hidden = true;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('productDeleteModal');

    if (!modal) return;

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeProductDeleteModal();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeProductDeleteModal();
        }
    });
});
