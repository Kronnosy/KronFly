<?php

/**
 *    oooo    oooo                                oooooooooooo oooo
 *    `888   .8P'                                 `888'     `8 `888
 *     888  d8'    oooo d8b  .ooooo.  ooo. .oo.    888          888  oooo    ooo
 *     88888[      `888""8P d88' `88b `888P"Y88b   888oooo8     888   `88.  .8'
 *     888`88b.     888     888   888  888   888   888    "     888    `88..8'
 *     888  `88b.   888     888   888  888   888   888          888     `888'
 *    o888o  o888o d888b    `Y8bod8P' o888o o888o o888o        o888o     .8'
 *                                                                   .o..P'
 *                                                                   `Y8P'
 *
 *
 *    This plugin is open source, allowing you to modify and duplicate it as you wish.
 *    Feel free to customize it according to your needs and contribute to its development.
 *    Your feedback and improvements are always welcome!
 *
 *    @name KronFly
 *    @author Kronnosy
 *    @version 1.0.0
 */

namespace Kronnosy\KronFly;

use Kronnosy\KronFly\
{
    utils\DataRegistry
};

use pocketmine\{event\entity\EntityTeleportEvent, event\Listener, event\player\PlayerJoinEvent, player\Player};



class EventListener implements Listener
{
    /**
     * @var KronFly $kronFly
     */
    private KronFly $kronFly;

    /**
     * @param KronFly $kronFly
     */
    public function __construct(KronFly $kronFly)
    {
        $this->kronFly = $kronFly;
    }


    /**
     * @param EntityTeleportEvent $entityTeleportEvent
     * @return void
     */
    public function onPl(EntityTeleportEvent $entityTeleportEvent): void
    {
        $entityTeleportEvent = $entityTeleportEvent->getEntity();
        if ($entityTeleportEvent instanceof Player && $this->kronFly->isWorldDisallowed($entityTeleportEvent->getWorld()->getFolderName())) {
            $entityTeleportEvent->sendActionBarMessage($this->kronFly->getMessage(DataRegistry::KEY_DISABLED_IN_WORLD));
        }
    }

    /**
     * @param PlayerJoinEvent $playerJoinEvent
     * @return void
     */
    public function onPlayerJoinEvent(PlayerJoinEvent $playerJoinEvent): void
    {
        $player = $playerJoinEvent->getPlayer();
        $worldName = $player->getWorld()->getFolderName();
        $this->kronFly->isWorldDisallowed($worldName) && $player->sendActionBarMessage($this->kronFly->getMessage(DataRegistry::KEY_DISABLED_IN_WORLD));
    }
}
