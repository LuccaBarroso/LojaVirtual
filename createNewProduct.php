<?php
     $title="Admin";
     include_once("./view/base/top.php");
     include_once("./view/topNavBar.php");
     include_once("./banco/produtos.php");
     include_once("./banco/userAuth.php");
     include_once("./banco/database.php");
     redirectIfNotAdmin();

     $nome_error = $descricao_error = $preco_error = $imagem_error = $inicio_error = $final_error = $desconto_error = "";
     $inicio = $final = $desconto = "";
     
     if($_SERVER["REQUEST_METHOD"] == "POST"){
      
      if(isset($_POST["nome"])){
         $nome = htmlspecialchars($_POST["nome"]);
      }
      if($nome == ""){
         $nome_error = "É necessário que o produto tenha um nome!";
      }
      
      if(isset($_POST["descricao"])){
         $descricao = htmlspecialchars($_POST["descricao"]);
      }
      if($descricao == ""){
         $descricao_error = "É necessário que o produto tenha um descricao!";
      }

      if(isset($_POST["preco"])){
         $preco = htmlspecialchars($_POST["preco"]);
      }
      if($preco == ""){
         $preco_error = "É necessário que o produto tenha um preco!";
      }
      
      if(isset($_POST["inicio"])){
         $inicio = htmlspecialchars($_POST["inicio"]);
      }
      if(isset($_POST["final"])){
         $final = htmlspecialchars($_POST["final"]);
      }
      if(isset($_POST["desconto"])){
         $desconto = htmlspecialchars($_POST["desconto"]);
      }
      
      if($preco_error == "" && $descricao_error == "" && $nome_error == ""){
         if(!empty($_FILES["imagem"]["name"])) {
            $fileName = $_FILES["imagem"]["name"];
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $path = "./uploads/produtos/".$nome.rand().".".$fileType;
            
            if(in_array($fileType, array('jpg','png','jpeg'))){
               $result = "";
               if($inicio == "" && $final == "" && $desconto == ""){
                  $result = createNewProduct($nome, $descricao, $preco, $path);
               }else{
                  if($inicio == ""){
                     $inicio_error = "É necessário que o produto tenha uma data de início de desconto ou não tenha nenhuma informação de desconto!";
                  }else if($final == ""){
                     $final_error = "É necessário que o produto tenha uma data de final de desconto ou não tenha nenhuma informação de desconto!";
                  }else if($desconto == ""){
                     $desconto_error = "É necessário que o produto tenha uma porcentagem de desconto ou não tenha nenhuma informação de desconto!";
                  }else if($desconto < 0 || $desconto > 100){
                        $desconto_error = "É necessário que o produto tenha uma porcentagem de desconto entre 0 e 100 ou não tenha nenhuma informação de desconto!";
                  }else{
                     $result = createNewProduct($nome, $descricao, $preco, $path, $inicio, $final, $desconto);
                  }
               }
               
               if($result){
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
            <h4 class="card-title">Criando Produto</h4>
            <div class="form-group">
               <label for="nome">Nome:</label>
               <input type="text" class="form-control" name="nome">
            </div>
            <?php
               if($nome_error != ""){
                  echo "<p class='alert alert-warning'>". $nome_error ."</p>";
               }
            ?>
            <div class="form-group">
               <label for="descricao">Descrição:</label>
               <input type="text" class="form-control" name="descricao">
            </div>
            <?php
               if($descricao_error != ""){
                  echo "<p class='alert alert-warning'>". $descricao_error ."</p>";
               }
            ?>
            <div class="form-group">
               <label for="preco">Preço:</label>
               <input type="number" min="0.00" step="0.01" class="form-control" name="preco">
            </div>
            <?php
               if($preco_error != ""){
                  echo "<p class='alert alert-warning'>". $preco_error ."</p>";
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
            <hr>
            <div class="form-group">
               <label for="inicio">Inicio desconto (Opcional):</label>
               <input type="date" class="form-control" name="inicio">
            </div>
            <?php
               if($inicio_error != ""){
                  echo "<p class='alert alert-warning'>". $inicio_error ."</p>";
               }
            ?>
            <div class="form-group">
               <label for="final">Final desconto (Opcional):</label>
               <input type="date" class="form-control" name="final">
            </div>
            <?php
               if($final_error != ""){
                  echo "<p class='alert alert-warning'>". $final_error ."</p>";
               }
            ?>
            <div class="form-group">
               <label for="desconto">Porcentagem de desconto (Opcional):</label>
               <input type="number" min="0" max="100" step="1" class="form-control" name="desconto">
            </div>
            <?php
               if($desconto_error != ""){
                  echo "<p class='alert alert-warning'>". $desconto_error ."</p>";
               }
            ?>
            <button type="submit" class="btn btn-primary">Criar</button>
        </form>
    </div>

<?php
     include_once("./view/base/bottom.php");
?>