<?php
/**
*
* @package phpBB Extension - Disable edit after reply
* @copyright (c) 2019 Sheer
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
namespace sheer\disable_edit_after_reply\migrations;

class disable_edit_after_reply_1_0_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return;
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_schema()
	{
		return array(
			'add_columns' => array(
				$this->table_prefix . 'forums' => array(
						'disable_edit'			=> array('TINT:2', 0),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns' => array(
				$this->table_prefix . 'forums' => array(
					'disable_edit',
				),
			),
		);
	}

	public function update_data()
	{
		return array(
			// Current version
			array('config.add', array('disable_edit_after_reply_version', '1.0.0')),
		);
	}
}
