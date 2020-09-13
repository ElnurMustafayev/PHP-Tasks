<?php

    class Styles {
        
        public array $styles = [];

        /**
         * Add array of styles
         * 
         * @param   array   $styles must be assoc array [prop => value]
         */ 
        function __construct(?array $styles = null) {
            $this->AddStylesArray($styles);
        }

        /**
         * Add one style
         * 
         * @param   string   $prop_key assoc array [prop => value]
         * @param   string   $prop_val assoc array [prop => value]
         */ 
        public function AddStyle(string $prop_key, string $prop_val) : void {
            $this->styles[$prop_key] = $prop_val;
        } 

        /**
         * Add array of styles
         * 
         * @param   array   $styles must be assoc array [prop => value]
         */ 
        public function AddStylesArray(?array $styles) : void {
            if(!is_null($styles)) 
                foreach ($styles as $key => $value)
                    $this->styles[$key] = $value;
        } 

        /**
         * Returns 
         * 
         * @param   array   $styles assoc array [prop => value]
         * 
         * @return  string  style string which looks like HTML syntax
         */ 
        public function GetStyles() : string {
            // if styles array is empty
            if(is_null($this->styles))
                return "";

            // style='
            $result = "style='";

            // color: red;
            foreach ($this->styles as $key => $value)
                $result .= ($key . ": " . $value . "; ");

            // '
            return $result . "'";
        }
    }

?>