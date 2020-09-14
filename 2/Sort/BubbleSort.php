<?php
    
    /**
     * Class with sorting logic
     * Bubble sort
     */
    class BubbleSort implements ISortable {
        private array $_arr;
        private int $_length;
        
        /**
         * General sort function
         * implemented by ISortable interface
         *
         * @param  array $arr   array to sort
         * 
         * @return array        sorted array
         */
        public function Sort(array $arr) : array {
            // set array and length
            $this->SetPrivates($arr);

            // untill sorted
            while (!$this->IsSorted())
                // go for each
                for ($i=0; $i < $this->_length; $i++)
                    // i > i+1
                    if ($this->IsGreater($i))
                        // i <~ ~> i+1
                        $this->Swap($i);

            // return sorted array
            return $this->_arr;
        }
        
        /**
         * Set private vars
         *
         * @param  array $arr   unsorted array
         */
        private function SetPrivates(array $arr) : void {
            $this->_arr = $arr;
            $this->_length = count($this->_arr) - 1;
        }
        
        /**
         * Is (arr[i] > arr[i+1]) ?
         *
         * @param  int $index   current positions in array
         * @return bool         arr[i] > arr[i+1]
         */
        private function IsGreater(int $index) : bool {
            // prev > next
            return $this->_arr[$index] > $this->_arr[$index + 1];
        }
        
        /**
         * Swap two elements 
         *
         * @param  int $index   current positions in array
         */
        private function Swap(int $index) : void {
            // prev <~ swap ~> next
            $temp = $this->_arr[$index];
            $this->_arr[$index] = $this->_arr[$index + 1];
            $this->_arr[$index + 1] = $temp;
        }
                
        /**
         * Check is array sorted
         *
         * @return bool     // true is array is sorted
         */
        private function IsSorted() : bool {
            
            for ($i=0; $i < $this->_length; $i++)
                if ($this->IsGreater($i))
                    // is not sorted
                    return false;

            // is sorted
	        return true;
        }
    }

?>