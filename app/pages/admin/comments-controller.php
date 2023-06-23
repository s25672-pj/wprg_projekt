<?php
if($action == 'delete'){
$query = "select * from comment where id = :id limit 1";
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

            $query = "delete from comment where id = :id limit 1";

            query($query, $data);

            redirect('admin/comments');
        }
    }
}
}