document.addEventListener('DOMContentLoaded', () => {

    // Sidebar submenu toggles
    const toggles = document.querySelectorAll('.nav-toggle');

    toggles.forEach((toggle) => {
        toggle.addEventListener('click', () => {

            const group = toggle.closest('.nav-group');

            if (!group) return;

            const isOpen = group.classList.toggle('open');

            toggle.setAttribute(
                'aria-expanded',
                String(isOpen)
            );

            const symbol = toggle.querySelector('.plus');

            if (symbol) {
                symbol.textContent = isOpen ? '−' : '+';
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

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });
    }
});
