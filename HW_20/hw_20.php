<?php

abstract class Hero {
    protected $health;
    protected $stamina;
    protected $weapon;

    public function __construct($health, $stamina, Weapon $weapon) {
        $this->health = $health;
        $this->stamina = $stamina;
        $this->weapon = $weapon;
    }

    abstract public function attack(Hero $opponent);

    public function takeDamage($damage) {
        $this->health -= $damage;
    }

    public function isAlive() {
        return $this->health > 0;
    }
}

class Warrior extends Hero {
    public function attack(Hero $opponent) {
        $opponent->takeDamage($this->weapon->getDamage());
    }
}

class Mage extends Hero {
    public function attack(Hero $opponent) {
        $opponent->takeDamage($this->weapon->getDamage());
    }
}

class Archer extends Hero {
    public function attack(Hero $opponent) {
        $opponent->takeDamage($this->weapon->getDamage());
    }
}


abstract class Weapon {
    protected $damage;

    public function __construct($damage) {
        $this->damage = $damage;
    }

    public function getDamage() {
        return $this->damage;
    }
}

class Bow extends Weapon {}
class Crossbow extends Weapon {}
class MagicStaff extends Weapon {}
class Sword extends Weapon {}
class Gun extends Weapon {}


class Battle {
    public static function start(Hero $hero1, Hero $hero2) {
        while ($hero1->isAlive() && $hero2->isAlive()) {
            $hero1->attack($hero2);
            $hero2->attack($hero1);
        }

        if ($hero1->isAlive()) {
            return "Переможець: Герой 1";
        } else if ($hero2->isAlive()) {
            return "Переможець: Герой 2";
        } else {
            return "Нічия";
        }
    }
}


$warrior = new Warrior(100, 50, new Sword(10));
$mage = new Mage(80, 40, new MagicStaff(15));
$archer = new Archer(90, 50, new Bow(13));

// $battleResult = Battle::start($warrior, $archer);
$battleResult = Battle::start($mage, $archer);
echo $battleResult;
