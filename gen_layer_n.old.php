<?php

$elfFile = "test.o";

$strings = [];

$elfFile = str_split(file_get_contents($file));
$len = count($elfFile);
foreach ($elfFile as $k => $v) {
  $elfFile[$k] = ord($v);
}

$elfFile = implode(",", $elfFile);

$layer1 = <<<ASM

section .rodata
  elf_file db {$elfFile}

section .data
  elf_path db "/proc/self/fd/"

section .text
extern integral_memfd_create
global _start

_start:
  push rbp
  mov rbp, rsp
  sub rsp, 32
  call integral_memfd_create

  mov [rbp - 8], rax
  mov rdi, rax
  mov rax, 1
  mov rsi, elf_file
  mov rdx, {$len}
  syscall

  mov rdi, [rbp - 8]
  mov rsi, elf_path
  add rsi, 14
  call itoa

  mov rax, 59
  mov rdi, elf_path
  lea rsi, [rbp + 16]
  lea rdx, [rbp + 32]
  syscall

exit:
  mov rax, 60
  xor rdi, rdi
  syscall

itoa:
  cmp rdi, 9
  jle .less_than_9
.less_than_9:
  add dil, 48
  mov byte [rsi], dil
  inc rsi
  jmp .ret

.ret:
  mov byte [rsi], 0
  ret
ASM;

file_put_contents("src/layer1.asm", $layer1);
