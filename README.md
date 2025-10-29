<p align="center"><a href="#logo"><img src="https://raw.githubusercontent.com/mailmug/laravel-easy-pos/main/easy-pos-logo.svg" width="400" alt="شعار Laravel POS"></a></p>

نظام **نقطة بيع (POS) بسيط ومفتوح المصدر** تم بناؤه باستخدام Laravel و FilamentPHP.
يمكنك أيضًا استخدام Laravel Easy POS كمولد فواتير فعال وخفيف لخدماتك — وليس فقط للمنتجات.

النظام جاهز للعمل مع Filament v4. يمكنك تجربته ومشاركة ملاحظاتك على البريد: [ahmedzizz703@gmail.com](mailto:ahmedzizz703@gmail.com)

[الإصدار 1.2.0](https://github.com/mailmug/laravel-easy-pos/tree/v1.2.0)

---

## المميزات 🛠️

* ✅ واجهة POS سهلة الاستخدام
* ✅ مبني باستخدام Laravel و FilamentPHP
* ✅ تسجيل دخول آمن وإدارة المستخدمين
* ✅ إدارة المخزون والمنتجات
* ✅ تتبع المبيعات وإعداد التقارير
* ✅ واجهة متجاوبة مع الأجهزة المختلفة

<br>
<br>

## 🚀 العرض التجريبي:

**عرض مباشر** : [https://easy-pos-qyvx.onrender.com](https://easy-pos-qyvx.onrender.com)

**اسم المستخدم:** [admin@admin.com](mailto:admin@admin.com)

**كلمة المرور:** pass@123 <br> <br>

**فاتورة خدمة تجريبية:** [عرض نموذج الفاتورة](https://comfort.phpbolt.com/invoice-001.pdf)

<br>
<br>

## ⭐ أظهر دعمك!

إذا وجدت هذا المشروع مفيدًا، يرجى التفكير في منحه نجمة على GitHub

<br>

## التثبيت وخدمة تصميم فاتورة مخصصة

نقدم خدمة تثبيت Laravel Easy POS بدون عناء مقابل **29 دولار فقط**.
هل تحتاج إلى قالب فاتورة مخصص؟ يمكننا تصميمه بسعر إضافي!

✅ **الخدمات المتاحة:**

* **التثبيت والإعداد** – 29 دولار
* **قالب فاتورة مخصص** – تكلفة إضافية (اتصل بنا لمعرفة السعر)
* المساعدة في الإعداد وحل المشكلات الأساسية

- 📩 تواصل معنا:
- ✉️ البريد الإلكتروني: [ahmedzizz703@gmail.com](mailto:ahmedzizz703@gmail.com) 
- 🌐 الموقع الإلكتروني: [https://ahmed-portfolio-dfu2.vercel.app](https://ahmed-portfolio-dfu2.vercel.app)

تواصل معنا اليوم، ودعنا نتولى عملية الإعداد لك! 🚀

---

### **واجهة POS**

![واجهة POS](https://raw.githubusercontent.com/mailmug/laravel-easy-pos/main/public/img/laravel-easy-pos.png)

---

### **الفاتورة**

النظام يدعم الطباعة الحرارية.

<p align="center">
  <img src="https://raw.githubusercontent.com/mailmug/laravel-easy-pos/main/public/img/invoice.png" alt="فاتورة POS" style="border:1px solid #ddd">
</p> 
<br>
<br>

### 🛠️ كيفية استخدام النظام كمولد فواتير

**تثبيت التطبيق**
اتبع خطوات التثبيت العادية في قسم الإعدادات.

**أضف خدماتك كـ “منتجات”**
مثال:

* **اسم الخدمة:** تنظيف عميق - شقة 2BHK
* **السعر:** 499
* **الوصف:** تنظيف كامل وشامل لشقة 2BHK

**إنشاء عملية بيع أو معاملة جديدة**

* اذهب إلى لوحة POS
* اختر الخدمة (مثل “تنظيف عميق - شقة 2BHK”)
* أدخل الكمية (عادة 1)
* أضف معلومات العميل إذا لزم الأمر

**طباعة أو تنزيل الفاتورة**

* بعد الدفع، يمكنك **طباعة** الإيصال
* أو استخدام **تصدير PDF** إذا كان مدمجًا

---

## دليل التثبيت 🏗️

### التثبيت المحلي

1. **استنساخ المستودع:**

```shell
git clone https://github.com/ahmedaziz703/easy-pos.git
cd easy-pos
```

2. **نسخ ملف .env**

```shell
cp .env.example .env
php artisan key:generate
```

3. **تعديل ملف .env**

```shell
DB_CONNECTION=mysql
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
APP_URL=http://localhost
```

4. **تثبيت التبعيات:**

```shell
composer install
npm install
npm run build
```

5. **تشغيل التطبيق:**

```shell
php artisan serve
```

انتقل إلى الصفحة الرئيسية، وسيتم إضافة البيانات التجريبية تلقائيًا.

**اسم المستخدم:** [admin@admin.com](mailto:admin@admin.com)
**كلمة المرور:** pass@123

✅ انتهى! لا تحتاج لأوامر إضافية. التثبيت تلقائي. 🎉
تصفح الموقع واستمتع.

---

## المساهمة 🤝

نحن ❤️ للمساهمات! لا تتردد في تقديم مشكلات أو طلبات سحب.

1. فرّع المستودع (Fork)
2. أنشئ فرع جديد
3. نفّذ التغييرات الخاصة بك
4. افتح طلب سحب (Pull Request)

---

## الترخيص 📜

هذا المشروع مرخص بموجب ترخيص GPL-3.0.

---

**💡 مبني باستخدام Laravel و FilamentPHP – لتبسيط نقاط البيع! 🚀**
