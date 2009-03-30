<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>EC Dragon Test</title>
</head>
<body>
<pre>
<?php
/**
 * マルチバイト文字列、英数字の混じった文字列を１文字ずつ配列に分割
 * 参考:http://detail.chiebukuro.yahoo.co.jp/qa/question_detail/q1417635014#
 * mb_split, str_split, preg_splitことごとく使えない。
 */
function mbStringToArray($string, $encoding = 'UTF-8') {
	$arrayResult = array();
	while ($iLen = mb_strlen($string, $encoding)) {
		array_push($arrayResult, mb_substr($string, 0, 1, $encoding));
		$string = mb_substr($string, 1, $iLen, $encoding);
	}
	return $arrayResult;
}

/**
 * 編集距離（レーベンシュタイン距離）を求める（マルチバイト文字対応）
 * @param $str1
 * @param $str2
 * @param $encoding
 * @param $costReplace
 * @return 数値（距離）,かぶっていた文字の数
 */
function LevenshteinDistance($str1, $str2, $costReplace = 2, $encoding = 'UTF-8') {
	$count_same_letter = 0;
	$d = array();
	$mb_len1 = mb_strlen($str1, $encoding);
	$mb_len2 = mb_strlen($str2, $encoding);

	$mb_str1 = mbStringToArray($str1, $encoding);
	$mb_str2 = mbStringToArray($str2, $encoding);

	for ($i1 = 0; $i1 <= $mb_len1; $i1++) {
		$d[$i1] = array();
		$d[$i1][0] = $i1;
	}

	for ($i2 = 0; $i2 <= $mb_len2; $i2++) {
		$d[0][$i2] = $i2;
	}

	for ($i1 = 1; $i1 <= $mb_len1; $i1++) {
		for ($i2 = 1; $i2 <= $mb_len2; $i2++) {
			//			$cost = ($str1[$i1 - 1] == $str2[$i2 - 1]) ? 0 : 1;
			if ($mb_str1[$i1 - 1] === $mb_str2[$i2 - 1]) {
				$cost = 0;
				$count_same_letter++;
			} else {
				$cost = $costReplace; //置換
				}
			$d[$i1][$i2] = min($d[$i1 - 1][$i2] + 1, //挿入
			$d[$i1][$i2 - 1] + 1, //削除
			$d[$i1 - 1][$i2 - 1] + $cost);
		}
	}
	//return $d[$mb_len1][$mb_len2];
	return array('distance' => $d[$mb_len1][$mb_len2], 'count_same_letter' => $count_same_letter);
}

$test = array(
	array('abc', 'abc'), //0
	array('kitten', 'sitting'), //3
	array('おしり', 'めがね'), //5
	array('照明', '明'), //
	array('いじめ', 'いじり'), //
	array('もずくのかに', 'かに'), //
	array('火事', '花火'), //
	array('火事', '黒板'), //
	array('smei', 'mei'), //
	array('12345', '234'),
);
foreach ($test as $row) {
	echo $row[0].','.$row[1];
	echo ' | ';
	echo levenshtein($row[0], $row[1]);
	echo ' = ';
	var_dump(LevenshteinDistance($row[0], $row[1]));
	echo '<br/>';
}

var_dump($test);
?>

</pre>
</body>
</html>