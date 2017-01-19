<?php echo  validation_errors();?>
<?php 
    if (isset($error_message)) {
        echo $error_message;
    }
?>
<?php echo form_open('user/login') ?>
<label for ="username">Username:</label> 
<input type="text" name='username' value="<?php echo set_value('username') ?>"><br/>

<label for ="password">Password:</label> 
<input type="password" name='password' ><br/>


<input type="submit" name="submit" value="Login" />
</form>
