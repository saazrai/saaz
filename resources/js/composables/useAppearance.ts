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

    return localStorage.getItem('appearance') as Appearance | null;
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
        const savedAppearance = localStorage.getItem('appearance') as Appearance | null;

        if (savedAppearance) {
            appearance.value = savedAppearance;
        }
    });

    function updateAppearance(value: Appearance) {
        appearance.value = value;

        // Store in localStorage for client-side persistence...
        localStorage.setItem('appearance', value);

        // Store in cookie for SSR...
        setCookie('appearance', value);

        updateTheme(value);
    }

    return {
        appearance,
        updateAppearance,
    };
}
