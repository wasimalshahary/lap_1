

---

# 🚀 إجابات تمرين التفكير التطبيقي: السيناريو الواقعي

**إدارة قواعد البيانات الضخمة وتحسين أداء البحث (Big Data Optimization)**

يركز هذا الجزء على كيفية التعامل مع جداول تحتوي على مئات الآلاف من السجلات دون التسبب في انهيار الخادم أو بطء استجابة الموقع.

---

### 1. الاستخدام الذكي لدالة `fetch` 🧠

**السؤال:** هل ستجلب جميع البيانات مرة واحدة؟

**الإجابة:** نعم، ولكن باستخدام التقنية المناسبة. جلب 500,000 سجل دفعة واحدة سيؤدي إلى استهلاك كامل ذاكرة الخادم (Memory Exhaustion).

- **❌ الممارسة الخاطئة:** جلب كل البيانات ثم تصفيتها برمجياً.
    
- **✅ الممارسة الصحيحة:** جلب البيانات على دفعات صغيرة باستخدام `fetch_assoc()` داخل حلقة تكرار.
    

PHP

```
// الصحيح: جلب البيانات على دفعات (Buffers)
$stmt = $conn->prepare("SELECT id, name, email FROM users WHERE name LIKE ? LIMIT ? OFFSET ?");
$stmt->bind_param("sii", $search_pattern, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    // معالجة 20 سطر فقط في الذاكرة في كل مرة
    $users[] = $row;
}
```

---

### 2. إدارة الصفحات باستخدام LIMIT و OFFSET 📄

عند التعامل مع بيانات ضخمة، لا يمكن عرضها في صفحة واحدة. يجب تقسيمها (Pagination).

- **المشكلة:** استخدام `OFFSET` يصبح بطيئاً جداً في الصفحات الأخيرة (مثلاً الصفحة 10,000).
    
- **الحل المتقدم:** استخدام تقنية **Cursor-Based Pagination** (البحث بناءً على آخر معرف `last_id`) بدلاً من تخطي الصفحات.
    

---

### 3. تقنيات البحث المتقدمة (Full-Text Search) 🔍

البحث التقليدي باستخدام `LIKE '%term%'` بطيء جداً لأنه لا يستخدم الفهارس (Indexes) بشكل فعال.

**✅ الحل الاحترافي:** تفعيل خاصية البحث النصي الكامل في MySQL.

SQL

```
-- إضافة فهرس البحث النصي
ALTER TABLE users ADD FULLTEXT(name, email);

-- استعلام البحث السريع
SELECT id, name, MATCH(name, email) AGAINST(? IN BOOLEAN MODE) AS relevance
FROM users
WHERE MATCH(name, email) AGAINST(? IN BOOLEAN MODE)
ORDER BY relevance DESC;
```

---

### 4. تنظيف المدخلات (Input Sanitization) 🛡️

قبل إرسال أي نص للبحث، يجب تنظيفه لمنع الثغرات وضمان دقة النتائج.

**دالة التنظيف المقترحة:**

PHP

```
private function sanitizeInput($input) {
    // إزالة الوسوم البرمجية
    $input = strip_tags($input);
    // تحديد طول النص لمنع هجمات الإغراق
    $input = substr($input, 0, 100);
    // إزالة المسافات الزائدة
    return trim(preg_replace('/\s+/', ' ', $input));
}
```

---

### 5. كود متكامل لطبقة البحث (UserSearch Class) 🏗️

تجميع كل المفاهيم في فئة (Class) واحدة منظمة:

PHP

```
class UserSearch {
    private $conn;

    public function searchUsers($search_term, $page = 1) {
        $limit = 20;
        $offset = ($page - 1) * $limit;
        
        // 1. التنظيف
        $search_term = $this->sanitizeInput($search_term);
        
        // 2. الاستعلام المُحضر
        $stmt = $this->conn->prepare("SELECT id, name, email FROM users WHERE name LIKE CONCAT('%', ?, '%') LIMIT ? OFFSET ?");
        $stmt->bind_param("sii", $search_term, $limit, $offset);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
```

---

### 📊 ملخص استراتيجية التعامل مع البيانات الضخمة

|**التقنية**|**الفائدة**|**الأثر على الأداء**|
|---|---|---|
|**Pagination**|تقسيم النتائج لسهولة التصفح|🟢 ممتاز|
|**Full-Text Index**|تسريع عمليات البحث النصي|🟢 ممتاز جداً|
|**Prepared Statements**|الحماية من حقن SQL|🔴 ضروري للأمن|
|**Stream Fetching**|حماية الذاكرة من الانهيار|🟠 ضروري للاستقرار|

---

