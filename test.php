<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP Levenshtein</title>
</head>
<body>
<pre>
<?php
require_once($include_dir . 'lib/levenshtein.php');

$test = array(
	array('abc', 'abc'), //0
	array('kitten', 'sitting'), //3
	array('smei', 'mei'), //2
	array('12345', '234'),//3
	array('おしり', 'めがね'), //4
	array('照明', '照明'), //0
	array('いじめ', 'いじり'), //2
	array('もずくのかに', 'かに'), //5
	array('CDショップ', 'Cショック'), //2
	array('火事', '花火'), //2
);
foreach ($test as $row) {
	echo '<hr>';
	echo $row[0].','.$row[1];
//	echo ' | ';
//	echo levenshtein($row[0], $row[1]);
//	echo ' = ';
	var_dump(LevenshteinDistance($row[0], $row[1], 1, 'UTF-8'));
	echo '<br/>';
}

?>

</pre>
</body>
</html>