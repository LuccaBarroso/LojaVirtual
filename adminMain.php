<?php
     $title="Admin";
     include_once("./view/base/top.php");
     include_once("./view/topNavBarAdmin.php");
     include_once("./banco/userInfo.php");
     redirectIfNotAdmin();
?>
    <div class="col-lg-8 grid-margin stretch-card m-auto">
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
                            @require_once("./banco/usuarios.php");
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
                                                <a href="./editUser.php" class="btn btn-outline-primary">
                                                    <p>Editar</p>
                                                </a>
                                                <a href="./deleteUser.php" class="btn btn-danger">
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