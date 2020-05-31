<?php

if (!isset($argc, $argv)) {
  echo "argc and argv not detected!\n";
  exit(1);
}

if ($argc !== 3) {
  echo "Usage: ".$argv." <input_file> <output_file>\n";
  exit(1);
}

require __DIR__."/php/helpers.php";

$inputFile = $argv[1];
$outputFile = $argv[2];

$elfFile = file_get_contents($inputFile);
$fileSize = strlen($elfFile);

$elfPos = $varPos = $elfRun = "";
$prologue = gen_prologue(
  [$elfFile, str_repeat("\0", 1024), "/proc/self/fd/\0\0\0\0"], $elfPos, $varPos, $elfRun);


$memfd = $varPos;
$argv  = "(".$varPos." + 8)";
$envp  = "(".$varPos." + 16)";

$asm = <<<ASM

section .text
global _start
_start:
  lea rdi, [rsp + 8]
  lea rsi, [rsp + 24]
{$prologue}
_set_stack:
  mov [{$argv}], rdi
  mov [{$envp}], rsi
  call memfd_create
  mov [{$memfd}], rax

  ; Write to memfd_create.
  mov rdi, rax
  mov rax, 1
  lea rsi, [{$elfPos}]
  mov rdx, {$fileSize}
  syscall

  mov rdi, [{$memfd}]
  lea rsi, [$elfRun]
  add rsi, 14
  call itoa

  mov rax, 59
  lea rdi, [$elfRun]
  mov rsi, [{$argv}]
  mov rdx, [{$envp}]
  syscall

exit:
  mov rax, 60
  xor rdi, rdi
  syscall

itoa:
  cmp rdi, 9
  jl .less_than_10
.less_than_10:
  add dil, 48
  mov byte [rsi], dil
  inc rsi
  jmp .epilogue
.epilogue:
  mov byte [rsi], 0
  ret

memfd_create:
  push rbp
  mov rbp, rsp
  sub rsp, 8
  mov byte [rbp - 8], 0
  mov rax, 319
  lea rdi, [rbp - 8]
  xor rsi, rsi
  syscall
  mov rsp, rbp
  pop rbp
  ret

ASM;


file_put_contents("test.asm", $asm);