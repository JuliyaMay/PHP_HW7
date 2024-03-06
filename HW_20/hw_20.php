<?php
abstract class Hero {
    protected $health;
    protected $stamina;
    protected $baseDamage;
    protected $weapon;

    public function __construct($health, $stamina, $baseDamage) {
        $this->health = $health;
        $this->stamina = $stamina;
        $this->baseDamage = $baseDamage;
    }

    public function setWeapon(Weapon $weapon) {
        $this->weapon = $weapon;
    }

    abstract public function attack(Hero $opponent);

    abstract protected function getTypeName(): string;

    protected function say($phrases): string {
        return $this->getTypeName() . ": " . $phrases[array_rand($phrases)] . PHP_EOL;
    }

    public function takeDamage($damage) {
        $this->health -= $damage;
    }

    public function isAlive() {
        return $this->health > 0;
    }

    abstract public function sayOnWin();
    abstract public function sayOnLose();

}

class Warrior extends Hero {
    public function attack(Hero $opponent) {
        $damage = $this->baseDamage + $this->weapon->getDamage();
        $opponent->takeDamage($damage);
    }

    protected function getTypeName(): string {
        return 'Воїн';
    }

    public function sayOnWin() {
        echo $this->say(["For glory!", "Victory is mine!"]);
    }

    public function sayOnLose() {
        echo $this->say(["Defeat... I will return stronger.", "I've lost this battle, but not the war."]);
    }
}

class Mage extends Hero {
    public function attack(Hero $opponent) {
        $damage = $this->baseDamage + $this->weapon->getDamage();
        $opponent->takeDamage($damage);
    }

    protected function getTypeName(): string {
        return 'Маг';
    }

    public function sayOnWin() {
        echo $this->say(["The arcane is mine to command.", "Another win for magic."]);
    }

    public function sayOnLose() {
        echo $this->say(["I must reconsider my spells...", "Magic, don't fail me now..."]);
    }
}

class Archer extends Hero {
    public function attack(Hero $opponent) {
        $damage = $this->baseDamage + $this->weapon->getDamage();
        $opponent->takeDamage($damage);
    }

    protected function getTypeName(): string {
        return 'Лучник';
    }

    public function sayOnWin() {
        echo $this->say(["A sharp eye never fails.", "Right on target!"]);
    }

    public function sayOnLose() {
        echo $this->say(["Missed... impossible!", "My aim was true, how?"]);
    }
}

abstract class Weapon {
    protected int $damage;

    public function __construct(int $damage) {
        $this->damage = $damage;
    }

    public function getDamage(): int {
        return $this->damage;
    }
}

class Bow extends Weapon {}
class Crossbow extends Weapon {}
class MagicStaff extends Weapon {}
class Sword extends Weapon {}
class Gun extends Weapon {}

class Guild {
    public static function bornHero($type, $health, $stamina, $baseDamage, $weapon) {
        switch ($type) {
            case 'Warrior':
                $hero = new Warrior($health, $stamina, $baseDamage);
                break;
            case 'Mage':
                $hero = new Mage($health, $stamina, $baseDamage);
                break;
            case 'Archer':
                $hero = new Archer($health, $stamina, $baseDamage);
                break;
            default:
                throw new Exception("Invalid hero type");
        }
        $hero->setWeapon($weapon);
        return $hero;
    }
}

class Battle {
    public static function start(Hero $hero1, Hero $hero2) {
        while ($hero1->isAlive() && $hero2->isAlive()) {
            $hero1->attack($hero2);
            if (!$hero2->isAlive()) {
                $hero1->sayOnWin();
                $hero2->sayOnLose();
                return "Переможець: Герой 1" . PHP_EOL;
            }

            $hero2->attack($hero1);
            if (!$hero1->isAlive()) {
                $hero2->sayOnWin();
                $hero1->sayOnLose();
                return "Переможець: Герой 2" . PHP_EOL;
            }
        }

        // Цей блок коду обробляє дуже малоймовірний сценарій, коли обидва герої помирають від останньої атаки одночасно
        if (!$hero1->isAlive() && !$hero2->isAlive()) {
            $hero1->sayOnLose();
            $hero2->sayOnLose();
            return "Нічия" . PHP_EOL;
        }
    }
}

$warrior = Guild::bornHero('Warrior', 100, 50, 10, new Sword(15));
$mage = Guild::bornHero('Mage', 80, 40, 12, new MagicStaff(20));
$archer = Guild::bornHero('Archer', 90, 50, 8, new Bow(13));

$battleResult = Battle::start($mage, $archer);
echo $battleResult;
