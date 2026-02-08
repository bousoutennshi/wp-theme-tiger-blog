import { describe, it, expect, beforeEach, vi } from 'vitest';
import { Scroll } from '../modules/scroll';

describe('Scroll', () => {
    let scroll: Scroll;

    beforeEach(() => {
        // Setup DOM
        document.body.innerHTML = `
      <div class="pagetop" style="opacity: 0; visibility: hidden;">
        <a href="#">Top</a>
      </div>
    `;

        // Mock window.scrollY
        Object.defineProperty(window, 'scrollY', {
            writable: true,
            configurable: true,
            value: 0,
        });

        // Mock window.scrollTo
        window.scrollTo = vi.fn() as unknown as typeof window.scrollTo;
    });

    it('should initialize without errors', () => {
        expect(() => {
            scroll = new Scroll(300);
        }).not.toThrow();
    });

    it('should return correct scroll position', () => {
        scroll = new Scroll(300);

        (window as any).scrollY = 500;
        expect(scroll.getScrollPosition()).toBe(500);
    });

    it('should show button when scrolled past threshold', () => {
        scroll = new Scroll(300);
        const button = document.querySelector('.pagetop') as HTMLElement;

        // Simulate scroll past threshold
        (window as any).scrollY = 400;
        window.dispatchEvent(new Event('scroll'));

        // Wait for requestAnimationFrame
        return new Promise((resolve) => {
            requestAnimationFrame(() => {
                expect(button.style.opacity).toBe('1');
                expect(button.style.visibility).toBe('visible');
                expect(button.getAttribute('aria-hidden')).toBe('false');
                resolve(undefined);
            });
        });
    });

    it('should hide button when scrolled below threshold', async () => {
        // Start with scroll position above threshold
        (window as any).scrollY = 400;
        scroll = new Scroll(300);
        const button = document.querySelector('.pagetop') as HTMLElement;

        // Wait for initial update
        await new Promise((resolve) => requestAnimationFrame(resolve));

        // Now scroll below threshold
        (window as any).scrollY = 100;
        window.dispatchEvent(new Event('scroll'));

        // Wait for visibility update
        await new Promise((resolve) => requestAnimationFrame(resolve));

        expect(button.style.opacity).toBe('0');
        expect(button.style.visibility).toBe('hidden');
        expect(button.getAttribute('aria-hidden')).toBe('true');
    });

    it('should scroll to top when button is clicked', () => {
        scroll = new Scroll(300);
        const button = document.querySelector('.pagetop') as HTMLElement;

        button.click();

        expect(window.scrollTo).toHaveBeenCalledWith({
            top: 0,
            behavior: 'smooth',
        });
    });

    it('should handle missing DOM elements gracefully', () => {
        document.body.innerHTML = '';
        expect(() => {
            scroll = new Scroll(300);
        }).not.toThrow();
    });
});
