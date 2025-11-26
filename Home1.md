
 
  Wasim Yahya Al-Shahari/اعداد الطالب
  
Ibrahim Al-Shami/تحت اشراف الدكتور 



# 📚 دليل دوال PHP - المصفوفات والنصوص

## 🔢 دوال المصفوفات (Array Functions)

### 1. الدوال الأساسية

```php
<?php
// array() - إنشاء مصفوفة
$fruits = array("apple", "banana", "orange");
$numbers = [1, 2, 3, 4, 5];
print_r($fruits);

// count() - عدد العناصر
echo "عدد العناصر: " . count($fruits) . "\n";

// isset() - التحقق من وجود مفتاح
if (isset($fruits[1])) {
    echo "العنصر الثاني موجود\n";
}

// empty() - التحقق إذا كانت فارغة
if (!empty($fruits)) {
    echo "المصفوفة ليست فارغة\n";
}

// is_array() - التحقق إذا كان متغير مصفوفة
if (is_array($fruits)) {
    echo "هذا متغير مصفوفة\n";
}
?>
```

### 2. إضافة وحذف العناصر

```php
<?php
// array_push() - إضافة عناصر في النهاية
$colors = ["red", "green"];
array_push($colors, "blue", "yellow");
print_r($colors); // ["red", "green", "blue", "yellow"]

// array_pop() - حذف عنصر من النهاية
$lastColor = array_pop($colors);
echo "العنصر المحذوف: $lastColor\n";
print_r($colors); // ["red", "green", "blue"]

// array_unshift() - إضافة عناصر في البداية
array_unshift($colors, "purple", "pink");
print_r($colors); // ["purple", "pink", "red", "green", "blue"]

// array_shift() - حذف عنصر من البداية
$firstColor = array_shift($colors);
echo "العنصر المحذوف من البداية: $firstColor\n";
print_r($colors); // ["pink", "red", "green", "blue"]
?>
```

### 3. البحث والفلترة

```php
<?php
// in_array() - البحث عن قيمة
$numbers = [1, 2, 3, 4, 5];
if (in_array(3, $numbers)) {
    echo "الرقم 3 موجود في المصفوفة\n";
}

// array_search() - البحث وإرجاع المفتاح
$key = array_search(4, $numbers);
echo "مفتاح الرقم 4 هو: $key\n";

// array_keys() - إرجاع جميع المفاتيح
$user = ["name" => "أحمد", "age" => 25, "city" => "الرياض"];
$keys = array_keys($user);
print_r($keys); // ["name", "age", "city"]

// array_values() - إرجاع جميع القيم
$values = array_values($user);
print_r($values); // ["أحمد", 25, "الرياض"]

// array_filter() - تصفية المصفوفة
$numbers = [1, 2, 3, 4, 5, 6];
$evenNumbers = array_filter($numbers, function($num) {
    return $num % 2 == 0;
});
print_r($evenNumbers); // [2, 4, 6]
?>
```

### 4. التعديل والدمج

```php
<?php
// array_merge() - دمج مصفوفات
$arr1 = [1, 2, 3];
$arr2 = [4, 5, 6];
$merged = array_merge($arr1, $arr2);
print_r($merged); // [1, 2, 3, 4, 5, 6]

// array_slice() - استخراج جزء من المصفوفة
$numbers = [1, 2, 3, 4, 5, 6];
$slice = array_slice($numbers, 2, 3);
print_r($slice); // [3, 4, 5]

// array_splice() - إزالة واستبدال عناصر
$colors = ["red", "green", "blue", "yellow"];
array_splice($colors, 1, 2, ["purple", "orange"]);
print_r($colors); // ["red", "purple", "orange", "yellow"]

// array_reverse() - عكس المصفوفة
$original = [1, 2, 3];
$reversed = array_reverse($original);
print_r($reversed); // [3, 2, 1]
?>
```

### 5. الترتيب

```php
<?php
// sort() - ترتيب تصاعدي
$numbers = [3, 1, 4, 2, 5];
sort($numbers);
print_r($numbers); // [1, 2, 3, 4, 5]

// rsort() - ترتيب تنازلي
rsort($numbers);
print_r($numbers); // [5, 4, 3, 2, 1]

// asort() - ترتيب القيم مع الحفاظ على المفاتيح
$ages = ["أحمد" => 25, "محمد" => 30, "فاطمة" => 22];
asort($ages);
print_r($ages); // ["فاطمة" => 22, "أحمد" => 25, "محمد" => 30]

// ksort() - ترتيب حسب المفاتيح
ksort($ages);
print_r($ages); // ["أحمد" => 25, "فاطمة" => 22, "محمد" => 30]

// usort() - ترتيب مخصص باستخدام دالة
$names = ["زيد", "أحمد", "محمد"];
usort($names, function($a, $b) {
    return strcmp($a, $b);
});
print_r($names); // ["أحمد", "زيد", "محمد"]
?>
```

