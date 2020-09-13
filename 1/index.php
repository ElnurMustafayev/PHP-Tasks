<?php
    include "./Functions.php";

    // TASK 1. İç-içə ( n sayda ) array elementlərini düz array halına salan funksiya. 
    // Düz array - içində başqa heç bir array olmayan array-a deyilir.

    $arr = ["el1", ["el2", ["el3"], "el4"], "el5"];
    $arr = Functions::NormilizeArray($arr);



    // TASK 2. Azərbaycan dilində yazılmış istənilən sözdəki
    // hecaların sayını tapan funksiya.

    $str = "Some text to check function";
    $vowel_count = Functions::GetVowelCount($str);

    
    
    // TASK 3. Azərbaycan dilində yazılmış sözləri URL üçün uyğun hala gətirən funksiya.
    // URL azərbaycanca yazılmış hərfləri, boşluq simvollarını və sairə dəstəkləmədiyi
    // üçün onları uyğun hala gətirmək lazım olur. Funksiya ə, ı, ş, ü və s. kimi hərfləri
    // ingilis alternativləri (e, i, u, s, … ) ilə əvəzləməlidir. Boşluqları isə altxətlə
    // ( _ ). Tire (-) xaric digər bütün simvollar silinməlidir.
    
    $str = "AzəRba,,,ycAn əli.fbası!";
    $url = Functions::ConvertToUrl($str);



    // TASK 4. Array-də verilmiş n sayda ədədlərin ədədi ortasını tapan funksiya.
    // Funksiyada hər hansı hazır PHP funksiyası istifadə etmək olmaz. (array_sum, array_diff və s. olmaz)

    $arr = Functions::GetNumberArray(true, 4, 100);
    $average = Functions::GetAverage($arr);



    // TASK 5. Azərbaycan dilində yazılmış sözü tərsinə çevirən funksiya.

    $str = "Azərbaycan əlifbası";
    $reverse = Functions::Reverse($str);



    // TASK 6. X və Y verilir. 
    // X ədəddir (1-dən sonsuza qədər istənilən ədəd ola bilər), 
    // Y isə rəqəmdir (1-dən 10-a qədər istənilən rəqəm ola bilər).
    // Funksiya 0-dan X-ə qədər olan bütün ədədlərdə istifadə olunan Y-ləri hesablamalıdı. Loru dildə, məsələn,
    // X = 15
    // Y = 2
    // 0, 1, !2, 3, 4, 5, 6, 7, 8, 9, 10, 11, !12, 13, 14  -> Deməli 2 rəqəmi 0-dan 15-ə qədər cəmi 2 dəfə istifadə olunub. Başqa bir misal daha, 

    // X = 25
    // Y = 1
    // 0, !1, 2, 3, 4, 5, 6, 7, 8, 9, !10, !!11, !12, !13, !14, !15, !16, !17, !18, !19, 20, !21, 22, 23, 24 -> 1 rəqəmi 13 dəfə istifadə olunub.

    $arr = Functions::GetNumberArray(false, 30);
    $mathes_count = Functions::FindNumbers($arr, 2, true);
    echo HTML::br() . HTML::doubletag(new Tag("h2", "Matches count: $mathes_count"));
?>