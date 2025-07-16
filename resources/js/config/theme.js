// Theme configuration with CSS variables
export const themes = {
  light: {
    // Core colors - Match production page exactly
    '--color-base': '239 239 239', // #efefef - main background from production
    '--color-surface': '255 255 255', // #ffffff - white surfaces
    '--color-elevated': '249 250 251', // #f9fafb - subtle elevation for active items
    
    // Borders - Clean and subtle
    '--color-border': '229 231 235', // #e5e7eb - very light gray border
    '--color-border-opacity': '0.5',
    '--color-border-subtle': '243 244 246', // #f3f4f6 - very subtle borders
    '--color-border-subtle-opacity': '1',
    
    // Text - Excellent contrast and hierarchy
    '--color-text-primary': '17 24 39', // #111827 - strong readable text
    '--color-text-secondary': '75 85 99', // #4b5563 - good secondary text
    '--color-text-muted': '107 114 128', // #6b7280 - clear muted text
    
    // Interactive elements - Professional blue system
    '--color-primary': '59 130 246', // #3b82f6 - trustworthy blue
    '--color-primary-hover': '37 99 235', // #2563eb - darker on hover
    '--color-secondary': '243 244 246', // #f3f4f6 - clean secondary
    '--color-secondary-hover': '229 231 235', // #e5e7eb - subtle hover
    
    // Status colors - Clear and accessible
    '--color-success': '5 150 105', // #059669 - professional green
    '--color-success-bg': '220 252 231', // #dcfce7 - light green bg
    '--color-success-bg-opacity': '1',
    '--color-danger': '220 38 38', // #dc2626 - clear red
    '--color-danger-bg': '254 226 226', // #fee2e2 - light red bg
    '--color-danger-bg-opacity': '1',
    '--color-warning': '217 119 6', // #d97706 - amber warning
    '--color-warning-bg': '254 243 199', // #fef3c7 - light amber bg
    '--color-warning-bg-opacity': '1',
    
    // Component specific - Match production design
    '--color-card-bg': '255 255 255', // #ffffff - pure white cards
    '--color-card-border': '226 232 240', // #e2e8f0 - slightly softer borders
    '--color-code-bg': '248 250 252', // #f8fafc - clean code background
    '--color-hover-bg': '243 244 246', // #f3f4f6 - subtle hover
    '--color-hover-bg-opacity': '1',
  },
  
  dark: {
    // Core colors
    '--color-base': '15 23 42', // #0f172a (slate-900)
    '--color-surface': '30 41 59', // #1e293b (slate-800)
    '--color-elevated': '51 65 85', // #334155 (slate-700)
    
    // Borders - More subtle for cleaner look
    '--color-border': '148 163 184', // #94a3b8 (slate-400)
    '--color-border-opacity': '0.12',
    '--color-border-subtle': '71 85 105', // #475569 (slate-600)
    '--color-border-subtle-opacity': '0.1',
    
    // Text
    '--color-text-primary': '248 250 252', // #f8fafc (slate-50)
    '--color-text-secondary': '226 232 240', // #e2e8f0 (slate-200)
    '--color-text-muted': '203 213 225', // #cbd5e1 (slate-300)
    
    // Interactive elements
    '--color-primary': '59 130 246', // #3b82f6 (blue-500)
    '--color-primary-hover': '37 99 235', // #2563eb (blue-600)
    '--color-secondary': '55 65 81', // #374151 (gray-700)
    '--color-secondary-hover': '75 85 99', // #4b5563 (gray-600)
    
    // Status colors
    '--color-success': '74 222 128', // #4ade80 (green-400)
    '--color-success-bg': '20 83 45', // #14532d (green-900)
    '--color-success-bg-opacity': '1',
    '--color-danger': '239 68 68', // #ef4444 (red-400)
    '--color-danger-bg': '127 29 29', // #7f1d1d (red-900)
    '--color-danger-bg-opacity': '1',
    '--color-warning': '251 146 60', // #fb923c (orange-400)
    '--color-warning-bg': '124 45 18', // #7c2d12 (orange-900)
    '--color-warning-bg-opacity': '1',
    
    // Component specific
    '--color-card-bg': '30 41 59', // #1e293b (slate-800)
    '--color-card-border': '71 85 105', // #475569 (slate-600) - subtle border
    '--color-code-bg': '15 23 42', // #0f172a (slate-900)
    '--color-hover-bg': '71 85 105', // #475569 (slate-600)
    '--color-hover-bg-opacity': '0.2',
  }
};

// Apply theme to root element
export function applyTheme(themeName) {
  const theme = themes[themeName] || themes.light;
  const root = document.documentElement;
  
  // Apply CSS variables
  Object.entries(theme).forEach(([key, value]) => {
    root.style.setProperty(key, value);
  });
  
  // Add theme class for Tailwind
  root.classList.remove('light', 'dark');
  root.classList.add(themeName);
  
  // Store preference
  localStorage.setItem('theme', themeName);
}

// Get current theme
export function getCurrentTheme() {
  return localStorage.getItem('theme') || 'dark';
}

// Initialize theme system
export function initializeTheme() {
  const theme = getCurrentTheme();
  applyTheme(theme);
}