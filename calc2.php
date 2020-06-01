<?php


$dtor = [
  0xe4cddec0,
  0x99b6d3ba,
  0xe6dde0bf,
  0x2c021c26,
  0x7a5cc6d1,
];

$cost = [];
$ii = 2;
$text = "eaInside{M1ll3nnIuM_Pr0bl3ms_4r3_h4r";
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
