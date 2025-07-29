import Echo from 'laravel-echo';

declare global {
    interface Window {
        axios: any;
        Echo: Echo;
        Pusher: any;
        pusherKey?: string;
    }
}

export {};