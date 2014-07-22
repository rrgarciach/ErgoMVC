<?php
    function sum(&$a, &$b)
    {
        $a = $a + $b;
        return $a;
    }
    $num1 = 2;
    $num2 = 3;
    $add = sum($num1, $num2);
    print $num1;
    print $num2;
    print $add; 
?>