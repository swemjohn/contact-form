<?php 
//Message Vars 
$msg = '';
$msgClass = '';
//Check for Submit
if(filter_has_var(INPUT_POST, 'submit')){
//Get the form data  
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);
 //Check if Empty
 if(!empty($name) && !empty($email) && !empty($message)){
   //Passed
   //Check email
   if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
     //failed
     $msg = 'Please use a valid email';
     $msgClass = 'alert-danger';
     
   }else {
     //Passed
     //Recipient Email
     $toEmail = 'thecodingdevs@gmail.com';
     $subject = 'Contact Request from '.$name;
     $body = '<h2>Contact Request</h2>
     <h4>Name</h4><p>'.$name.'</p>
     <h4>Email</h4><p>'.$email.'</p>
     <h4>Message</h4><p>'.$message.'</p>
     ';
     
     //Email headers
     $headers = "MIME-Version: 1.0" . "\r\n";
     $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";
     //Additonal Headers
     $headers .= "From: " .$name. "<".$email.">". "\r\n";
     if(mail($toEmail, $subject, $body, $headers)){
       //Email sent
       $msg = 'Your email has been sent';
       $msgClass = 'alert-success';
     }else{
       //Email sent failed
       $msg = 'Your email has not sent';
       $msgClass = 'alert-danger';
     }
   }
   
 }else{
   $msg = 'Please fill in all fields';
   $msgClass = 'alert-danger';
 }
 }
 ?>



<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  
<title>Contact Form</title>  
  
</head>  
  
<body>
  
  
  
  <div class="container">
      <?php if($msg != ''): ?>
            <div class="alert <?php echo $msgClass;?>"> <?php echo $msg; ?> </div>
      <?php endif; ?>
      
      <h3 class="text-center">Get in Touch</h3>
      <div class="row justify-content-center">
      <form class="col-lg-6" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
          
           <div class= "form-group">
               <label for="name" >Name</label>
               <input type="text" name="name" class="form-control"  value="<?php echo isset($_POST['name']) ? $name : '';?>">
           </div>  
           <div class= "form-group">
               <label for="name" name="email">Email</label>
               <input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email :'';?>">
           </div>  
           <div class= "form-group">
                <label for="message">Message</label>
                <textarea name="message" class="form-control" > <?php echo isset($_POST['message'])? $message : '';?> </textarea>
           </div>  
           <br>
           <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
</body>  
</html>