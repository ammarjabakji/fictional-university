<?php

  function mus_doubleMe($x) {
    echo $x * 2;
  }
  // we're practicing writing a function.
  // so within the parenthesis, we are setting the function definition,
  // first we want a parameter that can receive an incoming number
  // we called it $x
  // then in the curly brackets, which is the body of the function,
  // we want the function to echo out whatever number someone passes into the function $x
  // times 2
  mus_doubleMe(25);
  // this is a function we don't need to echo out, we just call the function and it echos out itself
  // but not all functions are like this
 ?>
 <br>
<?php
  // most functions don't echo out their result, they return their result
  function mus_tripleMe($x) {
    return $x * 3;
  }
  function mus_quadrupleMe($x) {
    return $x * 4;
  }

  echo mus_tripleMe(mus_quadrupleMe(2))
  // we're using the value that quadrupleMe returns, as the argument for tripleMe

 ?>
