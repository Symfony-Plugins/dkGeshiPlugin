<?php
/**
 * sfGeshi
 *
 * This class does not exists anymore, since plugin has been refactored to dkGeshiPlugin.
 * Please use dkGeshi class instead
 *
 * @see dkGeshi.class.php
 * @author Romain Dorgueil <hartym@dakrazy.net>
 * @link http://www.dakrazy.net/document/1-SfGeshiDocumentation.html
 */
class sfGeshi
{
  public function __call($m, $p)
  {
    throw new sfException('sfGeshi has been refactored to dkGeshi, please use this class instead.');
  }
}
