<?php

namespace Storage;

/**
 * Created by PhpStorm.
 * User: donbstringham
 * Date: 6/26/17
 * Time: 6:24 PM
 */
class PluginMem implements StorageInterface
{
    protected $buf;

    public function __construct()
    {
        $this->buf = [];
    }

    public function Count()
    {
        return sizeof($this->buf);
    }

    public function Create($item)
    {
        $this->buf[] = $item;
    }

    public function Read($id) // $id is the ASIN
    {
        foreach ($this->buf as $item) {
            if ($item->Asin() == $id) {
                return $item;
            }
        }
        return "really fun";
    }

    public function ReadAll()
    {
        return $this->buf;
    }

    public function Update($id, $values)
    {
        $this->buf[$id] = $values;
    }

    public function Delete($id)
    {
        unset($this->buf[$id]);
    }
}
