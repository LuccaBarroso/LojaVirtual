<!-- 
CREATE TABLE `banner` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `imagem` VARCHAR(255) NOT NULL,
 `inicio` DATETIME NOT NULL,
 `final` DATETIME NOT NULL,
 primary key(id)
);
-->
<?php
 
function getBanners(){
 require("./banco/database.php");
 $sql = "SELECT * FROM banner order by id";
 $result = mysqli_query($db, $sql);
 if($result!=null){
     if(mysqli_num_rows($result) > 0){
     $produtos = array();
     while($produtoAtual = mysqli_fetch_array($result)){
       array_push($produtos, $produtoAtual);
     }
     return $produtos;
     }else{
     return false;
     }
 }
}

function createNewBanner($imagem, $inicio, $final){
 require("./banco/database.php");
 $sql = "INSERT INTO banner (imagem, inicio, final) VALUES (?, ?, ?)";
 $stmt = mysqli_prepare($db, $sql);
 mysqli_stmt_bind_param($stmt, "sss",$param_imagem, $param_inicio, $param_final);
 
 $param_imagem = $imagem;
 $param_inicio = date ('Y-m-d H:i:s',strtotime($inicio));
 $param_final = date ('Y-m-d H:i:s',strtotime($final));
 

 //tenta executar
 if(mysqli_stmt_execute($stmt)){
   return true;
 }else{
   header("Location: http://localhost/adminMain.php?msg=Falha ao criar o produto&type=danger");
 }
}

function deleteBanner($id){
 require("./banco/database.php");
 $imgPath = getBannerById($id)["imagem"];
 $sql = "DELETE FROM produtos WHERE id=".$id;
 if(mysqli_query($db, $sql)){
   unlink($imgPath);
   header("Location: http://localhost/adminMain.php?msg=Produto Deletado com Sucesso&type=success");
 }else{
   header("Location: http://localhost/adminMain.php?msg=Falha ao deletar o produto&type=danger");
 }
}

function getBannerById($id){
 require("./banco/database.php");
 $sql = "SELECT * FROM produtos where id=".$id;
 $result = mysqli_query($db, $sql);
 if($result!=null){
   return mysqli_fetch_assoc($result);
 }else{
   return false;
 }
}

function updateBanner($id, $nome, $descricao, $preco, $imagem=false){
 require("./banco/database.php");
 $oldPath = getBannerById($id)["imagem"];
 if($imagem == false){
   $imagem = $oldPath;
 }else{
   unlink($oldPath);
 }

 $sql = "UPDATE produtos SET 
   nome='".$nome."',
   descricao='".$descricao."',
   preco='".$preco."',
   imagem='".$imagem."'
   WHERE id=".$id;

 if (mysqli_query($db, $sql)) {
  return true; 
 }else{
   header("Location: http://localhost/adminMain.php?msg=Falha ao Atualizar o prodduto&type=danger");
 }
}

function viewBanner($id){
 require("./banco/database.php");
 $sql = "UPDATE produtos SET view=view+1 WHERE id=".$id;
 if (mysqli_query($db, $sql)) {
  return true; 
 }
}

function getMostViewedBanners(){
 require("./banco/database.php");
 $sql = "SELECT * FROM produtos order by view desc limit 8";
 $result = mysqli_query($db, $sql);
 if($result!=null){
     if(mysqli_num_rows($result) > 0){
     $produtos = array();
     while($produtoAtual = mysqli_fetch_array($result)){
       array_push($produtos, $produtoAtual);
     }
     return $produtos;
     }else{
     return false;
     }
 }
}

function generateBannerHTML($Banner){
 echo '
 <div class="card p-1 pt-3 m-2">
     <a href="./Banner.php?id='.$Banner["id"].'" class="text-dark">
     <img src="'.$Banner["imagem"].'"
     class="card-img-top" alt="placeholder" style="width: 250px;"/>
     <div class="d-flex">
         <h5 class="card-title mr-auto ml-2">'.$Banner["nome"].'</h5>
         <p class="mr-1">'.$Banner["view"].'<i class="bi-eye pl-1"></i></p>
     </div>
     </a>
     <div class="d-flex justify-content-around font-weight-bold mt-4">
         <span class="pt-1">$'.number_format($Banner["preco"], 2, ',', '.').'</span><span><a href="./addBannerToCart.php?id='.$Banner["id"].'" class="btn btn-success mb-2">Adicionar</a></span>
     </div>
 </div>
 ';
}
?>