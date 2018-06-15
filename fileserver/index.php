<html>
  <head>
    <title>FileServer</title>
  </head>
  <body>
    <h1>Hello, welcome to FileServer v3.2.55.4</h1>
    <form name="file" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
      <label for="filename">Enter filename:</label>
      <input name="filename" placeholder="e.g. abc.txt" />
    </form>
    <h1>Current files available:</h1>
    <?php
      error_reporting(E_ERROR | E_PARSE);

      function good_file($name) {
        return(strpos($name, '.') != false or $name == "important");
      }

      $array = array_filter(scandir("files"), "good_file");
      foreach($array as $fileinside) {
        echo $fileinside, "<br />";
      }
    ?>
    <h1>File/directory content:</h1>
    <?php
      if(isset($_POST['filename'])) {
        $filename = "files/" . $_POST["filename"];
        $file = fopen($filename, "r") or die("Unable to open file.");
        if(strpos($_POST["filename"], ".") == false and strpos($filename, ".", 8) == false) {
          echo "Is a directory, scanning files...", "<br />";
          $array = array_filter(scandir($filename), "good_file");
          foreach($array as $fileinside) {
            echo "> ", $fileinside, "<br />";
          }
        } else {
          echo "Is not a directory, checking if file...", "<br />";
          echo "<pre>", fread($file, filesize($filename)), "</pre>";
        }
        fclose($file);
      } else {
        echo "Awaiting file...";
      }
    ?>
  </body>
</html>
