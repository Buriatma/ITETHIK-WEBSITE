<?php
include 'config/header.php'
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        <div class="alert__message error">
            <p>Error Message</p>
        </div>
        <form action="" enctype="multipart/form-data">
            <input type="text" placeholder="Title">
            <select>
                <option value="1">A</option>
                <option value="1">B</option>
                <option value="1">C</option>
                <option value="1">D</option>
                <option value="1">E</option>
                <option value="1">F</option>
            </select>
            <textarea rows="10" placeholder="Body"></textarea>
            <div class="form__control inline">
                <input type="checkbox" id="is_featured" checked>
                <label for="is_featured">Featured</label>
            </div>
            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" id="thumbnail">
            </div>
            <button type="submit" class="btn">Add Post</button>
        </form>
    </div>
</section>

<?php
include '../config/footer.php'
?>