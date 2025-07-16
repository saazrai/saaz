import { ref, computed, watch, onMounted } from 'vue';
import { applyTheme, getCurrentTheme, themes } from '@/config/theme';

// Shared state across all components
const currentTheme = ref(getCurrentTheme());

export function useTheme() {
  const isDark = computed(() => currentTheme.value === 'dark');
  const isLight = computed(() => currentTheme.value === 'light');
  
  // Theme colors as computed properties
  const colors = computed(() => {
    const theme = themes[currentTheme.value];
    const result = {};
    
    // Convert CSS variables to usable values
    Object.entries(theme).forEach(([key, value]) => {
      const cssVarName = key.replace('--', '').replace(/-/g, '_');
      result[cssVarName] = `rgb(${value})`;
    });
    
    return result;
  });
  
  // Toggle theme function
  const toggleTheme = () => {
    const newTheme = currentTheme.value === 'dark' ? 'light' : 'dark';
    currentTheme.value = newTheme;
    applyTheme(newTheme);
  };
  
  // Set specific theme
  const setTheme = (theme) => {
    if (themes[theme]) {
      currentTheme.value = theme;
      applyTheme(theme);
    }
  };
  
  // Watch for theme changes
  watch(currentTheme, (newTheme) => {
    applyTheme(newTheme);
  });
  
  // Initialize on mount
  onMounted(() => {
    // Re-sync with current state
    const savedTheme = getCurrentTheme();
    if (savedTheme !== currentTheme.value) {
      currentTheme.value = savedTheme;
    }
  });
  
  return {
    currentTheme,
    isDark,
    isLight,
    colors,
    toggleTheme,
    setTheme
  };
}