

section .data
global integral_memfd_create
integral_memfd_create:
  push rbp
  mov rbp, rsp
  sub rsp, 8
  mov dword [rbp - 8], 0
  mov rax, 319
  lea rdi, [rbp]
  xor rsi, rsi
  syscall
  mov rsp, rbp
  pop rbp
  ret
