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
    if (!range || !before) return;

    const updateComparison = () => {
      before.style.clipPath = `inset(0 ${100 - range.value}% 0 0)`;
    };

    range.addEventListener('input', updateComparison);
    updateComparison();
  });

  const viewer = document.getElementById('videoViewer');
  const viewerPlayer = document.getElementById('videoViewerPlayer');
  const viewerTitle = document.getElementById('videoViewerTitle');
  if (viewer && viewerPlayer) {
    const closeViewer = () => {
      viewer.hidden = true;
      viewerPlayer.pause();
      viewerPlayer.removeAttribute('src');
      document.body.style.overflow = '';
    };
    document.querySelectorAll('.testimonial-video-trigger').forEach((trigger) => {
      trigger.addEventListener('click', () => {
        viewerPlayer.src = trigger.dataset.videoSrc || '';
        viewerPlayer.muted = false;
        viewerTitle.textContent = trigger.dataset.videoTitle || '';
        viewer.hidden = false;
        document.body.style.overflow = 'hidden';
        viewerPlayer.play().catch(() => {});
        viewerPlayer.requestFullscreen?.().catch(() => {});
      });
    });
    viewer.querySelectorAll('[data-video-close]').forEach((button) => button.addEventListener('click', closeViewer));
    document.addEventListener('keydown', (event) => { if (event.key === 'Escape' && !viewer.hidden) closeViewer(); });
  }

  document.querySelectorAll('[data-reel-slider]').forEach((slider) => {
    const track = slider.querySelector('.testimonial-reel-track');
    if (!track) return;
    let index = 0;
    const cards = [...track.children];
    const visibleCards = () => window.innerWidth <= 600 ? 1 : (window.innerWidth <= 950 ? 3 : 4);
    const updatePosition = (animate = true) => {
      const card = cards[0];
      if (!card) return;
      track.style.transition = animate ? 'transform .5s ease' : 'none';
      track.style.transform = `translateX(-${index * (card.getBoundingClientRect().width + 18)}px)`;
    };
    const showNext = () => {
      const maxIndex = Math.max(0, cards.length - visibleCards());
      if (maxIndex === 0) return;
      if (index >= maxIndex) {
        index = 0;
        updatePosition(false);
        window.requestAnimationFrame(() => { index = 1; updatePosition(true); });
        return;
      }
      index += 1;
      updatePosition(true);
    };
    window.addEventListener('resize', () => { index = Math.min(index, Math.max(0, cards.length - visibleCards())); updatePosition(false); });
    window.setInterval(showNext, 4500);
  });
});
