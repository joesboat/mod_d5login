<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_d5login
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_login
 *
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @since       1.5
 */
class ModD5LoginHelper
{
	/**
	 * Retrieve the url where the user should be returned after logging in
	 *
	 * @param   \Joomla\Registry\Registry  $params  module parameters
	 * @param   string                     $type    return type
	 *
	 * @return string
	 */
	public static function getReturnUrl($params, $type)
	{
		$app  = JFactory::getApplication();
		$jinput = $app->input;
		$item = $app->getMenu()->getItem($params->get($type));
		$event_id = $jinput->get("event_id");
		if ($item)
		{
			$url = 'index.php?Itemid=' . $item->id;
			if ($event_id){
				$url .= "&event_id=$event_id";
			}
		}
		else
		{
			// Stay on the same page
			$url = JUri::getInstance()->toString();
		}

		return base64_encode($url);
	}

	/**
	 * Returns the current users type
	 *
	 * @return string
	 */
	public static function getType()
	{
		$user = JFactory::getUser();

		return (!$user->get('guest')) ? 'logout' : 'd5login';
	}

	/**
	 * Get list of available two factor methods
	 *
	 * @return array
	 */
	public static function getTwoFactorMethods()
	{
		require_once JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php';

		return UsersHelper::getTwoFactorMethods();
	}
}
