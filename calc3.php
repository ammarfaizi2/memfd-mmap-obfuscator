<?php


$dtor = [
  0x211eb60b,
  0x62939776,
  0xd9c4c6c3,
  0x79d8ccc2,
];

$cost = [];
$ii = 3;
$text = "d_t0_s0lv3_05ded75194939d325d71b08}\n";
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
