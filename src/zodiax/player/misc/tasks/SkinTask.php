<?php

declare(strict_types=1);

namespace zodiax\player\misc\tasks;

use zodiax\misc\AbstractDelayedTask;
use zodiax\player\PracticePlayer;
use zodiax\PracticeUtil;

class SkinTask extends AbstractDelayedTask{

	private PracticePlayer $session;

	public function __construct(PracticePlayer $session){
		parent::__construct(PracticeUtil::secondsToTicks(15));
		$this->session = $session;
	}

	protected function onUpdate(int $tickDifference) : void{
		if(($player = $this->session->getPlayer()) !== null && $player->isOnline()){
			$this->session->setChangeSkin(true);
		}
	}
}