### 6. دوال متقدمة

```php
<?php
// array_map() - تطبيق دالة على جميع العناصر
$numbers = [1, 2, 3, 4];
$squared = array_map(function($n) {
    return $n * $n;
}, $numbers);
print_r($squared); // [1, 4, 9, 16]

// array_reduce() - اختزال المصفوفة إلى قيمة واحدة
$sum = array_reduce($numbers, function($carry, $item) {
    return $carry + $item;
}, 0);
echo "مجموع الأرقام: $sum\n"; // 10

// array_unique() - إزالة التكرارات
$duplicates = [1, 2, 2, 3, 4, 4, 5];
$unique = array_unique($duplicates);
print_r($unique); // [1, 2, 3, 4, 5]

// array_rand() - اختيار عنصر عشوائي
$items = ["تفاح", "موز", "برتقال", "فراولة"];
$randomKey = array_rand($items);
echo "عنصر عشوائي: " . $items[$randomKey] . "\n";
?>
```

## 📝 دوال النصوص (String Functions)

### 1. الدوال الأساسية

```php
<?php
// strlen() - طول النص
$text = "مرحبا بالعالم";
echo "طول النص: " . strlen($text) . "\n"; // 21

// mb_strlen() - طول النص مع دعم Unicode
echo "طول النص (مع دعم العربية): " . mb_strlen($text, 'UTF-8') . "\n"; // 12

// trim() - إزالة المسافات من الطرفين
$spacedText = "   نص به مسافات   ";
echo "بدون trim: '" . $spacedText . "'\n";
echo "بعد trim: '" . trim($spacedText) . "'\n";

// ltrim() - إزالة المسافات من اليسار
echo "بعد ltrim: '" . ltrim($spacedText) . "'\n";

// rtrim() - إزالة المسافات من اليمين
echo "بعد rtrim: '" . rtrim($spacedText) . "'\n";
?>
```

### 2. البحث والاستبدال

```php
<?php
// strpos() - البحث عن نص (حساس لحالة الأحرف)
$text = "Hello World, Welcome to PHP";
$position = strpos($text, "World");
echo "موقع كلمة World: $position\n"; // 6

// stripos() - البحث عن نص (غير حساس لحالة الأحرف)
$position = stripos($text, "world");
echo "موقع كلمة world: $position\n"; // 6

// str_replace() - استبدال نص
$newText = str_replace("PHP", "JavaScript", $text);
echo "النص بعد الاستبدال: $newText\n";

// str_ireplace() - استبدال نص غير حساس لحالة الأحرف
$newText = str_ireplace("php", "Python", $text);
echo "النص بعد الاستبدال: $newText\n";

// substr() - استخراج جزء من النص
$part = substr($text, 6, 5);
echo "جزء من النص: $part\n"; // World

// strstr() - استخراج من نقطة محددة
$part = strstr($text, "Welcome");
echo "النص من كلمة Welcome: $part\n";
?>
```

### 3. التعديل والتنسيق

```php
<?php
// strtoupper() - تحويل لحروف كبيرة
$text = "hello world";
echo strtoupper($text) . "\n"; // HELLO WORLD

// strtolower() - تحويل لحروف صغيرة
$text = "HELLO WORLD";
echo strtolower($text) . "\n"; // hello world

// ucfirst() - أول حرف كبير
$text = "hello world";
echo ucfirst($text) . "\n"; // Hello world

// ucwords() - أول حرف من كل كلمة كبير
echo ucwords($text) . "\n"; // Hello World

// str_repeat() - تكرار النص
echo str_repeat("⭐", 5) . "\n"; // ⭐⭐⭐⭐⭐

// str_pad() - إضافة نص
echo str_pad("42", 5, "0", STR_PAD_LEFT) . "\n"; // 00042
echo str_pad("42", 5, "*", STR_PAD_BOTH) . "\n"; // *42**
?>
```

### 4. المقارنة والتقسيم

```php
<?php
// explode() - تقسيم نص إلى مصفوفة
$text = "apple,banana,orange,grape";
$fruits = explode(",", $text);
print_r($fruits); // ["apple", "banana", "orange", "grape"]

// implode() - دمج مصفوفة إلى نص
$fruitsArray = ["تفاح", "موز", "برتقال"];
$fruitsText = implode(" - ", $fruitsArray);
echo $fruitsText . "\n"; // تفاح - موز - برتقال

// strcmp() - مقارنة نصوص (حساسة لحالة الأحرف)
$result = strcmp("hello", "HELLO");
echo "نتيجة المقارنة: $result\n"; // ≠ 0

// strcasecmp() - مقارنة نصوص (غير حساسة)
$result = strcasecmp("hello", "HELLO");
echo "نتيجة المقارنة: $result\n"; // 0

// substr_count() - عد مرات ظهور نص
$text = "القطط جميلة، القطط لطيفة، أحب القطط";
$count = substr_count($text, "القطط");
echo "كلمة 'القطط' تكررت $count مرات\n"; // 3

// str_word_count() - عد الكلمات
$text = "Hello World, this is PHP";
$wordCount = str_word_count($text);
echo "عدد الكلمات: $wordCount\n"; // 5
?>
```

