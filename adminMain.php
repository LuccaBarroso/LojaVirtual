<?php
     $title="Admin";
     include_once("./view/base/top.php");
     include_once("./view/topNavBarAdmin.php");
     include_once("./banco/userAuth.php");
     redirectIfNotAdmin();
     if(isset( $_GET['msg'])){
        echo "
            <div class='d-flex justify-content-center'>
                <p class='alert alert-". $_GET['type']." m-2' style='width:400px;'>"
                    .$_GET['msg'].
                "!</p>
            </div>
        ";
    }
?>
    <!-- usuários -->
    <div class="col-lg-8 pt-4 grid-margin stretch-card m-auto">
        <div class="card center pt-2 mt-2">
            <div class="card-body">
                <h4 class="card-title">Usuários</h4>
                <p class="card-description">
                    Aqui você pode editar os usuários
                </p>
                <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Modificar</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            @require_once("./banco/userAuth.php");
                            $users = getUsuarios();
                            if($users){
                                foreach ($users as $user){
                                    echo '
                                        <tr>
                                            <td>'.$user['id'].'</td>
                                            <td>'.$user['nome'].'</td>
                                            <td>'.$user['email'].'</td>';
                                            if($user['admin']==1){
                                                echo "<td>Sim</td>";
                                            }else{
                                                echo "<td>Não</td>";
                                            }
                                            echo '
                                            <td>
                                                <a href="./updateUser.php?id='.$user['id'].'" class="btn btn-outline-primary" style="height:40px;">
                                                    <p>Editar</p>
                                                </a>
                                                <a href="./deleteUser.php?id='.$user['id'].'" class="btn btn-danger " style="height:40px;">
                                                    <p>Deletar</p>
                                                </a>
                                            </td>
                                        </tr>                                
                                    ';
                                }
                            }else{
                                echo '
                                    <div>
                                        Nenhum usuario encontrado.
                                    </div>
                                ';
                            }
                        ?>
                        
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Produtos -->
    <div class="col-lg-8 pt-4 grid-margin stretch-card m-auto">
        <div class="card center pt-2 mt-2">
            <div class="card-body">
                <div class="container d-flex justify-content-between">
                    <div class="">
                        <h4 class="card-title">Produtos</h4>
                        <p class="card-description">
                            Aqui você pode editar os Produtos
                        </p>
                    </div>
                    <div class="">
                        <a href="./createNewProduct.php" class="btn rol btn-primary">Criar Novo</a>
                    </div>
                </div>
                <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Modificar</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            @require_once("./banco/userAuth.php");
                            $users = getUsuarios();
                            if($users){
                                foreach ($users as $user){
                                    echo '
                                        <tr>
                                            <td>'.$user['id'].'</td>
                                            <td>'.$user['nome'].'</td>
                                            <td>'.$user['email'].'</td>';
                                            if($user['admin']==1){
                                                echo "<td>Sim</td>";
                                            }else{
                                                echo "<td>Não</td>";
                                            }
                                            echo '
                                            <td>
                                                <a href="./updateUser.php?id='.$user['id'].'" class="btn btn-outline-primary" style="height:40px;">
                                                    <p>Editar</p>
                                                </a>
                                                <a href="./deleteUser.php?id='.$user['id'].'" class="btn btn-danger " style="height:40px;">
                                                    <p>Deletar</p>
                                                </a>
                                            </td>
                                        </tr>                                
                                    ';
                                }
                            }else{
                                echo '
                                    <div>
                                        Nenhum usuario encontrado.
                                    </div>
                                ';
                            }
                        ?>
                        
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>


<?php
     include_once("./view/base/bottom.php");
?>