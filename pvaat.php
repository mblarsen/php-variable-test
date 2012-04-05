<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>pvaat</title>
<style type="text/css" media="screen">
	body { font-size: 110%; }
	.test { background-color:black;color:white; min-width:50px; }
	.result { background-color:lightcyan; text-align:center; }
	.true { background-color:yellowgreen; }
	.false { background-color:orangered; }
	tr > td.test { text-align: right; min-width:80px; }
	th, td { font-family:arial; padding:10px; }
</style>
	
</head>
<body id="pvaat" onload="">
<h1 id="php_variable_test">PHP Variable Test</h1>
<p>PHP version <?php echo phpversion(); ?></p>
<p>This page on <a href="https://github.com/mblarsen/PHP-Variable-Test">GitHub</a>.</p>
<?php
//ini_set("error_reporting", E_ALL | E_STRICT);
ini_set("error_reporting", E_ALL | E_STRICT);
ini_set("display_errors", 0);

$values = array(
	'NULL'      => function (&$v) { $v = NULL; },
	'0'         => function (&$v) { $v = 0; },
	'FALSE'     => function (&$v) { $v = FALSE; },
	'""'        => function (&$v) { $v = ''; },
	'TRUE'      => function (&$v) { $v = TRUE; },
	'1'         => function (&$v) { $v = 1; },
	'1.3'       => function (&$v) { $v = 1.3; },
	'-1'        => function (&$v) { $v = -1; },
	'"-1"'      => function (&$v) { $v = "-1"; },
	'"1"'       => function (&$v) { $v = "1"; },
	'"1.3"'     => function (&$v) { $v = "1.3"; },
	'"0"'       => function (&$v) { $v = "0"; },
	'" "'       => function (&$v) { $v = " "; },
	'"str"'     => function (&$v) { $v = "str"; },
	'"000str"'  => function (&$v) { $v = "000str"; },
	'"123str"'  => function (&$v) { $v = "123str"; },
	'"str000"'  => function (&$v) { $v = "str000"; },
	'"str123"'  => function (&$v) { $v = "str123"; },
	'array()'   => function (&$v) { $v = array(); },
	'array(1)'  => function (&$v) { $v = array(1); },
	'unset($v)' => function (&$v) { unset($v); }
);

$boolean_tests = array(
	'isset'                            => function ($value_function) { $v; $value_function($v); return isset($v); },
	'if ($v) {'                        => function ($value_function) { $v; $value_function($v); if ($v) { return TRUE; } return FALSE; },
	'empty($v)'                        => function ($value_function) { $v; $value_function($v); return empty($v); },
	'spacer'                           => NULL,
	'is_scalar($v)'                    => function ($value_function) { $v; $value_function($v); return is_scalar($v); },
	'is_bool($v)'                      => function ($value_function) { $v; $value_function($v); return is_bool($v); },
	'is_string($v)'                    => function ($value_function) { $v; $value_function($v); return is_string($v); },
	'is_int($v)'                       => function ($value_function) { $v; $value_function($v); return is_int($v); },
	'is_numeric($v)'                   => function ($value_function) { $v; $value_function($v); return is_numeric($v); },
	'is_float($v)'                     => function ($value_function) { $v; $value_function($v); return is_float($v); },
	'is_null($v)<sup>dep</sup>' => function ($value_function) { $v; $value_function($v); return is_null($v); },
	'is_array($v)'                     => function ($value_function) { $v; $value_function($v); return is_array($v); } 
);

echo '<h2>Boolean functions</h2>';

echo "<table>";
echo "<thead><tr><th>\$v=</th><th class=\"test\">" . join("</th><th class=\"test\">", array_keys($values)) . "</th></tr></thead>";
foreach ($boolean_tests as $test => $test_function) {
	if ('spacer' === $test) { echo "<tr><td colspan=\"" . count(array_keys($values)) . "\"></td></tr>"; continue; }
	echo "<tr><td class=\"test\">$test</td>";
	foreach ($values as $value => $value_function) {
		$result = $test_function($value_function);
		$result_class = $result === TRUE ? 'true' : 'false';
		echo "<td class=\"result $result_class\">$result_class</td>";
	}
	echo "</tr>\n";
}
echo "</table>";

$value_tests = array(
	'count($v)'    => function ($value_function) { $v; $value_function($v); return count($v); },
	'gettype($v)'  => function ($value_function) { $v; $value_function($v); return gettype($v); },
	'intval($v)'   => function ($value_function) { $v; $value_function($v); return intval($v); },
	'floatval($v)' => function ($value_function) { $v; $value_function($v); return floatval($v); },
	'strlen($v)'   => function ($value_function) { $v; $value_function($v); return strlen($v); },
	'strval($v)'   => function ($value_function) { $v; $value_function($v); return strval($v); },
	'floor($v)'    => function ($value_function) { $v; $value_function($v); return floor($v); },
	'ceil($v)'     => function ($value_function) { $v; $value_function($v); return ceil($v); },
	'round($v)'    => function ($value_function) { $v; $value_function($v); return round($v); },
	'strval($v)'   => function ($value_function) { $v; $value_function($v); return strval($v); },
);

echo '<h2>Value functions</h2>';

echo "<table>";
echo "<thead><tr><th>\$v=</th><th class=\"test\">" . join("</th><th class=\"test\">", array_keys($values)) . "</th></tr></thead>";
foreach ($value_tests as $test => $test_function) {
	echo "<tr><td class=\"test\">$test</td>";
	foreach ($values as $value => $value_function) {
		$result = $test_function($value_function);
		echo "<td class=\"result\">$result</td>";
	}
	echo "</tr>\n";
}
echo "</table>";

// Boolean comparison

echo '<h2>Boolean comparison</h2>';

$operators = array('==', '===', '!=', '!==', '<', '<=', '>', '>=');

echo "<table>";

foreach ($operators as $operator) {
	
	echo "<thead><tr><th>$operator</th><th class=\"test\">" . join("</th><th class=\"test\">", array_keys($values)) . "</th></tr></thead>";
	
	foreach ($values as $value1 => $value_function1) {
		
		echo "<tr><td class=\"test\">$value1</td>";
		
		foreach ($values as $value2 => $value_function2) {
			$result;
			$v1; $value_function1($v1);
			$v2; $value_function2($v2);
			if ('==' === $operator) {
				$result = $v1 == $v2;
			} else if ('!=' === $operator) {
				$result = $v1 != $v2;
			} else if ('===' === $operator) {
				$result = $v1 === $v2;
			} else if ('!==' === $operator) {
				$result = $v1 !== $v2;
			} else if ('<' === $operator) {
				$result = $v1 < $v2;
			} else if ('<=' === $operator) {
				$result = $v1 <= $v2;
			} else if ('>' === $operator) {
				$result = $v1 > $v2;
			} else if ('>=' === $operator) {
				$result = $v1 >= $v2;
			}
			if ($result) {
				echo '<td class="result true">true</td>';
			} else {
				echo '<td class="result false">false</td>';
			}
		}
		echo '</tr>';
	}
}
echo "</table>";
?>
</body>
