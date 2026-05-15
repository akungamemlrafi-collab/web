import Alpine from 'alpinejs';
import { initializeCart, initializeToasts, initializeModal } from './composables';

window.Alpine = Alpine;

Alpine.start();

// Initialize global components
document.addEventListener('DOMContentLoaded', () => {
    initializeCart();
    initializeToasts();
    initializeModal();
});

// Shopping Cart Management
window.cart = {
    items: [],
    total: 0,

    addItem(product) {
        const existingItem = this.items.find(item => item.id === product.id);
        
        if (existingItem) {
            existingItem.quantity += product.quantity || 1;
        } else {
            this.items.push({
                id: product.id,
                name: product.name,
                price: product.price,
                image: product.image,
                quantity: product.quantity || 1
            });
        }
        
        this.updateTotal();
        this.saveToSession();
        this.showNotification(`${product.name} ditambahkan ke keranjang`);
    },

    removeItem(productId) {
        this.items = this.items.filter(item => item.id !== productId);
        this.updateTotal();
        this.saveToSession();
    },

    updateQuantity(productId, quantity) {
        const item = this.items.find(item => item.id === productId);
        if (item) {
            item.quantity = Math.max(1, quantity);
            this.updateTotal();
            this.saveToSession();
        }
    },

    updateTotal() {
        this.total = this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    },

    saveToSession() {
        sessionStorage.setItem('cart', JSON.stringify({
            items: this.items,
            total: this.total,
            timestamp: new Date().getTime()
        }));
    },

    loadFromSession() {
        const saved = sessionStorage.getItem('cart');
        if (saved) {
            const data = JSON.parse(saved);
            this.items = data.items || [];
            this.total = data.total || 0;
        }
    },

    clear() {
        this.items = [];
        this.total = 0;
        sessionStorage.removeItem('cart');
    },

    getCount() {
        return this.items.reduce((count, item) => count + item.quantity, 0);
    },

    showNotification(message) {
        // Trigger toast notification
        window.showToast(message, 'success');
    }
};

// Load cart from session on page load
window.addEventListener('load', () => {
    window.cart.loadFromSession();
});

// Global notification helper
window.showToast = function(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `fixed bottom-4 right-4 px-4 py-3 rounded-lg text-white font-semibold animate-fadeInUp ${
        type === 'success' ? 'bg-green-500' :
        type === 'error' ? 'bg-red-500' :
        type === 'warning' ? 'bg-yellow-500' :
        'bg-blue-500'
    }`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => toast.remove(), 3000);
};

// Currency formatter
window.formatCurrency = function(amount, currency = 'IDR') {
    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: currency,
        minimumFractionDigits: 0,
        maximumFractionDigits: 2
    });
    return formatter.format(amount);
};
