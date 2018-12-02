<?php
$data = array_map(function ($str) { return trim($str); }, file(__DIR__ . '/input', FILE_SKIP_EMPTY_LINES));
// the first puzzle
$result = array_reduce($data, function ($result, $id) {
	$chars = [];
	foreach (str_split($id) as $char) isset($chars[$char]) ? $chars[$char]++ : ($chars[$char] = 1);
	foreach ($chars as $char => $count) {
		if ($count === 2) { $result[0]++; break; }
	}
	foreach ($chars as $char => $count) {
		if ($count === 3) { $result[1]++; break; }
	}
	return $result;
}, [0, 0]);
$checksum = $result[0] * $result[1];
echo $checksum . PHP_EOL;
// the second puzzle
sort($data);
for ($i = 0; $i < count($data); ++$i) {
	for ($j = $i + 1; $j < count($data); ++$j) {
		$differences = 0;
		$where = -1;
		for ($a = 0, $b = strlen($data[$i]); $a < $b; $a++) {
			if ($data[$i]{$a} !== $data[$j]{$a}) {
				$differences++;
				$where = $a;
			}
		}
		//var_dump($differences);
		if ($differences === 1) {
			echo $data[$i] . ' ' . $data[$j] . PHP_EOL;
			echo substr($data[$i], 0, $where) . substr($data[$i], $where + 1);
		}
	}
}

