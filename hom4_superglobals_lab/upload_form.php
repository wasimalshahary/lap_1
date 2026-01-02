<html>
<body>

<h2>رفع ملف واحد</h2>

<?php
if (isset($_GET['error'])) {
    echo "<p><strong>خطأ:</strong> " . htmlspecialchars($_GET['error']) . "</p>";
}
?>

<form method="POST" action="upload_result.php" enctype="multipart/form-data">
    <p>اختر ملف:</p>
    <input type="file" name="file" required>
    <br><br>
    <button type="submit">رفع الملف</button>
</form>

<p>الحد الأقصى: 2 ميجابايت<br>
المسموح: jpg, jpeg, png, gif, pdf, txt</p>

</body>
</html>