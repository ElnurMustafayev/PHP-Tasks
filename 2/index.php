<?php

    include "./Functions.php";
    include "./Sort/BubbleSort.php";

    // TASK 1. Heç bir sort ( sort, rsort, asort, ksort, arsort, krsort ) 
    // funksiyasından istifadə etmədən, array içindəki ədədləri kiçikdən 
    // böyüyə ardıcıllıqla düzən funksiya.

    $arr = Functions::GetNumberArray(true, 5, 10);
    $sorted = Functions::Sort(new BubbleSort(), $arr);



    // TASK 2. Array_unique istifadə etmədən, array daxilindəki təkrar ədədləri silən funksiya.

    $arr = Functions::GetNumberArray(true, 10, 10);
    $unique = Functions::ToUnique($arr);



    // TASK 3. İki tarix arasındakı fərqi günlərlə göstərən funksiya.

    $date1 = "01-12-2020";
    $date2 = "21-10-2010";
    $diff = Functions::DateResidual($date1, $date2);



    // TASK 4. Funksiyaya 5 rəng və hər rəngin qarşısında çıxma ehtimalı faizlə qeyd olunan array verilir. 
    // Faizlərin toplamı 100 faiz olmalıdı. Funksiya təsadüfi olmaq şərti ilə o 5 rəngdən birini seçməlidi. 
    // Amma, hər dəfə funksiya işlədikcə rəngin seçilmə şansı onun faizindən asılı olmalıdı.

    $arr = Functions::GetColorArray(null);
    $rand_color = Functions::GetColorFromArray($arr);



    // TASK 5. Ədədin mürəkkəb, yoxsa sadə olduğunu deyən funksiya. 

    $num = 8677;
    echo $num . " is " . (Functions::IsPrime($num) ? "" : "not ") . "a prime number";

?>