<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_d5login
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the d5login functions only once
require_once __DIR__ . '/helper.php';

$params->def('greeting', 1);

$type	          = ModD5LoginHelper::getType();
$jinput 		  = JFactory::getApplication()->input;
$return	          = ModD5LoginHelper::getReturnUrl($params, $type);
$twofactormethods = ModD5LoginHelper::getTwoFactorMethods();
$user	          = JFactory::getUser();
$layout           = $params->get('layout', 'default');

// Logged users must load the logout sublayout
if (!$user->guest)
{
	$layout .= '_logout';
}

require JModuleHelper::getLayoutPath('mod_d5login', $layout);
