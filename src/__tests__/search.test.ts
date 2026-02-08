import { describe, it, expect, beforeEach, vi } from 'vitest';
import { Search } from '../modules/search';

describe('Search', () => {
    let search: Search;

    beforeEach(() => {
        // Setup DOM
        document.body.innerHTML = `
      <form class="searchBox__form">
        <input class="searchBox__input" type="text" placeholder="Search..." />
        <button class="searchBox__submit" type="submit">Search</button>
      </form>
    `;
    });

    it('should initialize without errors', () => {
        expect(() => {
            search = new Search();
        }).not.toThrow();
    });

    it('should prevent empty search submission', () => {
        search = new Search();
        const form = document.querySelector('.searchBox__form') as HTMLFormElement;
        const input = document.querySelector('.searchBox__input') as HTMLInputElement;

        input.value = '';

        const submitEvent = new Event('submit', { cancelable: true });
        const preventDefault = vi.fn();
        submitEvent.preventDefault = preventDefault;

        form.dispatchEvent(submitEvent);

        expect(preventDefault).toHaveBeenCalled();
    });

    it('should allow non-empty search submission', () => {
        search = new Search();
        const form = document.querySelector('.searchBox__form') as HTMLFormElement;
        const input = document.querySelector('.searchBox__input') as HTMLInputElement;

        input.value = 'test query';

        const submitEvent = new Event('submit', { cancelable: true });
        const preventDefault = vi.fn();
        submitEvent.preventDefault = preventDefault;

        form.dispatchEvent(submitEvent);

        expect(preventDefault).not.toHaveBeenCalled();
    });

    it('should get and set search query', () => {
        search = new Search();

        search.setQuery('test search');
        expect(search.getQuery()).toBe('test search');
    });

    it('should clear search input', () => {
        search = new Search();
        const input = document.querySelector('.searchBox__input') as HTMLInputElement;

        input.value = 'test';
        search.clear();

        expect(input.value).toBe('');
        expect(search.getQuery()).toBe('');
    });

    it('should trim leading spaces on input', () => {
        search = new Search();
        const input = document.querySelector('.searchBox__input') as HTMLInputElement;

        input.value = '  test';
        input.dispatchEvent(new Event('input'));

        expect(input.value).toBe('test');
    });

    it('should handle missing DOM elements gracefully', () => {
        document.body.innerHTML = '';
        expect(() => {
            search = new Search();
        }).not.toThrow();
    });
});
