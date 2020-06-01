<?php

if (!isset($argc, $argv)) {
  echo "argc and argv not detected!\n";
  exit(1);
}

if ($argc !== 3) {
  echo "Usage: ".$argv." <input_file> <output_file>\n";
  exit(1);
}

$storeType = "stack";

require __DIR__."/php/helpers.php";

$inputFile = $argv[1];
$outputFile = $argv[2];

$handle = fopen($outputFile, "w");

$key = rstr(1000);
$textFile = file_get_contents($inputFile);

$len = strlen($textFile);
$keyLen = strlen($key);


for ($i = 0; $i < $len; $i++) {
  $textFile[$i] = chr(ord($textFile[$i]) ^ ord($key[$i % $keyLen]));
}

if ($storeType === "stack") {
  $asm = "";
  $var = gen_prologue_pt([$textFile, $key], $asm);
  $loadTextandKey = <<<ASM
  lea rdi, [{$var[0]}]
  lea rsi, [{$var[1]}]
ASM;
} else {
  /**
   * Write text data.
   */
  $textFile = str_split($textFile);
  $key = str_split($key);
  $c = ord($textFile[0]);
  fwrite($handle, <<<ASM
  section .rodata
    __rtext_pt_dt db {$c}
  ASM);
  unset($textFile[0]);
  $buff = "";
  $j = 0;
  foreach ($textFile as $v) {
    $buff .= ",".ord($v);
    if (($j % 10000) === 0) {
      fwrite($handle, $buff);
      $buff = "";
    }
  }
  if ($buff != "") {
    fwrite($handle, $buff);
    unset($buff);
  }

  /**
   * Write key data.
   */
  $c = ord($key[0]);
  fwrite($handle, <<<ASM

    __rkey_pt_dt db {$c}
  ASM);
  unset($key[0]);
  $buff = "";
  $j = 0;
  foreach ($key as $v) {
    $buff .= ",".ord($v);
    if (($j % 10000) === 0) {
      fwrite($handle, $buff);
      $buff = "";
    }
  }
  if ($buff != "") {
    fwrite($handle, $buff);
    unset($buff);
  }
  $asm = <<<ASM
  push rbp
  sub rbp, rsp
ASM;
  $loadTextandKey = <<<ASM
  mov rdi, __rtext_pt_dt
  mov rsi, __rkey_pt_dt
ASM;

}


fwrite($handle, <<<ASM

section .data
global _start
_start:
{$asm}
  mov rax, 9
  mov rsi, {$len}
  xor rdi, rdi
  mov edx, 0x6
  mov ecx, 0x22
  mov r8d, 0xffffffff
  xor r9, r9
  mov r10, 0x22
  mov rbx, 0x22
  syscall
  mov r10, rax
{$loadTextandKey}
  xor rcx, rcx
  mov r11, {$keyLen}

_decrypt:
  xor rdx, rdx
  mov rax, rcx
  idiv r11
  mov r8b, [rdi + rcx]
  mov r9b, [rsi + rdx]
  xor r8b, r9b
  mov [r10 + rcx], r8b
  inc rcx
  cmp rcx, {$len}
  jl _decrypt
  lea rdi, [rbp + 16]
  lea rsi, [rbp + 24]
  jmp r10
ASM);

fclose($handle);
