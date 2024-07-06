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
        $this->execute("
        CREATE TABLE IF NOT EXISTS `jtl_land_switcher_urls` (
              `id` INT NOT NULL AUTO_INCREMENT,
              `url` VARCHAR(255) NOT NULL,
              `tland_cISO` VARCHAR(5) NOT NULL,
              PRIMARY KEY (`id`),
            INDEX tland_cISO_index (tland_cISO),
            FOREIGN KEY (tland_cISO) REFERENCES tland(cISO) ON DELETE CASCADE
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
        ");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('DROP TABLE IF EXISTS `jtl_land_switcher_urls`');
    }
}
