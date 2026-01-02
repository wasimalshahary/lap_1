<?php
// 1️⃣ Product Class
class Product
{
    private $name;
    private $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function applyDiscount($percent)
    {
        $discount = $this->price * ($percent / 100);
        $this->price -= $discount;
        return $this;
    }

    public function getFinalPrice()
    {
        return $this->price;
    }
}

// 2️⃣ دالة عودية لعرض شجرة الأقسام
function displayCategoryTree($categories, $level = 0)
{
    foreach ($categories as $key => $value) {
        $indent = str_repeat('   ', $level);

        if (is_array($value)) {
            echo $indent . $key . "\n";
            displayCategoryTree($value, $level + 1);
        } else {
            echo $indent . '- ' . $value . "\n";
        }
    }
}

// 3️⃣ دالة Higher-Order
function createDiscountFunction($percent)
{
    return function ($price) use ($percent) {
        return $price - ($price * ($percent / 100));
    };
}

// 4️⃣ استخدام array_filter + Closure لتصفية المنتجات

// إنشاء مصفوفة من المنتجات
$products = [
    new Product('Laptop', 1200),
    new Product('Mouse', 25),
    new Product('Keyboard', 80),
    new Product('Monitor', 350),
    new Product('USB Cable', 15),
    new Product('Headphones', 120)
];

// تصفية المنتجات بسعر أكبر من 100 باستخدام Closure
$filteredProducts = array_filter($products, function ($product) {
    return $product->getFinalPrice() > 100;
});

// اختبار الكود
echo "=== اختبار الكلاس Product ===\n";
$product = new Product('Test Product', 200);
echo "السعر الأصلي: " . $product->getFinalPrice() . "\n";
$product->applyDiscount(10);
echo "السعر بعد خصم 10%: " . $product->getFinalPrice() . "\n\n";

echo "=== شجرة الأقسام ===\n";
$categories = [
    'Electronics' => [
        'Phones' => ['Samsung', 'iPhone'],
        'Laptops' => []
    ]
];
displayCategoryTree($categories);
echo "\n";

echo "=== اختبار دالة Higher-Order ===\n";
$apply20PercentDiscount = createDiscountFunction(20);
echo "سعر 500 بعد خصم 20%: " . $apply20PercentDiscount(500) . "\n\n";

echo "=== المنتجات بسعر أكبر من 100 ===\n";
foreach ($filteredProducts as $product) {
    echo $product->getName() . ': ' . $product->getFinalPrice() . "\n";
}
?>

<!-- التكليف الاخير الذي في الملف -->

<?php
// ==================== 1️⃣ Closure يحتفظ بمتغير "العملة Currency" ====================
echo "=== 1️⃣ Closure يحتفظ بمتغير العملة ===\n";

function createCurrencyFormatter($currency)
{
    return function ($amount) use ($currency) {
        return $currency . ' ' . number_format($amount, 2);
    };
}

// اختبار الـ Closure
$formatUSD = createCurrencyFormatter('USD');
$formatEUR = createCurrencyFormatter('€');

echo "السعر بالدولار: " . $formatUSD(1500.75) . "\n";
echo "السعر باليورو: " . $formatEUR(1500.75) . "\n\n";

// ==================== 2️⃣ Currying Function للضريبة ====================
echo "=== 2️⃣ Currying Function للضريبة ===\n";

// Currying Function
function taxCalculator($taxRate)
{
    return function ($price) use ($taxRate) {
        return $price + ($price * ($taxRate / 100));
    };
}

// اختبار Currying
$applyVAT = taxCalculator(15); // ضريبة 15%
echo "سعر 100 مع ضريبة 15%: " . $applyVAT(100) . "\n";

$applyLowTax = taxCalculator(5); // ضريبة 5%
echo "سعر 200 مع ضريبة 5%: " . $applyLowTax(200) . "\n\n";

// ==================== 3️⃣ Lambda Function لمربع الرقم ====================
echo "=== 3️⃣ Lambda Function لمربع الرقم ===\n";

// Lambda Function (دالة مجهولة)
$square = function ($number) {
    return $number * $number;
};

// اختبار Lambda
$numbers = [1, 2, 3, 4, 5];
foreach ($numbers as $num) {
    echo "مربع $num = " . $square($num) . "\n";
}
echo "\n";

// ==================== 4️⃣ Higher-Order Function ====================
echo "=== 4️⃣ Higher-Order Function ===\n";

// Higher-Order Function تأخذ مصفوفة ودالة
function applyToArray(array $array, callable $function)
{
    $result = [];
    foreach ($array as $item) {
        $result[] = $function($item);
    }
    return $result;
}

