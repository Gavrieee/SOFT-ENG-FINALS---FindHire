<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<?php
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

$job_posts_id = intval($_GET['job_posts_id']);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <div class="outerOuterContainer">
        <div class="normalContainer">
            <?php include 'returnButton.php'; ?>

            <?php $getPostByID = getPostByID($pdo, $job_posts_id); ?>

            <label for="">
                <h2 style="text-align: center; margin-top: 30px;">Are you sure you want to delete this Job Post below?</h2>
            </label>

            <div class="jobPosts" style="background-color: none;">

                <div class="image-container">
                    <img src="job_posts/<?php echo $getPostByID['title']; ?>" alt="">
                </div>

                <div class="jobPostDescriptionParent">
                    <div class="jobPostNameDate">
                        <h2>
                            <?php echo $getPostByID['created_by_name']; ?>
                        </h2>
                        <p>
                            <?php echo $getPostByID['created_at']; ?>
                        </p>
                    </div>
                    <div class="jobPostDescription">
                        <p>
                            <?php echo $getPostByID['description']; ?>
                        </p>
                    </div>
                </div>
            </div>

            <form action="core/handleForms.php" method="POST">
                <p>

                    <input type="hidden" name="job_post_name" value="<?php echo $getPostByID['title']; ?>">
                    <input type="hidden" name="job_posts_id" value="<?php echo $_GET['job_posts_id']; ?>">
                    <input type="submit" class="submitButton" style="height: 50px; font-size: 20px; margin-bottom: 25px;" name="deletePhotoBtn"
                        value="Delete">
                </p>
            </form>
        </div>
    </div>




</body>

</html>