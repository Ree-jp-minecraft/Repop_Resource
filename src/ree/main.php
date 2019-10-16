<?php

/*
 * _____                  _
 *|  __ \                (_)
 *| |__) |___  ___ ______ _ _ __
 *|  _  // _ \/ _ \______| | '_ \
 *| | \ \  __/  __/      | | |_) |
 *|_|  \_\___|\___|      | | .__/
 *                      _/ | |
 *                     |__/|_|
 *
 * Resources are back
 *
 * @copyright 2019 Ree_jp
 */

namespace ree;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;

use ree\BlockTask;
use ree\RepopTask;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
	    $this->getServer()->getPluginManager()->registerEvents($this, $this);
	    $this->getLogger()->info("loadingnow...");
	    $this->getLogger()->info("creator:ree");


	    $repop = new Config($this->getDataFolder()."repop.yml",Config::YAML,[
			'world' => 'lobby',
            'block' => '7',
            'time' => '15'
			]);
		$this->level = $this->getServer()->getLevelByName($repop->get("world"));
        $this->block = $repop->get("block");
        $this->time = $repop->get("time");
    }
    
    public function onBreak(BlockBreakEvent $ev){
        $p = $ev->getPlayer();
        if($p->getLevel() == $this->level){
            $block = $ev->getBlock();
            $vector = $block->asVector3();
            $level = $p->getlevel();
            if($this->block != $block->getId())
            {
                $this->getScheduler()->scheduleDelayedTask(new RepopTask($vector,$block,$level), $this->time);
            }
            $this->getScheduler()->scheduleDelayedTask(new BlockTask($vector,$this->block,$level), 1);
        }
    }
    
    public function onPlace (BlockPlaceEvent $ev) {
        if($ev->getPlayer()->getlevel() == $this->level){
            $ev->setCancelled();
        }
    }
    
}