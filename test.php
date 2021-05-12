
<?php
   include("ConnexionBase.php");
   global $connexion;
   $connexion = BDDConnexionPDO();
   
?>





<div class="blacktop"></div>

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


var_dump($connexion);

    

   
            
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
        



  
 

