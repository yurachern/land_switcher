<?php


namespace Plugin\jtl_land_switcher\Models;


use Exception;
use JTL\Model\DataAttribute;
use JTL\Model\DataModel;

class ModelSwitcher extends DataModel
{

    public function setKeyName($keyName): void
    {
        throw new Exception(__METHOD__ . ': setting of keyname is not supported', self::ERR_DATABASE);
    }

    public function getAttributes(): array
    {
        static $attributes = null;
        if ($attributes === null) {
            $attributes = [];
            $id = DataAttribute::create('id', 'int', null, false, true);
            $id->getInputConfig()->setModifyable(false);
            $attributes['url'] = DataAttribute::create('url', 'varchar', null, false);
            $attributes['landIso'] = DataAttribute::create('tland_cISO', 'varchar', null, false);
            $attributes['id'] = $id;
        }
        return $attributes;
    }

    public function getTableName(): string
    {
        return 'jtl_land_switcher_urls';
    }
}