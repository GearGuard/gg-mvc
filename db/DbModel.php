<?php

namespace gearguard\phpmvc\db;

use gearguard\phpmvc\Application;
use gearguard\phpmvc\Model;

//map user's model and use's class
abstract class DbModel extends Model
{
	abstract public function tableName(): string;
	abstract public function attributes(): array;
	abstract public function primaryKey(): string;

	public function save()
	{
		$tableName = $this->tableName();
		$attributes = $this->attributes();
		$params = array_map(fn($attr) => ":$attr", $attributes);
		$statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ")
	VALUES (" . implode(',', $params) . ")");

		foreach ($attributes as $attribute) {
			$statement->bindValue(":$attribute", $this->{$attribute});
		}
		$statement->execute();
		return true;
	}
	public function findOne($where) //where is an array [email => exampl@gmail.com firstname => examplename]
	{
		$tableName = static::tableName();
		$attributes = array_keys($where);
		$sql = implode(array_map(fn($attr) => "$attr = :$attr", $attributes));
		// SELECT* FROM $tableName WHERE email = :email AND firstname = :firstname
		$statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
		foreach ($where as $key => $item) {
			$statement->bindValue(":$key", $item);
		}
		$statement->execute();
		return $statement->fetchObject(static::class);
	}
	public static function prepare($sql)
	{
		return Application::$app->db->pdo->prepare($sql);
	}
}
