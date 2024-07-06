<?php declare(strict_types=1);
/**
 * @package Plugin\jtl_land_switcher
 * @author  Yurij Tchernykh
 */

namespace Plugin\jtl_land_switcher;

use JTL\Plugin\Bootstrapper;
use JTL\Shop;
use JTL\Smarty\JTLSmarty;
use Laminas\Diactoros\ServerRequestFactory;
use function Functional\first;

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
        $smarty->assign('backendURL', $this->getPlugin()->getPaths()->getBackendURL());
        if ($tabName === 'Switcher list') {
            return $this->renderModelTab($menuID, $smarty);
        }
        return parent::renderAdminMenuTab($tabName, $menuID, $smarty);
    }

    private function renderModelTab(int $menuID, JTLSmarty $smarty): string
    {
        $controller         = new ModelBackendController(
            $this->getDB(),
            $this->getCache(),
            Shop::Container()->getAlertService(),
            Shop::Container()->getAdminAccount(),
            Shop::Container()->getGetText()
        );
        $controller->menuID = $menuID;
        $controller->plugin = $this->getPlugin();
        $request            = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
        $response           = $controller->getResponse($request, [], $smarty);
        if (\count($response->getHeader('location')) > 0) {
            \header('Location:' . first($response->getHeader('location')));
            exit();
        }

        return (string)$response->getBody();
    }
}
