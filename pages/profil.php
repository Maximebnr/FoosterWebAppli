<?php
    include("ConnexionBase.php");
    global $connexion;
    $connexion = BDDConnexionPDO();
    
    
    
    
    
    if(isset($_POST['delog'])){
    // Suppression des variables de session et de la session
        $_SESSION = array();
        session_destroy();
        
       header('refresh:0;url=index.php?Page=home');
        

    // Suppression des cookies de connexion automatique
       // setcookie('login', '');
       // setcookie('pass_hache', '');
    }
   
?>

<?php
    if (SessionOuverte()==true){
        ?>
        
 <div class="blacktop"></div>

<div class="profile">
    <div class="profile-container">
        <div class="img-container">
            
                <?php

                

                $mv = $_SESSION['id'];

                $avt = $connexion->prepare("SELECT avatar FROM users WHERE id = $mv");
                $avt->execute(['id' => $mv]);
                $avresult = $avt->fetch();

                if($avresult == true){

                    $savatar = $avresult['avatar'];

                    $AfileExt = explode('.',$savatar);
                    $AfileActualExt = strtolower(end($AfileExt));

                    $fileNameNew = $savatar.".".$AfileActualExt;
                
                    $afileDestination = 'assets/imageupload/'.$savatar;


                }

                ?>

        <img src="<?php echo $afileDestination ;?>">
    



        </div>
        <p class="info full-name"> <?php
        
    
        $mv = $_SESSION['id'];

        $avtg = $connexion->prepare("SELECT pseudo FROM users WHERE id = $mv");
        $avtg->execute(['id' => $mv]);
        $avgresult = $avtg->fetch();

        $savatar = $avgresult['pseudo'];
                

        echo $savatar;
        
        ?> </p>

        
        <p class="info role">
            <i class="fas fa-star"></i>
            L'étoile montante
        </p>
        <p class="info place">
            <i class="fas fa-map-marker-alt"></i>
            France
        </p>

        

        <div class="social-container">
            <button class="twitter">
                <i class="fab fa-twitter"></i>
            </button>
            
            <button class="instagram">
                <i class="fab fa-instagram"></i>
            </button>
            
        </div>

                

        <form method='POST'>  
            <button type="submit" name="delog" id="delog" class="submit">Déconnexion</button>
        </form>
        
    </div>




    <div class="profile-modif">
        
    <div class="modif-form sign-in">
                    <form method="POST" enctype="multipart/form-data" class="modif-form">
                        <h2>Modifier image Profil</h2>                          
                            <label class="label-m">
                                <span class="span-m">Image de profil</span>
                                <input class="input-m" type='file' name='imageN' id='imageN'><br/>
                            </label>

                        <button class="submit" type="submit" name="formvalid" id="formvalid">Enregistrer</button>
                    </form>
    </div>


    <div class="modif-form sign-in">
                    <form method="POST" enctype="multipart/form-data" class="modif-form">
                        <h2>Modifier Pseudo</h2>                          
                            <label class="label-m">
                                <span class="span-m">Pseudo</span>
                                <input class="input-m" type='text' name='pseudo' id='pseudo'><br/>
                            </label>

                        <button class="submit" type="submit" name="formvalid2" id="formvalid2">Enregistrer</button>
                    </form>
    </div>





<?php

        if(isset($_POST['formvalid'])){

            extract($_POST);

           

            //système d'upload d'image

            $file = $_FILES['imageN'];


            $fileName = $_FILES['imageN']['name'];
            $fileTmpName = $_FILES['imageN']['tmp_name'];
            $fileSize = $_FILES['imageN']['size'];
            $fileError = $_FILES['imageN']['error'];
            $fileType = $_FILES['imageN']['type'];

            $fileExt = explode('.',$fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

                if(in_array($fileActualExt, $allowed)){
                    if($fileError === 0){
                        if($fileSize < 5000000){

                            $fileNameNew = uniqid('', true).".".$fileActualExt;
                            $fileDestination = 'assets/imageupload/'.$fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDestination);

                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?Page=profil">';
                        
                        }
                        else{
                            echo 'Le fichier est trop volumineux';
                        }

                    }
                    else
                    echo 'Erreur lors du téléchargement!';
                }
                else{
                    echo 'Erreur de type du fichier';
                    }
                    
                    //fin du système d'upload



                    
                
                //requête
                    $n2 = $connexion->prepare("UPDATE users SET avatar = :imageN WHERE id = :id");
                
                    $n2->execute([
                        'imageN' => $fileNameNew,
                        'id' => $_SESSION['id'] 
                    ]);          
                        
        }




        if(isset($_POST['formvalid2'])){

            extract($_POST);

            
            $cs = $connexion->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
            $cs->execute(['pseudo' => $pseudo]);

            $result = $cs->rowCount();

            if($result == 0){
                            
                    //requête
                    $n2 = $connexion->prepare("UPDATE users SET pseudo = :pseudo WHERE id = :id");
                        
                    $n2->execute([
                        'pseudo' => $pseudo,
                        'id' => $_SESSION['id'] 
                    ]);   
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?Page=profil">'; 
            }
            else{
                
                echo "Ce pseudo est déja utilisé";
            }

                       
                        
        }



?>



             

        <button class="action message">Mot de passe oublié</button>
    </div>
</div>
        

        <?php
            if(EtreAdministrateur() == 1){
                ?>
                <a href="index.php?Page=paneladmin">Panneau d'admin</a>
                <?php
            }
        ?>  
        
               
    </div>    

        <?php
    }
    else{
         
        ?>
<div class="blacktop"></div>

            <div class="container-form">
                <div class="content-form">
                    <div class="form sign-in">
                        <form method="POST" class="login-form">
                            <h2>Se connecter</h2>
                            <label>
                                <span>Pseudo</span>
                                <input type="text" name="lpseudo" id="lpseudo" required><br/>
                            </label>
                            <label>
                                <span>Password</span>
                                <input type="password" name="lpassword" id="lpassword" required><br/>
                            </label>
                            <button class="submit" type="submit" name="formlogin" id="formlogin">Se connecter</button>
                            <p class="forgot-pass">Mot de passe oublié ?</p>
                        </form>

                    <div class="social-media">
                        <ul>
                        <li><img src="assets/img/facebook.png"></li>
                        <li><img src="assets/img/twitter.png"></li>
                        <li><img src="assets/img/linkedin.png"></li>
                        <li><img src="assets/img/instagram.png"></li>
                        </ul>
                    </div>
                    </div>

                    <div class="sub-cont">
                    <div class="img">
                        <div class="img-text m-up">
                        <h2>Pas encore inscrit?</h2>
                        <p>Inscrit toi et viens jouer avec nous !</p>
                        </div>
                        <div class="img-text m-in">
                        <h2>Déja un compte?</h2>
                        <p>Si vous avez déja un compte, connectez vous!</p>
                        </div>
                        <div class="img-btn">
                        <span class="m-up">S'inscrire</span>
                        <span class="m-in">Connexion</span>
                        </div>
                    </div>



        <form method="POST" class="login-form">
            <div class="form sign-up">
                <h2>S'inscrire</h2>
                    <label>
                        <span>Pseudo</span>
                        <input type="text" name="pseudo" id="pseudo" required><br/>
                    </label>

                    <label>
                        <span>Email</span>
                        <input type="email" name="semail" id="semail"  required><br/>
                    </label>

                    <label>
                        <span>Password</span>
                        <input type="password" name="password" id="password"  required><br/>
                    </label>
                
                    <label>
                        <span>Confirm Password</span>
                        <input type="password" name="cpassword" id="cpassword"  required><br/>
                    </label>

                    <button type="submit" class="submit" name="form-register" id="form-register">S'inscire maintenant</button>
            </div>
        </form>




        <?php

                if(isset($_POST['form-register'])){

                  $fileNameD = "avatardefaut.jpg";
                  $avatard = 'assets/img/'.$fileNameD;

                    extract($_POST);

                    if(!empty($password) && !empty($cpassword) && !empty($semail) && !empty($pseudo)){

                        if($password == $cpassword){
                        $options = [
                            'cost' => 12,
                        ];

                        $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

                

                        $c = $connexion->prepare("SELECT email FROM users WHERE email = :email");
                        $c->execute(['email' => $semail]);

                        $result = $c->rowCount();

                        if($result == 0){
                            
                            $w = $connexion->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
                            $w->execute(['pseudo' => $pseudo]);

                            $resultw = $w->rowCount();

                            if($resultw ==0 ){

                                $q = $connexion->prepare("INSERT INTO users(pseudo,email,password,avatar) VALUES (:pseudo,:email,:password,:avatar)");
                           
                                $q->execute([
                                    'pseudo' => $pseudo,
                                    'email' => $semail,
                                    'avatar' => $fileNameD,
                                    'password' => $hashpass 
                                ]);
                                
                                //echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?Page=profil">';
                            }
                            else{
                                
                                echo "Ce pseudo est déja utilisé";
                            }   

                           
                        }
                        else{
                            
                            echo "Cet email est déja utilisé";
                        }

                        
                    }
                    else{
                        echo "Les mots de passes ne correspondent pas !";
                    }
                   
                }
                else{
                    echo "les champs ne sont pas tous remplies";
                }
            }

            ?>


                    </div>
                </div>
            </div>

        <?php


            if(isset($_POST['formlogin'])){

                extract($_POST);

                if(!empty($lpassword) && !empty($lpseudo)){

                    $q = $connexion->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
                    $q->execute(['pseudo' => $lpseudo]);
                    $result = $q->fetch();

  

                    if($result == true){
                        //le compte existe

                        $hashpassword = $result['password'];
                        if(password_verify($lpassword, $hashpassword)){

                            
                            $_SESSION['id'] = $result['id'];
                            $_SESSION['pseudo'] = $lpseudo;
                            $_SESSION['admin'] = $result['admin'];
                            
                        
                            


                            var_dump($_SESSION);
                            

                            
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?Page=profil">';    
exit; 
                            echo "Vous êtes connecté";
                        
                                        
                                
                            
                        }
                        else{
                            echo "Mot de passe incorrecte";
                        }
                    }
                    else{
                        echo "Il n'y a pas de compte associé à ce pseudo";
                    }

                }                   
                else{
                    echo "Veuillez completer l'ensemble des champs";
                }

            }

    }


?>





