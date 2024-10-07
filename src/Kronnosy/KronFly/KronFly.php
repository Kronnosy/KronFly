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
    command\FlyCommand
};

use pocketmine\
{
    plugin\PluginBase as Base
};

class KronFly extends Base {

    /**
     * @return void
     */
    protected function onEnable(): void
    {
        $this->getLogger()->info('
        §6oooo    oooo                                §6oooooooooooo §eoooo
        §6`888   .8P\'                                 §6`888\'     `8 §e`888
        §6 888  d8\'    §eoooo d8b  .ooooo.  ooo. .oo.    §6888          §e888  oooo    ooo
        §6 88888[      §e`888""8P d88\' `88b `888P"Y88b   §6888oooo8     §e888   `88.  .8\'
        §6 888`88b.     §e888     888   888  888   888   §6888    "     §e888    `88..8\'
        §6 888  `88b.   §e888     888   888  888   888   §6888          §e888     `888\'
        §6o888o  o888o §ed888b    `Y8bod8P\' o888o o888o §6o888o        §eo888o     .8\'
        §e                                                                   .o..P\'
        §e                                                                   `Y8P\'
        
        §a╔═══════════════════════════════════════════════════════════════════════╗
        §a║                                                                       ║
        §a║   §bKronFly plugin has been successfully activated!                     §a║
        §a║   §bEnjoy the freedom of flight in your Minecraft world.                §a║
        §a║                                                                       ║
        §a║   §fVersion: 1.0.0                                                      §a║
        §a║   §fAuthor: Kronnosy                                                    §a║
        §a║                                                                       ║
        §a╚═══════════════════════════════════════════════════════════════════════╝
        ');

        $this->saveDefaultConfig();

        $this->getServer()->getCommandMap()->register(
            "KronFly",
            new FlyCommand(
                $this,
                "fly",
                "Toggles flight mode for yourself or another player.",
                "/fly <ops: player_name>",
                [
                    "uc"
                ]
            )
        );

        parent::onEnable();
    }

    /**
     * @param string $key
     * @return string
     */
    public function getMessage(string $key): string
    {
        return $this->getConfig()->getNested(
            "messages.{$key}", ""
        );
    }

    /**
     * @param string $worldName
     * @return bool
     */
    public function isWorldDisallowed(string $worldName): bool
    {
        return $this->getConfig()->get(
            "disallowed-worlds.{$worldName}"
        );
    }
}
