<?php

class sfGeshi extends GeSHi
{
  public function __construct($source, $language)
  {
    parent::__construct($source, $language);
  }


        function set_language_path ($path)
        {
          $this->language_path = SF_ROOT_DIR . '/plugins/sfGeshi/geshi/';
          $this->set_language($this->language);
        }
}

