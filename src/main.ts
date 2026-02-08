/**
 * TIGER BLOG - Main Entry Point
 * Modern WordPress theme with TypeScript
 */

import { Navigation } from './modules/navigation';
import { Scroll } from './modules/scroll';
import { Search } from './modules/search';
import './styles/main.scss';

// Initialize modules when DOM is ready
const initTheme = (): void => {
    // Initialize navigation
    const navigation = new Navigation();

    // Initialize scroll functionality
    const scroll = new Scroll(300);

    // Initialize search
    const search = new Search();

    // Store instances globally for debugging (only in development)
    if (process.env.NODE_ENV === 'development') {
        (window as any).tigerBlog = {
            navigation,
            scroll,
            search,
        };
    }
};

// Wait for DOM to be ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTheme);
} else {
    initTheme();
}
