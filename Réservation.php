<?php //traitement php de la page : le formulaire renvoie sur ce script !

	//test si le formulaire est soumis :
	//si oui, la variable $_POST n'est pas vide et contient les valeurs des input du formulaire
	if(!empty($_POST))
	{
		try{
			
			//recup des valeurs dans des variables
			$name = $_POST["name"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];
            $nombrepersonne = $_POST["nombrepersonne"];
            $horaire = $_POST["horaire"];
            $jours = $_POST["jours"];
            $message = $_POST["message"];

            echo "Infos : ", $name,"", $email,"", $telephone,"", $nombrepersonne,"", $horaire,"", $jours,"",$message; 
            //pour vérifier en debug !

			//connexion à la base de données
			$db="formulaire_reservation"; //le nom de la base de données
			$username="phpmyadmin"; //l'utilisateur mysql
			$password="Doceo4all"; //et son pwd 
			$bdd = null;
			try {
				$bdd = new PDO("mysql:dbname=$db;host=localhost", $username, $password);
			}
			catch(exception $e) {
				die('Erreur :'.$e->getMessage());
			}
			
			//préparation de la requete d'insertion
			//c'est une "requête paramétrée"
            $rep=$bdd->prepare("insert into formulaire_booking (nom, email, telephone, nombre_de_personnes, 
            horaires_reservation, jour_de_reservation, votre_message) values (:name, :email, :telephone, 
            :nombrepersonne, :horaire, :jours, :message)");
			$rep->bindParam('name', $name, PDO::PARAM_STR);
            $rep->bindParam('email', $email, PDO::PARAM_STR);
            $rep->bindParam('telephone', $telephone, PDO::PARAM_STR);
            $rep->bindParam('nombrepersonne', $nombrepersonne, PDO::PARAM_STR);
            $rep->bindParam('horaire', $horaire, PDO::PARAM_STR);
            $rep->bindParam('jours', $jours, PDO::PARAM_STR);
            $rep->bindParam('message', $message, PDO::PARAM_STR);
            

			$rep->execute();
			echo "Inscription effectuée !"; //pour vérifier en debug !
		}
		catch(Exception $e){
			die('Erreur :'.$e->getMessage());
		} 	
	}


?>
