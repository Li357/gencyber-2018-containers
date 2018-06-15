<html>
  <head>
    <title>MD5 Hasher</title>
  </head>
  <body>
    <h1>MD5 Hasher (now with salts!)</h1>
    <p>The flag will be given if you manage to break my salted MD5 hasher (hint: you can't!)<br>You must give me two different strings that produce the same hash once salted :)</p>
    <form name="md5" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="get">
      <label for="string1">First String: </label>
      <input name="string1" required /><br />
      <label for="string2">Second String: </label>
      <input name="string2" required /><br />
      <input type="submit" />
    </form>
    <?php
      error_reporting(0); // Get rid of all those pesky **type conversion** warnings >:)
      include 'flag.php';
      if(isset($_GET['string1']) and isset($_GET['string2'])) {
        $one = $_GET['string1']; // You can also pass the strings via a URL query string
        $two = $_GET['string2']; // i.e. /index.php?string1=blah&string2=foo&salt=bar
        $salt = "gencyber2018";
        if($one !== $two) { // If only there were two things not equal here
          if(hash("md5", $one . $salt) === hash("md5", $two . $salt)) { // But equal here...
            echo "You have done the impossible. Here is the flag: " . $flag;
          } else {
            echo "WRONG!";
          }
        } else {
          echo "Those two strings don't look different.";
        }
      }
    ?>
    <h3>I'm so confident in my hasher, that I'll even give you the source code:</h3>
    <?php
      show_source(__FILE__)
    ?>
  </body>
</html>
