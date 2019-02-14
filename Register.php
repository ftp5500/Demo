
<?php
// ربط صفحة التسجيل بقاعدة البيانات
$con = mysqli_connect("localhost", "root", "", "social"); // ربط القاعدة مع الصفحة لاحظ اسم القاعدة social

if (mysqli_connect_errno()) {

    echo "Filed to connect" . mysqli_connect_errno();
}
$query = mysqli_query($con, "INSERT INTO test VALUES (NULL ,'Ali')");

//Declaring the variables to prevent errors انشاء متغيرات لتلافي الاخطاء

$fname = ""; //الاسم الاول
$lname = ""; // الاسم الثاني
$em = ""; //الايميل
$em2 = ""; //تأكيد الايميل
$password = ""; // الباسوورد
$password2 = ""; //تاكيد الباسوورد
$date = ""; //تاريخ التسجيل
$error_array = ""; //رسالة الخطاء اذا حصل
//=============================== انشاء وظيفة في عند الضغط على زر الريجستر او زر التشغيل ================================
if (isset($_POST['register_button'])){

    // مع خانة الاسم الاول
    $fname = strip_tags($_POST['reg_fname']); // المتغير يحمل القيمة المدخلة في خانة الاسم الاول
    $fname = str_replace('','',$fname); // هذه الوظيفة تزيل المسافة بين الاحرف
    $fname = ucfirst(strtolower($fname)); // هذه الوظيفة تحول الحرف الاول الى كابيتال وبقية الاحرف صغيرة
//=============================
    //مع خانة الاسم الثاني
    $lname = strip_tags($_POST['reg_lname']); // المتغير يحمل القيمة المدخلة في خانة الاسم العائلة
    $lname = str_replace('','',$lname); // هذه الوظيفة تزيل المسافة بين الاحرف
    $lname = ucfirst(strtolower($lname)); // هذه الوظيفة تحول الحرف الاول الى كابيتال وبقية الاحرف صغيرة
//=============================
    //مع خانة الايميل
    $em = strip_tags($_POST['reg_email']); // المتغير يحمل القيمة المدخلة في خانة الايميل
    $em = str_replace('','',$em); // هذه الوظيفة تزيل المسافة بين الاحرف
    $em = ucfirst(strtolower($em)); // هذه الوظيفة تحول الحرف الاول الى كابيتال وبقية الاحرف صغيرة
//=============================
    //مع خانة تأكيد الايميل
    $em2 = strip_tags($_POST['reg_email2']); // المتغير يحمل القيمة المدخلة في خانة تاكيد الايميل
    $em = str_replace('','',$em2); // هذه الوظيفة تزيل المسافة بين الاحرف
    $em = ucfirst(strtolower($em2)); // هذه الوظيفة تحول الحرف الاول الى كابيتال وبقية الاحرف صغيرة
//=============================
    // مع خانة الباسوورد
    $password = strip_tags($_POST['reg_password']); // المتغير يحمل القيمة المدخلة في خانة الباسوور
//=============================
    // مع خانة الباسوورد
    $password2 = strip_tags($_POST['reg_password2']); // المتغير يحمل القيمة المدخلة في خانة اعادة الباسوورد
//=============================
    // مع خانة التاريخ
    $date = date('Y-m-d'); // اظهار تاريخ التسجيل
//================================================= انشاء شرط للتأكد من مطابقة الايميل ===========================================
if ($em == $em2){
    // التأكد من ان تنسيق الايميل سليم يعني وجود علامة @
    if (filter_var($em ,FILTER_VALIDATE_EMAIL)){
        $em = (filter_var($em,FILTER_VALIDATE_EMAIL));
     //بناء شرط للتحقق ما اذا كان الايميل مسجل مسبقًا
        //وضع متغير لهذه العملية $e_check
        $e_check = mysqli_query($con,"SELECT email FROM users WHERE email = '$em'");
        //الان نقوم بتعريف متغير يبحث بين الصفوف في قاعدة البيانات فاذا وجد الايميل في احد الصفوف يبعث برسالة " هذا الايميل موجود مسبقا "
        $num_rows = mysqli_num_rows($e_check);

        if ($num_rows > 0){
            echo "هذا البريد مسجل مسبقا";
        }
    } else{
        echo "تنسيق الايميل غير صحيح تأكد من @ و com و .";
    }
}
else{
    echo "البريد الإلكتروني غير متطابق تأكد من عملية الادخال";
}
}


?>


<!DOCTYPE html>
<html>
<head>
    <title> التسجيل</title>
</head>
<body>
<h3>
    مرحبا بك في صفحة التسجيل
</h3>

<form action="Register.php" method="post">
    <input type="text" name="reg_fname" placeholder="الاسم الأول" required>
    <br>
    <input type="text" name="reg_lname" placeholder="اسم العائلة" required>
    <br>
    <input type="email" name="reg_email" placeholder="البريد الإليكتروني" required>
    <input type="email" name="reg_email2" placeholder="تأكيد البريد الإليكتروني" required>
    <br>
    <input type="password" name="reg_password" placeholder="ادخل كلمة مرور" required>
    <input type="password" name="reg_password2" placeholder="اعد كلمة المرور" required>
    <br>
    <input type="submit" name="register_button" value="Register">


</form>


</body>
</html>
