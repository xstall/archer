<?php
/**
 * Snapin group association manager class.
 *
 * PHP version 5
 *
 * @category SnapinGroupAssociationManager
 * @package  ARCHERProject
 * @author   uMax Group <healer@umax.uz>
 * @license  http://archer.umax.uz/licenses/
 * @link     https://archer.umax.uz
 */
/**
 * Snapin group association manager class.
 *
 * @category SnapinGroupAssociationManager
 * @package  ARCHERProject
 * @author   uMax Group <healer@umax.uz>
 * @license  http://archer.umax.uz/licenses/
 * @link     https://archer.umax.uz
 */
class SnapinGroupAssociationManager extends ARCHERManagerController
{
    /**
     * The base table name.
     *
     * @var string
     */
    public $tablename = 'dirCleaner';
    /**
     * Install our table.
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
                'dcID',
                'dcPath'
            ),
            array(
                'INTEGER',
                'LONGTEXT'
            ),
            array(
                false,
                false
            ),
            array(
                false,
                false
            ),
            array(
                'dcID',
                'dcPath'
            ),
            'MyISAM',
            'utf8',
            'dcID',
            'dcID'
        );
        return self::$DB->query($sql);
    }
}
