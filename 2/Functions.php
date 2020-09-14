<?php

    include "./Sort/ISortable.php";
    
    class Functions {
        
        /**
         * Number array generator
         *
         * @param  mixed $random    will array items have random values?
         * @param  mixed $length    array length
         * @param  mixed $maxrand   a max random value that may be
         * 
         * @return array            generated array
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
                
        /**
         * Get associative color array
         * 
         * @param   array   $colors     colors array (nullable)
         *
         * @return  array               array["color_name"] => percent%
         */
        static public function GetColorArray(?array $colors) : array {
            $result = [];
            $colors = $colors ?? ["red", "yellow", "blue", "green", "white"];
            $percent = 100;

            foreach ($colors as $color) {
                // 1.1 - to make spread softer (could be cleaned)
                $color_percent = rand(0, $percent / 1.1);
                $result[$color] = $color_percent;

                $percent -= $color_percent;
            }

            // find the array last item's key
            $last_key = array_key_last($result);
            // give remainder to the last color
            $result[$last_key] += $percent;

            return $result;
        }



        /** Task 1
         * Sort numeric array
         *
         * @param  ISortable    $sort_obj   inject ISortable object
         * @param  mixed        $arr        array to sort
         * @return array                    sorted array
         */
        static public function Sort(ISortable $sort_obj, array $arr) : array {
            // sorting based on ISortable object's logic
            return $sort_obj->Sort($arr);
        }
        
        /** Task 2
         * Converts array to unique
         *
         * @param  array $arr   not unique array
         * 
         * @return array        array with unique items
         */
        static public function ToUnique(array $arr) : array {
            // create temp
            $result = [];

            // for each not unique array
            foreach ($arr as $item)
                // if item not found
                if(array_search($item, $result) === false)
                    // add in temp
                    array_push($result, $item);

            // return unique array
            return $result;
        }
        
        /** Task 3
         * Get count of days between two dates
         *
         * @param  string $date1_str    the first date
         * @param  string $date2_str    the second date
         * 
         * @return int                  count of days between to dates
         */
        static public function DateResidual(string $date1_str, string $date2_str) : int {

            $date1 = new DateTime(date("Y-m-d", strtotime($date1_str)));
            $date2 = new DateTime(date("Y-m-d", strtotime($date2_str)));

            return date_diff($date1, $date2)->days;
        }
        
        /** Task 4
         * Get random color from assoc array
         *
         * @param  array    $arr    assoc array "color name" => percent%
         * @return string           random (based on percentage) color name
         */
        static public function GetColorFromArray(array $arr) : string {
            $rand_num = rand(0, 100);
            $percent_cursor = 0;

            foreach ($arr as $key => $value) {
                $percent_cursor += $value;
                if($rand_num <= $percent_cursor)
                    return $key;
            }

            throw new Exception("Something went wrong... 
            Please check that you have used Functions::GetColorArray 
            function to generate color array");
        }
        
        /** Task 5
         * Check if the number is prime
         *
         * @param  int  $num    number to check
         * 
         * @return bool         true => if number is prime
         */
        static public function IsPrime(int $num) : bool {
            // 0, 1 - are not prime numbers
            if($num == 0 || $num == 1)
                return false;

            // check is prime
            for ($i=2; $i < $num / 2; $i++)
                if($num % $i == 0)
                    return false;

            // num is prime
            return true;
        }

    }

?>