<!-- goal: make a bulleted list, looping through our array of names, doing something once for each item -->
<?php
  $musNames = array('David', 'Lauren', 'Cooper', 'Spike');
  // this is our name variable we created, its an array of names, it has 4 items, but we could add more later.

  $musCount = 0;
  // we remember that arrays are zero based,
  // so in order to access the first item in our array,
  // we're setting our count variable as 0,
  // otherwise if we called on item 1, it would return the second item in our array,'Lauren', not the first

  while($musCount < count($musNames)) {
    // we want our while loop here to echo out each item (name) in our array,
    // its going to do this inside of a bulleted list (see below)
    // how we get the while loop to eventually stop, is by using the wordpress function of count()
    // (the count function is not zero based, it just counts normally)
    // we are telling wordpress to count the items in our array, of the variable we created called $musNames
    // then we want it to remember that number it counted
    // then, to only continue to run the while loop again and again,
    // as long as that count(number) is more than our $musCount number, then it will stop

        echo "<li>Hi my name is $musNames[$musCount]</li>";
    // we are inserting the first name from our name variable into this bulleted list
    // in order to access one of the items in our array and return it in our bulleted list here
    // we use the variable we made up called $musNames, and use the square brackets []
    // the square brackets look inside the array and pick the item to return
    // to access the first item of 'David' its a 0, the second 'Lauren' is a 1
    // so instead of hardcoding a number inside our square brackets
    // "like saying return $musName[1]" for example
    // we're using our other variable of $musCount to be more efficient
    // this way if we ever add more items (names) to our array,
    // the list will update itself automatically, and we dont have to write as much code

    $musCount++;
    // so the while loop function reads the $musCount variable we created, set to start at 0
    // then it counts the total number of items in our array, which is 4, and it remembers this number
    // our loop checks to see if 0 is less than 4, since it is, it continues on
    // then it returns an item from the array, we are telling it to return item 0 first,
    // so it returns 'David' then it adds 1 to the $musCount variable we created,
    // then it starts over, now the $musCount variable is 1
    // it checks that the $musCount variable we created is less than 4
    // it is, so it moves forward,
    // then it returns an item from the array, we are telling it to return item 1 now,
    // so it returns 'Lauren' then it adds 1 to the $musCount variable we created,
    // then it starts over, going again and again
    // before it returns the item 'Spike' the count variable we created will have been 3
    // once it returns 'Spike', it will add 1 to our count variable making our count variable now 4
    // so on the next round, when it tries to run the while loop function,
    // the first thing it will do is check if whats in the parenthesis is still true,
    // it will check if 4 is less than 4,
    // since 4 is not less than 4, it will know to stop running the function.
  }
 ?>

<br>

<?php
  $musNames = array('David', 'Lauren', 'Cooper', 'Spike');
  $musCount = 0;

   while($musCount < count($musNames)) {
      echo "<li>Hi my name is $musNames[$musCount]</li>";
      $musCount++;
   }
?>
