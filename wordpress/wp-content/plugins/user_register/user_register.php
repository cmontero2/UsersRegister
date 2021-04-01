<?php 
    /* 
    Plugin Name: user register
    Description: Registra un usuario en wordpress y a la vez en moodle shorcode[user_register]
    Version: 1.0 
    Author: Cristina M
    */   
  

    //si se ha pulsado el boton de resgistrarse y los campos del formulario estan rellenados, registra al usuario
    if(isset($_POST['botonRegistro']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) ){
        registro();
    }

    //si pulsan el boton de matricularse
    if(isset($_POST['botonMatricula'])){
        $id_user = formulario(); 
        enrollUserToCourse($id_user, $_POST['cursos']);
        
    }

    //insertar usuario en un curso
    function enrollUserToCourse($id_user, $curso){
        $serverUrl = 'http://localhost/usersRegister/moodle/webservice/rest/server.php?wstoken=53ff1fd4b825fe46293e3cefa71e851a&wsfunction=enrol_manual_enrol_users';
        $enrolment = ['roleid' => 5, 'userid' => $id_user, 'courseid' => $curso];
        $enrolments = array($enrolment);
        $params = array( 'enrolments' => $enrolments );
        $restformat = "json";
        wp_remote_post($serverUrl.'&moodlewsrestformat='.$restformat.'&enrolments[0][roleid]=5&enrolments[0][userid]='.$id_user.'&enrolments[0][courseid]='.$curso);
        
    }

    //validar si el usuario esta en wordpress o está logueado
    function valid_user(){   
        if(!function_exists('wp_get_current_user')) {
            include(ABSPATH . "wp-includes/pluggable.php"); 
        }    
        if($current_user = wp_get_current_user()){        
            //busco los usuarios de moodle y compruebo si existe el usuario logueado en la BD de moodle
            $serverUrl = "http://localhost/usersRegister/moodle/webservice/rest/server.php?wstoken=53ff1fd4b825fe46293e3cefa71e851a&wsfunction=core_user_get_users";
            $restformat = "json";
            $resp = wp_remote_post($serverUrl.'&moodlewsrestformat='.$restformat.'&criteria[0][key]=email&criteria[0][value]='.$current_user->user_email);
    
            if(isset($resp['body'])){
                $users = json_decode($resp['body']);
                
                foreach($users as $user){                    
                    if(count($user)){
                        return $user[0]->id;
                    } else {
                        return false;
                    }                    
                }
            }
        } 
        return false;
    }

    function formulario(){
        if($id_user = valid_user()){
            $cursos = getCursos();
            echo "
                <h4 style='color: #00b6ff'>Elige el curso en el que te quieres matricular</h4>
                <form action='' method='post'>
                    <div>
                        <select style='text-align: center; position:relative' name='cursos'>";
                            foreach($cursos as $curso){
                                echo    "<option value='$curso->id'>"
                                            .$curso->fullname.
                                    "   </option>";
                            }
            echo    "   </select>
                    </div>
                    <div>
                        <button style='margin-top:20px;' type='submit' name='botonMatricula'>Matricularse</button>
                    </div> 
                </form>";
            return $id_user;
        } else {
            echo "    
            <h4 style='color: #00b6ff'>Regístrate o loguea con un usuario validado en Moodle</h4>
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
                    <button style='margin-top:20px;' type='submit' name='botonRegistro'>Registrarse</button>
                </div> 
            </form>"; 
        }
        
                    
    }

    //añadir css pero no funciona
    function apply_styles(){
        wp_enqueue_style('apply_styles', 
        plugins_url('user_register/css/styles.css'));
    }
    add_action('wp_enqueue_style', 'apply_styles');


    //devuelve los cursos actuales
    function getCursos(){
        $serverUrl = "http://localhost/usersRegister/moodle/webservice/rest/server.php?wstoken=53ff1fd4b825fe46293e3cefa71e851a&wsfunction=core_course_get_courses";
        $restformat = "json";
        $resp = wp_remote_post($serverUrl.'&moodlewsrestformat='.$restformat);
        $totalCursos = [];
       
        if(isset($resp['body'])){
            $cursos = json_decode($resp['body']);
            //echo gettype($cursos);
            
            foreach($cursos as $res){
                array_push($totalCursos, $res);
            }           

            return $totalCursos;            
        } 
    }

    //registra a los usuarios
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
        $restformat = "json";
        $resp = wp_remote_post($serverUrl.'&moodlewsrestformat='.$restformat.'&users[0][username]='.$login.'&users[0][email]='.$email.'&users[0][lastname]='.$login.'&users[0][firstname]='.$login.'&users[0][password]='.$password);
        
    }


    add_shortcode("user_register", "formulario");

?>