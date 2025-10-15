import tailwindcss from "@tailwindcss/vite";
import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    server: {
        host: "0.0.0.0", // menerima koneksi dari luar localhost
        hmr: {
            host: "https://crackless-unbevelled-lilli.ngrok-free.dev/", // ganti dengan URL ngrok kamu
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
