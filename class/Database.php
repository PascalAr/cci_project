<?php

class Database {

	/**
	 * @var PDO instance d'une connexion PDO
	 */
    static $pdo;
    

	 /** Construit un objet database et charge une instance de connexion PDO unique
	 * 
	 * @param void
	 * @return void
	 */
	public function __construct()
	{
		if(! self::$pdo instanceof PDO)
		{
			self::$pdo = new PDO
			(
				SGBD.':dbname='.DB_NAME.';host='.DB_HOST.';charset='.DB_CHARSET,
				DB_USER,
				DB_PASS
			);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
    }
    

	/** Execute une requête sql de type Insert ou Update ou Delete
	 * 
	 * @param string $sql requête sql a executer
	 * @param array $values tableaux associatif ou indexé des valeurs à passer à l'execution de la requête
	 * @return integer dernier id enregistré dans la base
	 */
	public function executeSql($sql, array $values = array())
	{
		$query = self::$pdo->prepare($sql);
		$query->execute($values);
		return self::$pdo->lastInsertId();
    }
    

	/** Execute une requête sql de type Select et renvoi le jeu d'enregistrement complet
	 * 
	 * @param string $sql requête sql a executer
	 * @param array $values tableaux associatif ou indexé des valeurs à passer à l'execution de la requête
	 * @return array jeu d'enregistrement
	 */
    public function query($sql, array $criteria = array())
    {
        $query = self::$pdo->prepare($sql);
        $query->execute($criteria);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


	/** Execute une requête sql de type Select et renvoi la premièe ligne du jeu d'enregistrement
	 * 
	 * @param string $sql requête sql a executer
	 * @param array $values tableaux associatif ou indexé des valeurs à passer à l'execution de la requête
	 * @return array jeu d'enregistrement la première ligne seulement
	 */
    public function queryOne($sql, array $criteria = array())
    {
        $query = self::$pdo->prepare($sql);
        $query->execute($criteria);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
}

/* Cette classe permet de faciliter la connexion à la bdd via PDO
Elle ne permet qu'une seule instance de connexion vers le serveur de bdd (singleton sur la class PDO) et facilite les requêtes préparées.
Méthodes :
**************
mixed executeSql(string $sql, array $values) //requete de type UPDATE, INSERT, DELETE
array query(string $sql, array $criteria) //requete de type SELECT
array queryOne(string $sql, array $criteria) //requete de type SELECT mais récupère la première ligne du jeu d'enregistrement
Dépendances :
**************
Les constantes SGBD, DB_NAME, DB_HOST, DB_USER, DB_PASS, DB_CHARSET doivent être définie
au niveau de l'application. Fichier config.php par exemple.
Ce fichier sera inclu dans le programme principal (le routeur de l'application index.php)
Exemple d'utilisation :
*************
$db = new Database();
$users = $db->query('SELECT * FROM users');
Todo :
*******
L'association des valeurs dynamiques (bind) pour l'ensemble des requêtes préparées est passée sous
la forme d'un tableau
Il sera associatif ou indéxé numériquement selon la construction de la requête (? ou :param).
*/