import { ref, computed, watch } from 'vue'
import { usePage } from '@inertiajs/vue3'
import axios from 'axios'

export type Theme = 'light' | 'dark'

interface UiPreferences {
    theme: Theme
    admin_theme: Theme
    sidebar_collapsed: boolean
    font_size: 'small' | 'medium' | 'large'
    animations_enabled: boolean
}

const defaultPreferences: UiPreferences = {
    theme: 'dark',
    admin_theme: 'dark',
    sidebar_collapsed: false,
    font_size: 'medium',
    animations_enabled: true
}

const uiPreferences = ref<UiPreferences>({ ...defaultPreferences })
const isLoading = ref(false)
const isInitialized = ref(false)

export const useTheme = () => {
    const page = usePage()
    const user = computed(() => (page.props as any).auth?.user)
    
    const isDarkMode = computed(() => uiPreferences.value.theme === 'dark')
    const isAdminDarkMode = computed(() => uiPreferences.value.admin_theme === 'dark')

    const applyTheme = () => {
        // For admin pages, use admin_theme. For regular pages, use theme.
        const currentPath = window.location.pathname
        const isAdminPage = currentPath.startsWith('/admin')
        
        const effectiveTheme = isAdminPage ? uiPreferences.value.admin_theme : uiPreferences.value.theme
        
        if (effectiveTheme === 'dark') {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    }

    const loadFromLocalStorage = () => {
        const appTheme = localStorage.getItem('appDarkMode')
        const adminTheme = localStorage.getItem('adminDarkMode')
        
        if (appTheme !== null) {
            uiPreferences.value.theme = appTheme === 'true' ? 'dark' : 'light'
        }
        
        if (adminTheme !== null) {
            uiPreferences.value.admin_theme = adminTheme === 'true' ? 'dark' : 'light'
        }
    }

    const saveToLocalStorage = () => {
        localStorage.setItem('appDarkMode', String(isDarkMode.value))
        localStorage.setItem('adminDarkMode', String(isAdminDarkMode.value))
    }

    const fetchPreferences = async () => {
        // Only fetch from API if user is authenticated
        if (!user.value || !user.value.id) {
            loadFromLocalStorage()
            applyTheme()
            isInitialized.value = true
            return
        }
        
        try {
            isLoading.value = true
            const response = await axios.get('/api/profile/ui-preferences', {
                withCredentials: true
            })
            if (response.data.success) {
                uiPreferences.value = { ...defaultPreferences, ...response.data.data }
                saveToLocalStorage()
                applyTheme()
            }
        } catch (error) {
            // Check if it's an authentication error
            if (axios.isAxiosError(error) && error.response?.status === 401) {
                console.warn('User not authenticated, using localStorage for theme preferences')
            } else {
                console.warn('Failed to fetch UI preferences, using localStorage fallback:', error)
            }
            loadFromLocalStorage()
            applyTheme()
        } finally {
            isLoading.value = false
            isInitialized.value = true
        }
    }

    const updatePreferences = async (updates: Partial<UiPreferences>) => {
        // Update local state and localStorage immediately
        uiPreferences.value = { ...uiPreferences.value, ...updates }
        saveToLocalStorage()
        
        if ('theme' in updates || 'admin_theme' in updates) {
            applyTheme()
        }
        
        // Only sync to API if user is authenticated
        if (!user.value || !user.value.id) {
            return true
        }
        
        try {
            const response = await axios.patch('/api/profile/ui-preferences', updates, {
                withCredentials: true
            })
            if (response.data.success) {
                return true
            }
        } catch (error) {
            // Check if it's an authentication error
            if (axios.isAxiosError(error) && error.response?.status === 401) {
                console.warn('User not authenticated, theme preference saved to localStorage only')
            } else {
                console.error('Failed to sync UI preferences to server:', error)
            }
            // Don't fail - localStorage update already succeeded
            return true
        }
        
        return true
    }

    const toggleTheme = async (isAdmin = false) => {
        const currentTheme = isAdmin ? uiPreferences.value.admin_theme : uiPreferences.value.theme
        const newTheme: Theme = currentTheme === 'dark' ? 'light' : 'dark'
        
        const updates: Partial<UiPreferences> = isAdmin 
            ? { admin_theme: newTheme }
            : { theme: newTheme }
        
        await updatePreferences(updates)
    }

    const setTheme = async (theme: Theme, isAdmin = false) => {
        const updates: Partial<UiPreferences> = isAdmin 
            ? { admin_theme: theme }
            : { theme }
        
        await updatePreferences(updates)
    }

    const initializeTheme = async () => {
        if (isInitialized.value) return
        
        loadFromLocalStorage()
        applyTheme()
        
        // Check if current route is a public/diagnostic route
        const currentPath = window.location.pathname
        const isPublicRoute = currentPath.startsWith('/diagnostics') || 
                            currentPath === '/' || 
                            currentPath.startsWith('/info') ||
                            currentPath.startsWith('/legal')
        
        // Only fetch preferences if authenticated and not on public route
        if (typeof window !== 'undefined' && user.value && !isPublicRoute) {
            await fetchPreferences()
        } else {
            isInitialized.value = true
        }
    }

    watch(
        () => [uiPreferences.value.theme, uiPreferences.value.admin_theme],
        () => {
            applyTheme()
        },
        { immediate: true }
    )

    return {
        uiPreferences: computed(() => uiPreferences.value),
        isDarkMode,
        isAdminDarkMode,
        isLoading: computed(() => isLoading.value),
        isInitialized: computed(() => isInitialized.value),
        toggleTheme,
        setTheme,
        updatePreferences,
        fetchPreferences,
        initializeTheme,
        applyTheme
    }
}