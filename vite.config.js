import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/utils/validarInput.js',
                'resources/js/cursos/crearCurso.js',
            ],
            refresh: true,
        }),
        
    ],
});
