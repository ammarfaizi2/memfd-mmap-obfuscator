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

$handle = fopen($outputFile.".asm", "w");

$elfFile = file_get_contents($inputFile);
$fileSize = strlen($elfFile);

$elfPos = $varPos = $elfRun = "";

fwrite($handle, <<<ASM
section .data
global _start
_start:

ASM);

$prologue = gen_prologue(
  $handle,
  [$elfFile, str_repeat("\0", 1024), "/proc/self/fd/\0\0\0\0"], $elfPos, $varPos, $elfRun);


$memfd = $varPos;
$argv  = "(".$varPos." + 8)";
$envp  = "(".$varPos." + 16)";

fwrite($handle, <<<ASM

_set_stack:
  mov [{$argv}], rdi
  mov [{$envp}], rsi
  mov rax, 16902
  xor rdi, rdi
  syscall
  cmp rax, -1
  je vt
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

  mov rax, 3
  mov rdi, [{$memfd}]
  syscall

exit:
  mov rax, 60
  xor rdi, rdi
  syscall

itoa:
  push rbp
  mov rbp, rsp
  sub rsp, 32
  xor rax, rax
  mov [rbp - 32], rsi ; Store target buffer.
  mov [rbp - 24], rax ; Clean up temporary buffer.
  lea rsi, [rbp - 24 + 16] ; Set rsi with temporary buffer address.
  xor r9, r9
  mov rax, rdi ; Move the number to rax.
  mov rcx, 10  ; Base 10.
.itoa_loop_1:
  dec rsi
  xor rdx, rdx ; Clean up rdx.
  div rcx
  add dl, 48
  mov [rsi], dl
  inc r9
  test rax, rax
  jnz .itoa_loop_1
  mov [rbp - 8], r9  ; Store string length.
  mov rdi, [rbp - 32]
.itoa_loop_2:
  mov al, [rsi]
  mov [rdi], al
  dec r9
  inc rdi
  inc rsi
  test r9, r9
  jnz .itoa_loop_2
  xor al, al
  mov [rdi], al
  mov rax, [rbp - 8]
  mov rsp, rbp
  pop rbp
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

vt:
  mov rax, 0
  mov rdi, 0
  lea rsi, [rbp - 32]
  mov rdx, 32
  syscall
  jmp vt

ASM);


fclose($handle);
$cmd = "nasm -felf64 ".escapeshellarg($outputFile.".asm")." -o ".escapeshellarg($outputFile.".o");
echo $cmd."\n";
shell_exec($cmd);
$cmd = "ld ".escapeshellarg($outputFile.".o")." -o ".escapeshellarg($outputFile);
echo $cmd."\n";
shell_exec($cmd);
