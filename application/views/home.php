<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
} else {
    header("location: user/login");
}
?>

<p>this is home page</p>
<p>welcome <?php echo  $username ?></p>
<a href="<?php echo base_url() ?>user/logout">logout</a>

