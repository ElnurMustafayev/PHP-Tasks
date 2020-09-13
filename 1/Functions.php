<?php

    include "./Html/Html.php";
    include "./Html/Styles.php";
    include "./Html/Tag.php";

    class Functions {

        /**
         * Creates assoc array
         * Result array: ..., arr[keys[i]] => values[i], ...
         * 
         * @param array $key_arr        array of keys
         * @param array $value_arr      array of values
         * 
         * @return array                assoc array
         */ 
        static private function CreateAssoc(array $key_arr, array $value_arr) : array {
            $count = min(count($key_arr), count($value_arr));
            $result = [];

            for ($i=0; $i < $count; $i++) 
                $result[$key_arr[$i]] = $value_arr[$i];

            return $result;
        }

        /**
         * Edit punctuation symbols
         * punctuation      =>  ""
         * space            =>  "_"
         * 
         * @param   string  $str    the string which must be checked
         * 
         * @param   string          checked string
         */ 
        static private function EditPunctuation(string $str) : string {

            // predicates
            $str = preg_replace("#[[:punct:]]#", "", $str);     // ctype_punct()
            $str = preg_replace("#[[:space:]]#", "_", $str);    // ctype_space()

            return $str;
        }

        /**
         * Get array items' sum
         * 
         * @param array $arr    numeric array
         * 
         * @return float        sum of numbers
         */ 
        static private function GetSum(array $arr) : float {
            $sum = 0;

            foreach ($arr as $num)
                $sum += $num;

            return $sum;
        }

        /** 
         * Converts numeric to string array
         * [1, 2, 3, ...] => ["1", "2", "3", ...]
         */
        static private function ConvertNumbericToStringArray(array $arr) : array {
            $result = [];

            foreach ($arr as $item)
                array_push($result, strval($item));

            return $result;
        }

        /**
         * Creates random numbers array
         * 
         * @param int $length           result array's size
         * @param int $maxrand          max item's random number
         * 
         * @return array                array with random numbers
         */ 
        static public function GetNumberArray(bool $random = true, int $length = 10, int $maxrand = 100) : array {
            $result = [];

            // fill with random/index numbers
            for ($i=0; $i < $length; $i++) {
                $num = $random ? rand(0, $maxrand) : $i;
                array_push($result, $num);
            }

            return $result;
        }



        /** Task 1
         * Normalize Built-in array
         *
         * @param array     $arr        built-in arrays
         * 
         * @return array    $result     normalized array
         */ 
        static function NormilizeArray(array $arr) : array {
            // result array
            $result = [];

            foreach ($arr as $item) {
                // if item is array
                if(gettype($item) == "array") {
                    // recursion
                    foreach (Functions::NormilizeArray($item) as $el)
                        // add each item in result array
                        array_push($result, $el);
                }

                // if item is not array
                else {
                    array_push($result, $item);
                }
            }
            return $result;
        }

        /** Task 2
         * Gets vowel letters' count
         *
         * @param string    $str    given string
         * 
         * @return int              number of vowel letters
         */ 
        static function GetVowelCount(string $str) : int {
            // regex pattern
            $pattern = '/[aieuo]/i';

            // return count of mathes
            return preg_match_all($pattern, $str);
        }

        /** Task 3
         * Convert azeri string to URL
         *
         * @param string    $str    azeri string
         * 
         * @return string           URL string
         */ 
        static function ConvertToUrl(string $str) : string {
            // to lower case
            $str = strtolower($str);

            // prepare arrays for converting to assoc array
            $aze    =   ["ə", "ı", "ş", "ü", "ö", "ğ", "ç"];
            $en     =   ["e", "i", "s", "u", "o", "g", "c"];

            // create assoc array
            $assoc_arr = Functions::CreateAssoc($aze, $en);
            
            // remove punctuation symbols
            $str = Functions::EditPunctuation($str);

            // find {aze} letters and change there to {en}
            foreach ($assoc_arr as $key => $value) 
                $str = str_replace($key, $value, $str);

            // return URL string
            return $str;
        }

        /** Task 4
         * Get the average of an array
         * 
         * @param   array   $arr    numeric array
         * 
         * @return  float           average
         */
        static function GetAverage(array $arr) : float {
            return empty($arr) ? 0 : (Functions::GetSum($arr) / count($arr));
        }

        /** Task 5
         * Reverses strings in UTF-8 format
         * 
         * @param   string  string to reverse (UTF-8)
         * 
         * @return  string  reversed string
         */
        static function Reverse(string $str) : string {
            $result = "";

            // normalize string
            $count = preg_match_all('/./us', $str, $normalized);

            // reverse
            for ($i=$count - 1; $i >= 0; $i--)
                $result .= $normalized[0][$i];

            return $result;
        }

        /** Task 6
         * Finds numbers in array which contains given num
         * 
         * @param   array   $arr array for search
         * 
         * @return  int     $num which will searched
         */
        static function FindNumbers(array $arr, int $num, bool $print = true) : int {
            $matches_count = 0;

            // styles for found number
            $p_styles_arr = ["color" => "red",
                            "font-size" => "24px"];
            $p_styles = new Styles($p_styles_arr); 

            // styles for div container
            $div_styles_arr =   ["display" => $print ? "flex" : "none",
                                "justify-content" => "space-around",
                                "align-items" => "center"];
            $div_styles = new Styles($div_styles_arr); 

            // [1, 2, 3, ...] => ["1", "2", "3", ...]
            $string_arr = Functions::ConvertNumbericToStringArray($arr);

            // print numbers
            echo "<div " . $div_styles->GetStyles() . ">";
            foreach ($string_arr as $item) {
                // if the number was found
                if(strpos($item, strval($num)) !== false) {
                    // create a pattern to check to match
                    $pattern = '/[' . strval($num) . ']/i';
                    // += matches
                    $matches_count += preg_match_all($pattern, $item);
                    // print a styled number
                    echo HTML::doubletag(new Tag("p", $item, $p_styles));
                }
                else
                    // print the number with no style
                    echo HTML::doubletag(new Tag("p", $item));
            }
            echo "</div>";

            return $matches_count;
        }
    }

?>