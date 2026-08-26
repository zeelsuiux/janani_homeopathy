</main></div><script>
const adminMenuToggle = document.querySelector('.admin-mobile-toggle');
const adminSidebar = document.getElementById('adminSidebar');
if (adminMenuToggle && adminSidebar) {
	adminMenuToggle.addEventListener('click', () => {
		const open = document.body.classList.toggle('admin-menu-open');
		adminMenuToggle.setAttribute('aria-expanded', String(open));
	});
}
</script></body></html>
