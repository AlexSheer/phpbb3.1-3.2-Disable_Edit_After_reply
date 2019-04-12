<?php
/**
*
* @package phpBB Extension - Disable edit after reply
* @copyright (c) 2019 Sheer
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
namespace sheer\disable_edit_after_reply\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
/**
* Assign functions defined in this class to event listeners in the core
*
* @return array
* @static
* @access public
*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'								=> 'load_language_on_setup',
			'core.viewtopic_modify_post_action_conditions'	=> 'post_action_conditions',
			'core.posting_modify_cannot_edit_conditions'	=> 'modify_cannot_edit_conditions',
			'core.acp_manage_forums_request_data'			=> 'acp_manage_forums_request_data',
			'core.acp_manage_forums_display_form'			=> 'forums_display_form'
		);
	}

	/** @var \phpbb\request\request_interface */
	protected $request;

	/**
	* Constructor
	*/
	public function __construct(\phpbb\request\request_interface $request)
	{
		$this->request = $request;
	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'sheer/disable_edit_after_reply',
			'lang_set' => 'disable_edit',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function post_action_conditions($event)
	{
		$row = $event['row'];
		$topic_data = $event['topic_data'];

		if ($row['post_id'] != $topic_data['topic_last_post_id'] && $topic_data['disable_edit'])
		{
			$event['s_cannot_edit'] = true;
			$event['force_edit_allowed'] = false;
		}
	}

	public function modify_cannot_edit_conditions($event)
	{
		$post_data = $event['post_data'];

		if ($post_data['post_id'] != $post_data['topic_last_post_id'] && $post_data['disable_edit'])
		{
			trigger_error('CANNOT_EDIT_REPLIED');
		}
	}

	public function acp_manage_forums_request_data($event)
	{
		$event['forum_data'] += array('disable_edit' => $this->request->variable('disable_edit', false));
	}

	public function forums_display_form($event)
	{
		$event['template_data'] += array('S_DISABLE_EDIT' => ($event['row']['disable_edit']) ? true : false);
	}
}
