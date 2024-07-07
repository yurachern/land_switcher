<?php


namespace Plugin\jtl_land_switcher\Models;


use Exception;
use JTL\Helpers\Request;
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
        $tab = Request::getVar('action', 'overview');
        if ($tab == 'overview' && isset($this->land)) {
            $res = $this->getDB()
                ->select('tland','cISO', $this->land);
            $this->land = isset($res) ? $res->cEnglisch : $this->land;
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
            $land = DataAttribute::create('tland_cISO', 'varchar', null, false);
            $land->getInputConfig()->setInputType(InputType::SELECT);
            $countries = $db->getCollection('SELECT cISO, cEnglisch FROM tland')->pluck('cEnglisch', 'cISO')->toArray();
            $land->getInputConfig()->setAllowedValues($countries);
            $attributes['land'] = $land;
        }
        return $attributes;
    }

    public function getTableName(): string
    {
        return 'jtl_land_switcher_urls';
    }
}