<?php
	$con=@mysqli_connect("localhost","root","");
	if(!$con)
	{
		echo "Nuk u realizua lidhja". @mysqli_connect_error();
	}
	else 
	{
		echo "Lidhja u realizua";
	}
	
	$query="CREATE DATABASE Libraria";
	@mysqli_query($con,$query);
	
	if (@mysqli_query($con, $query))
		{
			echo "Databaza u krijua me sukses";
		} 
	else {
			echo "Ndodhi nje gabim gjate krijimit te batabazes " . @mysqli_error($con);
		 }

?>