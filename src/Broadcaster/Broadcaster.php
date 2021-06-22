<?php
use pocketmine\plugin\PluginBase;

use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\event\player\PlayerQuitEvent;

use pocketmine\Player;

use pocketmine\Server;

use pocketmine\event\Listener;

use pocketmine\utils\TextFormat as C;

class Plugin extends PluginBase implements Listener{
  
        public $cfg;
  
        public function onLoad(){
            $this->getLogger()->info("Loading Broadcaster");
            @mkdir($this->getDataFolder());
            $this->saveDefaultConfig();
            $this->cfg = $this->getConfig()->getAll();
        }
        public function onEnable(){
            $this->getServer()->getPluginManager()->registerEvents($this,$this);
		        $this->getLogger()->info("Thank you for enabling broadcaster!");
        }
        public function onDisable(){
            $this->getLogger()->info("Disabled Broadcaster");
        }
        public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
            
        }
        public function broadcast(array $args) {
            $msg = implode(" ", $args);
            $prefix = cfg["prefix"];
            $msgcolor = cfg["msgcolor"]
            $msg = implode(" ", array($prefix, implode("", array($msgcolor, $msg)));
            foreach($this->getServer()->getOnlinePlayers() as $player) {
                $player->sendMessage(TextFormat::colorize(str_replace("{PLAYER}", $player->getName(), $msg));
            }
        }
}
