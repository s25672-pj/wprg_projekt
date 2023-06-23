<?php

if (isset($_POST['postcomment'])){
    $userid = user('id');
    $username = user('username');
    $post_slug = $url[1] ?? null;
    $comment = $_POST['comment'];
    if(!empty($comment)){
        $data = [];
        $data['user_id'] = $userid;
        $data['post_slug'] = $post_slug;
        $data['username'] = $username;
        $data['comment'] = $comment;

        $query = "insert into comment(user_id,post_slug,username,comment) values (:user_id,:post_slug,:username,:comment)";

        query($query, $data);
    }
}
?>
<?php if(logged_in()):?>
<div style="text-align: center" class="row" >
    <div style="text-align: center" >
        <div style="text-align: center" >
            <form style="text-align: center" class="form-horizontal" method="post">
                <div style="text-align: center" class="form-group">
                    <label class="col-lg-3 control-label">Add comment</label>
                    <div style="text-align: center" class="col-lg-9">
                        <textarea  class="form-control mx-4" rows="5" cols="10" name="comment" placeholder="Comment"></textarea>

                    </div>

                </div>
                <input type="submit" name="postcomment" value="Comment" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
<?php endif;?>

<div class="row mb-2 justify-content-center">
    <div style="text-align: center;"><h1>Comments</h1>
        <div style="text-align: center;">
    <?php

    $limit = 2;
    $offset = ($PAGE['page_number'] - 1) * $limit;

    $post_slug = $url[1] ?? null;
    $query = "select * from comment where post_slug = :post_slug order by id desc limit $limit offset $offset";
    $data = array('post_slug' => $post_slug);
    $rows = query($query, $data);
    ?>
    <?php
            if($rows){
            foreach ($rows as $row) {
            include '../app/pages/includes/comment-card.php';
            }
            }else{
            echo "No comments found!";
            }

    ?>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <a href="<?=$PAGE['first_link']?>">
            <button class="btn btn-primary">First Page</button>
        </a>
        <a href="<?=$PAGE['prev_link']?>">
            <button class="btn btn-primary">Prev Page</button>
        </a>
        <a href="<?=$PAGE['next_link']?>">
            <button class="btn btn-primary float-end">Next Page</button>
        </a>
    </div>

</div>
