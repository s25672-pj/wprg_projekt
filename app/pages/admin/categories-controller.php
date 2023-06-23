<?php
if($action == 'add'){
    if(!empty($_POST)) {

        //validate
        $errors = [];

        if (empty($_POST['category'])) {
            $errors['category'] = "A category is required";
        } else if (!preg_match("/^[a-zA-Z0-9 \-\_\&]+$/", $_POST['category'])) {
            $errors['category'] = "A category can only have letters";
        }
        $slug = str_to_url($_POST['category']);
        $query = "select id from categories where slug = :slug limit 1";
        $slug_row= query($query, ['slug' => $slug]);

        if ($slug_row) {
            $slug .= rand(1000,9999);
        }

        if (empty($errors)) {
            //save to DB
            $data = [];
            $data['category'] = $_POST['category'];
            $data['slug'] = $slug;
            $data['disabled'] = $_POST['disabled'];

            $query = "insert into categories (category,slug,disabled) values (:category,:slug,:disabled)";
            query($query, $data);

            redirect('admin/categories');
        }
    }
}
elseif($action == 'edit'){
    $query = "select * from categories where id = :id limit 1";
    $row = query_row($query, ['id' => $id]);

    if(!empty($_POST))
    {
        if ($row)
        {
            //validate
            $errors = [];

            if (empty($_POST['category'])) {
                $errors['category'] = "A category is required";
            } else if (!preg_match("/^[a-zA-Z0-9 \-\_\&]+$/", $_POST['category'])) {
                $errors['category'] = "A category can only have letters";
            }
            if (empty($errors)) {
                //update to DB
                $data = [];
                $data['category'] = $_POST['category'];
                $data['disabled'] = $_POST['disabled'];
                $data['id'] = $id;


                $query = "UPDATE categories SET category = :category, disabled = :disabled WHERE id = :id LIMIT 1";
                query($query, $data);

                redirect('admin/categories');
            }
        }
    }
}
elseif($action == 'delete'){
    $query = "select * from categories where id = :id limit 1";
    $row = query_row($query, ['id' => $id]);

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if ($row)
        {
            //validate
            $errors = [];

            if (empty($errors)) {
                //delete from DB
                $data = [];
                $data['id'] = $id;

                $query = "delete from categories where id = :id limit 1";

                query($query, $data);

                redirect('admin/categories');
            }
        }
    }
}
?>
