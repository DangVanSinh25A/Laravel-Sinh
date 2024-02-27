<h1>upload file</h1>
<form action="<?php  echo route('categories.add'); ?>" method="POST">

    <div>
    <input type="file" nme="photo" placeholder="anh chuyen muc"
    value="<?php echo route('categories.upload'); ?>" enctype="multipart/form-data">
    </div>
    <button type="submit"> upload chuyen muc</button>
    <?php echo csrf_field(); ?>
    <!-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" > -->
</form>