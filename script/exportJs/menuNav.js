export function currentPage() {
    const currentPage = window.location.href;
    const navItems = document.querySelectorAll('.nav ul li');

    navItems.forEach(item => {
        const page = item.dataset.page;
        const link = item.querySelector('a').getAttribute('href');

        if (currentPage.includes(link)) {
            item.classList.add('active');
        }
    });
};
document.addEventListener('DOMContentLoaded', function() {
    currentPage();
});