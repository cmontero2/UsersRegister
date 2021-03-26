<?php 
/* 
Plugin Name: user register
Description: Registra un usuario en wordpress y a la vez en moodle shorcode[user_register]
Version: 1.0 
Author: Cristina M
*/


function formulario(){

    echo "
    <head><link rel='stylesheet' type='text/css' href='/css/styles.css' media='screen' /> </head>
    <body method='post'>
        <h1>Registrate</h1>
        <form >
            <div>
                <label>Nombre</label>
            </div>
            <div>
                <input type='text'/>
            </div>
            <div>
                <label>Contraseña</label>
            </div>
            <div>
                <input type='password'/>
            </div>           
            <div >
                <button type='button'>Registrate</button>
            </div>
        </form>
    </body>";
}

add_shortcode("user_register", "formulario");