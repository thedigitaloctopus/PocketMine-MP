<?php

/*

           -
         /   \
      /         \
   /   PocketMine  \
/          MP         \
|\     @shoghicp     /|
|.   \           /   .|
| ..     \   /     .. |
|    ..    |    ..    |
|       .. | ..       |
\          |          /
   \       |       /
      \    |    /
         \ | /

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.


*/

class StairBlock extends TransparentBlock{
	public function __construct($id, $meta = 0, $name = "Unknown"){
		parent::__construct($id, $meta, $name);
		$this->isFullBlock = false;
	}

	public function place(Item $item, Player $player, Block $block, Block $target, $face, $fx, $fy, $fz){
		$faces = array(
			0 => 0,
			1 => 2,
			2 => 1,
			3 => 3,
		);
		$this->meta = $faces[$player->entity->getDirection()] & 0x03;
		if(($fy > 0.5 and $face !== 1) or $face === 0){
			$this->meta |= 0x04; //Upside-down stairs
		}
		$this->level->setBlock($block, $this);
		return true;
	}
	
	public function getDrops(Item $item, Player $player){
		if($item->isPickaxe() >= 1){
			return array(
				array($this->id, 0, 1),
			);
		}else{
			return array();
		}
	}
}