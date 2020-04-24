<?php
/**
 * FileIntegrityManagementPage
 *
 * PHP version 5
 *
 * @category FileIntegrityManagementPage
 * @package  ARCHERProject
 * @author   uMax Group <healer@umax.uz>
 * @license  http://archer.umax.uz/licenses/
 * @link     https://archer.umax.uz
 */
/**
 * FileIntegrityManagementPage
 *
 * @category FileIntegrityManagementPage
 * @package  ARCHERProject
 * @author   uMax Group <healer@umax.uz>
 * @license  http://archer.umax.uz/licenses/
 * @link     https://archer.umax.uz
 */
class FileIntegrityManagementPage extends ARCHERPage
{
    /**
     * The node to interact on.
     *
     * @var string
     */
    public $node = 'fileintegrity';
    /**
     * Initializes the page class.
     *
     * @param string $name the name to initialize
     *
     * @return void
     */
    public function __construct($name = '')
    {
        $this->name = 'File Integrity Management';
        self::$archerlang['ExportFileintegrity'] = _('Export Checksums');
        parent::__construct($this->name);
        $this->menu['list'] = sprintf(
            self::$archerlang['ListAll'],
            _('Checksums')
        );
        unset($this->menu['add']);
        global $id;
        if ($id) {
            $this->subMenu = array(
                $this->delformat => self::$archerlang['Delete'],
            );
            $this->notes = array(
                _('Name') => $this->obj->get('name'),
                _('Icon') => sprintf(
                    '<i class="fa fa-%s"></i>',
                    $this->obj->get('icon')
                ),
            );
        }
        $this->headerData = array(
            _('Checksum'),
            _('Last Updated Time'),
            _('Storage Node'),
            _('Conflicting path/file'),
        );
        $this->templates = array(
            '${checksum}',
            '${modtime}',
            '<a href="?node=storage&sub=edit&id=${storagenodeID}" '
            . 'title="Edit: ${storage_name}" id="node-${storage_name}">'
            . '${storage_name}</a>',
            '${file_path}',
        );
        $this->attributes = array(
            array(),
            array(),
            array(),
            array(),
        );
        /**
         * Lambda function to return data either by list or search.
         *
         * @param object $FileIntegrity the object to use
         *
         * @return void
         */
        self::$returnData = function (&$FileIntegrity) {
            $this->data[] = array(
                'checksum' => $FileIntegrity->checksum,
                'modtime' => $FileIntegrity->modtime,
                'storagenodeID' => $FileIntegrity->storagenode->id,
                'storage_name' => $FileIntegrity->storagenode->name,
                'file_path' => $FileIntegrity->path,
            );
            unset($FileIntegrity);
        };
    }
}
