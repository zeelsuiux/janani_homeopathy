const bookingModal = document.getElementById('bookingModal');

if (bookingModal) {
  let bookingModalTrigger = null;

  const closeBookingModal = () => {
    bookingModal.classList.remove('show');
    bookingModal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    if (bookingModalTrigger) bookingModalTrigger.focus();
  };

  bookingModal.querySelectorAll('[data-booking-close]').forEach((button) => {
    button.addEventListener('click', () => {
      bookingModalTrigger = document.activeElement;
      closeBookingModal();
    });
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && bookingModal.classList.contains('show')) {
      closeBookingModal();
    }
  });

  window.setTimeout(() => {
    if (bookingModal.classList.contains('show')) return;
    bookingModal.classList.add('show');
    bookingModal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    bookingModal.querySelector('input')?.focus();
  }, 30000);
}
