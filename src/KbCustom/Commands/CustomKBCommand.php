<?php

namespace KbCustom\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\CommandException;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use KbCustom\Core\Main;

class CustomKBCommand extends Command {

    private $main;

    public function __construct(Main $main)
    {
        parent::__construct("kbcustom", "Cette command change les Kb de votre serveur !");
        $this->main = $main;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender->hasPermission("kbcustom.use")) {
            if($sender instanceof Player) {

                $config = new Config($this->main->getDataFolder(). "/". $sender->getWorld()->getFolderName(). ".yml", Config::YAML);

                if(isset($args[0])) {
                    if(isset($args[1])) {
                        switch($args[0]) {
                            case "setkb":

                                $config->set("world", $sender->getWorld()->getFolderName());
                                $config->set("kb", $args[1]);
                                $config->save();
                                $sender->sendMessage(TextFormat::GREEN. "Vous avez réussi à changer le kb en ". TextFormat::DARK_GREEN. $args[1]. TextFormat::GREEN. " dans le monde ". TextFormat::DARK_GREEN. $sender->getWorld()->getFolderName());

                                break;
                            case "setdelay":

                                $config->set("world", $sender->getWorld()->getFolderName());
                                $config->set("delay", $args[1]);
                                $config->save();
                                $sender->sendMessage(TextFormat::GREEN. "Vous avez réussi à changer le coup de retard en ". TextFormat::DARK_GREEN. $args[1]. TextFormat::GREEN. " dans le monde ". TextFormat::DARK_GREEN. $sender->getWorld()->getFolderName());

                                break;
                            default:
                                $sender->sendMessage(TextFormat::RED. "Arguments manquants. Essayer /kbcustom (setkb/setdelay) (amount)");
                                break;
                    }
                } else {
                    $sender->sendMessage(TextFormat::RED. "Arguments manquants. Essayer /kbcustom (setkb/setdelay) (amount)");
                }
            }} else {
                $sender->sendMessage(TextFormat::RED. "Arguments manquants. Essayer /kbcustom (setkb/setdelay)");
            }
        } else {
            $sender->sendMessage(TextFormat::RED. "Tu n'a pas la perm de use cette command !");
        }
    }
}