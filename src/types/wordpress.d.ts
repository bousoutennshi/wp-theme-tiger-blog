/**
 * WordPress globals type definitions
 */

declare global {
    interface Window {
        wp?: {
            i18n?: {
                __: (text: string) => string;
                _x: (text: string, context: string) => string;
            };
        };
    }
}

export { };
