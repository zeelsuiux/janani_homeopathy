</main></div><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script><script>
const adminMenuToggle = document.querySelector('.admin-mobile-toggle');
const adminSidebar = document.getElementById('adminSidebar');
if (adminMenuToggle && adminSidebar) {
	adminMenuToggle.addEventListener('click', () => {
		const open = document.body.classList.toggle('admin-menu-open');
		adminMenuToggle.setAttribute('aria-expanded', String(open));
	});
}
</script></body></html>
