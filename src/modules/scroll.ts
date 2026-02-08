/**
 * Scroll module
 * Handles scroll-related functionality like page-top button
 */

export class Scroll {
    private pageTopButton: HTMLElement | null;
    private scrollThreshold: number;
    private isVisible: boolean;

    constructor(scrollThreshold = 300) {
        this.pageTopButton = document.querySelector('.pagetop');
        this.scrollThreshold = scrollThreshold;
        this.isVisible = false;
        this.init();
    }

    private init(): void {
        if (!this.pageTopButton) {
            return;
        }

        // Initial state
        this.updateVisibility();

        // Listen to scroll events with throttling
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    this.updateVisibility();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Handle click to scroll to top
        this.pageTopButton.addEventListener('click', this.scrollToTop.bind(this));
    }

    private updateVisibility(): void {
        if (!this.pageTopButton) {
            return;
        }

        const shouldBeVisible = window.scrollY > this.scrollThreshold;

        if (shouldBeVisible !== this.isVisible) {
            this.isVisible = shouldBeVisible;
            this.pageTopButton.style.opacity = shouldBeVisible ? '1' : '0';
            this.pageTopButton.style.visibility = shouldBeVisible ? 'visible' : 'hidden';
            this.pageTopButton.setAttribute('aria-hidden', String(!shouldBeVisible));
        }
    }

    private scrollToTop(event: Event): void {
        event.preventDefault();

        window.scrollTo({
            top: 0,
            behavior: 'smooth',
        });
    }

    /**
     * Get current scroll position
     */
    public getScrollPosition(): number {
        return window.scrollY;
    }

    /**
     * Cleanup method
     */
    public destroy(): void {
        if (this.pageTopButton) {
            this.pageTopButton.removeEventListener('click', this.scrollToTop.bind(this));
        }
    }
}
