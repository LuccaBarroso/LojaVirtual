<?php
     $title="Admin";
     include_once("./view/base/top.php");
     include_once("./view/topNavBar.php");
     include_once("./banco/banner.php");
     include_once("./banco/userAuth.php");
     include_once("./banco/database.php");
     redirectIfNotAdmin();

     $inicio_error = $final_error = $imagem_error  = "";
     
     if($_SERVER["REQUEST_METHOD"] == "POST"){
      
      
      if(isset($_POST["inicio"])){
         $inicio = htmlspecialchars($_POST["inicio"]);
      }
      if($inicio == ""){
         $inicio_error = "É necessário que o banner tenha uma data de inicio!";
      }
      
      if(isset($_POST["final"])){
         $final = htmlspecialchars($_POST["final"]);
      }
      if($final == ""){
         $final_error = "É necessário que o banner tenha uma data de final!";
      }

      if($inicio_error == "" && $final_error == ""){
         if(!empty($_FILES["imagem"]["name"])) {
            $fileName = $_FILES["imagem"]["name"];
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $path = "./uploads/banners/banner".rand().".".$fileType;
            
            if(in_array($fileType, array('jpg','png','jpeg'))){
               if(createNewBanner($path, $inicio, $final)){
                  move_uploaded_file($_FILES["imagem"]["tmp_name"], $path);
                  header("Location: http://localhost/adminMain.php?msg=Produto Criado com Sucesso&type=success");
               }
            }else{ 
              $imagem_error = 'Só são permitidos os formatos JPG, JPEG e PNG.'; 
            }
         }else{
            $imagem_error = "É necessário que o produto tenha uma imagem!";
         }
      }
     }
?>

    <div class="card center pt-2 mt-5 mx-auto" style="width: 500px;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="POST" class="card-body">
            <h4 class="card-title">Criando Banner</h4>
            <div class="form-group">
               <label for="inicio">Data de início:</label>
               <input type="date" class="form-control" name="inicio">
            </div>
            <?php
               if($inicio_error != ""){
                  echo "<p class='alert alert-warning'>". $inicio_error ."</p>";
               }
            ?>
            <div class="form-group">
               <label for="final">Data de final:</label>
               <input type="date" class="form-control" name="final">
            </div>
            <?php
               if($final_error != ""){
                  echo "<p class='alert alert-warning'>". $final_error ."</p>";
               }
            ?>
            <div class="form-group">
               <label for="preco">Imagem:</label>
               <input type="file" class="btn" name="imagem">
            </div>
            <?php
               if($imagem_error != ""){
                  echo "<p class='alert alert-warning'>". $imagem_error ."</p>";
               }
            ?>
            <button type="submit" class="btn btn-primary">Criar</button>
        </form>
    </div>

<?php
     include_once("./view/base/bottom.php");
?>