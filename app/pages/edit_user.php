<?php include '../app/pages/includes/header.php'; ?>
<?php require_once "../app/pages/edit_user-controller.php"; ?>
<div class="col-md-6 mx-auto">
    <form method="post" enctype="multipart/form-data">

        <h1 class="h3 mb-3 fw-normal">Edit account</h1>



            <?php if (!empty($errors)):?>
                <div class="alert alert-danger">Please fix the errors below</div>
            <?php endif;?>

            <div class="my-2">
                <label class="d-block">
                    <img class="mx-auto d-block image-preview-edit" src="<?=get_image($row['image'])?>" style="cursor: pointer;width: 150px;height: 150px;object-fit: cover;">
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
                <input value="<?=old_value('username', $row['username'])?>" name="username" type="text" class="form-control mb-2" id="floatingInput" placeholder="Username">
                <label for="floatingInput">Username</label>
            </div>
            <?php if(!empty($errors['username'])):?>
                <div class="text-danger"><?=$errors['username']?></div>
            <?php endif;?>

            <div class="form-floating">
                <input value="<?=old_value('email', $row['email'])?>" name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <?php if(!empty($errors['email'])):?>
                <div class="text-danger"><?=$errors['email']?></div>
            <?php endif;?>


            <div class="form-floating">
                <input value="<?=old_value('password')?>" name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password (leave empty to keep old one)</label>
            </div>
            <?php if(!empty($errors['password'])):?>
                <div class="text-danger"><?=$errors['password']?></div>
            <?php endif;?>

            <div class="form-floating">
                <input value="<?=old_value('retype_password')?>" name="retype_password" type="password" class="form-control" id="floatingPassword" placeholder="Retype Password">
                <label for="floatingPassword">Password</label>
            </div>

            <a href="<?=ROOT?>/home">
                <button class="mt-4 btn btn-lg btn-primary" type="button">Back</button>
            </a>
            <button class="mt-4 btn btn-lg btn-primary  float-end" type="submit">Save</button>


    </form>
</div>


<?php include '../app/pages/includes/footer.php'; ?>
