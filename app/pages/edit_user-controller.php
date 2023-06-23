<?php
$id = user('id');
$query = "select * from users where id = :id limit 1";
$row = query_row($query, ['id'=>$id]);

if(!empty($_POST))
{

    if($row)
    {

        //validate
        $errors = [];

        if(empty($_POST['username']))
        {
            $errors['username'] = "A username is required";
        }else
            if(!preg_match("/^[a-zA-Z]+$/", $_POST['username']))
            {
                $errors['username'] = "Username can only have letters and no spaces";
            }

        $query = "select id from users where email = :email && id != :id limit 1";
        $email = query($query, ['email'=>$_POST['email'],'id'=>$id]);

        if(empty($_POST['email']))
        {
            $errors['email'] = "A email is required";
        }else
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
            {
                $errors['email'] = "Email not valid";
            }else
                if($email)
                {
                    $errors['email'] = "That email is already in use";
                }

        if(empty($_POST['password']))
        {

        }else
            if(strlen($_POST['password']) < 8)
            {
                $errors['password'] = "Password must be 8 character or more";
            }else
                if($_POST['password'] !== $_POST['retype_password'])
                {
                    $errors['password'] = "Passwords do not match";
                }


        if(!empty($_FILES['image']['name'])){
            $folder = "uploads/";

            if(!file_exists($folder)){
                mkdir($folder, 0777, true);
            }

            $fileName = time().'-'.$_FILES['image']['name'];

            $destination = $folder.$fileName;

            move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            // resize_image($destination);

        }

        if(empty($errors))
        {
            //save to database
            $data = [];
            $data['username'] = $_POST['username'];
            $data['email']    = $_POST['email'];
            $data['role']     = 'user';
            $data['id']       = $id;

            $password_str     = "";
            $image_str        = "";

            if(!empty($_POST['password']))
            {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $password_str = "password = :password, ";
            }

            if(!empty($destination))
            {
                $image_str = "image = :image, ";
                $data['image']       = $destination;
            }

            $query = "update users set username = :username, email = :email, $password_str $image_str role = :role where id = :id limit 1";

            query($query, $data);



        }
    }
}