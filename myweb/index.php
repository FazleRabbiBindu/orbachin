<?php 

include 'model.php';
$user = new User();
if(isset($_POST['signup']))
{
    $action = $user->sign_up($_POST['email'],$_POST['password']);
    if($action == 'home')
    {
        echo "<script>window.location.href='http://fazlerabbibindu.infinityfreeapp.com/home.html';</script>";
    }
    elseif($action == 'login')
    {
        echo "<script>window.location.href='http://fazlerabbibindu.infinityfreeapp.com/login.html';</script>";
    }
    elseif($action == 'signup')
    {
        echo "<script>window.location.href='http://fazlerabbibindu.infinityfreeapp.com/signup.html';</script>";
    }
    else
    {
        echo "<script>window.location.href='http://fazlerabbibindu.infinityfreeapp.com/404.html';</script>";
    }
    
}
elseif(isset($_POST['login']))
{
    $action = $user->log_in($_POST['email'],$_POST['password']);
    if($action == 'home')
    {
        echo "<br>home";
        //echo "<script>window.location.href='http://fazlerabbibindu.infinityfreeapp.com/home.html';</script>";
    }
    elseif($action == 'login')
    {
        echo "<br>Login";
        //echo "<script>window.location.href='http://fazlerabbibindu.infinityfreeapp.com/login.html';</script>";
    }
    elseif($action == 'signup')
    {
        echo "<script>window.location.href='http://fazlerabbibindu.infinityfreeapp.com/signup.html';</script>";
    }
    else
    {
        echo "<script>window.location.href='http://fazlerabbibindu.infinityfreeapp.com/404.html';</script>";
    }
}
else
{
    //echo 'email: '.$_POST['email'].'<br>';
    //echo 'password: '.$_POST['password'];
    //echo "<script>window.location.href='http://fazlerabbibindu.infinityfreeapp.com/home.html';</script>";
    //echo"Home";
}
?>