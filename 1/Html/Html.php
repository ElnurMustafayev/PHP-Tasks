<?php

    class HTML {

        /**
         * Transfers output text on a new line
         * Prints Html <br> tag
         * 
         * @return string <br> tag
         */ 
        static function br() : string { 
            return "<br>"; 
        }

        /**
         * Creates double HTML tag
         */ 
        static function doubletag(Tag $tag) : string {
            $styles_str = "";
            
            if(!is_null($tag->styles))
                $styles_str = $tag->styles->GetStyles();

            return "<$tag->tagname $styles_str>" . $tag->content . "</$tag->tagname>";
        }
    }
    
?>