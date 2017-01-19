<?php echo  validation_errors();?>
<?php echo form_open('user/register') ?>
<label for ="username">Username:</label> 
<input type="text" name='username' value="<?php echo set_value('username') ?>"><br/>

<label for ="password">Password:</label> 
<input type="password" name='password' ><br/>

<label for ="passconf">Confirm Password:</label> 
<input type="password" name='passconf' ><br/>

<label for ="firstname">First Name:</label> 
<input type="text" name='firstname' value="<?php echo set_value('firstname') ?>"><br/>

<label for ="lastname">Last Name:</label> 
<input type="text" name='lastname' value="<?php echo set_value('lastname') ?>"><br/>

<label for ="email">Email:</label> 
<input type="email" name='email' value="<?php echo set_value('email') ?>"><br/>

<input type="submit" name="submit" value="Sign Up" />
</form>

