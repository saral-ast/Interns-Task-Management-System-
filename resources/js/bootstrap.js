import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// Import Echo and Soketi client for Reverb
import Echo from "laravel-echo";
import Soketi from "@soketi/soketi-js";

// Initialize Laravel Echo - Ensure this runs first
document.addEventListener("DOMContentLoaded", () => {
    initializeEcho();
});

function initializeEcho() {
    // If Echo is already initialized, don't do it again
    if (window.Echo) {
        return;
    }

    try {
        // Try different methods to get Reverb credentials
        const reverbHost =
            (window.ReverbConfig && window.ReverbConfig.host) ||
            import.meta.env.VITE_REVERB_HOST ||
            process.env.MIX_REVERB_HOST ||
            "127.0.0.1";

        const reverbPort =
            (window.ReverbConfig && window.ReverbConfig.port) ||
            import.meta.env.VITE_REVERB_PORT ||
            process.env.MIX_REVERB_PORT ||
            "8080";

        const reverbScheme =
            (window.ReverbConfig && window.ReverbConfig.scheme) ||
            import.meta.env.VITE_REVERB_SCHEME ||
            process.env.MIX_REVERB_SCHEME ||
            "http";

        const reverbKey =
            (window.ReverbConfig && window.ReverbConfig.key) ||
            import.meta.env.VITE_REVERB_APP_KEY ||
            process.env.MIX_REVERB_APP_KEY ||
            "app-key";

        // Create the Echo instance with Reverb configuration
        window.Echo = new Echo({
            broadcaster: "reverb",
            key: reverbKey,
            host: `${reverbScheme}://${reverbHost}:${reverbPort}`,
            client: Soketi,
        });

        // Event handler for Echo connection
        window.Echo.connector.socket.on("connect", () => {
            window.dispatchEvent(new CustomEvent("echoConnected"));
        });
    } catch (error) {
        console.error("Echo initialization error:", error);
    }
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';
