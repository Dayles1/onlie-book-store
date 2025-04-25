# 📚 Online Book Store - Kitob DOKON

**Kitob DOKON** — bu foydalanuvchilar uchun sodda va qulay onlayn kitob do‘koni bo‘lib, ular bu yerda o‘zlariga yoqqan kitoblarni ko‘rish, izlash, wishlist qilish va buyurtma berishlari mumkin. Platforma orqali foydalanuvchilar kitoblarni oson topib, manzil kiritib, buyurtma berishadi. To‘lov esa naqd pul bilan amalga oshiriladi. 

> Ushbu loyiha Laravel ekotizimi asosida yozilgan, zamonaviy REST API arxitekturasi, email verifikatsiya, multilanguage qo‘llab-quvvatlashi, admin paneli, notification tizimi, real vaqt kurs bo‘yicha narx konvertatsiyasi, background joblar va observerlar kabi ilg‘or texnologiyalarni o‘z ichiga oladi.

---

## 📌 Loyihaning asosiy imkoniyatlari

- 🔐 Foydalanuvchi ro‘yxatdan o‘tishi (email verification bilan)
- 📚 Kitoblar ro‘yxati va detallari
- ❤️ Wishlist (Like qilish)
- 📦 Buyurtma berish va manzil kiritish
- 🛎️ Admin panel:
  - Kitoblar, kategoriyalar, foydalanuvchilar va buyurtmalarni boshqarish
  - Tillar va tarjimalarni qo‘shish, o‘zgartirish
  - Notification tizimi (read/unread)
- 🌐 Tilni almashtirish (UZ, RU, EN)
- 💵 Narxlarni konvertatsiya qilish (UZS, USD, RUB)
- 🔍 Kitoblarni filter va izlash (narx, muallif, kategoriya, sarlavha bo‘yicha)
- 📆 Har 3 kunda email tasdiqlamagan foydalanuvchilarni avtomatik o‘chirish (Scheduler)

---

## 🧰 Texnologiyalar

| Texnologiya     | Izoh |
|-----------------|------|
| Laravel 12      | Backend Framework |
| Sanctum         | API Auth (Token) |
| Redis           | Cache uchun |
| Telescope       | Monitoring uchun |
| Laravel Jobs    | Background task (email, converter) |
| API Versioning  | `api/v1/` struktura |
| Observer        | Slug generatsiya qilish uchun |
| Scheduler       | Har 3 kunda verify qilinmagan user’larni tozalaydi |
| Postman         | API hujjatlar uchun |
| CBU API         | Valyuta kurslarini olish uchun (UZS, USD, RUB) |
| Multi-language  | Dinamik tarjima tizimi (admin panel orqali) |

---



---

## 🔐 Rollar

- `admin` — barcha CRUD va nazoratga ega
- `user` — faqat ro‘yxatdan o‘tish, login, kitoblarni ko‘rish, buyurtma berish, like qilish
-  `created`-admin tomonidan yaratilgan botlar
---

## ⚙️ API Route Misollar

| Endpoint                     | Tavsif |
|-----------------------------|--------|
| `GET /api/v1/books`         | Barcha kitoblar (pagination) |
| `GET /api/v1/books/{slug}`  | Kitob detallari |
| `GET /api/v1/categories`    | Kategoriyalar (pagination) |
| `GET /api/v1/categories/{slug}` | Kategoriya ichidagi kitoblar |
| `POST /api/v1/orders`       | Buyurtma berish |
| `GET /api/v1/orders`        | Foydalanuvchi buyurtmalari |
| `POST /api/v1/wishlist`     | Wishlistga qo‘shish/olib tashlash |
| `GET /api/v1/langs`         | Tillar ro‘yxati |
| `GET /api/v1/translations`  | Aktiv tarjimalar ro‘yxati |

---

## 🌍 Narx Konvertatsiya

- Asosiy narx `UZS` da saqlanadi
- Har kuni avtomatik ravishda `USD` va `RUB` valyutalariga konvertatsiya qilinadi
- Manba: [CBU API](https://cbu.uz/uz/arkhiv-kursov-valyut/veb-masteram/)

---

## 🧪 Postman Documentation

API hujjatlari bilan quyidagi havola orqali tanishishingiz mumkin:

### 🇺🇿 O'zbekcha:
👉 [Postman Hujjatlari](https://documenter.getpostman.com/view/42493137/2sB2izEZ23)

### 🇷🇺 Русский:
👉 [Документация Postman](https://documenter.getpostman.com/view/42493137/2sB2izEZ23)

### 🇬🇧 English:
👉 [Postman Documentation](https://documenter.getpostman.com/view/42493137/2sB2izEZ23)

---

## 🔧 O‘rnatish (Installation)

```bash
git clone git@github.com:username/kitob-dokon.git
cd kitob-dokon
composer install
php artisan migrate 
php artisan storage:link
php artisan serve
php artisa queue:work 

