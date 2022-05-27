<?php

declare(strict_types=1);

namespace zodiax\commands\staff;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use zodiax\commands\PracticeCommand;
use zodiax\player\PlayerManager;
use zodiax\PracticeCore;
use zodiax\ranks\RankHandler;
use function count;
use function implode;
use function trim;

class UnfreezeCommand extends PracticeCommand{

	public function __construct(){
		parent::__construct("unfreeze", "Unfreeze a player", "Usage: /unfreeze <player>", []);
		parent::setPermission("practice.permission.unfreeze");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
		if($this->testPermission($sender) && $sender instanceof Player){
			if(count($args) >= 1){
				if(($pSession = PlayerManager::getSession($player = PlayerManager::getPlayerByPrefix($name = trim(implode(" ", $args))))) !== null){
					if($pSession->isFrozen()){
						$pSession->setFrozen();
						$sender->sendMessage(PracticeCore::PREFIX . PracticeCore::COLOR . "Successfully unfroze " . TextFormat::RED . $player->getDisplayName());
					}
					return true;
				}
				$sender->sendMessage(PracticeCore::PREFIX . TextFormat::RED . "Can not find player $name");
				return true;
			}
			$sender->sendMessage(PracticeCore::PREFIX . $this->getUsage());
		}
		return true;
	}

	public function getRankPermission() : string{
		return RankHandler::PERMISSION_MOD;
	}
}
