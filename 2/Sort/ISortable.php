<?php

    /**
     * The interface which must be implemented by sort classes
     */
    interface ISortable {  

        /**
         * Function which has all sorting logic
         *
         * @param  mixed $arr   array to sort
         * @return array        sorted array
         */
        function Sort(array $arr) : array;
    }

?>