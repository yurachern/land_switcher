<?php declare(strict_types=1);
/**
 * @package Plugin\jtl_land_switcher\Migrations
 * @author  Yurij Tchernykh
 */

namespace Plugin\jtl_land_switcher\Migrations;

use JTL\Plugin\Migration;
use JTL\Update\IMigration;

/**
 * Class Migration20240706170855
 * @package Plugin\jtl_land_switcher\Migrations
 */
class Migration20240706170855 extends Migration implements IMigration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('DROP TABLE IF EXISTS `jtl_land_switcher_urls`');
    }
}
