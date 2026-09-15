import './bootstrap';
import '@fontsource/space-grotesk/400.css';
import '@fontsource/space-grotesk/500.css';
import '@fontsource/space-grotesk/600.css';
import '@fontsource/space-grotesk/700.css';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import { createIcons, icons } from 'lucide';

window.Alpine = Alpine;

Alpine.plugin(collapse);
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    createIcons({
        icons,
    });
});