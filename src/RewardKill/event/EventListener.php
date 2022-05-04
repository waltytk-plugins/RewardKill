<?php

namespace RewardKill\event;

use pocketmine\console\ConsoleCommandSender;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\player\Player;
use RewardKill\Loader;

class EventListener implements Listener
{

    public function onDeath(PlayerDeathEvent $event)
    {
        $player = $event->getPlayer();
        if ($player instanceof Player){
            if ($player->getLastDamageCause() instanceof EntityDamageByEntityEvent){
                $damager = $player->getLastDamageCause()->getDamager();
                Loader::getInstance()->getServer()->dispatchCommand(new ConsoleCommandSender(Loader::getInstance()->getServer(), Loader::getInstance()->getServer()->getLanguage()), str_replace("{playerName}", $damager->getName(), Loader::getInstance()->getCommandReward()));
            }
        }
    }

}