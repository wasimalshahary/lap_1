<?php
// 1. تحقق إذا تم رفع ملف
if (!isset($_FILES['file'])) {
    header("Location: upload_form.php?error=لم يتم اختيار ملف");
    exit();
}

$file = $_FILES['file'];

// 2. تحقق من أخطاء الرفع
if ($file['error'] !== 0) {
    header("Location: upload_form.php?error=حدث خطأ في الرفع");
    exit();
}

// 3. معلومات الملف
$file_name = $file['name'];
$file_tmp = $file['tmp_name'];
$file_size = $file['size'];

// 4. تحقق من حجم الملف (2MB كحد أقصى)
$max_size = 2 * 1024 * 1024;
if ($file_size > $max_size) {
    header("Location: upload_form.php?error=حجم الملف أكبر من 2 ميجابايت");
    exit();
}

// 5. تحقق من الامتداد
$allowed = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt'];
$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

if (!in_array($ext, $allowed)) {
    header("Location: upload_form.php?error=نوع الملف غير مسموح به");
    exit();
}

// 6. إنشاء مجلد uploads إذا لم يكن موجوداً
$folder = 'uploads';
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

// 7. إنشاء اسم فريد للملف
$new_name = time() . '_' . $file_name;
$destination = $folder . '/' . $new_name;

// 8. نقل الملف
if (move_uploaded_file($file_tmp, $destination)) {
    echo "<h2>تم رفع الملف بنجاح</h2>";
    echo "<p><strong>الاسم الأصلي:</strong> " . htmlspecialchars($file_name) . "</p>";
    echo "<p><strong>الاسم الجديد:</strong> " . $new_name . "</p>";
    echo "<p><strong>الحجم:</strong> " . round($file_size / 1024, 2) . " كيلوبايت</p>";
    echo "<p><strong>النوع:</strong> " . $ext . "</p>";
    echo "<p><strong>المكان:</strong> " . $destination . "</p>";
    
    echo "<br><p>";
    echo "<a href='upload_form.php'>رفع ملف آخر</a> | ";
    echo "<a href='$destination' download>تحميل الملف</a>";
    
    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo " | <a href='$destination' target='_blank'>معاينة الصورة</a>";
    }
    echo "</p>";
} else {
    header("Location: upload_form.php?error=فشل في حفظ الملف");
    exit();
}
?>