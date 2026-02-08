import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
    build: {
        // ライブラリモードではなく、通常のビルドモード
        outDir: 'assets',
        emptyOutDir: true,
        rollupOptions: {
            input: {
                main: resolve(__dirname, 'src/main.ts'),
            },
            output: {
                // ファイル名パターン
                entryFileNames: '[name].js',
                chunkFileNames: '[name]-[hash].js',
                assetFileNames: '[name][extname]',
            },
        },
        // ソースマップを生成（開発用）
        sourcemap: true,
        // 最小化
        minify: 'terser',
    },
    css: {
        preprocessorOptions: {
            scss: {
                // SCSS追加設定が必要な場合はここに
            },
        },
    },
    resolve: {
        alias: {
            '@': resolve(__dirname, 'src'),
        },
    },
});
