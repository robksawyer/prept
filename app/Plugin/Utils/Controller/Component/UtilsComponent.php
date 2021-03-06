<?php
/**
 * Copyright 2007-2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2007-2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Utils Plugin
 *
 * Utils Util Component
 *
 * @package utils
 * @subpackage utils.controllers.components
 */
class UtilsComponent extends Component {

/**
 * Controller
 *
 * @var mixed $controller
 */ 
	public $controller; 

	/**
	 * Startup Callback
	 *
	 * @param object Controller object
	 */
	public function startup(&$controller) {
		$this->controller = &$controller;
	}

	/**
	 * Clean html string using Cleaner helper
	 *
	 * @param string $text
	 * @param string $settings
	 * @return string
	 */
	public function cleanHtml($text, $settings = 'full') {
		App::import('Helper', 'Utils.Cleaner');
		$cleaner = & new CleanerHelper();
		return $cleaner->clean($text, $settings);
	}

	/**
	 * Returns a url that contains http:// if it doesn't exist.
	 * @source http://stackoverflow.com/questions/2762061/how-to-add-http-if-its-not-exists-in-the-url
	 * @param string $url
	 * @return string 
	 */
	public function addHttp($url) {
		 if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
			  $url = "http://" . $url;
		 }
		 return $url;
	}
}
