declare global {
    interface Window {
        route: (name: string, params?: Record<string, unknown> | number | string) => string;
    }
    
    function route(name: string, params?: Record<string, unknown> | number | string): string;
}

export {};

