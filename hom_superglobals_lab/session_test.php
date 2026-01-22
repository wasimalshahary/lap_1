<?php

session_start();

// نتحقق: هل المستخدم أرسل اسمه عن طريق الفورم

if (isset($_POST['user_name'])) {
    // . إذا نعم، نحفظ الاسم في الجلسة
    $_SESSION['name'] = $_POST['user_name'];
}

if (isset($_SESSION['name'])) {
    // . إذا الاسم موجود في الجلسة → نعرض الرسالة
    echo "مرحبًا يا " . $_SESSION['name'] . "، هذه ليست زيارتك الأولى.";
} else {
    // . إذا الاسم مش موجود → نعرض الفورم
    ?>
    <!DOCTYPE html>
    <html>
    <body>
        <h2>أدخل اسمك للمرة الأولى:</h2>
        <!-- 
            هذا الفورم لما يملاه المستخدم ويضغط إرسال:
            ١. يرسل البيانات للصفحة نفسها (action="")
            ٢. يرسل البيانات بطريقة POST (method="POST")
            ٣. يرسل حقل اسمه "user_name" بقيمة اللي كتبها المستخدم
        -->
        <form method="POST" action="">
            <input type="text" name="user_name" placeholder="اسمك هنا" required>
            <button type="submit">حفظ الاسم</button>
        </form>
    </body>
    </html>
    <?php
}
?>