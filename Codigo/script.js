document.addEventListener('DOMContentLoaded', () => {
  const prefersReducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)'
  ).matches;

  const proof = document.querySelector('.proof');
  if (!proof || prefersReducedMotion) return;


  proof.style.transition = 'box-shadow 600ms ease';
  proof.style.boxShadow = '0 0 0 3px rgba(255, 90, 54, 0.25)';
  setTimeout(() => {
    proof.style.boxShadow = 'none';
  }, 700);
});
