<!DOCTYPE html>

<html lang="it">
    <head>
        <link rel="stylesheet" href="./stylesheet.css">
        <meta charset="utf-8">
        <title>Login</title>
    </head>
    
    <body>
        <?php
            //definisco username e password corretti
            $usernameCorretto = "nomeACaso";
            $passwordCorretta = "PasswordUltraSicura"; 
            //funzione di controllo dell'input utente
            function controlloInput($dato){
                $datoSicuro = $dato;
                //elimino eventuale script o caratteri html pericolosi
                if(is_Numeric($datoSicuro)){ // se è un numero, uso filter_input
                    $datoSicuro = filter_input(INPUT_POST, $datoSicuro, FILTER_SANITIZE_NUMERIC);
                }else{//se è una stringa, uso htmlspecialchars
                    $datoSicuro = htmlspecialchars($datoSicuro);
                }
                //elimino eventuali spazi vuoti
                $datoSicuro = trim($datoSicuro);
                //elimino eventuali backslash:
                $datoSicuro = stripslashes($datoSicuro);


                return $datoSicuro;
            }

           
             //controllo l'input
            
            //controllo che i campi non siano vuoti, utilizzando la superglobale $_REQUEST
            if(empty($_REQUEST["name"]) || empty($_REQUEST["password"])){
                header("Location: ../index.html");
                exit(1);
            }
            
            //controllo che il metodo di invio dei dati sia quello previsto, in questo caso POST
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                //recupero i dati inseriti, utilizzando la funzione che ho progettato prima per eliminare input dannosi da parte dell'utente
                $username = controlloInput($_REQUEST["name"]);
                $password = controlloInput($_REQUEST["password"]);
            }else{
                header("Location ../index.html");
                exit(1);
            }
            
            //controllo che password e Username inseriti dall'utente siano corretti
            if($username === $usernameCorretto && $password === $passwordCorretta){
                echo "<h1 class='text'>Accesso Effettuato! Benvenuto, $username!</h1>";
            }else if($username !== $usernameCorretto){
                echo "<h1 class='text'>Il nome utente inserito non è corretto</h1>";
            }else if($password !==$passwordCorretta){
                echo "<h1 class='text'>La password inserita non è corretta</h1>";
            }

            echo "<a href='../index.html'>logout</a>";
        ?>
    </body>

</html>



