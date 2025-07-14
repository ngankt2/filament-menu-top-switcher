let sidebarScrollTop = 0;

function getSidebar() {
    return document.querySelector('.fi-sidebar-nav');
}

// Lưu scroll trước khi chuyển trang
document.addEventListener('click', (e) => {
    const item = e.target.closest('.fi-sidebar-item');
    const sidebar = getSidebar();

    if (item && sidebar) {
        sidebarScrollTop = sidebar.scrollTop;
    }
});

// Restore scroll sau khi chuyển trang
document.addEventListener('livewire:navigated', () => {
    const tryRestoreScroll = () => {
        const sidebar = getSidebar();
        if (sidebar && sidebar.scrollTop !== sidebarScrollTop) {
            sidebar.scrollTo({ top: sidebarScrollTop, behavior: 'auto' });
            requestAnimationFrame(tryRestoreScroll);
        }
    };

    requestAnimationFrame(tryRestoreScroll);
});
