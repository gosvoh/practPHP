<?php
// блок инициализации
try {
	$pdoSet = new PDO('mysql:host=localhost', 'root', '');
	$pdoSet->query('SET NAMES utf8;');
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}

// код для "неубиваемой" базы данных
$sqlTM = "CREATE DATABASE IF NOT EXISTS bank;";
$stmt = $pdoSet->query($sqlTM);
$sqlTM = "USE bank;";
$stmt = $pdoSet->query($sqlTM);

$sqlTM = "
CREATE TABLE IF NOT EXISTS `Individuals` (
	`id` INT NOT NULL,
	`first_name` VARCHAR(30) NOT NULL,
	`last_name` VARCHAR(30) NOT NULL,
	`middle_name` VARCHAR(30) DEFAULT NULL,
	`passport` VARCHAR(30) NOT NULL,
	`INN` VARCHAR(12) NOT NULL,
	`SNILS` VARCHAR(11) NOT NULL,
	`license` VARCHAR(30) DEFAULT NULL,
	`additional_docs` VARCHAR(30) DEFAULT NULL,
	`notes` VARCHAR(255) DEFAULT NULL,
	PRIMARY KEY (`id`)
  );
";
$stmt = $pdoSet->query($sqlTM);
// конец кода для "неубиваемой" базы данных

if (isset($_GET['bt1'])) {
	// работает независимо от кол-ва столбцов.
	$sql = "SHOW COLUMNS FROM Individuals";
	$stmt = $pdoSet->query($sql);
	$resultMF = $stmt->fetchAll();
	$sqlTM = "INSERT INTO Individuals (";
	for ($iR = 1; $iR < Count($resultMF); ++$iR) {
		$sqlTM .= $resultMF[$iR]["Field"];
		if ($iR < Count($resultMF) - 1) {
			$sqlTM .= ', ';
		} else {
			$sqlTM .= ") VALUES (";
		}
	}

	for ($iR = 1; $iR < Count($resultMF); ++$iR) {
		$sqlTM .= "'" . $_GET[$resultMF[$iR]["Field"]] . "'";
		if ($iR < Count($resultMF) - 1) {
			$sqlTM .= ', ';
		} else {
			$sqlTM .= ")";
		}
	}

	$stmt = $pdoSet->query($sqlTM);
}

// начало вставки для UPDATE
if (isset($_GET['textId'])) {
	// работает независимо от кол-ва столбцов.
	$sql = "SHOW COLUMNS FROM Individuals";
	$stmt = $pdoSet->query($sql);
	$resultMF = $stmt->fetchAll();
	$sqlTM = "UPDATE Individuals SET ";
	for ($iR = 1; isset($_GET["textEd" . $iR]); ++$iR) {
		$sqlTM .= $resultMF[$iR]["Field"] . "='" . $_GET["textEd" . $iR] . "'";
		if (isset($_GET["textEd" . ($iR + 1)])) {
			$sqlTM .= ', ';
		} else {
			$sqlTM .= " WHERE id = " . $_GET["textId"];
		}
	}

	$stmt = $pdoSet->query($sqlTM);
}
// конец вставки для UPDATE


// начало вставки для DELETE
if (isset($_GET['delid'])) {
	$sqlTM = "DELETE FROM Individuals WHERE id = " . $_GET["delid"];
	$stmt = $pdoSet->query($sqlTM);
}
// конец вставки для DELETE

// добавление столбца.
if (isset($_GET['addrow'])) {
	$sqlTM = "ALTER TABLE Individuals ADD " . $_GET['addrow'] . "1 TEXT NOT NULL AFTER " . $_GET['addrow'];
	$stmt = $pdoSet->query($sqlTM);
}
// удаление столбца.
if (isset($_GET['delrow'])) {
	$sqlTM = "ALTER TABLE Individuals DROP " . $_GET['delrow'];
	$stmt = $pdoSet->query($sqlTM);
}

// основной запрос для выгрузки массива данных из таблицы.
if (isset($_GET['order'])) {
	$sql = "SELECT * FROM Individuals ORDER BY " . $_GET['order'] . " DESC";
} else {
	$sql = "SELECT * FROM Individuals ORDER BY id DESC";  // ASC - по возрастанию; DESC - по убыванию.
}
$stmt = $pdoSet->query($sql);
$resultMF = $stmt->fetchAll(PDO::FETCH_NUM); // PDO::FETCH_NUM - только числовые индексы: [0][0]
