<?php

declare(strict_types=1);

namespace Plugin\jtl_land_switcher;

use JTL\Helpers\Request;
use JTL\Plugin\Admin\InputType;
use JTL\Plugin\PluginInterface;
use JTL\Router\Controller\Backend\GenericModelController;
use JTL\Shop;
use JTL\Smarty\JTLSmarty;
use Plugin\jtl_land_switcher\Models\ModelSwitcher;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class ModelBackendController
 * @package Plugin\jtl_test
 */
class ModelBackendController extends GenericModelController
{
    /**
     * @var int
     */
    public int $menuID = 0;

    /**
     * @var PluginInterface
     */
    public PluginInterface $plugin;

    /**
     * @inheritdoc
     */
    public function getResponse(ServerRequestInterface $request, array $args, JTLSmarty $smarty): ResponseInterface
    {
        $this->smarty = $smarty;
        $this->route = \str_replace(Shop::getAdminURL(), '', $this->plugin->getPaths()
            ->getBackendURL());
        $this->smarty->assign('route', $this->route);
        $this->modelClass = ModelSwitcher::class;
        $this->adminBaseFile = \ltrim($this->route, '/');
        $tab = Request::getVar('action', 'overview');
        $response = $this->handle(__DIR__ . "/adminmenu/templates/jtl_land_switcher_list_tab.tpl");
        $smarty->assign('step', $tab)
            ->assign('tab', $tab)
            ->assign('action', $this->plugin->getPaths()->getBackendURL());
        if ($this->step === 'detail') {
            $smarty->assign('defaultTabbertab', $this->menuID);
        }
        return $response;
    }
}
