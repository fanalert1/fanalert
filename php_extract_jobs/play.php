$string = 'abcd e f g';
$string = str_replace(" ", "", $string);
$s = mb_strlen($string, "UTF-8");
echo $s;

//$item = preg_replace("/[^A-Za-z]/","",$item);