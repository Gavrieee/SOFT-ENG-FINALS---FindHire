<?php

require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (!isset($_SESSION['id'])) {
    die(json_encode(['success' => false, 'message' => 'Unauthorized']));
}
$sender_id = $_SESSION['id'];
$sender_username = $_SESSION['username'];
$receiver_id = $_GET['receiver_id'];

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .normalContainer {
            /* background-color: brown; */
        }

        .messageSection {

            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 10px;
            border: 2px solid black;
            border-radius: 10px;
            background-color: #f9f9f9;
            overflow-y: scroll;
            height: 320px;
            /* Set the height of the chat box */
        }

        .sendMessageSection {
            /* background-color: rebeccapurple; */

            padding: 10px 35px 0px 38px;
        }

        .messageBubble {
            max-width: 75%;
            /* Limit the bubble width */
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 20px;
            font-size: 14px;
            line-height: 1.5;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .messageBubble.sender {
            background-color: #dcf8c6;
            /* Light green */
            color: black;
            margin-left: auto;
            /* Align to the right */
            text-align: right;
        }

        .messageBubble.receiver {
            background-color: #ffffff;
            color: black;
            margin-right: auto;
            /* Align to the left */
            text-align: left;
            border: 1px solid #e0e0e0;
        }

        .senderName,
        .receiverName {
            font-size: 14px;
            margin-bottom: 5px;
            /* color: #666; */
            color: black;
        }

        .messageDIV {
            /* background-color: yellow; */
        }

        .scrollable {
            width: 300px;
            height: 150px;
            overflow-y: scroll;
            border: 1px solid #ccc;
        }

        /* Entire scrollbar */
        .messageSection::-webkit-scrollbar {
            width: 10px;
            /* Width of the scrollbar */

        }

        /* Scrollbar track */
        .messageSection::-webkit-scrollbar-track {
            /* background: white; */
            /* Light gray background */
            margin-right: 20px;
            /* padding-right: 20px; */

        }

        /* Scrollbar thumb */
        .messageSection::-webkit-scrollbar-thumb {
            background: black;
            /* Darker gray thumb */
            border-radius: 15px;
            /* Rounded edges */


        }

        /* Thumb hover effect */
        .messageSection::-webkit-scrollbar-thumb:hover {
            background: #555;
            /* Even darker gray when hovered */
        }
    </style>
</head>

<body>

    <div class="outerOuterContainer">
        <div class="normalContainer">
            <?php include 'returnButton.php'; ?>
            <h1 style="text-align: center;">Message</h1>

            <?php $receiverUsername = getReceiverUsername($pdo, $receiver_id); ?>
            <div class="checkStatusMessage" style="margin: 0px 35px 20px 35px;">
                <h3>You are now chatting with <b><?php echo $receiverUsername; ?></b>.</h3>
            </div>

            <div class="messageSection">

                <?php $showMessages = showMessages($pdo, $sender_id, $receiver_id); ?>
                <p style="text-align: center; color: rgb(91, 91, 91);">This is the beginning of your chat.</p>

                <?php foreach ($showMessages as $message) { ?>
                    <?php if ($message['sender_name'] == $_SESSION['username']) { ?>
                        <!-- Message bubble for the sender (You) -->
                        <div class="messageBubble sender">
                            <p class="senderName"><b><?php echo $message['sender_name']; ?></b> (You)</p>
                            <p class="messageContent"><?php echo $message['content']; ?></p>
                        </div>
                    <?php } else { ?>
                        <!-- Message bubble for the receiver -->
                        <div class="messageBubble receiver">
                            <p class="receiverName"><b><?php echo $message['sender_name']; ?></b></p>
                            <p class="messageContent"><?php echo $message['content']; ?></p>
                        </div>
                    <?php } ?>
                <?php } ?>

            </div>


            <div class="sendMessageSection">
                <div class="messageDIV">

                    <form action="core/handleForms.php" method="POST">
                        <input type="hidden" name="action" value="send_message">
                        <input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>">
                        <input type="hidden" name="job_post_id" value="<?php echo $job_post_id; ?>">
                        <input type="hidden" name="sender_username" value="<?php echo $sender_username; ?>">
                        <div style="display: flex; align-items: center; justify-content: center;">
                            <input
                                style="width: 100%; height: 30px; border: 2px solid black; border-radius: 15px; padding-left: 10px;"
                                type="text" name="content" placeholder="Type your message here..." required>
                            <button class="writePostButton" style="width: 1px;" type="submit"
                                name="submit_message"></button>
                        </div>
                    </form>
                </div>

            </div>




        </div>
    </div>






</body>

</html>