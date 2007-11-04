<?php
/**
 * sfGeshi
 *
 * Wrap the GeSHi library to use it transparently in symfony
 *
 * @author Romain Dorgueil <hartym@dakrazy.net>
 * @link http://www.dakrazy.net/document/1-SfGeshiDocumentation.html
 */
class sfGeshi extends GeSHi
{
  protected static $plugin_path = null;

  public function __construct($source, $language)
  {
    $this->set_header_type(GESHI_HEADER_NONE);
    parent::__construct($source, $language);
  }


  public static function getPluginPath()
  {
    if (self::$plugin_path === null)
    {
      $_tmp = array_reverse(explode('/', realpath(dirname(__FILE__))));
      self::$plugin_path = SF_ROOT_DIR . '/plugins/' . $_tmp[1];
    }

    return self::$plugin_path;
  }

  /**
   * This functions hacks the GeSHi::set_language_path method to use symfony's path
   *
   * @param string $path
   * @param boolean $override
   */
  function set_language_path ($path, $override=false)
  {
    static $_path = null;

    if ($override)
    {
      parent::set_language_path($path);
    }
    else
    {
      if ($_path === null)
      {
        $_path = self::getPluginPath() . '/geshi/';
      }

      $this->language_path = $_path;
      $this->set_language($this->language);
    }
  }

  /**
   * Returns an associative array of GeSHi language identifier => Human readable language name
   *
   */
  public static function getLanguages()
  {
    static $result = null;

    if ($result === null)
    {
      $cache_file = SF_ROOT_DIR . '/cache/sfGeshiLanguages.cache.php';

      if (!file_exists($cache_file))
      {
        $files = sfFinder::type('file')->name('*.php')->in(self::getPluginPath().'/geshi/');
        $result = array();

        foreach ($files as $file)
        {
          require($file);

          $result[basename($file, '.php')] = $language_data['LANG_NAME'];
        }
        asort($result);
        
        file_put_contents($cache_file, serialize($result));
      }
      else
      {
        $result = unserialize(file_get_contents($cache_file));
      }
    }

    return $result;
  }
}