<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <style>
        
        .profileUser {
            /* background-color: red; */

            border: 1.5px solid black;
            border-radius: 15px;
            margin: 20px;
            padding: 10px;

            width: 100%;

            box-sizing: border-box;
        }

        .profileParent {
            /* background-color: hotpink; */

            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 30px;
            
            border: 1.5px solid black;
            border-radius: 15px;
        }

        .profileUser a {
            text-decoration: none;
            color: inherit;
            font-weight: bold;
        }
    </style>

</head>

<body>

    <div class="outerOuterContainer">
        <div class="normalContainer">
            <?php include 'returnButton.php'; ?>
            <h1>View Accounts Page</h1>
            <p>This is the View Accounts Page.</p>

            <div class="profileParent">
                <?php $getAllUsers = getAllUsers($pdo) ?>


                <?php foreach ($getAllUsers as $user) { ?>
                    <div class="profileUser">
                        <div style="display: flex; justify-content: center; alig-items: center; background-color: none;">
                            <div class="circle-container" style="width: 100px; height: auto;">
                                <img src="website_images/derpy_cat_profile.jpg" alt="Circular Image" class="circle-img">
                            </div>
                        </div>
                        <div style="display: flex; justify-content: center; alig-items: center; background-color: none;">
                            <p>
                                <a
                                    href="profile.php?username=<?php echo $user['username']; ?>"><?php echo $user['username'] ?></a>
                            </p>
                        </div>

                    </div>

                <?php } ?>


            </div>


        </div>
    </div>


</body>

</html>