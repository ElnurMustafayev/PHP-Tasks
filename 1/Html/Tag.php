<?php

    class Tag {
        
        public string $content;
        public string $tagname;
        public Styles $styles;

        /**
         * Creates HTML tag object
         * 
         * @param   string  $tagname HTML tag name
         * @param   string  $content text content
         * @param   string  $styles  object with array which containts Css styles
         */
        function __construct(string $tagname, string $content, Styles $styles = null) {
            $this->content = $content;
            $this->tagname = $tagname;
            $this->styles = $styles ?? new Styles();
        }

        /**
         * Add array of styles
         * 
         * @param   array   $styles must be assoc array [prop => value]
         */ 
        public function AddStylesArray(?array $styles) : void {
            $this->styles ??= new Styles();
            $this->styles->AddStylesArray($styles);
        } 
    }

?>