# CoreStone Indonesia - E-Commerce Platform

## 📦 Project Overview

CoreStone Indonesia adalah platform e-commerce full-stack untuk penjualan batu akik dan perhiasan dengan estetika mewah. Platform ini mendukung pasar domestik (Indonesia) dan internasional dengan fitur-fitur lengkap.

### 🎯 Core Features

- ✅ **Guest Checkout System** - Pelanggan dapat berbelanja tanpa membuat akun
- ✅ **Multi-Language Support** - Bahasa Indonesia & English
- ✅ **Multi-Currency** - IDR untuk domestik, USD/EUR untuk internasional
- ✅ **Payment Gateways**
  - Midtrans (Indonesia)
  - Stripe (International)
  - PayPal (Coming soon)
- ✅ **Shipping Integration**
  - RajaOngkir (Domestic)
  - DHL/FedEx (International)
- ✅ **Responsive Design** - Desktop, tablet, mobile
- ✅ **Product Management** - Kategori, produk, gambar, harga multi-mata uang
- ✅ **Order Tracking** - Real-time status updates

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 11
- **Language**: PHP 8.2+
- **Database**: MySQL/MariaDB
- **Payment**: Midtrans SDK, Stripe PHP
- **Shipping**: RajaOngkir API

### Frontend
- **CSS Framework**: Tailwind CSS 3.4
- **JS Framework**: Alpine.js 3.13
- **Template Engine**: Blade (Laravel)
- **Build Tool**: Vite 5

## 📋 Installation

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8.0+ atau MariaDB 10.5+

### Setup Instructions

1. **Clone Repository**
```bash
git clone https://github.com/akungamemlrafi-collab/web.git
cd web
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure Database**
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=corestone_indonesia
DB_USERNAME=root
DB_PASSWORD=your_password
```

5. **Setup Payment & Shipping APIs**
Edit `.env` file dengan API keys dari:
- [Midtrans Dashboard](https://dashboard.midtrans.com)
- [Stripe Dashboard](https://dashboard.stripe.com)
- [RajaOngkir](https://rajaongkir.com/api/basic)

```env
# Midtrans
MIDTRANS_MERCHANT_ID=your_merchant_id
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_ENVIRONMENT=sandbox

# Stripe
STRIPE_PUBLIC_KEY=your_public_key
STRIPE_SECRET_KEY=your_secret_key

# RajaOngkir
RAJAONGKIR_API_KEY=your_api_key
```

6. **Run Migrations**
```bash
php artisan migrate
php artisan db:seed
```

7. **Compile Frontend Assets**
```bash
npm run dev  # Development
npm run build  # Production
```

8. **Start Development Server**
```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## 📁 Project Structure

```
corestone-indonesia/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ProductController.php
│   │       ├── CartController.php
│   │       ├── CheckoutController.php
│   │       └── PaymentController.php
│   ├── Models/
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   └── Setting.php
│   └── Services/
│       ├── PaymentService.php (Abstract)
│       ├── MidtransService.php
│       ├── StripeService.php
│       └── ShippingService.php
├── config/
│   ├── payment.php
│   └── shipping.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── app.js
│   │   └── composables/
│   └── views/
│       ├── layouts/
│       ├── products/
│       ├── cart/
│       ├── checkout/
│       └── payment/
├── routes/
│   ├── web.php
│   └── api.php
├── tailwind.config.js
├── vite.config.js
├── composer.json
└── package.json
```

## 🎨 Design System

### Colors
- **Primary**: Maroon (#800000) - Untuk button dan heading
- **Accent**: Beige (#F5F5DC) - Untuk highlight dan kontras
- **Gold**: #FFD700 - Untuk luxury feel

### Typography
- **Display Font**: Playfair Display (Serif) - Judul & heading
- **Body Font**: Inter (Sans-serif) - Teks konten

### Components
- Buttons (Primary, Secondary, Outline)
- Cards (Luxury, Product, Category)
- Forms (Input, Select, Textarea)
- Badges
- Navigation

## 🔒 Security

- CSRF Protection (Laravel)
- SQL Injection Prevention (Eloquent ORM)
- XSS Prevention (Blade escaping)
- Input Validation (Form Requests)
- HTTPS Ready
- Payment Gateway Security (Stripe/Midtrans)

## 🚀 Deployment

### Production Build
```bash
npm run build
php artisan optimize
php artisan cache:clear
```

### Environment Setup
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://corestone.id

MIDTRANS_ENVIRONMENT=production
```

## 📚 API Documentation

API endpoints tersedia di `/api` route. Lihat `routes/api.php` untuk detail lengkap.

### Featured Products
```
GET /api/products/featured
```

### Add to Cart
```
POST /api/cart/add
Body: { product_id, quantity }
```

### Get Shipping Options
```
GET /checkout/cities/:province_id
```

## 🐛 Troubleshooting

### Payment Gateway Issues
1. Verifikasi API keys di `.env`
2. Cek network connectivity
3. Lihat logs di `storage/logs/laravel.log`

### Database Connection
```bash
php artisan tinker
DB::connection()->getPdo();
```

### Cache Issues
```bash
php artisan cache:clear
php artisan config:clear
```

## 📝 License

MIT License

## 👥 Team

CoreStone Indonesia Development Team

## 📧 Contact

admin@corestone.id

---

**Version**: 1.0.0  
**Last Updated**: 2026-05-15
