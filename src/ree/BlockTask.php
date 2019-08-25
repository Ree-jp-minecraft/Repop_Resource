<?php

namespace ree;

use pocketmine\scheduler\Task;
use pocketmine\level\Level;
use pocketmine\block\Block;

class BlockTask extends Task {
    
    public function __construct ($vector,$block ,$level){
        $this->vector = $vector;
        $this->block = $block;
        $this->level = $level;
    }
    
    public function onRun ($tick){
        if(!$this->block == null)
        {
            $block = Block::get($this->block ,0);
            $this->level->setBlock($this->vector,$block);
        }
    }
}
