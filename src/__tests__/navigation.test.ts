import { describe, it, expect, beforeEach } from 'vitest';
import { Navigation } from '../modules/navigation';

describe('Navigation', () => {
    let navigation: Navigation;

    beforeEach(() => {
        // Setup DOM
        document.body.innerHTML = `
      <nav class="globalNavi">
        <input class="globalNavi__toggle" id="globalNavi__toggle" type="checkbox" />
        <ul class="globalNavi__list">
          <li><a href="#">Link 1</a></li>
          <li><a href="#">Link 2</a></li>
        </ul>
      </nav>
    `;
    });

    it('should initialize without errors', () => {
        expect(() => {
            navigation = new Navigation();
        }).not.toThrow();
    });

    it('should set aria-expanded on toggle change', () => {
        navigation = new Navigation();
        const toggle = document.querySelector('.globalNavi__toggle') as HTMLInputElement;
        const menu = document.querySelector('.globalNavi__list') as HTMLElement;

        toggle.checked = true;
        toggle.dispatchEvent(new Event('change'));

        expect(menu.getAttribute('aria-expanded')).toBe('true');

        toggle.checked = false;
        toggle.dispatchEvent(new Event('change'));

        expect(menu.getAttribute('aria-expanded')).toBe('false');
    });

    it('should close menu when Escape key is pressed', () => {
        navigation = new Navigation();
        const toggle = document.querySelector('.globalNavi__toggle') as HTMLInputElement;
        const menu = document.querySelector('.globalNavi__list') as HTMLElement;

        toggle.checked = true;
        toggle.dispatchEvent(new Event('change'));

        const escapeEvent = new KeyboardEvent('keydown', { key: 'Escape' });
        document.dispatchEvent(escapeEvent);

        expect(toggle.checked).toBe(false);
        expect(menu.getAttribute('aria-expanded')).toBe('false');
    });

    it('should close menu programmatically', () => {
        navigation = new Navigation();
        const toggle = document.querySelector('.globalNavi__toggle') as HTMLInputElement;
        const menu = document.querySelector('.globalNavi__list') as HTMLElement;

        toggle.checked = true;
        navigation.closeMenu();

        expect(toggle.checked).toBe(false);
        expect(menu.getAttribute('aria-expanded')).toBe('false');
    });

    it('should handle missing DOM elements gracefully', () => {
        document.body.innerHTML = '';
        expect(() => {
            navigation = new Navigation();
        }).not.toThrow();
    });
});
