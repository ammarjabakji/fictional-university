
<!-- goal: make a bulleted list on the page that outputs to 100 -->

<?php
  $musCount = 1;
  while($musCount < 101) {
      echo "<li>$musCount</li>";
      $musCount++;
  }
 ?>

<!-- Explained Here: -->
 <?php
// $musCount = 1;
      // we made up that our count begins with the value of 1
// while($musCount < 101) {
     // as long as whatever is in the parenthesis of the while loop is true - $musCount being less than 101
     // keep looping (outputting) whatever is in the curly brackets
     // until whatever is in the parentheses is proven false
// echo "<li>$musCount</li>";
     // instead of writing a "1" and hard coding (writing out) these
     // list items again and again until we reach 100
     // we are going to echo out our count variable, in a bulleted list
     // so the first time that our while loop runs it will echo out a 1
     // because we set the variable above of our count to be 1
// $musCount++;
     // on this line here, we are making an adjustment to our original Count variable
     // we are telling it to incriment or increase our count variable by 1 each time
     // after the list item has been spit out
     // this is where the looping happens, it echos out our list item with the count variable,
     // then after it does that, we add one to the count variable,
     // and then we have it echo out the count variable again,
     // because the content of whats inside the parentheis of the while loop function
     // has not been proven false yet, (its not less than 101 yet)
     // so it will just keep looping (outputting)
     // until the content of the parenthesis of the while loop function is false
     // eventually it will reach 100, and output 100
     // then when our function adds 1 more to 100,  and loops again
     // it will see that our variable of 101 is now NOT less than 100, and the function is now false
     // so the while loop will finally end
   // }
  ?>
