document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.main-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', () => {
      const open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }

  document.querySelectorAll('[data-before-after]').forEach((compare) => {
    const range = compare.querySelector('.before-after-range');
    const before = compare.querySelector('.before-after-before');
    const handle = compare.querySelector('.before-after-handle');
    if (!range || !before) return;

    const updateComparison = () => {
      before.style.clipPath = `inset(0 ${100 - range.value}% 0 0)`;
      if (handle) handle.style.left = `${range.value}%`;
    };

    range.addEventListener('input', updateComparison);
    updateComparison();
  });
});
