<?php
include 'config/header.php';
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        <div class="alert__message error">
            <p>Error Message</p>
        </div>
        <form action="<?= ROOT_URL ?>admin/logic/add-post-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="title" placeholder="Title">
            <select name="category">
                <option value="1">A</option>
            </select>
            <textarea rows="10" name="body" placeholder="Body"></textarea>
            <div class="form__control inline">
                <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                <label for="is_featured">Featured</label>
            </div>
            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Add Post</button>
        </form>
    </div>
</section>

<?php
include '../config/footer.php'
    ?>