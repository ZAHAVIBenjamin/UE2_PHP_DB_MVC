<?php use App\Database; ?>
<form id="formulaireI" method='post' action="index.php?page=inscription">
    <br>
    <input type='text' name= 'pseudo' placeholder =  'pseudo*' required >
    <br>
    <input type='password' name= 'mdp'  placeholder = 'Mot de passe*' required>
    <br>
    <input type='text' name= 'nom'  placeholder = 'nom*' required>
    <br>
    <input type='text' name= 'prenom' placeholder =  'prenom*' required>
    <br>
    <input type='text' name= 'email' placeholder = 'email*' required>
    <br>
    <input type='text' name= 'phone' placeholder = 'Telephone'>
    <br>
    <p>Adherer à la Newsletter</p><input type='checkbox' name= 'newsLetter'>
    <br>
    <input class="bouttonSocial" type='submit' value=valider >
    <a  class="bouttonSocial" href="index.php">Retour</a>
</form> 
<?php
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email'])) {
       $nom = htmlspecialchars($_POST['nom']);   
       $prenom = htmlspecialchars($_POST['prenom']);   
       $email = htmlspecialchars($_POST['email']);   
       $pseudo = htmlspecialchars($_POST['pseudo']);     
       $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
       if(!empty($_POST['phone'])){
        $phone = htmlspecialchars($_POST['phone']);
       }     
       else{
        $phone = NULL;
       }
       if(isset($_POST['newsLetter'])){
       $newsLetter = 1;
       }
       else{
        $newsLetter = 0;
       }
        $dataBase = new Database();
        $base = $dataBase->getConnection();
        if($base){
            $sqlCre = 
                   'INSERT INTO chasseur (nom, prenom, email, pseudo, mdp , phone, newsLetter)
                    VALUES ( :nom,  :prenom,  :email,  :pseudo, :mdp, :phone, :newsLetter)';

            $stmt = $base->prepare($sqlCre);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':mdp', $mdp);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':newsLetter', $newsLetter);
            $stmt->execute();       
            header('Location: index.php?page=accueil');
            exit;
        }
        else{
            echo("<br>impossible connexion servers");
        }
    }
?>