<?php
	$con=@mysqli_connect("localhost","root","","Libraria");
	if(!$con)
	{
		echo "Nuk u realizua lidhja". @mysqli_connect_error();
	}
	else 
	{
		echo "Lidhja u realizua </br>";
	}
	$query="CREATE TABLE Klienti 
			(
				ID_Klient INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
				Emri VARCHAR(20) NOT NULL,
				Mbiemri VARCHAR(20) NOT NULL,
				Email VARCHAR(50) NOT NULL,
				Adresa VARCHAR(25) NOT NULL,
				Qyteti VARCHAR(30) NOT NULL,
				Shteti VARCHAR(20) NOT NULL,
				Kodi_Postar VARCHAR(5) NOT NULL
			)";
	if(@mysqli_query($con,$query))
	{
		echo "Tabela u krijua me sukses.</br>";
	}
	else
	{
		echo "Ndodhi nje gabim gjate krijimit te tabeles: ".@mysqli_error($con)."</br>";
	}
	
	
	$query1="CREATE TABLE Porosi 
			(
				ID_Porosi INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
				ID_Klient INT(11) NOT NULL,
				DatePorosi DATE NOT NULL
			)";
	if(@mysqli_query($con,$query1))
	{
		echo "Tabela u krijua me sukses.</br>";
	}
	else
	{
		echo "Ndodhi nje gabim gjate krijimit te tabeles: ".@mysqli_error($con)."</br>";
	}
	
		
	$query2="CREATE TABLE FletePorosi 
			(
				ID_Porosi INT(11) NOT NULL,
				Seri VARCHAR(15) NOT NULL,
				Sasia INT(4) NOT NULL,
				Cmimi DOUBLE(6,2)
			)";
	if(@mysqli_query($con,$query2))
	{
		echo "Tabela u krijua me sukses. </br>";
	}
	else
	{
		echo "Ndodhi nje gabim gjate krijimit te tabeles: ".@mysqli_error($con)."</br>";
	}
	
	
	$query3="CREATE TABLE Lib_Pershkrim
			(
				Nr_Seri BIGINT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
				Titulli VARCHAR(50) NOT NULL,
				Pershkrimi VARCHAR(500) NOT NULL,
				Cmimi INT(6) NOT NULL,
				Botuesi VARCHAR(20) NOT NULL,
				Publikimi DATE NOT NULL,
				Tirazhi INT (5) NOT NULL,
				Nr_Faqeve INT (5) NOT NULL,
				Foto LONGBLOB NOT NULL
			)";
	if(@mysqli_query($con,$query3))
	{
		echo "Tabela u krijua me sukses. </br>";
	}
	else
	{
		echo "Ndodhi nje gabim gjate krijimit te tabeles: ".@mysqli_error($con)."</br>";
	}
	
	$query4 ="CREATE TABLE Lib_Autor
			(
				ID_Autor INT(6) AUTO_INCREMENT PRIMARY KEY NOT NULL,
				Emri VARCHAR(20) NOT NULL,
				Mbiemri VARCHAR(20) NOT NULL
			)";
	if(@mysqli_query($con,$query4))
	{
		echo "Tabela u krijua me sukses. </br>";
	}
	else
	{
		echo "Ndodhi nje gabim gjate krijimit te tabeles: ".@mysqli_error($con)."</br>";
	}
	
	$query5="CREATE TABLE Lib_Aut_Klas
			(
				Nr_Seri INT(11) NOT NULL,
				ID_Autor INT(11) NOT NULL
			)";
	if(@mysqli_query($con,$query5))
	{
		echo "Tabela u krijua me sukses. </br>";
	}
	else
	{
		echo "Ndodhi nje gabim gjate krijimit te tabeles: ".@mysqli_error($con)."</br>";
	}
	
	$query6="CREATE TABLE Lib_Kat
	(
		ID_Kat INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
		Kategoria VARCHAR(50) NOT NULL
		
	)";
	if(@mysqli_query($con,$query6))
	{
		echo "Tabela u krijua me sukses. </br>";
	}
	else
	{
		echo "Ndodhi nje gabim gjate krijimit te tabeles: ".@mysqli_error($con)."</br>";
	}
	
	$query7="CREATE TABLE Lib_Klas
	(
		ID_Kat INT(11) NOT NULL,
		Nr_Seri INT(11) NOT NULL
		
	)";
	if(@mysqli_query($con,$query7))
	{
		echo "Tabela u krijua me sukses. </br>";
	}
	else
	{
		echo "Ndodhi nje gabim gjate krijimit te tabeles: ".@mysqli_error($con)."</br>";
	}
	
?>