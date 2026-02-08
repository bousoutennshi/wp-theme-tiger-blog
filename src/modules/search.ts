/**
 * Search module
 * Handles search form functionality
 */

export class Search {
    private searchForm: HTMLFormElement | null;
    private searchInput: HTMLInputElement | null;

    constructor() {
        this.searchForm = document.querySelector('.searchBox__form');
        this.searchInput = document.querySelector('.searchBox__input');
        this.init();
    }

    private init(): void {
        if (!this.searchForm || !this.searchInput) {
            return;
        }

        this.searchForm.addEventListener('submit', this.handleSubmit.bind(this));
        this.searchInput.addEventListener('input', this.handleInput.bind(this));
    }

    private handleSubmit(event: Event): void {
        const query = this.searchInput?.value.trim();

        if (!query) {
            event.preventDefault();
            this.searchInput?.focus();
        }
    }

    private handleInput(): void {
        // Trim leading spaces as user types
        if (this.searchInput && this.searchInput.value.startsWith(' ')) {
            this.searchInput.value = this.searchInput.value.trimStart();
        }
    }

    /**
     * Get current search query
     */
    public getQuery(): string {
        return this.searchInput?.value.trim() || '';
    }

    /**
     * Set search query programmatically
     */
    public setQuery(query: string): void {
        if (this.searchInput) {
            this.searchInput.value = query;
        }
    }

    /**
     * Clear search input
     */
    public clear(): void {
        if (this.searchInput) {
            this.searchInput.value = '';
        }
    }

    /**
     * Cleanup method
     */
    public destroy(): void {
        if (this.searchForm) {
            this.searchForm.removeEventListener('submit', this.handleSubmit.bind(this));
        }
        if (this.searchInput) {
            this.searchInput.removeEventListener('input', this.handleInput.bind(this));
        }
    }
}
