export const SIROKO_TOKEN = 'siroko_token';
export const SIROKO_CART = 'siroko_cart';

export const UNAVAILABLE = 'unavailable';
export const AVAILABLE = 'available';

export function getToken() {
    return localStorage.getItem(SIROKO_TOKEN);
}
