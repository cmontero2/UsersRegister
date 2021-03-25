<?php

require( 'support/class-mo-api-authentication-support.php' );
require( 'support/class-mo-api-authentication-faq.php' );
require( 'config/class-mo-api-authentication-config.php' );
require( 'license/class-mo-api-authentication-license.php' );
require( 'account/class-mo-api-authentication-account.php' );
require( 'demo/class-mo-api-authentication-demo.php' );
require( 'postman/class-mo-api-authentication-postman.php' );
require('class-mo-api-authentication-auth-usage.php');
require( 'advanced/class-mo-api-authentication-advancedsettings.php' );
require ( 'advanced/class-mo-api-authentication-protectedrestapis.php' );
require( 'custom-api-integration/class-mo-api-authentication-custom-api-integration.php' );

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       miniorange
 * @since      1.0.0
 *
 * @package    Miniorange_api_authentication
 * @subpackage Miniorange_api_authentication/admin/partials
 */


function mo_api_authentication_main_menu() {

	$currenttab = "";
	if( isset( $_GET['tab'] ) )
		$currenttab = $_GET['tab'];

	if(!get_option('mo_save_settings'))
	{
		update_option('mo_save_settings',0);
	}

	$currentPageUrl=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
	?>

<div>
<?php 


if(get_option('mo_save_settings')==1){
	update_option('mo_save_settings',2);
?>
<div class="mo_api_main" id="mo_api_main" >
	<div class="mo_api_pop_up" id="mo_api_pop_up" >
	<div class="mo_api_close" id="mo_api_close" >&times;</div>
	
	<div class="mo_api_banner">
				<img style="float:center;" src="<?php echo dirname( plugin_dir_url( __FILE__ ) );?>/images/speed-limit-100.png" width="100"height="100">
				<div style="color:#D12913 ;margin-top: 30px;font-size: 25px;font-weight:900;"><?php echo base64_decode('TU9OVEhMWSBBVVRIRU5USUNBVElPTiBMSU1JVA=='); ?></div>
				<br>
				<h2><?php echo base64_decode('WW91ciBNb250aGx5IGZyZWUgYXV0aGVudGljYXRpb25zIGxpbWl0IGlzIDEwMC4='); ?></h2>
				<h2><?php echo base64_decode('T24gRWFjaCBzdWNjZXNzZnVsIEFQSSBhdXRoZW50aWNhdGlvbiB0aGUgbGltaXQgd2lsbCBiZSBjbG9zZXIu') ;?></h2>
				<?php if((get_option('miniorange_api_authentication_ctr'))=='MA=='){ ?>
				<h2><?php echo base64_decode('WW91IGFyZSB5ZXQgdG8gdXNlIHlvdXIgZmlyc3QgYXV0aGVudGljYXRpb24uIA=='); ?></h2>
				<?php } ?>
				<div>
				<a href="admin.php?page=mo_api_authentication_settings&tab=usage"_blank"><button type="button" style="background-color:#110652;border: 2px solid;margin:15px; width:140px;height: 40px;" class="button button-primary button-large" >Check Usage</button></a>
			</div>
		</div>
</div>
</div>

<?php }
if((base64_decode(get_option('miniorange_api_authentication_ctr')))>=base64_decode('MTAw') && (!empty(array_keys(parse_url($currentPageUrl),'page=mo_api_authentication_settings&tab=config')) || !empty(array_keys(parse_url($currentPageUrl),'page=mo_api_authentication_settings')))){?>
<div class="mo_api_main" id="mo_api_main" >
	<div class="mo_api_pop_up" id="mo_api_pop_up" >
	<div class="mo_api_close" id="mo_api_close" >&times;</div>
	
	<div class="mo_api_banner">
				<img style="float:center;" src="<?php echo dirname( plugin_dir_url( __FILE__ ) );?>/images/sands-of-time.png" width="100"height="100">
				<div style="color:#D12913 ;margin-top: 30px;font-size: 25px;font-weight:900;"><?php echo base64_decode('QVVUSEVOVElDQVRJT04gTElNSVQgUkVBQ0hFRCE='); ?></div>
				<br>
				<h2><?php echo base64_decode('WW91IGhhdmUgZXhoYXVzdGVkIHRoZSBtb250aGx5IGF1dGhlbnRpY2F0aW9uIGxpbWl0Lg=='); ?></h2>
				<h2><?php echo base64_decode('VXBncmFkZSB0byBlbmpveSB1bmxpbWl0ZWQgYXV0aGVudGljYXRpb25zLg=='); ?></h2>
				<div >
				<a href="admin.php?page=mo_api_authentication_settings&tab=licensing"_blank"><button type="button" style="background-color:#110652;border: 2px solid;margin:15px; width:140px;height: 40px;" class="button button-primary button-large" >Upgrade</button></a>
			</div>
		</div>
</div>
</div>
<?php } ?>
	<div>
	<?php 
	Mo_API_Authentication_Admin_Menu::mo_api_auth_show_menu( $currenttab );
	echo '
	<div id="mo_api_authentication_settings">';
		echo '
		<div class="miniorange_container">';
		echo '
		<table style="width:100%;">
			<tr>
				<td style="vertical-align:top;width:65%;" class="mo_api_authentication_content">';
					Mo_API_Authentication_Admin_Menu::mo_api_auth_show_tab( $currenttab );
				// echo '</td><td style="vertical-align:top;padding-left:1%;" class="mo_api_authentication_sidebar">';
					Mo_API_Authentication_Admin_Menu::mo_api_auth_show_support_sidebar( $currenttab );
				echo '</tr>
		</table>
		<div class="mo_api_authentication_tutorial_overlay" id="mo_api_authentication_tutorial_overlay" hidden></div>
		</div>'; ?>
	</div>

<script type="text/javascript">
	
	jQuery(document).ready(function(){

function mo_api_showWindow() {
	jQuery('#mo_api_main').show();
}

mo_api_showWindow();

function mo_api_hideWindow(){
	jQuery('#mo_api_main').hide();
	
}
 
jQuery('#mo_api_close').click(function(){
	mo_api_hideWindow();
})

})
</script>

<?php
}

