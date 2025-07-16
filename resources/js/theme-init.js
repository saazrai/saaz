// Initialize theme immediately to prevent flash
(function() {
  const theme = localStorage.getItem('theme') || 'dark';
  document.documentElement.classList.add(theme);
})();