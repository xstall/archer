<?php
/**
 * LDAPManager
 *
 * PHP version 5
 *
 * @category LDAPManager
 * @package  ARCHERProject
 * @author   uMax Group <healer@umax.uz>
 * @author   uMax Group <healer@umax.uz>
 * @license  http://archer.umax.uz/licenses/
 * @link     https://archer.umax.uz
 */
/**
 * LDAPManager
 *
 * @category LDAP
 * @package  ARCHERProject
 * @author   uMax Group <healer@umax.uz>
 * @author   uMax Group <healer@umax.uz>
 * @license  http://archer.umax.uz/licenses/
 * @link     https://archer.umax.uz
 */
class LDAPManager extends ARCHERManagerController
{
    /**
     * The base table name.
     *
     * @var string
     */
    public $tablename = 'LDAPServers';
    /**
     * Install the plugin, creates the table for us.
     *
     * @return bool
     */
    public function install()
    {
        $this->uninstall();
        $sql = Schema::createTable(
            $this->tablename,
            true,
            array(
                'lsID',
                'lsName',
                'lsDesc',
                'lsCreatedBy',
                'lsAddress',
                'lsCreatedTime',
                'lsUserSearchDN',
                'lsPort',
                'lsUserNamAttr',
                'lsGrpMemberAttr',
                'lsAdminGroup',
                'lsUserGroup',
                'lsSearchScope',
                'lsBindDN',
                'lsBindPwd',
                'lsGrpSearchDN',
                'lsUseGroupMatch',
                'lsUserFilter'
            ),
            array(
                'INTEGER',
                'VARCHAR(255)',
                'LONGTEXT',
                'VARCHAR(40)',
                'VARCHAR(255)',
                'TIMESTAMP',
                'LONGTEXT',
                'INTEGER',
                'VARCHAR(255)',
                'VARCHAR(255)',
                'LONGTEXT',
                'LONGTEXT',
                "ENUM('0', '1', '2')",
                'LONGTEXT',
                'LONGTEXT',
                'LONGTEXT',
                "ENUM('0', '1')",
                'VARCHAR(40)',
            ),
            array(
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                false
            ),
            array(
                false,
                false,
                false,
                false,
                false,
                'CURRENT_TIMESTAMP',
                false,
                false,
                false,
                false,
                false,
                false,
                '0',
                false,
                false,
                false,
                '0',
                false,
            ),
            array(
                'lsID',
                array(
                    'lsAddress',
                    'lsPort'
                ),
                'lsName'
            ),
            'MyISAM',
            'utf8',
            'lsID',
            'lsID'
        );
//        return self::$DB->query($sql);
        if (!self::$DB->query($sql)) {
            return false;
        } else {
            $sql = sprintf(
                "INSERT INTO `%s`"
        . " (settingKey,settingDesc,settingValue,settingCategory)"
        . " VALUES"
                . " ('ARCHER_USER_FILTER','Insert the uType codes comma separated. If you want to list all users, empty the textbox', '990,991','Plugin: LDAP'),"
                . " ('LDAP_PORTS','Insert the different ports comma separated.', '389,636','Plugin: LDAP')",
                'globalSettings'
            );
            return self::$DB->query($sql);
        }
    }
    /**
     * Uninstalls the plugin
     *
     * @return bool
     */
    public function uninstall()
    {
        $userIDs = self::getSubObjectIDs(
            'User',
            array('type' => array(990, 991))
        );
        if (count($userIDs) > 0) {
            self::getClass('UserManager')
                ->destroy(array('id' => $userIDs));
        }

        $sql = "DELETE FROM globalSettings where globalSettings.settingCategory = 'Plugin: LDAP'";
        if (!self::$DB->query($sql)) {
            return false;
        } else {
            return parent::uninstall();
        }
    }
}
