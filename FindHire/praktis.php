<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .image-container {
            position: relative;
            /* Create a positioning context for the link */
            display: inline-block;
            /* Ensure the container wraps tightly around the image */
        }

        .image-container img {
            display: block;
            /* Prevent any gaps around the image */
            width: 100%;
            /* Ensure the image is responsive */
            height: auto;
        }

        .image-container a {
            position: absolute;
            /* Position the link relative to the container */
            top: 10px;
            /* Adjust the vertical position */
            right: 10px;
            /* Adjust the horizontal position */
            text-decoration: none;
            /* Remove underline */
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
            color: white;
            /* Text color */
            padding: 5px 10px;
            /* Padding around the link */
            border-radius: 5px;
            /* Rounded corners */
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .image-container a:hover {
            background-color: rgba(0, 0, 0, 0.8);
            /* Darker background on hover */
        }

        .link-container {
            display: flex;
            /* Arrange items in a row */
            gap: 10px;
            /* Add spacing between the links */
        }

        .link-container a {

            transition: background-color 0.3s ease;
        }

        .link-container a:hover {
            background-color: #0056b3;
        }


        .container {
            display: flex;
            flex-direction: column;
            /* Stack items vertically */
            height: 200px;
            /* Set the height of the container */
            border: 2px solid #333;
            border-radius: 15px;
            /* Apply border radius */
            padding: 10px;
        }

        .item {
            margin-bottom: 10px;
            /* Space between items */
        }

        .last-item {
            margin-top: auto;
            /* Pushes the last item to the bottom */
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 10px;
        }

        .item {
            background-color: lightcoral;
            padding: 20px;
            text-align: center;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        .my-div {
            background-color: aqua;
            width: 100px;
            height: 150px;
            overflow-y: scroll;
            /* Enable vertical scrolling */
            overflow-x: hidden;
            /* Prevent horizontal scrolling */
            border: 1px solid #ccc;
            padding-right: 20px;
            /* Adds space between the scrollbar and content */
        }
    </style>

</head>

<body>
    <div class="image-container">
        <img src="website_images/derpy_cat_profile.jpg" alt="Example Image">
        <a href="praktis.php">Go to Link</a>
        <a style="margin-right: 90px;" href="praktis.php">Go to Link</a>
    </div>
    <div class="link-container">
        <a href="praktis.php">Link 1</a>
        <a href="praktis.php">Link 2</a>
    </div>

    <div style="border: 2px solid black; border-radius: 15px;">
        <div class="container">
            <div class="item">Item 1</div>
            <div class="item">Item 2</div>
            <div class="item">Item 3</div>
            <div class="last-item">Last Item (at the bottom)</div>
        </div>
    </div>

    <div id="draggableDiv" draggable="true" style="width: 100px; height: 100px; background: blue;">
        Drag me!
    </div>
    <div id="dropZone" style="width: 200px; height: 200px; border: 2px dashed black; margin-top: 20px;">
        Drop here
    </div>

    <script>
        const draggable = document.getElementById('draggableDiv');
        const dropZone = document.getElementById('dropZone');

        // Add dragstart event to the draggable element
        draggable.addEventListener('dragstart', (event) => {
            event.dataTransfer.setData('text/plain', event.target.id);
        });

        // Allow the drop zone to accept drops
        dropZone.addEventListener('dragover', (event) => {
            event.preventDefault(); // Prevent default behavior to allow drop
        });

        // Handle the drop event
        dropZone.addEventListener('drop', (event) => {
            event.preventDefault();
            const data = event.dataTransfer.getData('text/plain');
            const draggedElement = document.getElementById(data);
            dropZone.appendChild(draggedElement); // Move the draggable element
        });
    </script>

    <?php
    $items = ['Item 1', 'Item 2', 'Item 3', 'Item 4', 'Item 5', 'Item 6'];
    ?>



    <div class="container">
        <?php foreach ($items as $item): ?>
            <div class="item"><?php echo $item; ?></div>
        <?php endforeach; ?>
    </div>

    <div class="my-div">
        This is some text that will stay inside the container. Here's a reallylongwordthatmightoverflowandbreakthedesign
        which will now wrap properly thanks to the CSS rules!
    </div>



</body>

</html>