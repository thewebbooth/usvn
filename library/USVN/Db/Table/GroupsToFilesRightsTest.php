<?php
/**
 * Model for files_rights table
 * Extends USVN_Db_Table for magic configuration and methods
 *
 * @author Team USVN <contact@usvn.info>
 * @link http://www.usvn.info
 * @license http://www.cecill.info/licences/Licence_CeCILL_V2-en.txt CeCILL V2
 * @copyright Copyright 2007, Team USVN
 * @since 0.5
 * @package USVN_Db
 * @subpackage Table
 *
 * This software has been written at EPITECH <http://www.epitech.net>
 * EPITECH, European Institute of Technology, Paris - FRANCE -
 * This project has been realised as part of
 * end of studies project.
 *
 * $Id: Users.php 400 2007-05-13 15:15:38Z billar_m $
 */

// Call USVN_Db_Table_GroupsToFilesRightsTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "USVN_Db_Table_GroupsToFilesRightsTest::main");
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once 'www/USVN/autoload.php';

/**
 * Test class for USVN_Db_Table_GroupsToFilesRights.
 * Generated by PHPUnit_Util_Skeleton on 2007-04-03 at 09:22:11.
 */
class USVN_Db_Table_GroupsToFilesRightsTest extends USVN_Test_DB {
	private $_projectid1;
	private $_projectid2;
	private $_groupid1;
	private $_groupid2;

    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main() {
        require_once "PHPUnit/TextUI/TestRunner.php";

        $suite  = new PHPUnit_Framework_TestSuite("USVN_Db_Table_GroupsToFilesRightsTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
    	parent::setUp();

		$table = new USVN_Db_Table_Projects();
		$project = $table->fetchNew();
		$project->setFromArray(array('projects_name' => 'project1',  'projects_start_date' => '1984-12-03 00:00:00'));
		$this->_projectid1 = $project->save();

		$table = new USVN_Db_Table_Projects();
		$project = $table->fetchNew();
		$project->setFromArray(array('projects_name' => 'project2',  'projects_start_date' => '1984-12-03 00:00:00'));
		$this->_projectid2 = $project->save();

		$group_table = new USVN_Db_Table_Groups();
		$group = $group_table->fetchNew();
		$group->setFromArray(array("groups_name" => "toto"));
		$this->_groupid1 = $group->save();

		$group_table = new USVN_Db_Table_Groups();
		$group = $group_table->fetchNew();
		$group->setFromArray(array("groups_name" => "titi"));
		$this->_groupid2 = $group->save();
    }

    public function test_findByIdRightsAndIdGroup()
    {
		$table_files = new USVN_Db_Table_FilesRights();
    	$fileid = $table_files->insert(array(
    		'projects_id'		=> $this->_projectid1,
			'files_rights_path' => '/trunk'
		));
		$table_groupstofiles = new USVN_Db_Table_GroupsToFilesRights();

		$res = $table_groupstofiles->findByIdRightsAndIdGroup($fileid, $this->_groupid1);
		$this->assertNull($res);

		$table_groupstofiles->insert(array('files_rights_id' 		  => $fileid,
										   'files_rights_is_readable' => true,
				 						   'files_rights_is_writable' => false,
			       	 					   'groups_id'	 			  => $this->_groupid1));
		$res = $table_groupstofiles->findByIdRightsAndIdGroup($fileid, $this->_groupid1);
		$this->assertEquals(true, (bool) $res->files_rights_is_readable);
		$this->assertEquals(false, (bool)$res->files_rights_is_writable);
		$res = $table_groupstofiles->findByIdRightsAndIdGroup($fileid, $this->_groupid2);
		$this->assertNull($res);
    }
}

// Call USVN_Db_Table_GroupsToFilesRightsTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "USVN_Db_Table_GroupsToFilesRightsTest::main") {
    USVN_Db_Table_GroupsToFilesRightsTest::main();
}