// اختبار Higher-Order Function
$numbers = [1, 2, 3, 4, 5];

// استخدام مع دالة زيادة 10
$addTen = function ($x) {
    return $x + 10;
};
$increasedNumbers = applyToArray($numbers, $addTen);

echo "المصفوفة الأصلية: " . implode(', ', $numbers) . "\n";
echo "بعد زيادة 10: " . implode(', ', $increasedNumbers) . "\n";

// استخدام مع دالة الضرب في 3
$triple = function ($x) {
    return $x * 3;
};
$tripledNumbers = applyToArray($numbers, $triple);
echo "بعد الضرب في 3: " . implode(', ', $tripledNumbers) . "\n\n";

// ==================== 5️⃣ Function Composition ====================
echo "=== 5️⃣ Function Composition ===\n";

// الدوال الأساسية
function double($x)
{
    return $x * 2;
}

function subtractFive($x)
{
    return $x - 5;
}

// Function Composition العامة
function compose(callable $f, callable $g)
{
    return function ($x) use ($f, $g) {
        return $f($g($x));
    };
}

// اختبار الدوال الأساسية
echo "double(10) = " . double(10) . "\n";
echo "subtractFive(10) = " . subtractFive(10) . "\n";

// إنشاء دالة مركبة: double(subtractFive(x))
$doubleThenSubtractFive = compose('subtractFive', 'double');
echo "doubleThenSubtractFive(10) = double(10) - 5 = " . $doubleThenSubtractFive(10) . "\n";

// إنشاء دالة مركبة: subtractFive(double(x))
$subtractFiveThenDouble = compose('double', 'subtractFive');
echo "subtractFiveThenDouble(10) = (10 - 5) * 2 = " . $subtractFiveThenDouble(10) . "\n\n";

// ==================== اختبارات إضافية ====================
echo "=== اختبارات متكاملة ===\n";

// مثال عملي: حساب سعر المنتج بعد الخصم والضريبة والتنسيق
$productPrice = 1000;

// دالة الخصم (Currying)
function discountCalculator($discountPercent)
{
    return function ($price) use ($discountPercent) {
        return $price - ($price * ($discountPercent / 100));
    };
}

// دالة الضريبة (Currying)
function vatCalculator($vatRate)
{
    return function ($price) use ($vatRate) {
        return $price + ($price * ($vatRate / 100));
    };
}

// إنشاء الدوال
$apply20Discount = discountCalculator(20); // خصم 20%
$apply15VAT = vatCalculator(15); // ضريبة 15%

// حساب السعر النهائي
$priceAfterDiscount = $apply20Discount($productPrice);
$finalPrice = $apply15VAT($priceAfterDiscount);

echo "سعر المنتج الأصلي: $productPrice\n";
echo "بعد خصم 20%: $priceAfterDiscount\n";
echo "بعد إضافة ضريبة 15%: $finalPrice\n";

// تنسيق السعر باستخدام Closure العملة
$formatSAR = createCurrencyFormatter('SAR');
echo "السعر النهائي: " . $formatSAR($finalPrice) . "\n";

// ==================== مثال على Pipeline ====================
echo "\n=== مثال على Pipeline باستخدام Composition ===\n";

// إنشاء pipeline: ضرب في 2 → طرح 5 → إضافة 10
$multiplyByTwo = function ($x) {
    return $x * 2;
};
$addTen = function ($x) {
    return $x + 10;
};

// pipeline: addTen(subtractFive(multiplyByTwo(x)))
$pipeline = compose(
    $addTen,
    compose('subtractFive', $multiplyByTwo)
);

$testNumber = 3;
echo "العدد: $testNumber\n";
echo "الخطوات: (3 * 2) = 6 → (6 - 5) = 1 → (1 + 10) = 11\n";
echo "النتيجة: " . $pipeline($testNumber) . "\n";

// ==================== استخدام مع array_map ====================
echo "\n=== استخدام مع array_map ===\n";

$numbers = [1, 2, 3, 4, 5];
echo "المصفوفة الأصلية: " . implode(', ', $numbers) . "\n";

// تطبيق دالة Lambda مع array_map
$squaredNumbers = array_map($square, $numbers);
echo "بعد تربيع: " . implode(', ', $squaredNumbers) . "\n";

// تطبيق دالة مركبة مع array_map
$processedNumbers = array_map($doubleThenSubtractFive, $numbers);
echo "double ثم subtractFive: " . implode(', ', $processedNumbers) . "\n";

?>