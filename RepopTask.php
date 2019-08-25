<?php

namespace ree;

use pocketmine\scheduler\Task;
use pocketmine\level\Level;

class RepopTask extends Task {
    
    public function __construct ($vector,$block ,$level){
        $this->vector = $vector;
        $this->block = $block;
        $this->level = $level;
    }
    
    public function onRun ($tick){
        $this->level->setBlock($this->vector,$this->block);
    }
}
