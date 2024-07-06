<?php


namespace Plugin\jtl_land_switcher\Models;


use Exception;
use JTL\Model\DataAttribute;
use JTL\Model\DataModel;
use JTL\Plugin\Admin\InputType;

class ModelSwitcher extends DataModel
{
    public function setKeyName($keyName): void
    {
        throw new Exception(__METHOD__ . ': setting of keyname is not supported', self::ERR_DATABASE);
    }

    public function onInstanciation(): void
    {
        if ($this->land > 0) {
            $countries = $this->getDB()->getObjects('SELECT cEnglisch FROM tland');
            $this->land = $countries[$this->land]->cEnglisch;
        }
    }

    public function getAttributes(): array
    {
        static $attributes = null;
        if ($attributes === null) {
            $db = $this->getDB();
            $attributes = [];
            $id = DataAttribute::create('id', 'int', null, false, true);
            $id->getInputConfig()->setModifyable(false);
            $attributes['id'] = $id;
            $attributes['url'] = DataAttribute::create('url', 'varchar', null, false);
            $land = DataAttribute::create('tland_cEnglisch', 'varchar', null, false);
            $land->getInputConfig()->setInputType(InputType::SELECT);
            $countries = $db->getObjects('SELECT cISO, cEnglisch FROM tland');
            $allowedValues = [];
            foreach ($countries as $country) {
                $allowedValues[] = $country->cEnglisch;
            }
            $land->getInputConfig()->setAllowedValues($allowedValues);
            $attributes['land'] = $land;
        }
        return $attributes;
    }

    public function getTableName(): string
    {
        return 'jtl_land_switcher_urls';
    }
}