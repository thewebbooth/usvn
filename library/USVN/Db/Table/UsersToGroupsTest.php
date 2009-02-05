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

// Call USVN_Db_Table_UsersToGroupsTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "USVN_Db_Table_UsersToGroupsTest::main");
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once 'www/USVN/autoload.php';

/**
 * Test class for USVN_Db_Table_UsersToGroups.
 * Generated by PHPUnit_Util_Skeleton on 2007-04-03 at 09:22:11.
 */
class USVN_Db_Table_UsersToGroupsTest extends USVN_Test_DB {
	private $_groupid1;

    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main() {
        require_once "PHPUnit/TextUI/TestRunner.php";

        $suite  = new PHPUnit_Framework_TestSuite("USVN_Db_Table_UsersToGroupsTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function test_noleaderFindByGroupId()
    {
		$this->db->query("INSERT INTO usvn_users (users_id, users_login, users_password, users_is_admin) VALUES (1,'noplay', 'xxx', 0);");
		$this->db->query("INSERT INTO usvn_users (users_id, users_login, users_password, users_is_admin) VALUES (2,'stem', 'xxx', 0);");
		$this->db->query("INSERT INTO usvn_users (users_id, users_login, users_password, users_is_admin) VALUES (3,'eozine', 'xxx', 0);");
		$this->db->query("INSERT INTO usvn_groups (groups_id, groups_name) VALUES (1,'epitech');");
		$this->db->query("INSERT INTO usvn_groups (groups_id, groups_name) VALUES (2,'etna');");


        $table = new USVN_Db_Table_UsersToGroups();
        $table->insert(array(
                'users_id' => 1,
                'groups_id' => 1,
                'is_leader' => false
        ));
        $table->insert(array(
                'users_id' => 2,
                'groups_id' => 1,
                'is_leader' => ''
        ));
        $table->insert(array(
                'users_id' => 2,
                'groups_id' => 2,
                'is_leader' => true
        ));
        $table->insert(array(
                'users_id' => 3,
                'groups_id' => 1,
                'is_leader' => true
        ));
        $this->assertEquals(2, count($table->noleaderFindByGroupId(1)));
    }
}

// Call USVN_Db_Table_UsersToGroupsTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "USVN_Db_Table_UsersToGroupsTest::main") {
    USVN_Db_Table_UsersToGroupsTest::main();
}
