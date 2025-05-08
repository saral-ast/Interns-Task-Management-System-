import { defineConfig, loadEnv } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(({ mode }) => {
    // Load env variables
    const env = loadEnv(mode, process.cwd(), ["VITE_", "PUSHER_"]);

    // Hardcoded fallback values (only for development)
    const pusherKey =
        env.VITE_PUSHER_APP_KEY ||
        env.PUSHER_APP_KEY ||
        "your-fallback-pusher-key";
    const pusherCluster =
        env.VITE_PUSHER_APP_CLUSTER || env.PUSHER_APP_CLUSTER || "ap2";

    return {
        plugins: [
            laravel({
                input: ["resources/css/app.css", "resources/js/app.js"],
                refresh: true,
            }),
            tailwindcss(),
        ],
        define: {
            // Make env variables available to the client
            "import.meta.env.VITE_PUSHER_APP_KEY": JSON.stringify(pusherKey),
            "import.meta.env.VITE_PUSHER_APP_CLUSTER":
                JSON.stringify(pusherCluster),
            "process.env.MIX_PUSHER_APP_KEY": JSON.stringify(pusherKey),
            "process.env.MIX_PUSHER_APP_CLUSTER": JSON.stringify(pusherCluster),
            "process.env.NODE_ENV": JSON.stringify(mode),
        },
        // Show detailed build info to help with troubleshooting
        build: {
            sourcemap: mode !== "production",
        },
    };
});
