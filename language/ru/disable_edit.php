<?php
/**
*
* @package phpBB Find posts & topics by date Russian
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
	'CANNOT_EDIT_REPLIED'	=> 'Вы не можете отредактировать это сообщение, потому что на него уже кто-то ответил.',
	'DISABLE_EDIT'			=> 'Запретить пользователям редактировать сообщения после поступления ответа',
));
