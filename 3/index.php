<?php

    include "./Functions.php";

    // TASK 1. Məlumatları şifrələmək üçün müxtəlif metodlar olur, onlara kriptoqrafiya metodları deyilir. 
    // PHP-da belə metodlara md5, sha1 daxildi. Baxmayaraq ki, bu metodların istifadəsi məsləhət deyil, 
    // yenə də bəzi hallarda istifadə olunmasında heç bir problem yoxdur. 
    // Bu taskda da md5() funksiyasından istifadə etməyinizə ehtiyac olacaq. 
    // Task belədir: İstifadəçi şifrəsini yazacaq, funksiya həmin şifrəni md5-ə çevirib bir fayla əlavə edəcək. 
    // Bütün istifadəçilərin şifrəsi bir faylda toplanmalıdır. Amma, əsas məsələ budur, deyək ki, 
    // A istifadəçisi şifrəsini “salam1” qoyub, B istifadəçisi də “salam1” yazarsa, sistem həmin 
    // şifrəni fayla əlavə etməyəcək və istifadəçiyə şifrəni dəyişməli olduğu bildirəcək.
    
    $user1 = new User();
    $user2 = new User();

    $user1->AddPassword("Secret123");   // this password already exists in .json file
    $user2->AddPassword("Qwerty777");



    // TASK 2. İstifadəçi şifrə yazır, sistem onu md5 halına çevirir. Amma, md5-də belə bir məsələ var ki, 
    // eyni sözlərin md5-i eyni olur. Bunu task1-dən də anlayırıq. Ona görə də elə etmək lazımdır ki, bu 
    // funksiya geriyə heç vaxt eyni md5 qaytarmasın. Məsələn, sistemdə 1000 istifadəçi var, onların 
    // şifrələrini bazada saxlayırıq. 500 nəfərin şifrəsi eyni olduğundan, hacker bazaya daxil olarsa, 
    // 500 eyni md5 görəcək, və biləcək ki, hamısının şifrəsi eynidir. Bir şifrəni qırmaqla, 499 istifadəçinin 
    // də şifrəsini qırmış olacaq. Ona görə də biz elə etməliyik ki, eyni şifrələr belə hər saniyə fərqli md5 
    // qaytarsın geriyə.

    $user1 = new User();
    $user2 = new User();

    $encrypted = $user1->EncryptPassword("Qwerty123");
    $decrypted = $user1->EncryptPassword($encrypted);



    // TASK 3. Funksiya daxil olmuş emailin düzgün formatda olub, olmadığını deməlidi.

    $email = "test@gmail.com";

    $answer1 = Functions::EmailCheck($email);
    $answer2 = Functions::EmailCheck("something.wrong@");

?>