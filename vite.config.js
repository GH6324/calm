import { defineConfig } from "vite";
import { fileURLToPath } from "url";
import path from "path";
import { prismjsPlugin } from 'vite-plugin-prismjs'

export default defineConfig({
    plugins: [
        prismjsPlugin({
            languages: 'all',
            css: true
        })
    ],
    build: {
        outDir: fileURLToPath(new URL("./dist", import.meta.url)),
        lib: {
            entry: path.resolve(__dirname, 'lib/main.js'),
            name: 'calm',
            fileName: 'calm',
            formats: ["iife"]
        }
    }
})