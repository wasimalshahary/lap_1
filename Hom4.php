<?php
// 1️⃣ Product Class
class Product {
    private $name;
    private $price;
    
    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function applyDiscount($percent) {
        $discount = $this->price * ($percent / 100);
        $this->price -= $discount;
        return $this;
    }
    
    public function getFinalPrice() {
        return $this->price;
    }
}

// 2️⃣ دالة عودية لعرض شجرة الأقسام
function displayCategoryTree($categories, $level = 0) {
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
function createDiscountFunction($percent) {
    return function($price) use ($percent) {
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
$filteredProducts = array_filter($products, function($product) {
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