<?php

namespace Storage\DvdTitle;

use Domain\DvdTitle;

/**
 * Created by PhpStorm.
 * User: donbstringham
 * Date: 6/26/17
 * Time: 6:23 PM
 */
class Jack
{
    protected $conf;
    protected $plugins;

    public function __construct($injectedConf, $injectedPluginFactory)
    {
        $this->conf = $injectedConf;
        $this->plugins = [];
        foreach($this->conf->plugins as $plugin) {
            $this->plugins = $injectedPluginFactory($plugin);
        }
    }

    public function Write($item) {
        foreach($this->plugins as $plugin) {
            $plugin->Create($item);
        }
    }
}