function mo_api_authentication_show_bfs_note(){
	?>
            <form name="f" method="post" action="" id="mo_oauth_client_bfs_note_form">
            	<?php wp_nonce_field('mo_oauth_client_bfs_note_form','mo_oauth_client_bfs_note_form_field'); ?>
				<input type="hidden" name="option" value="mo_oauth_client_bfs_note_message"/>	
                <div class="notice notice-info"style="padding-right: 38px;position: relative;border-color:red; background-color:black"><h4><center><i class="fa fa-gift" style="font-size:50px;color:red;"></i>&nbsp;&nbsp;
				<big><font style="color:white; font-size:30px;"><b>END OF YEAR SALE: </b><b style="color:yellow;">UPTO 50% OFF!</b></font> <br><br></big><font style="color:white; font-size:20px;">Contact us @ oauthsupport@xecurify.com for more details.</font></center></h4>
				<p style="text-align: center; font-size: 60px; margin-top: 0px; color:white;" id="demo"></p>
				</div>
			</form>
		<script>
		var countDownDate = <?php echo strtotime('Dec 31, 2020 23:59:59') ?> * 1000;
		var now = <?php echo time() ?> * 1000;
		var x = setInterval(function() {
			now = now + 1000;
			var distance = countDownDate - now;
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
				minutes + "m " + seconds + "s ";
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("demo").innerHTML = "EXPIRED";
			}
		}, 1000);
		</script>
		<?php
}

class Mo_API_Authentication_Admin_Menu {
	
