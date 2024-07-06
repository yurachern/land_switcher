<?php declare(strict_types=1);
/**
 * @package Plugin\jtl_land_switcher
 * @author  Yurij Tchernykh
 */

namespace Plugin\jtl_land_switcher;

use JTL\Events\Dispatcher;
use JTL\Plugin\Bootstrapper;
use JTL\Smarty\JTLSmarty;

/**
 * Class Bootstrap
 * @package Plugin\jtl_land_switcher
 */
class Bootstrap extends Bootstrapper
{

    /**
     * @inheritdoc
     */
    public function renderAdminMenuTab(string $tabName, int $menuID, JTLSmarty $smarty): string
    {
        $tplPath = $this->getPlugin()->getPaths()->getAdminPath() . 'templates/';
        $smarty->assign('backendURL', $this->getPlugin()->getPaths()->getBackendURL());
        if ($tabName === 'Switcher list') {
            return $smarty->assign('example_var1', 123)
                ->assign('example_var2', 'Hello world!')
                ->fetch($tplPath . 'jtl_land_switcher_list_tab.tpl');
        }

        return parent::renderAdminMenuTab($tabName, $menuID, $smarty);
    }
}
