<!-- parameters and arguments -->

<?php
// $name and $color are parameters here,
// parameters are like empty boxes or frames that can receive an incoming argument
function greet($name, $color) {
  echo "<p>Hi, my name is $name and my favorite color is $color </p>";
}

  greet('John', 'blue');
  greet('Jane', 'green');
  // john and blue are arguments
?>
