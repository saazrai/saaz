import { onMounted, ref } from 'vue';

type Appearance = 'light' | 'dark' | 'system';

export function updateTheme(value: Appearance) {
    if (typeof window === 'undefined') {
        return;
    }

    let effectiveTheme: 'light' | 'dark';
    
    if (value === 'system') {
        const mediaQueryList = window.matchMedia('(prefers-color-scheme: dark)');
        effectiveTheme = mediaQueryList.matches ? 'dark' : 'light';
    } else {
        effectiveTheme = value;
    }
    
    // Update both class and data-theme attribute for theme.css
    document.documentElement.classList.toggle('dark', effectiveTheme === 'dark');
    document.documentElement.setAttribute('data-theme', effectiveTheme);
}

const setCookie = (name: string, value: string, days = 365) => {
    if (typeof document === 'undefined') {
        return;
    }

    const maxAge = days * 24 * 60 * 60;

    document.cookie = `${name}=${value};path=/;max-age=${maxAge};SameSite=Lax`;
};

const mediaQuery = () => {
    if (typeof window === 'undefined') {
        return null;
    }

    return window.matchMedia('(prefers-color-scheme: dark)');
};

const getStoredAppearance = () => {
    if (typeof window === 'undefined') {
        return null;
    }

    // First check for appearance setting, then fallback to main theme
    const appearance = localStorage.getItem('appearance') as Appearance | null;
    if (appearance) {
        return appearance;
    }
    
    // Fallback to main theme system
    const theme = localStorage.getItem('theme');
    if (theme === 'light' || theme === 'dark') {
        return theme as Appearance;
    }
    
    return null;
};

const handleSystemThemeChange = () => {
    const currentAppearance = getStoredAppearance();

    updateTheme(currentAppearance || 'dark');
};

export function initializeTheme() {
    if (typeof window === 'undefined') {
        return;
    }

    // Initialize theme from saved preference or default to dark...
    const savedAppearance = getStoredAppearance();
    updateTheme(savedAppearance || 'dark');

    // Set up system theme change listener...
    mediaQuery()?.addEventListener('change', handleSystemThemeChange);
}

const appearance = ref<Appearance>('dark');

export function useAppearance() {
    onMounted(() => {
        const savedAppearance = getStoredAppearance();

        if (savedAppearance) {
            appearance.value = savedAppearance;
        } else {
            // Default to dark to match main theme system
            appearance.value = 'dark';
        }
    });

    function updateAppearance(value: Appearance) {
        appearance.value = value;

        // Store in localStorage for client-side persistence...
        localStorage.setItem('appearance', value);
        
        // Also sync with main theme system for consistency
        if (value === 'light' || value === 'dark') {
            localStorage.setItem('theme', value);
        }

        // Store in cookie for SSR...
        setCookie('appearance', value);

        updateTheme(value);
    }

    return {
        appearance,
        updateAppearance,
    };
}