	public static function mo_api_auth_show_menu( $currenttab ) { 

		$mo_api_class='mo_api_auth_notice';
		$mo_api_padding='10px';
		if($currenttab=='licensing'){
		$mo_api_class='mo_api_auth_notice2';
		$mo_api_padding='5px';
		}
		 ?>

		<div class="wrap">
			<div>
				<img style="float:left;" src="<?php echo dirname( plugin_dir_url( __FILE__ ) );?>/images/logo.png">
			</div>
		</div>
		<div class="wrap">
	       	<h1>
	            miniOrange API Authentication&nbsp
	           	<a class="add-new-h2" href="https://forum.miniorange.com/" target="_blank">Ask questions on our forum</a>
				<a class="add-new-h2" href="https://faq.miniorange.com/" target="_blank">FAQ</a>
				<a class="add-new-h2" href="https://plugins.miniorange.com/wordpress-rest-api-authentication" target="_blank">Know More</a>
				<a class="add-new-h2" href="admin.php?page=mo_api_authentication_settings&tab=postman" style="background-color: #ff6c37;color:white;border-color:white">Postman Samples</a>
				<a class="add-new-h2" href="admin.php?page=mo_api_authentication_settings&tab=usage" style="background-color: #E5280A;color:white;border-color:white">Authentications Usage</a>
	       	</h1>
       	</div>
        <style>
            .add-new-hover:hover{
                color: white !important;
            }
        </style>

		<?php
		$today = date("Y-m-d H:i:s");
		$date = "2020-12-31 23:59:59";

		if ( $today <= $date )
			mo_api_authentication_show_bfs_note();

		?>

	<div class="notice notice-warning is-dismissible <?php echo $mo_api_class ?>" style="padding-bottom:<?php echo $mo_api_padding ?>;margin-bottom: 2px;margin-top: 1px;">
	<?php 

	if($mo_api_class=='mo_api_auth_notice2'){ ?>
	<h3 style="color: white;font-size: 18px;font-weight: 340;margin-top: 10px;"><strong>We provide <span style="font-weight: 800;">100</span> Authentications per month in our free version. <a href="admin.php?page=mo_api_authentication_settings&tab=usage"_blank" style="color:#9acee6 ">Click here</a > to check the usage.</strong></h3>
	<?php }
	if($mo_api_class=='mo_api_auth_notice'){?>
	<h3 style="color: white;font-weight: 850;"><strong>We provide <span style="font-weight: 800;">100</span> Authentications per month in our free version.  <a href="admin.php?page=mo_api_authentication_settings&tab=usage"_blank" style="color: #9acee6">Click here</a> to check the usage.</strong></h3>
	<?php } ?>

	</div>

		<div id="tab">
			<h2 class="nav-tab-wrapper">
				<a class="nav-tab <?php if( $currenttab == '' || $currenttab == 'config' ) echo 'nav-tab-active';?>" href="admin.php?page=mo_api_authentication_settings&tab=config">Configure API Authentication</a>
                <a class="nav-tab <?php if( $currenttab == 'protectedrestapis' ) echo 'nav-tab-active';?>" href="admin.php?page=mo_api_authentication_settings&tab=protectedrestapis">Protected REST APIs</a>
                <a class="nav-tab <?php if( $currenttab == 'advancedsettings' ) echo 'nav-tab-active';?>" href="admin.php?page=mo_api_authentication_settings&tab=advancedsettings">Advanced Settings</a>
				<a class="nav-tab <?php if( $currenttab == 'custom-integration' ) echo 'nav-tab-active';?>" href="admin.php?page=mo_api_authentication_settings&tab=custom-integration">Custom API Authentication</a>
				<a class="nav-tab <?php if($currenttab == 'requestfordemo') echo 'nav-tab-active';?>" href="admin.php?page=mo_api_authentication_settings&tab=requestfordemo">Request For Demo</a>
				<a class="nav-tab <?php if($currenttab == 'account') echo 'nav-tab-active';?>" href="admin.php?page=mo_api_authentication_settings&tab=account">Account Setup</a>
				<a class="nav-tab <?php if($currenttab == 'licensing') echo 'nav-tab-active';?>" href="admin.php?page=mo_api_authentication_settings&tab=licensing">Licensing Plans</a>
			</h2>
		</div> 
	</div>
</div>
	<?php } 
	
	public static function mo_api_auth_show_tab( $currenttab ) { 
		if($currenttab == 'account') {
			if (get_option ( 'mo_api_authentication_verify_customer' ) == 'true') {
				Mo_API_Authentication_Admin_Account::verify_password();
			} else if (trim ( get_option ( 'mo_api_authentication_email' ) ) != '' && trim ( get_option ( 'mo_api_authentication_admin_api_key' ) ) == '' && get_option ( 'mo_api_authentication_new_registration' ) != 'true') {
				Mo_API_Authentication_Admin_Account::verify_password();
			}
			else {
				Mo_API_Authentication_Admin_Account::register();
			}
		} elseif( $currenttab == '' || $currenttab == 'config') 
    		Mo_API_Authentication_Admin_Config::mo_api_authentication_config();
		elseif( $currenttab == 'protectedrestapis')
            Mo_API_Authentication_Admin_ProtectedRestAPIs::mo_api_authentication_protectedrestapis();
    	elseif( $currenttab == 'advancedsettings') 
			Mo_API_Authentication_Admin_AdvancedSettings::mo_api_authentication_advancedsettings();
		elseif( $currenttab == 'custom-integration' )
			Mo_API_Authentication_Admin_CustomAPIIntegration::mo_api_authentication_customintegration();			
    	elseif( $currenttab == 'requestfordemo') 
    		Mo_API_Authentication_Admin_RFD::mo_api_authentication_requestfordemo();
    	elseif( $currenttab == 'faq') 
    		Mo_API_Authentication_Admin_FAQ::mo_api_authentication_faq();
    	elseif( $currenttab == 'licensing')
			Mo_API_Authentication_Admin_License::mo_api_authentication_licensing_page();
		elseif( $currenttab == 'postman')
			Mo_API_Authentication_Postman::mo_api_authentication_postman_page();
		else if($currenttab == 'usage')
			Mo_API_Authentication_Usage::mo_api_authentication_usage_page();
	} 
	public static function mo_api_auth_show_support_sidebar( $currenttab ) { 
		if( $currenttab != 'licensing' ) { 
			echo '<td style="vertical-align:top;padding-left:1%;" class="mo_api_authentication_sidebar">';
			echo Mo_API_Authentication_Admin_Support::mo_api_authentication_support();
			echo '<br>';
			echo Mo_API_Authentication_Admin_Support::mo_api_authentication_advertise();
			echo '</td>';
		}
	}
		
}