import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// Import Echo and Pusher
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

// Disable Pusher logging
Pusher.logToConsole = false;

// Initialize Laravel Echo - Ensure this runs first
document.addEventListener("DOMContentLoaded", () => {
    initializeEcho();
});

// Initialize Echo immediately as well (for cases where DOM is already loaded)
initializeEcho();

function initializeEcho() {
    // If Echo is already initialized, don't do it again
    if (window.Echo) {
        return;
    }

    try {
        // Try different methods to get Pusher credentials
        const pusherKey =
            // First try the PusherConfig from the blade template
            (window.PusherConfig && window.PusherConfig.key) ||
            // Then try Vite env variables
            import.meta.env.VITE_PUSHER_APP_KEY ||
            // Then try Mix env variables
            process.env.MIX_PUSHER_APP_KEY;

        const pusherCluster =
            (window.PusherConfig && window.PusherConfig.cluster) ||
            import.meta.env.VITE_PUSHER_APP_CLUSTER ||
            process.env.MIX_PUSHER_APP_CLUSTER ||
            "ap2";

        if (!pusherKey) {
            throw new Error("Pusher key is undefined");
        }

        // Create the Echo instance with standard Pusher configuration
        window.Echo = new Echo({
            broadcaster: "pusher",
            key: pusherKey,
            cluster: pusherCluster,
            forceTLS: true,
            // Don't use custom WebSocket settings - let Pusher handle it
            encrypted: true,
        });

        // Event handlers for Echo/Pusher connection
        window.Echo.connector.pusher.connection.bind("connected", () => {
            window.dispatchEvent(new CustomEvent("echoConnected"));
        });
    } catch (error) {
        // Silently handle errors
        console.error("Error initializing Echo:", error);
    }
}
