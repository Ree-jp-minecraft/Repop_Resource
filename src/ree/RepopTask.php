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
