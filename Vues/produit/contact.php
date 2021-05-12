<link rel="stylesheet" media="screen" type="text/css" title="Exemple" href="Styles/Tableaux.css" />
<script language="javascript">
	function IsMail(email) {
		return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email));
	};

	function Verifier() {
		var erreur = "Vous n'avez pas renseigné les informations suivantes : \n";
		var bool = "true";

		if (document.FormContact.nom.value == "") {
			erreur = erreur + "- votre nom de famille\n";
			bool = "false";
		}

		if (document.FormContact.prenom.value == "") {
			erreur = erreur + "- votre prénom\n";
			bool = "false";
		}
		var i = 5;
		while ((i < 8) && (document.FormContact[i].checked == false)) {
			i++;
		}
		if (document.FormContact[i].checked == false) {
			erreur = erreur + "- votre profession\n";
			bool = "false";
		}

		if (document.FormContact.email.value == "") {
			erreur = erreur + "- votre email\n";
			bool = "false";
		}

		if (document.FormContact.demande.value == "") {
			erreur = erreur + "- votre demande\n";
			bool = "false";
		} else {
			if (!IsMail(document.FormContact.email.value)) {
				erreur = erreur + "- email non valide\n";
				bool = "false";
			}
		}

		if (bool == "true") {
			return true;
		} else {
			alert(erreur);
			return false;
		}

	}
</script>

<p align=center> </p>
<h3 align=center> Société LaFleur </h3>
<hr>
<h4 align=center> 6, rue des Primevères
	<br /> 53000 LAVAL
	<br /> Téléphone 02.43.84.65.74 </h4>
<hr>
<p align="center"> Pour nous écrire : <a href="mailto:lafleur@orange.fr">lafleur@orange.fr</a>
	<br />
	<?php

	require_once("Vues/Fonctions.php");
	if (!isset($_POST['email'])) { ?>
		ou laissez-nous votre demande ci-dessous

</p>
<form id="FormContact" name="FormContact" method="post" action="index.php?page=contact" onsubmit="return Verifier()">
	<table class="table table-bordered">
		<tr>
			<th><label for="civilite">Civilité (*)</label></th>
			<td>
				<select name="civilite">
					<option value="Mme">Madame</option>
					<option value="Mlle">Mademoiselle</option>
					<option value="M." selected="selected">Monsieur</option>
				</select>
			</td>
		</tr>
		<tr>
			<th><label for="nom">Nom (*)</label></th>
			<td><input name="nom" type="text" id="nom" size="25" required /></td>
		</tr>
		<tr>
			<th><label for="prenom">Pr&eacute;nom (*)</label></th>
			<td><input name="prenom" type="text" id="prenom" size="25" required /></td>
		</tr>
		<tr>
			<th><label for="sexe">Sexe (*)</label></th>
			<td><input name="sexe" type="radio" id="sexe" value="Masculin" checked="checked" />&nbsp;M&nbsp;
				<input name="sexe" type="radio" id="sexe" value="Féminin" />&nbsp;F&nbsp;
			</td>
		</tr>
		<tr>
			<th><label for="profession">Profession (*)</label></th>
			<td><input name="profession1" type="checkbox" id="sports" value="Fleuriste" />&nbsp;Fleuriste&nbsp;
				<input name="profession2" type="checkbox" id="sports" value="Grossiste" />&nbsp;Grossiste
				<input name="profession3" type="checkbox" id="sports" value="Centre commercial" />&nbsp;Centre co
				mmercial
				<input name="profession4" type="checkbox" id="sports" value="Autre" />&nbsp;Autre
			</td>
		</tr>
		<tr>
			<th><label for="email">Email (*)</label></th>
			<td><input name="email" required type="text" id="email" size="50" /></td>
		</tr>
		<tr>
			<th><label for="tel">T&eacute;l&eacute;phone</label></th>
			<td><input name="tel" type="text" id="tel" size="15" /></td>
		</tr>
		<tr>
			<th><label for="demande">Demande (*)</label></th>
			<td><textarea required name="demande" cols="50" rows="7" id="demande"></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input class="btn btn-success" type="submit" name="Valider" id="Valider" value="Envoyer votre message" />
			</td>
		</tr>
	</table>
</form>
<?php } else {
		echo "<br/>";
		$message = "Civilite : " . $_POST['civilite'] . "<br/>";
		$message .= "Nom : " . $_POST['nom'] . "<br/>";
		$message .= "Prenom : " . $_POST['prenom'] . "<br/>";
		$message .= "Sexe : " . $_POST['sexe'] . "<br/>Profession : <br/>";
		if (isset($_POST['profession1'])) $message .= $_POST['profession1'] . "<br/>";
		if (isset($_POST['profession2'])) $message .= $_POST['profession2'] . "<br/>";
		if (isset($_POST['profession3'])) $message .= $_POST['profession3'] . "<br/>";
		if (isset($_POST['profession4'])) $message .= $_POST['profession4'] . "<br/>";
		$message .= "Email : " . $_POST['email'] . "<br/>";
		$message .= "Telephone : " . $_POST['tel'] . "<br/>";
		$message .= "Demande : " . $_POST['demande'];

		echo "Voici les données reçues : <br/>" . $message;

		// Envoi Email format HTML
		echo "<br/>";
		$message = "<table>";
		$message .= "<tr><td>Civilite</td><td>" . $_POST['civilite'] . "</td></tr>";
		$message .= "<tr><td>Nom</td><td>" . $_POST['nom'] . "</td></tr>";
		$message .= "<tr><td>Prenom</td><td>" . $_POST['prenom'] . "</td></tr>";
		$message .= "<tr><td>Sexe</td><td>" . $_POST['sexe'] . "</td></tr><tr><td>Profession</td><td>";
		if (isset($_POST['profession1'])) $message .= $_POST['profession1'] . "<br/>";
		if (isset($_POST['profession2'])) $message .= $_POST['profession2'] . "<br/>";
		if (isset($_POST['profession3'])) $message .= $_POST['profession3'] . "<br/>";
		if (isset($_POST['profession4'])) $message .= $_POST['profession4'] . "<br/>";
		$message .= "</td></tr><tr><td>Email</td><td>" . $_POST['email'] . "</td></tr>";
		$message .= "<tr><td>Telephone</td><td>" . $_POST['tel'] . "</td></tr>";
		$message .= "<tr><td>Demande</td><td>" . $_POST['demande'] . "</td></tr></table>";

		if (EnvoiMailHtml("sebmauguy@gmail.com", $message, "Demande de renseignements"))
			echo "<p align='center'>Votre demande a été prise en compte, nous vous répondrons très prochainement</p>";
		else
			echo "<p align='center'>Echec de l'envoi de votre demande, veuillez recommencer ultérieurement</p>";
	}
?>