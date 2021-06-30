<?php
namespace Dawnkiller2008\Broadcaster;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as C;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\Config;

class Broadcaster extends PluginBase implements Listener{

        public function onLoad(){
            $this->getLogger()->info("Loading Broadcaster");
        }
        public function onEnable(){
            $this->getServer()->getPluginManager()->registerEvents($this,$this);
	    $this->getLogger()->info("Thank you for enabling broadcaster!");
            $this->saveDefaultConfig();
            $this->reloadConfig();
        }
        public function onDisable(){
            $this->getLogger()->info("Disabled Broadcaster");
        }
        public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
            switch($cmd->getName()){
              case "broadcast":
                if(empty($args)){
		    $sender->sendMessage("Usage: /broadcast <message>");
		    return true;
	        }
                $msg = implode(" ", $args);
                $prefix = $this->getConfig()->get("prefix");
                $msgcolor = $this->getConfig()->get("msgcolor");
                $newmsg = join("", array($msgcolor, $msg));
                $finalmsg = join(" ", array($prefix, $newmsg));
                foreach($this->getServer()->getOnlinePlayers() as $player) {
                    $player->sendMessage(TextFormat::colorize(str_replace("{PLAYER}", $player->getName(), $finalmsg)));
                }
                $this->getLogger()->info($finalmsg);
                return true;
              case "bcast":
                if(empty($args)){
		    $sender->sendMessage("Usage: /broadcast <message>");
		    return true;
	        }
                $msg = implode(" ", $args);
                $prefix = $this->getConfig()->get("prefix");
                $msgcolor = $this->getConfig()->get("msgcolor");
                $newmsg = join("", array($msgcolor, $msg));
                $finalmsg = join(" ", array($prefix, $newmsg));
                foreach($this->getServer()->getOnlinePlayers() as $player) {
                    $player->sendMessage(TextFormat::colorize(str_replace("{PLAYER}", $player->getName(), $finalmsg)));
                }
                $this->getLogger()->info($finalmsg);
                return true;
              case "bc":
                if(empty($args)){
		    $sender->sendMessage("Usage: /broadcast <message>");
		    return true;
	        }
                $msg = implode(" ", $args);
                $prefix = $this->getConfig()->get("prefix")[0];
                $msgcolor = $this->getConfig()->get("msgcolor")[0];
                $finalmsg = $prefix.' '.$msgcolor.$msg;
                foreach($this->getServer()->getOnlinePlayers() as $player) {
                    $player->sendMessage(TextFormat::colorize(str_replace("{PLAYER}", $player->getName(), $finalmsg)));
                }
                $this->getLogger()->info($finalmsg);
                return true;
            }
        }
}
