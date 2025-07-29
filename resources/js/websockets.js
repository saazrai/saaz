import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
    auth: {
        headers: {
            'X-CSRF-TOKEN': window.axios.defaults.headers.common['X-CSRF-TOKEN'],
            'X-Requested-With': 'XMLHttpRequest',
        },
    },
});

// Add connection error handling
window.Echo.connector.pusher.connection.bind('error', (error) => {
    console.warn('🚨 WebSocket connection error:', error);
    console.log('💡 Admin panel will continue to work without real-time features');
});

window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('✅ WebSocket connected successfully');
});

window.Echo.connector.pusher.connection.bind('disconnected', () => {
    console.log('🔌 WebSocket disconnected');
});