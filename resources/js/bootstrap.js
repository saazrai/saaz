import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Add CSRF token to axios headers
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// Only initialize WebSockets when explicitly enabled and Reverb is available
const enableWebSockets = import.meta.env.VITE_ENABLE_WEBSOCKETS === 'true';
const hasReverbSupport = import.meta.env.VITE_REVERB_AVAILABLE === 'true';

if (enableWebSockets && (hasReverbSupport || !import.meta.env.PROD)) {
    import('./websockets.js').then(() => {
        console.log('✅ WebSocket connection initialized');
    }).catch((error) => {
        console.warn('⚠️ WebSocket initialization failed:', error.message);
        console.log('🔄 Admin panel will work without real-time features');
    });
} else {
    console.log('🔧 WebSockets disabled - Admin panel works without real-time features');
    // Create a mock Echo object that prevents errors
    window.Echo = {
        join: () => ({ 
            here: () => {}, 
            joining: () => {}, 
            leaving: () => {}, 
            error: () => {},
            listen: () => {}
        }),
        private: () => ({ 
            listen: () => {}, 
            error: () => {} 
        }),
        leave: () => {},
        connector: { pusher: { connection: { bind: () => {} } } }
    };
}
