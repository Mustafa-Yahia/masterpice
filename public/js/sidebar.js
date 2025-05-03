document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('adminSidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const menuItems = document.querySelectorAll('.has-submenu');

    // Toggle sidebar collapse/expand
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');

        // Save state in localStorage
        const isCollapsed = sidebar.classList.contains('collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed);
    });

    // Check saved state
    if (localStorage.getItem('sidebarCollapsed') === 'true') {
        sidebar.classList.add('collapsed');
    }

    // Handle submenu toggle
    menuItems.forEach(item => {
        const link = item.querySelector('.menu-link');

        link.addEventListener('click', function(e) {
            if (!sidebar.classList.contains('collapsed')) {
                e.preventDefault();
                item.classList.toggle('active');
            }
        });
    });

    // Responsive behavior
    function handleResponsive() {
        if (window.innerWidth < 992) {
            sidebar.classList.add('collapsed');
        } else {
            // Restore saved state for larger screens
            if (localStorage.getItem('sidebarCollapsed') === 'false') {
                sidebar.classList.remove('collapsed');
            }
        }
    }

    // Initial check
    handleResponsive();

    // Listen for resize events
    window.addEventListener('resize', handleResponsive);

    // Add active class based on current URL
    const currentUrl = window.location.href;
    const menuLinks = document.querySelectorAll('.menu-link:not(.has-submenu > .menu-link)');

    menuLinks.forEach(link => {
        if (link.href === currentUrl) {
            link.classList.add('active');

            // Expand parent submenu if exists
            const parentMenu = link.closest('.has-submenu');
            if (parentMenu) {
                parentMenu.classList.add('active');
            }
        }
    });
});
