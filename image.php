<!DOCTYPE html>
<html>
<head>
  <title>Image Gallery</title>
  <style>
    /* General styles */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    /* Masonry grid styles */
    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      grid-gap: 10px;
    }
    .grid-item {
      width: 20%;
      overflow: hidden;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .grid-item img {
      width: 100%;
      height: auto;
      display: block;
      transition: transform 0.3s ease;
    }
    .grid-item:hover img {
      transform: scale(1.1);
    }
  </style>
  <!-- Include the Masonry.js library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="grid-container">
      <?php
      // Define the directory to read image files from
      $dir = "images/";

      // Use the glob() function to get all files with extensions .jpg, .jpeg, .png, .gif
      $imageFiles = glob($dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

      // Loop through the array of image files to display in the grid items
      foreach ($imageFiles as $image) {
        // Add the grid item with the image
        echo "<div class='grid-item'><img src='$image'></div>";
      }
      ?>
    </div>
  </div>

  <!-- Initialize Masonry on the grid container after page load -->
  <script>
    var grid = document.querySelector('.grid-container');
    var msnry = new Masonry(grid, {
      itemSelector: '.grid-item',
      columnWidth: '.grid-item',
      gutter: 10
    });
  </script>
</body>
</html>
