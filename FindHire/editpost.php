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
    <style>
        .editJobDescription {
            /* background-color: aqua; */
        }

        .submitButton {
            all: unset;
            cursor: pointer;

            background-color: black;
            color: white;
            font-weight: bold;

            border-radius: 15px;
            text-align: center;
            height: 35px;
        }

        .submitButton:hover {
            background-color: rgb(44, 44, 44);
        }

        .submitButton:focus {
            background-color: rgb(91, 91, 91);
        }

        .descriptionNfile {
            /* background-color: aqua; */
            /* width: 100%; */
        }

        .descriptionNfile p {
            display: flex;
            /* Use flexbox for alignment */
            align-items: center;
            /* Vertically align items along the center */
            justify-content: center;
            /* Horizontally align items at the center */
            gap: 10px;
            /* Optional: Add spacing between the elements */
            /* padding: 0px 10px; */
        }

        input[type="text"] {
            height: 25px;
            /* Adjust height as needed */
            padding: 5px;
            width: 100%;
            border-radius: 15px;
            border: 2px solid black;
        }

        .chooseFileLabel {
            display: flex;
            /* Use flexbox to align the label contents */
            align-items: center;
            cursor: pointer;
        }

        .chooseFile {
            display: none;
            /* Hide the default file input */
        }
    </style>
</head>

<body>
    <div class="outerOuterContainer">
        <div class="normalContainer">
            <?php include 'returnButton.php'; ?>
            <h1 style="text-align: center;">Edit Post</h1>

            <div class="jobPosts">

                <?php $getPostByID = getPostByID($pdo, $job_posts_id); ?>
                <form action="core/handleForms.php" method="POST" enctype="multipart/form-data">

                    <div class="image-container">
                        <img src="job_posts/<?php echo $getPostByID['title']; ?>" alt="">
                    </div>

                    <div class="jobPostDescriptionParent" style="background-color: none ; padding: 0px 30px;">
                        <div class="editJobDescription" style="background-color: none ;">
                            <h4 style="text-align: center;">
                                <label for="#">Edit the post's description</label>
                                <input type="hidden" name="job_posts_id" value="<?php echo $_GET['job_posts_id']; ?>">
                            </h4>

                            <div class="descriptionNfile">
                                <p>
                                    <input type="text" name="description"
                                        value="<?php echo $getPostByID['description']; ?>">

                                    <label class="chooseFileLabel">
                                        <img style="width: 25px; height: 25px;" src="website_images/imageSVG.svg"
                                            alt="Upload Image" title="Choose an image to post.">
                                        <input type="file" name="image" class="chooseFile" accept="image/*" required>
                                    </label>
                                </p>
                            </div>
                            <p>
                                <input class="submitButton" type="submit" name="insertJobPost" value="Edit">
                            </p>
                        </div>



                    </div>


                </form>
            </div>






        </div>
    </div>

</body>

</html>