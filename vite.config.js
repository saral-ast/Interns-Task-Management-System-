import { defineConfig, loadEnv } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(({ mode }) => {
    // Load env variables
    const env = loadEnv(mode, process.cwd(), ["VITE_", "REVERB_"]);

    // Hardcoded fallback values (only for development)
    const reverbKey =
        env.VITE_REVERB_APP_KEY || env.REVERB_APP_KEY || "app-key";

    const reverbHost = env.VITE_REVERB_HOST || env.REVERB_HOST || "127.0.0.1";

    const reverbPort = env.VITE_REVERB_PORT || env.REVERB_PORT || "8080";

    const reverbScheme = env.VITE_REVERB_SCHEME || env.REVERB_SCHEME || "http";

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
            "import.meta.env.VITE_REVERB_APP_KEY": JSON.stringify(reverbKey),
            "import.meta.env.VITE_REVERB_HOST": JSON.stringify(reverbHost),
            "import.meta.env.VITE_REVERB_PORT": JSON.stringify(reverbPort),
            "import.meta.env.VITE_REVERB_SCHEME": JSON.stringify(reverbScheme),
            "process.env.MIX_REVERB_APP_KEY": JSON.stringify(reverbKey),
            "process.env.MIX_REVERB_HOST": JSON.stringify(reverbHost),
            "process.env.MIX_REVERB_PORT": JSON.stringify(reverbPort),
            "process.env.MIX_REVERB_SCHEME": JSON.stringify(reverbScheme),
            "process.env.NODE_ENV": JSON.stringify(mode),
        },
        // Show detailed build info to help with troubleshooting
        build: {
            sourcemap: mode !== "production",
        },
    };
});
