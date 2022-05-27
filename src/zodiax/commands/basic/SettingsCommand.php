<?php

declare(strict_types=1);

namespace zodiax\commands\basic;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use zodiax\commands\PracticeCommand;
use zodiax\forms\display\basic\settings\GeneralSettingsForm;
use zodiax\ranks\RankHandler;

class SettingsCommand extends PracticeCommand{

	public function __construct(){
		parent::__construct("settings", "Show player's settings UI", "Usage: /settings", ["toggles"]);
		parent::setPermission("practice.permission.settings");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
		if($this->testPermission($sender) && $sender instanceof Player){
			GeneralSettingsForm::onDisplay($sender);
		}
		return true;
	}

	public function getRankPermission() : string{
		return RankHandler::PERMISSION_NONE;
	}
}