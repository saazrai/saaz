/**
 * Route Helper Utilities
 * 
 * Provides safe route generation with fallback URLs
 * to prevent Ziggy errors for unauthenticated users
 */

/**
 * Safely get a route URL with fallback
 * @param {string} routeName - The route name to resolve
 * @param {string} fallbackUrl - The fallback URL if route is not available
 * @param {object} params - Optional route parameters
 * @returns {string} The resolved route URL or fallback
 */
export function safeRoute(routeName, fallbackUrl, params = {}) {
    // Check if route function exists and if the route is available
    if (typeof route !== 'undefined' && route().has && route().has(routeName)) {
        return route(routeName, params);
    }
    return fallbackUrl;
}

/**
 * Check if a route exists in the current context
 * @param {string} routeName - The route name to check
 * @returns {boolean} True if route exists, false otherwise
 */
export function hasRoute(routeName) {
    return typeof route !== 'undefined' && route().has && route().has(routeName);
}

/**
 * Get multiple routes with their fallbacks
 * @param {Object} routeMap - Object mapping route names to fallback URLs
 * @returns {Object} Object with resolved URLs
 */
export function safeRoutes(routeMap) {
    const resolved = {};
    for (const [routeName, fallbackUrl] of Object.entries(routeMap)) {
        resolved[routeName] = safeRoute(routeName, fallbackUrl);
    }
    return resolved;
}

// Default route fallbacks for common routes
export const defaultFallbacks = {
    'assessments.diagnostics.index': '/diagnostics',
    'catalog.courses.index': '/courses',
    'register': '/register',
    'login': '/login',
    'dashboard': '/dashboard',
    'learn.dashboard': '/learn',
    'profile.show': '/profile',
    'commerce.cart.show': '/cart',
};