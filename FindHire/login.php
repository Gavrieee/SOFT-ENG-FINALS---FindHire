<?php
require_once 'core/models.php';
require_once 'core/handleForms.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginNregister.css">

    <style>
        .a-link {
            text-decoration: none;
            color: inherit;
            font-weight: bold;
        }

        .actionFeedback {
            position: fixed;
            /* Stays in a fixed position */
            bottom: 20px;
            /* Positioned near the bottom of the screen */
            right: 20px;
            /* Positioned near the right side */
            background-color: black;
            /* Notification background color */
            color: white;
            /* Text color */
            padding: 10px 20px;
            /* Space inside the notification */
            border-radius: 30px;
            /* Rounded corners for aesthetics */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for depth */
            font-size: 16px;
            /* Adjusted font size */
            font-weight: bold;
            /* Bold text for visibility */
            z-index: 1000;
            /* Ensures it's on top of other elements */
            display: inline-block;
            /* Ensures it behaves like a block with width */
            transition: opacity 0.3s ease-in-out;
            /* Smooth fade-out effect */
        }

        .hidden {
            opacity: 0;
            /* Makes the notification invisible */
            pointer-events: none;
            /* Prevents interactions when hidden */
        }
    </style>

    <script>
        setTimeout(() => {
            const notification = document.getElementById('notification');
            notification.style.opacity = '0'; // Triggers the fade-out
            setTimeout(() => {
                notification.style.display = 'none'; // Completely hides after fade-out
            }, 300); // Matches the transition duration in CSS
        }, 3000); // 3 seconds before starting fade-out


    </script>


</head>

<body>


    <div class="outsideContainer">

        <div class="mainContainer">

            <img class="logo_name" src="website_images/FindHire_BETTER.svg" alt="FindHire_BETTER">

            <div class="mainForm">
                <div class="actionFeedback" id="notification">
                    <?php
                    if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
                        echo "<p style='color: white;'>{$_SESSION['message']}</p>";
                    }
                    unset($_SESSION['message']);
                    unset($_SESSION['status']);

                    // echo $_SESSION['role'];
                    ?>
                </div>
                <form action="core/handleForms.php" method="POST">
                    <p>
                        <label for="username">Username</label>
                        <input type="text" name="username">
                    </p>
                    <p>
                        <label for="username">Password</label>
                        <input type="password" name="password">

                    </p>
                    <p>
                        <input type="submit" name="loginUserBtn" value="Log In" class="submit-button">
                    </p>
                </form>
                <hr>

            </div>
            <div class="asking">
                <p>Don't have an account? You may register <a class="a-link" href="register.php">here</a>.</p>
            </div>


        </div>
    </div>





</body>

</html>