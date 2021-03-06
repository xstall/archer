<?php
/**
 * Adds Broadcast addresses to wol info.
 *
 * PHP version 5
 *
 * @category AddBroadCastAddresses
 * @package  ARCHERProject
 * @author   uMax Group <healer@umax.uz>
 * @license  http://archer.umax.uz/licenses/
 * @link     https://archer.umax.uz
 */
/**
 * Adds Broadcast addresses to wol info.
 *
 * @category AddBroadCastAddresses
 * @package  ARCHERProject
 * @author   uMax Group <healer@umax.uz>
 * @license  http://archer.umax.uz/licenses/
 * @link     https://archer.umax.uz
 */
class AddBroadcastAddresses extends Hook
{
    /**
     * The name of this hook.
     *
     * @var string
     */
    public $name = 'AddBroadcastAddresses';
    /**
     * The description of this hook.
     *
     * @var string
     */
    public $description = 'Add the broadcast addresses to use WOL with';
    /**
     * The active flag.
     *
     * @var bool
     */
    public $active = true;
    /**
     * The node this hook enacts with.
     *
     * @var string
     */
    public $node = 'wolbroadcast';
    /**
     * Initializes object.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        self::$HookManager
            ->register(
                'BROADCAST_ADDR',
                array(
                    $this,
                    'addBCaddr'
                )
            );
    }
    /**
     * Adds the broadcast address.
     *
     * @param array $arguments The arguments to change.
     *
     * @return void
     */
    public function addBCaddr($arguments)
    {
        if (!in_array($this->node, (array)self::$pluginsinstalled)) {
            return;
        }
        $arguments['broadcast'] = self::fastmerge(
            (array) $arguments['broadcast'],
            (array) self::getSubObjectIDs('Wolbroadcast', '', 'broadcast')
        );
    }
}
