<?php
require 'form.php';
require 'text.php';

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>

</head>
<body>
<?php
$form = new Form($_POST);
// init the id of form
$form->id="myForm";
$form->wrap="p";
// init required data
$form->requiredData(array("login","mail")); 
 // form(action,methode)
echo $form->openForm('index.php','post');
echo "Votre Login : ";
// input (id,name,type,class,value,placeholder,required(true/false))
echo $form->input("login","userlogin","text","input","your login here");
echo "Your password : ";
echo $form->input("password","userpassword","password","input");
echo text::wrapIt("Choose your age : ".$form->select("age","userage",array("Choose your age","0-10","11-18","19-30","31-50","51-80")));

echo text::wrapIt("What is tyour gender :".$form->radio("usergender",array("male","female","couple")));

echo text::wrapIt("Choose the object : ".$form->checkbox("userObject",array("work","personnal","fun")));

echo $form->submit("Envoyer");

// close the formulare
echo $form->closeForm();
?>

    
</body>
</html>