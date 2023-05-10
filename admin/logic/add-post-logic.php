<?php

require '../../config/database.php';

if (isset($_POST['submit'])) {

    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    $is_featured = $is_featured ? 1 : 0;

    if (!$title) {
        $_SESSION['add-post'] = "Enter post title";
    } elseif (!$category_id) {
        $_SESSION['add-post'] = "Select post category";
    } elseif (!$body) {
        $_SESSION['add-post'] = "Enter post body";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "Add post thumbnail";
    } else {
        $thumbmnail_name = $thumbnail['name'];
        $thumbnail_tmp_name = $avatar['tmp_name'];
        $thumbnail_destination_path = '../assets/images/blog-posts-images/' . $thumbmnail_name;

        $allowed_files = ["png", "jpg", "jpeg"];
        $extension = explode('.', $thumbmnail_name);
        $extension = end($extension);

        if (in_array($extension, $allowed_files)) {
            if ($thumbnail['size'] < 2_000_000) {
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
            } else {
                $_SESSION['add-post'] = "Thumbnail size must be less than 2mb";
            }
        } else {
            $_SESSION['add-post'] = "Thumbnail must be PNG or JPG or JPEG";
        }
    }

    if (isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-post.php');
        die();
    } else {

        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        $query = "INSERT INTO posts (title , body , thumbnail , category_id , author_id , is_featured) VALUES ('$title' , '$body' , '$thumbmnail_name' , $category_id , $author_id , $is_featured)";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add-post-success'] = "New post added successfully";
            header('location: ' . ROOT_URL . 'admin/');
            die();
        }
    }

}

header('location: ' . ROOT_URL . 'admin/add-post.php');
die();