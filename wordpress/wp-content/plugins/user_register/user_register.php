<?php 
/* 
Plugin Name: user register
Description: Registra un usuario en wordpress y a la vez en moodle shorcode[user_register]
Version: 1.0 
Author: Cristina M
*/


    function formulario(){

        echo "    
            <h1>Regístrate</h1>
            <form action='' method='post'>
                <div>
                    <label>Nombre de usuario</label>
                </div>
                <div>
                    <input type='text' name='login'/>
                </div>
                <div>
                    <label>Contraseña</label>
                </div>
                <div>
                    <input type='password' name='password'/>
                </div>
                <div>
                    <label>Email</label>
                </div>
                <div>
                    <input type='text' name='email'>
                </div>          
                <div>
                    <button style='margin-top:20px;' type='submit' name='botonRegistro'>Registrate</button>
                </div>
                <div>
                    <button style='margin-top:20px;' type='submit' name='botonCursos'>Ver cursos disponibles</button>
                </div>
            </form>
        ";    
    }

    if(isset($_POST['botonRegistro'])){
        registro();
    }

    if(isset($_POST['botonCursos'])){
        getCursos();        
    }

    function getCursos(){
        $serverUrl = "http://localhost/usersRegister/moodle/webservice/rest/server.php?wstoken=53ff1fd4b825fe46293e3cefa71e851a&wsfunction=core_course_get_courses";
        $restformat = "json";
        $resp = wp_remote_post($serverUrl.'&moodlewsrestformat='.$restformat);
       
        if(isset($resp['body'])){
            $cursos = json_decode($resp['body']);
            //echo gettype($cursos);
            echo "<h4 style='text-align: center; margin-top:5%'>Cursos</h4>";
            foreach($cursos as $res){
                echo "<div>
                    <ul>
                        <li style='text-align: center; list-style:none;'>"
                        .$res->fullname.
                    "   </li>
                    </ul>
                </div>";
            }
        }
        
        
    }

    function registro(){
        if(!function_exists('wp_get_current_user')) {
            include(ABSPATH . "wp-includes/pluggable.php"); 
        }
        $login = $_POST['login'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        //crea el usuario en wordpress
        wp_create_user($login, $password, $email);
        
        //crea el usuario en moodle
        $serverUrl = "http://localhost/usersRegister/moodle/webservice/rest/server.php?wstoken=53ff1fd4b825fe46293e3cefa71e851a&wsfunction=core_user_create_users";
        
        //$user = new stdClass();
        /*        
        $user = array (
            'username' => $login,            
            'email' => $email,
            'lastname' => $login,
            'firstname' => $login,            
            'password' => $password
        );
        
        $users[0]['username']='funciono';
        $users[0]['email']='you@yourhostt.org';
        $users[0]['lastname']='Test2';
        $users[0]['idnumber']='923116';
        $users[0]['firstname']='nombre';
        $users[0]['password']='P@40ssword123!';        
        
        $user1 = new stdClass();
        $user1->username = 'testusername2';
        $user1->password = 'Uk3@0d5wpp';
        $user1->firstname = 'testfirstname2';
        $user1->lastname = 'testlastname2';
        $user1->email = 'testemail2@moodle.com';
        $user1->auth = 'manual';
        $user1->idnumber = 'test2';
        $user1->description = 'asd2';
        $user1->city = 'asd2';
        $user1->country = 'BR';     //list of abrevations is in yourmoodle/lang/en/countries
        
        
        $users = array($user);       
        $params = array('users'=>$users);
        */


        $restformat = "json";
        $resp = wp_remote_post($serverUrl.'&moodlewsrestformat='.$restformat.'&users[0][username]='.$login.'&users[0][email]='.$email.'&users[0][lastname]='.$login.'&users[0][firstname]='.$login.'&users[0][password]='.$password);
        
    }


    add_shortcode("user_register", "formulario");