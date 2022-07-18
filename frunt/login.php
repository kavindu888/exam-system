<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link type="text/css" rel="stylesheet" href="login.css"/>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
   </head>
    <body>
        <?php 
          $color="#99ccff"; 
        ?>
 
        <form method="POST" action="actions/loginAction.php"  >
          
            <div class="mb-3 col-sm-8 col-md-6 mx-auto d-block fw-bold" style="border-color:<?php echo  $color;?> ;border-width: 1px;padding: 15px 15px 15px 15px; border-style: solid ;margin-top: 150px;color: #ffffff;">
                   <h2 class="col-12 mx-auto d-block text-center fw-bold">Log In</h2> 
                   
                           <?php
        

if( !empty( $_REQUEST['msg'] ) )
{
    $color="#ff0000";
   ?>
        <p style="color: #ff0000;"><?php echo sprintf($_REQUEST['msg'] );?></p>
   
<?php }?>  
                   
                   <label  class="form-label" style="color: #000000;">Email Address :</label> 
                           <input type="text" name="email" placeholder="Email" class="form-control"  />
                           <br>
                           <label  class="form-label" style="color: #000000">Password :</label> 
                           <input type="password" name="pw"placeholder="Password"  class="form-control"  />
        
                           <br>
           <input class="btn btn-primary col-12" type="submit" name="confirm" value="Sign In"  />
                           <br>
                           <br>
                           <br>
                     
          
   
            
            </div>
                
               </form>
    </body>
</html>
