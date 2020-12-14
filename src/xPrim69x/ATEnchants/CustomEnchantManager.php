<?php

namespace xPrim69x\ATEnchants;
use pocketmine\item\enchantment\Enchantment;
use xPrim69x\ATEnchants\enchants\sword\{BleedEnchant,
	DazeEnchant,
	FrostEnchant,
	HadesEnchant,
	KaboomEnchant,
	LifestealEnchant,
	OOFEnchant,
	PoisonEnchant,
	UpliftEnchant,
	ZeusEnchant};
use xPrim69x\ATEnchants\enchants\armor\{AdrenalineEnchant,
	BunnyEnchant,
	GearsEnchant,
	GlowingEnchant,
	OverlordEnchant,
	ScorchEnchant};
use xPrim69x\ATEnchants\enchants\bow\RelocateEnchant;
use xPrim69x\ATEnchants\enchants\pickaxe\{
	ExplosiveEnchant,
	FeedEnchant
	};

class CustomEnchantManager {

	private static $main;

	const SLOT_ARMOR = self::SLOT_HEAD | self::SLOT_TORSO | self::SLOT_LEGS | self::SLOT_FEET;
	const SLOT_NONE = 0x0;
	const SLOT_SWORD = 0x10;
	const SLOT_FEET = 0x8;
	const SLOT_LEGS = 0x4;
	const SLOT_TORSO = 0x2;
	const SLOT_HEAD = 0x1;
	const SLOT_BOW = 0x20;
	const SLOT_PICKAXE = 0x400;

	public const RARITY_COMMON = 10;
	public const RARITY_UNCOMMON = 5;
	public const RARITY_RARE = 2;
	public const RARITY_MYTHIC = 1;

	const CONVERSIONS = [
		"kaboom" => 69,
		"zeus" => 70,
		"uplift" => 71,
		"poison" => 72,
		"lifesteal" => 73,
		"hades" => 74,
		"bleed" => 75,
		"daze" => 76,
		"frost" => 77,
		"oof" => 78,
		"gears" => 79,
		"bunny" => 80,
		"glowing" => 81,
		"overlord" => 82,
		"relocate" => 83,
		"scorch" => 84,
		"adrenaline" => 85,
		"feed" => 86,
	];

	public static function init(Main $main){
		self::$main = $main;

		//Sword Enchants
		Enchantment::registerEnchantment(new KaboomEnchant(69,"Kaboom",self::RARITY_MYTHIC, self::SLOT_SWORD, self::SLOT_NONE,3));
		Enchantment::registerEnchantment(new ZeusEnchant(70,"Zeus",self::RARITY_RARE, self::SLOT_SWORD, self::SLOT_NONE,3));
		Enchantment::registerEnchantment(new UpliftEnchant(71,"Uplift",self::RARITY_RARE, self::SLOT_SWORD, self::SLOT_NONE,1));
		Enchantment::registerEnchantment(new PoisonEnchant(72,"Poison",self::RARITY_UNCOMMON, self::SLOT_SWORD, self::SLOT_NONE,2));
		Enchantment::registerEnchantment(new LifestealEnchant(73,"Lifesteal",self::RARITY_UNCOMMON, self::SLOT_SWORD, self::SLOT_NONE,2));
		Enchantment::registerEnchantment(new HadesEnchant(74,"Hades",self::RARITY_UNCOMMON, self::SLOT_SWORD, self::SLOT_NONE,3));
		Enchantment::registerEnchantment(new BleedEnchant(75,"Bleed",self::RARITY_RARE, self::SLOT_SWORD, self::SLOT_NONE,3));
		Enchantment::registerEnchantment(new DazeEnchant(76,"Daze",self::RARITY_UNCOMMON, self::SLOT_SWORD, self::SLOT_NONE,3));
		Enchantment::registerEnchantment(new FrostEnchant(77,"Frost",self::RARITY_COMMON, self::SLOT_SWORD, self::SLOT_NONE,3));
		Enchantment::registerEnchantment(new OOFEnchant(78,"OOF",self::RARITY_COMMON, self::SLOT_SWORD, self::SLOT_NONE,2));

		//Armor Toggleable Enchants
		Enchantment::registerEnchantment(new GearsEnchant(79,"Gears",self::RARITY_RARE,self::SLOT_FEET,self::SLOT_NONE,2));
		Enchantment::registerEnchantment(new BunnyEnchant(80,"Bunny",self::RARITY_UNCOMMON,self::SLOT_FEET,self::SLOT_NONE,3));
		Enchantment::registerEnchantment(new GlowingEnchant(81,"Glowing",self::RARITY_COMMON,self::SLOT_HEAD,self::SLOT_NONE,1));
		Enchantment::registerEnchantment(new OverlordEnchant(82,"Overlord",self::RARITY_MYTHIC,self::SLOT_ARMOR,self::SLOT_NONE,2));

		//Bow Enchants
		Enchantment::registerEnchantment(new RelocateEnchant(83, "Relocate", self::RARITY_RARE, self::SLOT_BOW, self::SLOT_NONE,1));

		//Armor Entity Damage Enchants
		Enchantment::registerEnchantment(new ScorchEnchant(84,"Scorch",self::RARITY_COMMON,self::SLOT_ARMOR,self::SLOT_NONE,5));
		Enchantment::registerEnchantment(new AdrenalineEnchant(85,"Adrenaline",self::RARITY_UNCOMMON,self::SLOT_ARMOR,self::SLOT_NONE,1));

		//Pickaxe Enchants
		Enchantment::registerEnchantment(new FeedEnchant(86,"Feed",self::RARITY_COMMON,self::SLOT_PICKAXE,self::SLOT_NONE,1));

	}

}