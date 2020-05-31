<?php

/**
 * @param resource $handle
 * @param array    $strings
 * @param string   &$elfPos
 * @param string   &$varPos
 * @param string   &$elfRun
 * @return void
 */
function gen_prologue($handle, array $strings, string &$elfPos, string &$varPos, string &$elfRun): void
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

  fwrite($handle, <<<ASM
    push rbp
    mov rbp, rsp
    sub rsp, {$lenTotal}

  ASM);
  $i = 8;
  $split = array_reverse(str_split($imploded, 8));
  foreach ($split as $part) {

    $len = strlen($part);
    $pad = str_repeat("\0", 8 - $len);
    $ecp = "0x".bin2hex(strrev($part.$pad));
    // $ecp = "\"{$part}\"";
    fwrite($handle,
      "  mov rax, {$ecp}\n".
      "  mov [rbp - {$i}], rax\n"
    );
    $i += 8;
  }

  fwrite($handle,
    "\n\n  ; Var info\n".
    "  ; ncos = {$ncos}\n"
  );

  $i = $ncos;
  $j = 1;
  foreach ($strings as $k => $v) {
    $len = strlen($v);
    $i += $len + 1;
    fwrite($handle,
      "  ; [rbp - {$i}] ; // {$len} bytes\n"
    );
    if ($k == 0) {
      $elfPos = "(rbp - {$i})";
    } else if ($k == 1) {
      $varPos = "(rbp - {$i})";
    } else {
      $elfRun = "(rbp - {$i})";
    }
  }
}

/**
 * @param array  $strings
 * @param string &$asm
 * @return array
 */
function gen_prologue_pt(array $strings, string &$asm)
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
    $asm .=
      "  mov rax, {$ecp}\n".
      "  mov [rbp - {$i}], rax\n";
    $i += 8;
  }

  $asm .=
    "\n\n  ; Var info\n".
    "  ; ncos = {$ncos}\n";

  $i = $ncos;
  $j = 1;
  $arr = [];
  foreach ($strings as $k => $v) {
    $len = strlen($v);
    $i += $len + 1;
    $asm .= "  ; [rbp - {$i}] ; // {$len} bytes\n";
    $arr[] = "(rbp - {$i})";
  }
  return $arr;
}

/**
 * @param int $n
 * @return string
 */
function rstr(int $n): string
{
  $str = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM+";
  $r = "";
  $c = strlen($str) - 1;
  for ($i = 0; $i < $n; $i++) {
    $r .= $str[rand(0, $c)];
  }
  return $r;
}
