<?php
	global $db;

	/* Database Config */
	define('DB_SERVER', '127.0.0.1');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'frenchleather');

	try {
		$db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8', DB_USERNAME, DB_PASSWORD);
	}
	catch(Exception $exception) {
		die('Erreur : '.$exception->getMessage());
	}

	function setUser($login, $password) {
		global $db;
		$query = $db->prepare('INSERT INTO user(login, password) VALUES (?, ?)');
		$query->execute(array($login, $password));
	}

	function getUserByLoginPassword($login, $password) {
		global $db;
		$query = $db->prepare('SELECT id, login, password FROM user WHERE login = ? AND password = ?');
		$query->execute(array($login, $password));
		$fetch = $query->fetch();
		return $fetch;
	}

	function getUserById($id) {
		global $db;
		$query = $db->prepare('SELECT id, login, password FROM user WHERE id = ?');
		$query->execute(array($id));
		$fetch = $query->fetch();
		return $fetch;
	}

	function existUserByLogin($login) {
		global $db;
		$query = $db->prepare('SELECT * FROM user WHERE login = ?');
		$query->execute(array($login));
		$count = $query->rowCount();
		return $count ? true : false;
	}

	function existUserByLoginPassword($login, $password) {
		global $db;
		$query = $db->prepare('SELECT * FROM user WHERE login = ? AND password = ?');
		$query->execute(array($login, $password));
		$count = $query->rowCount();
		return $count ? true : false;
	}

	function setPost($author, $text, $date, $nblike, $nbdislike) {
		global $db;
		$query = $db->prepare('INSERT INTO post(author, text, date, nblike, nbdislike) VALUES (?, ?, ?, ?, ?)');
		$query->execute(array($author, $text, $date, $nblike, $nbdislike));
	}

	function getPost() {
		global $db;
		$query = $db->prepare('SELECT id, author, text, DATE_FORMAT(date, "%d/%m/%Y - %H:%i") AS datePost, nblike, nbdislike FROM post ORDER BY date DESC');
		$query->execute();
		$fetch = $query->fetchAll();
		return $fetch;
	}

	function setComment($post, $author, $text, $date, $nblike, $nbdislike) {
		global $db;
		$query = $db->prepare('INSERT INTO comment(post, author, text, date, nblike, nbdislike) VALUES (?, ?, ?, ?, ?, ?)');
		$query->execute(array($post, $author, $text, $date, $nblike, $nbdislike));
	}

	function getComment($post) {
		global $db;
		$query = $db->prepare('SELECT id, post, author, text, DATE_FORMAT(date, "%d/%m/%Y - %H:%i") AS dateComment, nblike, nbdislike FROM comment WHERE post = ? ORDER BY date DESC');
		$query->execute(array($post));
		$fetch = $query->fetchAll();
		return $fetch;
	}
