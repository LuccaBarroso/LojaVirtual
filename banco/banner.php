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
     $banners = array();
     while($produtoAtual = mysqli_fetch_array($result)){
       array_push($banners, $produtoAtual);
     }
     return $banners;
     }else{
     return false;
     }
 }
}

function getValidBanners(){
 require("./banco/database.php");
 $sql = "SELECT * FROM banner order by id";
 $result = mysqli_query($db, $sql);
 if($result!=null){
     if(mysqli_num_rows($result) > 0){
     $banners = array();
     while($produtoAtual = mysqli_fetch_array($result)){
      if(strtotime($produtoAtual['inicio']) <= time() && strtotime($produtoAtual['final']) >= time()){
       array_push($banners, $produtoAtual);
      }
     }
     return $banners;
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
 $sql = "DELETE FROM banner WHERE id=".$id;
 if(mysqli_query($db, $sql)){
   unlink($imgPath);
   header("Location: http://localhost/adminMain.php?msg=Produto Deletado com Sucesso&type=success");
 }else{
   header("Location: http://localhost/adminMain.php?msg=Falha ao deletar o produto&type=danger");
 }
}

function getBannerById($id){
 require("./banco/database.php");
 $sql = "SELECT * FROM banner where id=".$id;
 $result = mysqli_query($db, $sql);
 if($result!=null){
   return mysqli_fetch_assoc($result);
 }else{
   return false;
 }
}

function updateBanner($id, $inicio, $final, $imagem=false){
 require("./banco/database.php");
 $oldPath = getBannerById($id)["imagem"];
 if($imagem == false){
   $imagem = $oldPath;
 }else{
   unlink($oldPath);
 }

 $sql = "UPDATE banner SET 
   inicio='".$inicio."',
   final='".$final."',
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
?>