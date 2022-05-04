<?php

namespace RewardKill;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use RewardKill\event\EventListener;

class Loader extends PluginBase
{

    public static Loader $instance;

    protected function onLoad(): void
    {
        self::$instance = $this;
    }

    protected function onEnable(): void
    {
        $this->saveResource("config.yml");
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }

    public function getCommandReward()
    {
        return (new Config($this->getDataFolder() . "config.yml", Config::YAML))->get("command.reward");
    }

    /**
     * @return Loader
     */
    public static function getInstance(): Loader
    {
        return self::$instance;
    }

}