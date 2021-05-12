<?php
    global $db;
    include 'ConnexionBase.php';
    
?>

<?php
    if (SessionOuverte()==true){
        
            if(EtreAdministrateur() == 1){
               // afficher page

               ?>
               <div class="blacktop"></div>



               <main id="main">

                   <!-- ======= Breadcrumbs Section ======= -->
                   <section class="breadcrumbs">
                   <div class="container">

                       <div class="d-flex justify-content-between align-items-center">
                       <h2>Gestion de menu</h2>

                       
                       </div>

                   </div>
                   </section><!-- End Breadcrumbs Section -->

                   <section class="inner-page">
                       <div class="container">
                        <div class="formMenu">
                                <div class="titleMenuF">Ajouter un produit dans le menu</div>
                                <div class="contentMenuF">

                                <form action="POST">
                                    <div class="user-details">
                                    <div class="input-box">
                                        <span class="details">Nom du produit</span>
                                        <input type="text" placeholder="Enter Product Name" name='NameP' id='NameP' required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Description du produit</span>
                                        <input type="textarea" placeholder="Entrer la description du produit" name='DescP' id='DescP' required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Catégorie du produit</span>
                                        <input type="text" placeholder="Entrer la catégorie du produit" name='CatP' id='CatP' required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Prix du produit</span>
                                        <input type="text" placeholder="Entrer le prix du produit (ex:15.8€ )" name='PrixP' id='PrixP' required>
                                    </div>

                                    <button class="submit" type="submit" name="formlogin" id="formlogin">Se connecter</button>

                                    <button class="submit" type="submit" name="formAddProduct" id="formAddProduct">Ajouter</button>
                                    
                                </form>
                                </div>
                        </div>
                       </div>
                   </section>


                   <div class="formMenu">
    <div class="titleMenuF">Ajouter un produit dans le menu</div>
    <div class="contentMenuF">

      <form mathod="POST" >
        <div class="user-details">
          <div class="input-box">
            <span class="details">Nom du produit</span>
            <input type="text" placeholder="Enter Product Name" name='NameP' id='NameP' required>
          </div>
          <div class="input-box">
            <span class="details">Description du produit</span>
            <input type="textarea" placeholder="Entrer la description du produit" name='DescP' id='DescP' required>
          </div>
          <div class="input-box">
            <span class="details">Catégorie du produit</span>
            <input type="text" placeholder="Entrer la catégorie du produit" name='CatP' id='CatP' required>
          </div>
          <div class="input-box">
            <span class="details">Prix du produit</span>
            <input type="text" placeholder="Entrer le prix du produit (ex:15.8€ )" name='PrixP' id='PrixP' required>
          </div>
    

          <input type="submit" value="Ajouter" name='fromAddProduct' id='formAddProduct' >
          <button class="submit" type="submit" name="fromAddProduct" id="fromAddProduct">Enregistrer</button>
        
      </form>


      <?php


if(isset($_POST['formAddProduct'])){




    

   
            
            $wz = $connexion->prepare("SELECT NameP FROM products WHERE NameP = :NameP");
            $wz->execute(['NameP' => $NameP]);

            $resultwz = $wz->rowCount();

            if($resultwz == 0 ){

                $qwz = $connexion->prepare("INSERT INTO products(NameP,DescP,CatP,PrixP) VALUES (:NameP,:DescP,:CatP,:PrixP)");
        
                $qwz->execute([
                    'NameP' => $NameP,
                    'DescP' => $DescP,
                    'CatP' => $CatP,
                    'PrixP' => $PrixP 
                ]);

                
                echo('wsh wsh');
            }
            else{
                
                echo "Ce produit existe déja";
            }   


}
 


?>


    </div>
  </div>

               </main><!-- End #main -->


               <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

       <?php
               
            }
            else{
                 // afficher vous n'etes pas admin

                 ?>
                <div class="blacktop"></div>



                <main id="main">

                    <!-- ======= Breadcrumbs Section ======= -->
                    <section class="breadcrumbs">
                    <div class="container">

                        <div class="d-flex justify-content-between align-items-center">
                        <h1>Vous n'êtes pas Administrateur</h1>

                        
                        </div>

                    </div>
                    </section><!-- End Breadcrumbs Section -->

                    <section class="inner-page">
                        <div class="container">
                            <a href="index.php?Page=home">Accueil</a>
                        </div>
                    </section>

                </main><!-- End #main -->


                <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

        <?php
            }

    }
    else{

        // vous n'êtes pas connecté

        ?>
                <div class="blacktop"></div>



                <main id="main">

                    <!-- ======= Breadcrumbs Section ======= -->
                    <section class="breadcrumbs">
                    <div class="container">

                        <div class="d-flex justify-content-between align-items-center">
                        <h1>Vous n'êtes pas connecté</h1>

                        
                        </div>

                    </div>
                    </section><!-- End Breadcrumbs Section -->

                    <section class="inner-page">
                        <div class="container">
                            <a href="index.php?Page=profil">Se connecter</a>
                        </div>
                    </section>

                </main><!-- End #main -->


                <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

        <?php
    }        
?>  




<?php


if(isset($_POST['formAddProduct'])){


  echo var_dump($_POST);


    extract($_POST);

   
            
            $wz = $db->prepare("SELECT NameP FROM products WHERE NameP = :NameP");
            $wz->execute(['NameP' => $NameP]);

            $resultwz = $wz->rowCount();

            if($resultwz == 0 ){

                $qwz = $db->prepare("INSERT INTO products(NameP,DescP,CatP,PrixP) VALUES (:NameP,:DescP,:CatP,:PrixP)");
        
                $qwz->execute([
                    'NameP' => $NameP,
                    'DescP' => $DescP,
                    'CatP' => $CatP,
                    'PrixP' => $PrixP 
                ]);

                
                
            }
            else{
                
                echo "Ce produit existe déja";
            }   


}
 


?>