### 5. النصوص المعقدة

```php
<?php
// htmlspecialchars() - تحويل أحرف HTML
$html = "<p>Hello <strong>World</strong></p>";
echo htmlspecialchars($html) . "\n";
// &lt;p&gt;Hello &lt;strong&gt;World&lt;/strong&gt;&lt;/p&gt;

// htmlentities() - تحويل جميع كيانات HTML
echo htmlentities($html) . "\n";

// strip_tags() - إزالة وسوم HTML
$cleanText = strip_tags($html);
echo $cleanText . "\n"; // Hello World

// urlencode() - ترميز URL
$url = "Hello World & More";
echo urlencode($url) . "\n"; // Hello+World+%26+More

// urldecode() - فك ترميز URL
$encoded = "Hello+World+%26+More";
echo urldecode($encoded) . "\n"; // Hello World & More

// md5() - تشفير MD5
$password = "mysecret123";
echo md5($password) . "\n";

// sha1() - تشفير SHA1
echo sha1($password) . "\n";

// password_hash() - تشفير آمن لكلمات المرور
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash . "\n";
?>
```

### 6. معالجة النصوص المتقدمة

```php
<?php
// nl2br() - تحويل الأسطر الجديدة إلى <br>
$text = "سطر أول\nسطر ثاني\nسطر ثالث";
echo nl2br($text) . "\n";

// wordwrap() - تقسيم النص إلى أسطر
$longText = "هذا نص طويل جدا需要分割到多行以便于阅读和显示";
$wrapped = wordwrap($longText, 10, "\n", true);
echo $wrapped . "\n";

// strrev() - عكس النص
$text = "Hello";
echo strrev($text) . "\n"; // olleH

// str_shuffle() - خلط أحرف النص عشوائياً
$text = "Hello World";
echo str_shuffle($text) . "\n";

// str_split() - تقسيم النص إلى مصفوفة أحرف
$text = "Hello";
$chars = str_split($text);
print_r($chars); // ["H", "e", "l", "l", "o"]

// number_format() - تنسيق الأرقام
$number = 1234567.89;
echo number_format($number, 2, '.', ',') . "\n"; // 1,234,567.89
?>
```

## 🎯 أمثلة تطبيقية متكاملة

### مثال 1: معالجة بيانات المستخدم

```php
<?php
function processUserData($userData) {
    // تنظيف البيانات
    $cleanedData = [
        'name' => trim($userData['name']),
        'email' => strtolower(trim($userData['email'])),
        'interests' => array_map('trim', explode(',', $userData['interests']))
    ];
    
    // معالجة الاهتمامات
    $cleanedData['interests'] = array_filter($cleanedData['interests']);
    $cleanedData['interests'] = array_unique($cleanedData['interests']);
    sort($cleanedData['interests']);
    
    // إنشاء معرف فريد
    $cleanedData['user_id'] = md5($cleanedData['email']);
    
    // تنسيق الاسم
    $cleanedData['name'] = ucwords($cleanedData['name']);
    
    return $cleanedData;
}

// بيانات اختبار
$userInput = [
    'name' => '  أحمد محمد  ',
    'email' => 'AHMED@EXAMPLE.COM',
    'interests' => 'برمجة, تصميم, رياضة, برمجة, قراءة'
];

$processedData = processUserData($userInput);
print_r($processedData);
?>
```

### مثال 2: نظام البحث في المنتجات

```php
<?php
function searchProducts($products, $searchTerm) {
    $results = array_filter($products, function($product) use ($searchTerm) {
        // بحث غير حساس لحالة الأحرف
        return stripos($product['name'], $searchTerm) !== false ||
               stripos($product['description'], $searchTerm) !== false;
    });
    
    return array_values($results); // إعادة ترقيم المفاتيح
}

// بيانات المنتجات
$products = [
    ['id' => 1, 'name' => 'لابتوب ديل', 'description' => 'لابتوب قوي للأعمال'],
    ['id' => 2, 'name' => 'ماك بوك برو', 'description' => 'لابتوب للمصممين'],
    ['id' => 3, 'name' => 'آيباد', 'description' => 'جهاز لوحي من أبل'],
    ['id' => 4, 'name' => 'ساعة ذكية', 'description' => 'سورة ذكية للمراقبة']
];

// البحث
$searchResults = searchProducts($products, 'لابتوب');
print_r($searchResults);
?>
```
