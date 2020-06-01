<?php


$dtor = [
  0x1c0afff8,
  0x1d1e09b9,
  0x1bb221fe,
  0xbb86dce3,
  0x6fbec3b4,
  0x57bcc5aa
];

$cost = [];
$ii = 1;
$text = "Congratulation, you got the flag: _t";
$text = str_split($text, 4);

$i = 0;
foreach ($text as $k => $v) {
  $text[$k] = sprintf("%08s", bin2hex(strrev($text[$k])));
  $dtor[$k] = sprintf("%08s", dechex($dtor[$k]));
  $decText = hexdec($text[$k]);
  $decDtor = hexdec($dtor[$k] ?? 0);
  $valt = $decText - $decDtor;
  echo ($valt >= 0 ? "add" : "sub")." dword [pwd_in_{$ii} + {$i}], ".abs($valt)."\n";
  // echo "  mov eax, dword [pwd_in_{$ii} + {$i}]\n";
  // echo "  ".($val >= 0 ? "add" : "sub")." eax, ".abs($valt)."\n";
  // echo "  mov dword [pwd_in_{$ii} + {$i}], eax\n";
  $i += 4;
}
unset($v);
// die;
// var_dump($text, $dtor, $cost);
