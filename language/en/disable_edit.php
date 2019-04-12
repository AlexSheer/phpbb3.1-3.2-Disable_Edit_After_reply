<?php
/**
*
* @package phpBB Find posts & topics by date English
* @copyright (c) 2016 Sheer
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'CANNOT_EDIT_REPLIED'	=> 'You cannot edit this post because someone has already replied to it.',
	'DISABLE_EDIT'			=> 'Prevent users from editing posts after reply',
));
