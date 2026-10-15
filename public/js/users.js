document.addEventListener('DOMContentLoaded', () => {

    // Sidebar submenu toggles
    document.querySelectorAll('.nav-toggle').forEach(toggle => {

        toggle.addEventListener('click', () => {

            const group = toggle.closest('.nav-group');

            if (!group) return;

            const isOpen = group.classList.toggle('open');

            toggle.setAttribute('aria-expanded', String(isOpen));

            const plus = toggle.querySelector('.plus');

            if (plus) {
                plus.textContent = isOpen ? '−' : '+';
            }
        });
    });

    // Mobile sidebar
    const menuButton = document.getElementById('menuButton');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function closeSidebar() {
        if (!sidebar || !overlay || !menuButton) return;

        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        menuButton.setAttribute('aria-expanded', 'false');
    }

    if (menuButton && sidebar && overlay) {

        menuButton.addEventListener('click', () => {

            const isOpen = sidebar.classList.toggle('show');

            overlay.classList.toggle('show', isOpen);

            menuButton.setAttribute(
                'aria-expanded',
                String(isOpen)
            );
        });

        overlay.addEventListener('click', closeSidebar);
    }

    // Close modal using Escape key
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            closeSidebar();
            closeDeleteNotice();
        }
    });

    // Close modal when clicking outside
    const modal = document.getElementById('deleteModal');

    if (modal) {
        modal.addEventListener('click', event => {
            if (event.target === modal) {
                closeDeleteNotice();
            }
        });
    }
});

// Show Delete Confirmation Modal
function showDeleteNotice(button) {

    const userName = button.dataset.userName;
    const deleteUrl = button.dataset.deleteUrl;

    const modal = document.getElementById('deleteModal');
    const message = document.getElementById('deleteMessage');
    const form = document.getElementById('deleteUserForm');

    if (!modal || !message || !form || !deleteUrl) {
        return;
    }

    message.textContent =
        `Are you sure you want to delete "${userName}"? This action cannot be undone.`;

    form.action = deleteUrl;

    modal.hidden = false;
}

// Close Delete Confirmation Modal
function closeDeleteNotice() {

    const modal = document.getElementById('deleteModal');

    if (modal) {
        modal.hidden = true;
    }

}
