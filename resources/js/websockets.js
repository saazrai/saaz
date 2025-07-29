import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

// Configure WebSocket connection based on environment
const isProduction = import.meta.env.PROD;
const wsHost = import.meta.env.VITE_REVERB_HOST;
const wsPort = import.meta.env.VITE_REVERB_PORT;
const wsScheme = import.meta.env.VITE_REVERB_SCHEME;

console.log('🔧 WebSocket Config:', {
    host: wsHost,
    port: wsPort,
    scheme: wsScheme,
    isProduction
});

// Try Reverb first, fallback to Pusher if Reverb fails
const useReverb = import.meta.env.VITE_USE_REVERB !== 'false';

if (useReverb) {
    try {
        window.Echo = new Echo({
            broadcaster: 'reverb',
            key: import.meta.env.VITE_REVERB_APP_KEY,
            wsHost: wsHost,
            wsPort: isProduction ? (wsScheme === 'https' ? 443 : 80) : (wsPort ?? 8080),
            wssPort: isProduction ? (wsScheme === 'https' ? 443 : 80) : (wsPort ?? 8080),
            forceTLS: wsScheme === 'https',
            enabledTransports: ['ws', 'wss'],
            disableStats: true,
            cluster: null,
            auth: {
                headers: {
                    'X-CSRF-TOKEN': window.axios.defaults.headers.common['X-CSRF-TOKEN'],
                    'X-Requested-With': 'XMLHttpRequest',
                },
            },
        });
        console.log('🔧 Using Laravel Reverb WebSocket');
    } catch (error) {
        console.warn('⚠️ Reverb failed, falling back to Pusher:', error);
        initializePusher();
    }
} else {
    console.log('🔧 Using Pusher WebSocket (Reverb disabled)');
    initializePusher();
}

function initializePusher() {
    // Fallback to Pusher configuration
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: import.meta.env.VITE_PUSHER_APP_KEY || 'your-pusher-key',
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER || 'mt1',
        forceTLS: true,
        auth: {
            headers: {
                'X-CSRF-TOKEN': window.axios.defaults.headers.common['X-CSRF-TOKEN'],
                'X-Requested-With': 'XMLHttpRequest',
            },
        },
    });
}

// Enhanced connection handling
let connectionTimeout;
let retryCount = 0;
const maxRetries = 3;

window.Echo.connector.pusher.connection.bind('error', (error) => {
    console.warn('🚨 WebSocket connection error:', error);
    console.log('💡 Retrying connection...');
    
    // Implement retry logic
    if (retryCount < maxRetries) {
        retryCount++;
        connectionTimeout = setTimeout(() => {
            console.log(`🔄 Retry attempt ${retryCount}/${maxRetries}`);
            window.Echo.connector.pusher.connect();
        }, 2000 * retryCount); // Exponential backoff
    } else {
        console.log('❌ Max retries reached. Admin panel will work without real-time features.');
    }
});

window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('✅ WebSocket connected successfully');
    retryCount = 0; // Reset retry count on successful connection
    if (connectionTimeout) {
        clearTimeout(connectionTimeout);
        connectionTimeout = null;
    }
});

window.Echo.connector.pusher.connection.bind('disconnected', () => {
    console.log('🔌 WebSocket disconnected');
});

window.Echo.connector.pusher.connection.bind('connecting', () => {
    console.log('🔄 WebSocket connecting...');
});

window.Echo.connector.pusher.connection.bind('unavailable', () => {
    console.warn('⚠️ WebSocket unavailable');
});