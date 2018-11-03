<?php
if(isset($_GET['getAct'])){
    $getAct = $_GET['getAct'];

    switch($getAct){
            case 1:
                Login();
            break;
            case 2:
                Logout();
            break;
            case 3:
                AllUserData();
            break;
            case 4:
                getSession();
                break;
            case 5:
                AllUserDataResidos();
              break;
            case 6:
                  EmpresasParceiras();
              break; 
            case 7:
                  //uploadImg();
            break;
            default:
            echo ('{"status": "error", "msg":"Need act"}');
        }
}
if(isset($_POST['postAct'])){
    $postAct = $_POST['postAct'];
    switch($postAct){
            case 1:
                Cadastro();
            break;
            case 2:
                cadastraAnuncio();
            break;

            default:
            echo ('{"status": "error", "msg":"Need act"}');
        }

}



function cadastraAnuncio(){
    $db = new PDO('mysql:host=localhost;dbname=api;charset=utf8mb4', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    if(isset($_POST['data']) 
    && isset($_POST['name_r'])
    && isset($_POST['qtd']) 
    && isset($_POST['cep'])
    && isset($_POST['number']) 
    && isset($_POST['resid']) //Situação do residuo 
    && isset($_POST['cat'])) // tipo de resíduo
    {
        if(isset($_POST['name_r']))
            $name_r = $_POST['name_r'];

        if(isset($_POST['data']))
            $data = $_POST['data'];

        if(isset($_POST['qtd']))
            $qtd = $_POST['qtd'];    
    
        if(isset($_POST['cep']))
            $cep = $_POST['cep'];   

        if(isset($_POST['number']))
            $number = $_POST['number'];

        if(isset($_POST['resid']))
            $resid = $_POST['resid'];

        if(isset($_POST['cat']))
            $cat = $_POST['cat'];

        session_start();
        $owner =  $_SESSION['user_id'];

        try{
            $sql = "
                INSERT INTO `residuos`
                (`nome_r`,
                `categoria_id`, 
                `quantidade`, 
                `dias_disponiveis`, 
                `cep`, 
                `data_criacao`, 
                `id_owner`) 
            VALUES 
                ('$name_r',
                '$cat',
                '$qtd',
                '$data',
                '$cep',
                 NOW(),
                '$owner')";

            //echo $sql;
        
           $stmt_count = $db->prepare($sql);
           
            if($stmt_count->execute()){
                $resul = "<div class='alert alert-success' role='alert'>Seu resíduo foi cadastrado.</div>";
                echo '{"status": "ok"}';
                //header('Location: ../novoProduto.html?ok');
            }else{
                echo '{"status": "error"}';
                $resul = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar seu resíduo, tente novamente.</div>";
            }
            //session_start();
            $_SESSION['aviso'] = $resul;

        }catch(PDOException $ex){
            echo '{"status": "error", "msg": "'.$ex.'"}';
        }
    }
}

//Cadastro PF POST
function Cadastro(){
    $db = new PDO('mysql:host=localhost;dbname=api;charset=utf8mb4', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']))
    {
        if(isset($_POST['nome']))
        $nome = $_POST['nome'];
        if( isset($_POST['email']))
        $email = $_POST['email'];
        if(isset($_POST['senha']))
        $senha = $_POST['senha'];
        try{
            $sql = "INSERT INTO `usuarios`(`nome`, `email`, `senha`, `nivel_id`, `tipo_conta`, `qnt_pontos`) VALUES ('$nome','$email','$senha','1','pf','0')";
            $stmt_count = $db->prepare($sql);
            if($stmt_count->execute()){
                echo '{"status": "ok"}';
            }else{
                echo '{"status": "error"}';
            }

        }catch(PDOException $ex){
            echo '{"status": "error", "msg": "'.$ex.'"}';
        }
    }
}


//Login PF GET

function Login(){
    $db = new PDO('mysql:host=localhost;dbname=api;charset=utf8mb4', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    if(isset($_GET['email']) && isset($_GET['senha'])){

        if(isset($_GET['email']))
          $email = $_GET['email'];

        if(isset($_GET['senha']))
          $senha = $_GET['senha'];

        try{
            $sql = ("SELECT * FROM `usuarios` WHERE `email` = '$email' AND `senha` = '$senha'");

            $stmt = $db->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($users) <= 0){
                echo '{"status": "false", "act": "login"}';
                //var_dump($users);
            }else{
                $user = $users[0];

                session_start();
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nome'];
                $_SESSION['user_email'] = $user['email'];
                echo '{"status": "true", "tipo": "'.$user['tipo_conta'].'", "act": "login"}';
            }
        }catch(PDOException $ex){
            echo '{"status": "false", "msg": "'.$ex.'"}';
        }
    }
}

function getSession(){
    $SESSION['user_email'];
}

//Get All User Data
function AllUserData(){
    $db = new PDO('mysql:host=localhost;dbname=api;charset=utf8mb4', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        session_start();
        $email = $_SESSION['user_email'];
        try{
            $sql = ("SELECT * FROM `usuarios` WHERE `email` = '$email'");

            $stmt = $db->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($users) <= 0){

                echo json_encode($users);
            }else{
                $user = $users[0];
                echo json_encode($user);

            }
        }catch(PDOException $ex){
            echo '{"status": "false", "msg": "'.$ex.'"}';
        }
}

function Logout(){
    if(isset($_GET['getAct']) && $_GET['getAct'] == '2')
    {
        session_start();
        $_SESSION['logged_in'] = false;
        session_destroy();

        echo '{"status": "true", "act": "logOut"}';
    }
}





//Get All User Data
function AllUserDataResidos(){
    $db = new PDO('mysql:host=localhost;dbname=api;charset=utf8mb4', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        session_start();
        $user_id = $_SESSION['user_id'];
        //echo $user_id;
        try{
            $sql = ("SELECT * FROM `residuos` WHERE `id_owner` = '$user_id'");
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $residuos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($residuos) <= 0){
                //echo json_encode($residuos);
                echo '{"status" : "err" }';
            }else{
                $residuos = $residuos;
                echo json_encode($residuos);

            }
        }catch(PDOException $ex){
            echo '{"status": "false", "msg": "'.$ex.'"}';
        }
}


//Get All User Data
function EmpresasParceiras(){
    $db = new PDO('mysql:host=localhost;dbname=api;charset=utf8mb4', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        session_start();
        $email = $_SESSION['user_email'];
        try{
            $sql = ("SELECT * FROM `empresa_parceira` WHERE `email` = '$email'");

            $stmt = $db->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($users) <= 0){

                echo json_encode($users);
            }else{
                $user = $users[0];
                echo json_encode($user);

            }
        }catch(PDOException $ex){
            echo '{"status": "false", "msg": "'.$ex.'"}';
        }
}

//Fim
?>
