<?php
function login($username, $password, $ip) {

    ## TO DO: remove the following debug when done
    // return ' you are trying to login with u:'.$username. ' p:'.$password;

    $pdo = Database::getInstance()->getConnection();
    ## TO DO: Finish the following query to check if the user and password are matching in the DB
    $get_user_query = 'SELECT * FROM tbl_user WHERE user_name = :username AND user_pass = :password';
    $user_set = $pdo->prepare($get_user_query);
    $user_set->execute(
        array(
            ':username'=>$username,
            ':password'=>$password
        )
    );

    if($found_user = $user_set->fetch(PDO::FETCH_ASSOC)){
        // we found user in the DB, get him in
        $found_user_id = $found_user['user_id'];

        // write the username and userid into session
        $_SESSION['user_id'] = $found_user_id;
        $_SESSION['user_name'] = $found_user['user_fname'];
        $_SESSION['user_level'] = $found_user['user_level'];

        //update the user ip by the current logged in one
        $update_user_query = 'UPDATE tbl_user SET user_ip= :user_ip WHERE user_id=:user_id';
        $update_user_set = $pdo->prepare($update_user_query);
        $update_user_set->execute(
            array(
                ':user_ip'=>$ip,
                ':user_id'=>$found_user_id
            )
        );

        //redirect user back to index.php
        redirect_to('index.php');
        
    } else {
        //this is invalid attempt, reject it
        return 'this is incorrect';
    }
}

function confirm_logged_in($admin_above_only=false) {
    if (!isset($_SESSION['user_id'])) {
        redirect_to("admin_login.php");
    }

    if (!empty($admin_above_only) && empty($_SESSION['user_level'])) {
        redirect_to('index.php');
    }
}

function logout() {
    session_destroy();

    redirect_to('admin_login.php');
}