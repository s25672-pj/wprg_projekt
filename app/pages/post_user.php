<?php include '../app/pages/includes/header.php'; ?>
<?php require_once "../app/pages/post_user-controller.php"; ?>

<div class="col-md-12 mx-auto">
    <form method="post" enctype="multipart/form-data">

        <h1 class="h3 mb-3 fw-normal">Create post</h1>

        <?php if (!empty($errors)):?>
            <div class="alert alert-danger">Please fix the errors below</div>
        <?php endif;?>

        <div class="my-2">
            Featured Image:<br>
            <label class="d-block">
                <img class="mx-auto d-block image-preview-edit" src="<?=get_image('')?>" style="cursor: pointer;width: 150px;height: 150px;object-fit: cover;">
                <input onchange="display_image_edit(this.files[0])" type="file" name="image" class="d-none">
            </label>
            <?php if(!empty($errors['image'])):?>
                <div class="text-danger"><?=$errors['image']?></div>
            <?php endif;?>

            <script>

                function display_image_edit(file)
                {
                    document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
                }
            </script>
        </div>


        <div class="form-floating">
            <input value="<?=old_value('title')?>" name="title" type="text" class="form-control mb-2" id="floatingInput" placeholder="Username">
            <label for="floatingInput">Title</label>
        </div>
        <?php if(!empty($errors['title'])):?>
            <div class="text-danger"><?=$errors['title']?></div>
        <?php endif;?>

        <div class="">
            <textarea id="summernote" rows="8" name="content" id="floatingInput" placeholder="Post content" type="content" class="form-control"><?=old_value('content')?></textarea>
        </div>
        <?php if(!empty($errors['content'])):?>
            <div class="text-danger"><?=$errors['content']?></div>
        <?php endif;?>

        <div class="form-floating my-3">
            <select name="category_id" class="form-select">

                <?php

                $query = "select * from categories order by id desc";
                $categories = query($query);
                ?>
                <option value="">--Select--</option>
                <?php if(!empty($categories)):?>
                    <?php foreach($categories as $cat):?>
                        <option <?=old_select('category_id',$cat['id'])?> value="<?=$cat['id']?>"><?=$cat['category']?></option>
                    <?php endforeach;?>
                <?php endif;?>

            </select>
            <label for="floatingInput">Category</label>
        </div>
        <?php if(!empty($errors['category'])):?>
            <div class="text-danger"><?=$errors['category']?></div>
        <?php endif;?>

        <a href="<?=ROOT?>/home">
            <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
        </a>
        <button class="mt-4 btn btn-lg btn-primary float-end" type="submit">Create</button>

    </form>
</div>

<?php include '../app/pages/includes/footer.php'; ?>
