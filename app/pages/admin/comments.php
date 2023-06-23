<?php if($action == 'delete'):?>
    <div class="col-md-6 mx-auto">
        <form method="post">
            <h1 class="h3 mb-3 fw-normal">Delete comment</h1>
            <?php if(!empty($row)) :?>
                <div class="form-floating">
                    <div class="form-control" id="floatingInput"><?=old_value("post_slug", $row['post_slug'])?></div>
                    <label for="floatingInput">Post_slug</label>
                </div>
                <div class="form-floating">
                    <div class="form-control" id="floatingInput"><?=old_value("username", $row['username'])?></div>
                    <label for="floatingInput">username</label>
                </div>
                <div class="form-floating">
                    <div class="form-control" id="floatingInput"><?=old_value("comment", $row['comment'])?></div>
                    <label for="floatingInput">comment</label>
                </div>



                <a href="<?=ROOT?>/admin/comments">
                    <button class="mt-4 btn btn-primary w-100 py-2" type="button">Back</button>
                </a>
                <button class="mt-4 btn btn-danger w-100 py-2" type="submit">Delete</button>
            <?php else:?>
                <div class="alert alert-danger text-center">Record not found</div>

            <?php endif;?>
        </form>
    </div>


<?php else:?>

    <h4>
        Comments
<!--        <a href="--><?php //=ROOT?><!--/admin/users/add">-->
<!--            <button class="btn btn-primary">Add New</button>-->
<!--        </a>-->
    </h4>

    <div class="table-responsive">
        <table class="table">

            <tr>
                <th>#</th>
                <th>Post-slug</th>
                <th>Username</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php
            $limit = 10;
            $offset = ($PAGE['page_number'] - 1) * $limit;

            $query = "select * from comment order by id desc limit $limit offset $offset";
            $rows = query($query);
            ?>

            <?php if(!empty($rows)):?>
                <?php foreach($rows as $row):?>
                    <tr>
                        <td><?=$row['id']?></td>
                        <td><?=esc($row['post_slug'])?></td>
                        <td><?=$row['username']?></td>
                        <td><?=$row['comment']?></td>
                        <td><?=date("jS M, Y",strtotime($row['date']))?></td>
                        <td>
<!--                            <a href="--><?php //=ROOT?><!--/admin/users/edit/--><?php //=$row['id']?><!--">-->
<!--                                <button class="btn btn-warning text-white btn-sm"><i class="bi bi-pencil-square"></i></button>-->
<!--                            </a>-->
                            <a href="<?=ROOT?>/admin/comments/delete/<?=$row['id']?>">
                                <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>
        </table>

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

<?php endif;?>