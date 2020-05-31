
section .text
global _start
_start:
  push rbp
  mov rbp, rsp
  sub rsp, 32

  mov rdi, 123123123123123
  lea rsi, [rbp - 8]
  call itoa
  mov [rbp - 16], rax

write:
  mov rax, 1
  mov rdi, 1
  lea rsi, [rbp - 8]
  mov rdx, [rbp - 16]
  syscall

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
