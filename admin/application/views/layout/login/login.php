<?php
if (isset($this->session->userdata['logged_in'])) {

header("location: ".base_url()."/login/user_login_process/");
}
?>
<?php
if (isset($logout_message)) {
	echo "<div class='message'>";
	echo $logout_message;
	echo "</div>";
}
?>
<?php
if (isset($message_display)) {
	echo "<div class='message'>";
	echo $message_display;
	echo "</div>";
}
?>
<div id="main">
	<div class="VYMape" aria-hidden="true"><img src="<?php echo base_url() ?>asset/img/main_bg.svg" style="width:100%;height:100%;position:fixed;top:0;left:0;bottom:0;right:0;" /></div>
	<div id="login">
		<div class="logo"></div>
		<h2>Iniciar sesión</h2>
		
		<?php echo form_open('login/user_login_process/'); ?>
		
		<label>UserName :</label>
		<input type="text" name="username" id="name" placeholder="username"/><br /><br />
		<label>Password :</label>
		<input type="password" name="password" id="password" placeholder="**********"/><br/><br />
		<input  class="btn btn-primary" type="submit" value=" Login " name="submit"/><br />
		<?php
			echo "<div class='error_msg'>";
				if (isset($error_message)) {
					echo $error_message;
				}
				echo validation_errors();
			echo "</div>";
		?>
		<?php echo form_close(); ?>
	</div>
</div>
<span>Powered by Oxford</span>