<?php

/**
 * @param array  $strings
 * @param string &$elfPos
 * @param string &$varPos
 * @param string &$elfRun
 * @return string
 */
function gen_prologue(array $strings, string &$elfPos, string &$varPos, string &$elfRun): string
{
  $imploded = "";
  foreach (array_reverse($strings) as $str) {
    $imploded .= $str."\0";
  }
  $lcos = strlen($imploded);
  $ncos = $lcos % 8;
  if ($ncos > 0) {
    $ncos = 8 - $ncos;
  }

  $lenTotal = strlen($imploded) + $ncos;

  $asm = <<<ASM
    push rbp
    mov rbp, rsp
    sub rsp, {$lenTotal}

  ASM;
  $i = 8;
  $split = array_reverse(str_split($imploded, 8));
  foreach ($split as $part) {

    $len = strlen($part);
    $pad = str_repeat("\0", 8 - $len);
    $ecp = "0x".bin2hex(strrev($part.$pad));
    // $ecp = "\"{$part}\"";
    $asm .= "  mov rax, {$ecp}\n";
    $asm .= "  mov [rbp - {$i}], rax\n";
    $i += 8;
  }

  $asm .= "\n\n  ; Var info\n";
  $asm .= "  ; ncos = {$ncos}\n";

  $i = $ncos;
  $j = 1;
  foreach ($strings as $k => $v) {
    $len = strlen($v);
    $i += $len + 1;
    $asm .= "  ; [rbp - {$i}] ; // {$len} bytes\n";
    if ($k == 0) {
      $elfPos = "(rbp - {$i})";
    } else if ($k == 1) {
      $varPos = "(rbp - {$i})";
    } else {
      $elfRun = "(rbp - {$i})";
    }
  }

  return $asm;
}
