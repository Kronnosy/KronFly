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

namespace Kronnosy\KronFly\command;

use Kronnosy\KronFly\
{
    KronFly,
    utils\DataRegistry
};

use pocketmine\
{
    command\Command,
    command\CommandSender,
    player\Player
};

class FlyCommand extends Command
{
    /**
     * @var KronFly $plugin
     */
    private KronFly $kronFly;

    /**
     * @param KronFly $kronFly
     * @param string|null $name
     * @param string $description
     * @param null $usageMessage
     * @param array $aliases
     */
    public function __construct(KronFly $kronFly, string $name = null, $description = "", $usageMessage = null, array $aliases = [])
    {
        $this->kronFly = $kronFly;

        $this->setPermission(DataRegistry::PERMISSION_FLY);
        $this->setPermissionMessage(DataRegistry::KEY_NO_PERMISSION);

        parent::__construct(
            $name,
            $description,
            $usageMessage,
            $aliases
        );
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return bool
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool
    {
        if (!$this->testPermission($sender)) {
            $sender->sendActionBarMessage($this->kronFly->getMessage(DataRegistry::KEY_NO_PERMISSION));
            return false;
        }

        $target = $sender;
        if (isset($args[0])) {
            $target = $this->kronFly->getServer()->getPlayerExact($args[0]);
        }

        if (!$target instanceof Player) {
            $sender->sendActionBarMessage($this->kronFly->getMessage(
                $target === null ? DataRegistry::KEY_OTHER_PLAYER_NOT_FOUND : DataRegistry::KEY_COMMAND_ONLY_FOR_PLAYERS
            ));
            return false;
        }

        if ($this->kronFly->isWorldDisallowed($target->getWorld()->getFolderName())) {
            $sender->sendActionBarMessage($this->kronFly->getMessage(DataRegistry::KEY_DISABLED_IN_WORLD));
            return false;
        }

        $newState = !$target->getAllowFlight();
        if ($sender === $target && $target->isFlying() && !$newState) {
            $sender->sendActionBarMessage($this->kronFly->getMessage(DataRegistry::KEY_ERROR_ALREADY_FLYING));
            return false;
        }

        $target->setAllowFlight($newState);
        $target->setFlying($newState);

        $target->sendActionBarMessage($this->kronFly->getMessage($newState ? DataRegistry::KEY_OPENED : DataRegistry::KEY_CLOSED));

        if ($sender !== $target) {
            $sender->sendActionBarMessage(str_replace(
                DataRegistry::PREFIX_PLAYER,
                $target->getName(),
                $this->kronFly->getMessage($newState ? DataRegistry::KEY_FLY_PLAYER_ENABLE : DataRegistry::KEY_FLY_PLAYER_DISABLE)
            ));
        }

        return true;
    }

}
