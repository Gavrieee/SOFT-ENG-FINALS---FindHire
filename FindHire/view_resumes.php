<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<?php
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

// Check if user is logged in and is an HR
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'HR') {
    die("Unauthorized access.");
}

$job_posts_id = intval($_GET['job_posts_id']);
$applications_id = getApplicationIDByJobPost($pdo, $job_posts_id);

$user_id = $_SESSION['username'];

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .viewResumeContainer {
            /* background-color: aqua; */
            padding: 0px 20px;
            border: 2px solid black;
            border-radius: 0px 0px 15px 15px;
            margin-bottom: 20px;
        }

        .a-link-name {
            text-decoration: none;
            color: inherit;
        }

        .viewResumeContainer table {
            /* background-color: green; */
            font-size: 14px;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
            border: 1px solid black;
            margin: 25px 0px;
        }

        .viewResumeContainer th {
            table-layout: fixed;
            background-color: black;
            color: white;
            width: 10%;
            padding: 5px;
        }

        .backButton {
            margin: 5px;
        }

        .centerParent {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .centerChild {
            /* background-color: palevioletred; */
            padding-top: 15px;
        }
    </style>
</head>

<body>

    <div class="outerOuterContainer">
        <div class="normalContainer">
            <?php include 'returnButton.php'; ?>

            <h1>View Resume per Post</h1>
            <p>This is the View Resume per Post page.</p>

            <div class="jobPosts">
                <?php $getPostByID = getPostByID($pdo, $job_posts_id); ?>
                <div>
                    <img src="job_posts/<?php echo $getPostByID['title']; ?>" alt="Job Post Image">
                </div>

                <div style="padding: 30px;">
                    <div class="jobPostNameDate">
                        <h2>
                            <?php echo $getPostByID['created_by_name']; ?>
                        </h2>

                        <p>
                            <i><?php echo $getPostByID['created_at']; ?></i>
                        </p>
                    </div>

                    <div class="jobPostDescription">
                        <p>
                            <?php echo $getPostByID['description']; ?>
                        </p>
                    </div>
                </div>

            </div>

            <div class="checkStatusMessage" style="margin: 0px 0px 0px 0px; border-radius: 15px 15px 0px 0px">
                <h3 style="text-align: center;">List of Applicants for this Job Post</h3>
            </div>

            <div class="viewResumeContainer">
                <?php $applications = getApplicationsByJobPost($pdo, $job_posts_id); ?>


                <?php if (empty($applications)) { ?>
                    <div class="centerParent">
                        <div>
                            <p style="text-align: center;">No applications found for this job post.</p>
                            <div class="centerParent">
                                <div>
                                    <img style="width: 150px; height: auto;" src="website_images/findingSignSVG.svg"
                                        alt="Empty">
                                </div>
                            </div>

                        </div>
                    </div>

                <?php } else { ?>
                    <?php foreach ($applications as $application) { ?>
                        <table>
                            <tr>
                                <th>Username</th>
                                <th>Submitted at</th>
                                <th>Message</th>
                                <th>Resume File</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><a class="a-link-name"
                                        href="message.php?receiver_id=<?php echo $application['applicant_id']; ?>"><strong><?php echo htmlspecialchars($application['username']); ?></strong></a>
                                </td>
                                <td><?php echo htmlspecialchars($application['submitted_at']); ?></td>
                                <td><?php echo htmlspecialchars($application['messages']); ?></td>
                                <td><a class="a-link-name" style="text-decoration: underline;"
                                        href="resumes/<?php echo htmlspecialchars($application['resume_path']); ?>"
                                        target="_blank">View
                                        Resume</a></td>
                                <td>
                                    <b><?php
                                    $status = htmlspecialchars($application['status']);
                                    if ($status === 'Accepted') {
                                        echo "<span style='color: green;'>$status</span>";
                                    } elseif ($status === 'Rejected') {
                                        echo "<span style='color: red;'>$status</span>";
                                    } elseif ($status === 'Pending') {
                                        echo "<span style='color: blue;'>$status</span>";
                                    } else {
                                        echo "<span style='color: black;'>$status</span>";
                                    }
                                    ?></b>
                                </td>
                                <td>
                                    <?php if ($application['status'] == 'Pending')
                                        ; { ?>
                                        <form action="core/handleForms.php" method="POST">

                                            <?php $applicant_id = $application['applicant_id']; ?>
                                            <input type="hidden" name="job_posts_id" value="<?php echo $job_posts_id; ?>">
                                            <input type="hidden" name="applications_id" value="<?php echo $applications_id; ?>">

                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                                            <input type="hidden" name="applicant_id" value="<?php echo $applicant_id; ?>">

                                            <!-- DEBUGGING -->
                                            <?php $job_post_description = $getPostByID['description']; ?>

                                            <input type="hidden" name="job_post_description"
                                                value="<?php echo $job_post_description; ?>">
                                            <!-- DEBUGGING -->

                                            <div class="centerParent">
                                                <div class="centerChild">
                                                    <?php if (in_array($application['status'], ['Accepted', 'Rejected'])) { ?>
                                                        <div class="">
                                                            <input class="backButton" style="width: 50px;" type="submit"
                                                                name="undoButton" value="Undo">
                                                        </div>

                                                    <?php } else { ?>
                                                        <div>
                                                            <input class="backButton" style="width: 50px;" type="submit"
                                                                name="acceptButton" value="Accept">
                                                            <input class="backButton" style="width: 50px;" type="submit"
                                                                name="rejectButton" value="Reject">
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>


                                        </form>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    <?php } ?>

                <?php } ?>
            </div>









        </div>
    </div>

</body>

</html>