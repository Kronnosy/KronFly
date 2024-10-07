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

namespace Kronnosy\KronFly\utils;


class DataRegistry
{
    const PERMISSION_FLY = "kronfly.command.fly.use";
    const PERMISSION_OTHER_FLY = "kronfly.command.fly.others";
    const KEY_NO_PERMISSION = "no-permission";
    const KEY_OTHER_PLAYER_NOT_FOUND = "other-fly-player-not-found";
    const KEY_COMMAND_ONLY_FOR_PLAYERS = "command-only-for-players";
    const KEY_DISABLED_IN_WORLD = "fly-disabled-in-world";
    const KEY_ERROR_ALREADY_FLYING =  "fly-error-already-flying";
    const KEY_OPENED = "fly-opened";
    const KEY_CLOSED = "fly-closed";
    const KEY_FLY_PLAYER_ENABLE = "other-fly-player-enable";
    const KEY_FLY_PLAYER_DISABLE = "other-fly-player-disable";

    const PREFIX_PLAYER = "{player}";
}
