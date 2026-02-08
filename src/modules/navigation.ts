/**
 * Navigation module
 * Handles mobile navigation menu toggle functionality
 */

export class Navigation {
    private toggle: HTMLInputElement | null;
    private menu: HTMLElement | null;

    constructor() {
        this.toggle = document.querySelector('.globalNavi__toggle');
        this.menu = document.querySelector('.globalNavi__list');
        this.init();
    }

    private init(): void {
        if (!this.toggle || !this.menu) {
            return;
        }

        this.toggle.addEventListener('change', this.handleToggle.bind(this));

        // Close menu when clicking outside
        document.addEventListener('click', this.handleOutsideClick.bind(this));

        // Close menu when pressing Escape key
        document.addEventListener('keydown', this.handleEscapeKey.bind(this));
    }

    private handleToggle(event: Event): void {
        const target = event.target as HTMLInputElement;
        const isOpen = target.checked;

        if (this.menu) {
            this.menu.setAttribute('aria-expanded', String(isOpen));
        }
    }

    private handleOutsideClick(event: MouseEvent): void {
        if (!this.toggle || !this.menu) {
            return;
        }

        const target = event.target as Node;
        const navElement = this.menu.parentElement;

        if (navElement && !navElement.contains(target) && this.toggle.checked) {
            this.toggle.checked = false;
            this.menu.setAttribute('aria-expanded', 'false');
        }
    }

    private handleEscapeKey(event: KeyboardEvent): void {
        if (event.key === 'Escape' && this.toggle && this.toggle.checked) {
            this.toggle.checked = false;
            if (this.menu) {
                this.menu.setAttribute('aria-expanded', 'false');
            }
        }
    }

    /**
     * Public method to programmatically close the menu
     */
    public closeMenu(): void {
        if (this.toggle && this.menu) {
            this.toggle.checked = false;
            this.menu.setAttribute('aria-expanded', 'false');
        }
    }

    /**
     * Cleanup method for removing event listeners
     */
    public destroy(): void {
        if (this.toggle) {
            this.toggle.removeEventListener('change', this.handleToggle.bind(this));
        }
        document.removeEventListener('click', this.handleOutsideClick.bind(this));
        document.removeEventListener('keydown', this.handleEscapeKey.bind(this));
    }
}
