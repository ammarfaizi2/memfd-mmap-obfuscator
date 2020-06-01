
section .text
global _start
_start:
  push rbp
  mov rbp, rsp
  sub rsp, 536
  mov rax, 0x000000203a64726f
  mov [rbp - 8], rax
  mov rax, 0x7773736150207265
  mov [rbp - 16], rax
  mov rax, 0x746e4500203a3220
  mov [rbp - 24], rax
  mov rax, 0x64726f7773736150
  mov [rbp - 32], rax
  mov rax, 0x207265746e450020
  mov [rbp - 40], rax
  mov rax, 0x3a332064726f7773
  mov [rbp - 48], rax
  mov rax, 0x736150207265746e
  mov [rbp - 56], rax
  mov rax, 0x4500525a4e705658
  mov [rbp - 64], rax
  mov rax, 0x41796e4e46546c63
  mov [rbp - 72], rax
  mov rax, 0x697359494e496466
  mov [rbp - 80], rax
  mov rax, 0x696e714e4e484a49
  mov [rbp - 88], rax
  mov rax, 0x7443686f68525851
  mov [rbp - 96], rax
  mov rax, 0x6a564d4c64634f4b
  mov [rbp - 104], rax
  mov rax, 0x50536e667875456e
  mov [rbp - 112], rax
  mov rax, 0x516e4f4b43744b63
  mov [rbp - 120], rax
  mov rax, 0x6161007362625444
  mov [rbp - 128], rax
  mov rax, 0x6f4948576b626472
  mov [rbp - 136], rax
  mov rax, 0x4a57776b5554756f
  mov [rbp - 144], rax
  mov rax, 0x71414876664e7277
  mov [rbp - 152], rax
  mov rax, 0x716a706273544e44
  mov [rbp - 160], rax
  mov rax, 0x765456627352627a
  mov [rbp - 168], rax
  mov rax, 0x52536847634c4e77
  mov [rbp - 176], rax
  mov rax, 0x6d67777948655977
  mov [rbp - 184], rax
  mov rax, 0x68756e0054447754
  mov [rbp - 192], rax
  mov rax, 0x4253626b4745756a
  mov [rbp - 200], rax
  mov rax, 0x557474644f736963
  mov [rbp - 208], rax
  mov rax, 0x69674b684878724b
  mov [rbp - 216], rax
  mov rax, 0x784f6967645a434f
  mov [rbp - 224], rax
  mov rax, 0x5077616b49754641
  mov [rbp - 232], rax
  mov rax, 0x756a4a686f6b6756
  mov [rbp - 240], rax
  mov rax, 0x7755547342434956
  mov [rbp - 248], rax
  mov rax, 0x52576a4500000000
  mov [rbp - 256], rax
  mov rax, 0x0000000000000000
  mov [rbp - 264], rax
  mov rax, 0x0000000000000000
  mov [rbp - 272], rax
  mov rax, 0x0000000000000000
  mov [rbp - 280], rax
  mov rax, 0x0000000000000000
  mov [rbp - 288], rax
  mov rax, 0x0000000000000000
  mov [rbp - 296], rax
  mov rax, 0x0000000000000000
  mov [rbp - 304], rax
  mov rax, 0x0000000000000000
  mov [rbp - 312], rax
  mov rax, 0x0000000000000000
  mov [rbp - 320], rax
  mov rax, 0x0000000000000000
  mov [rbp - 328], rax
  mov rax, 0x0000000000000000
  mov [rbp - 336], rax
  mov rax, 0x0000000000000000
  mov [rbp - 344], rax
  mov rax, 0x0000000000000000
  mov [rbp - 352], rax
  mov rax, 0x0000000000000000
  mov [rbp - 360], rax
  mov rax, 0x0000000000000000
  mov [rbp - 368], rax
  mov rax, 0x0000000000000000
  mov [rbp - 376], rax
  mov rax, 0x0000000000000000
  mov [rbp - 384], rax
  mov rax, 0x0000000000000000
  mov [rbp - 392], rax
  mov rax, 0x0000000000000000
  mov [rbp - 400], rax
  mov rax, 0x0000000000000000
  mov [rbp - 408], rax
  mov rax, 0x0000000000000000
  mov [rbp - 416], rax
  mov rax, 0x0000000000000000
  mov [rbp - 424], rax
  mov rax, 0x0000000000000000
  mov [rbp - 432], rax
  mov rax, 0x0000000000000000
  mov [rbp - 440], rax
  mov rax, 0x0000000000000000
  mov [rbp - 448], rax
  mov rax, 0x0000000000000000
  mov [rbp - 456], rax
  mov rax, 0x0000000000000000
  mov [rbp - 464], rax
  mov rax, 0x0000000000000000
  mov [rbp - 472], rax
  mov rax, 0x0000000000000000
  mov [rbp - 480], rax
  mov rax, 0x0000000000000000
  mov [rbp - 488], rax
  mov rax, 0x0000000000000000
  mov [rbp - 496], rax
  mov rax, 0x0000000000000000
  mov [rbp - 504], rax
  mov rax, 0x0000000000000000
  mov [rbp - 512], rax
  mov rax, 0x000a2164726f7773
  mov [rbp - 520], rax
  mov rax, 0x73617020676e6f72
  mov [rbp - 528], rax
  mov rax, 0x77202c7972726f53
  mov [rbp - 536], rax

  mov rax, 101
  xor rdi, rdi
  syscall
  cmp rax, -1
  je _trace_trap

  ; Var info
  ; ncos = 2
  ; [rbp - 19] ; // 16 bytes "Enter Password: "
  %define pwd_ask_1 (rbp - 19)
  %define pwd_ask_len_1 (16)
  ; [rbp - 38] ; // 18 bytes "Enter Password 2: "
  %define pwd_ask_2 (rbp - 38)
  %define pwd_ask_len_2 (18)
  ; [rbp - 57] ; // 18 bytes "Enter Password 3: "
  %define pwd_ask_3 (rbp - 57)
  %define pwd_ask_len_3 (18)
  ; [rbp - 122] ; // 64 bytes "aacKtCKOnQnEuxfnSPKOcdLMVjQXRhohCtIJHNNqnifdINIYsiclTFNnyAXVpNZR"
  %define pwd_cmp_1 (rbp - 122)
  %define pwd_cmp_len (64)
  ; [rbp - 187] ; // 64 bytes "nuhwYeHywgmwNLcGhSRzbRsbVTvDNTsbpjqwrNfvHAqouTUkwWJrdbkWHIoDTbbs"
  %define pwd_cmp_2 (rbp - 187)
  %define pwd_cmp_len (64)
  ; [rbp - 252] ; // 64 bytes "EjWRVICBsTUwVgkohJjuAFuIkawPOCZdgiOxKrxHhKgicisOdttUjuEGkbSBTwDT"
  %define pwd_cmp_3 (rbp - 252)
  %define pwd_cmp_len (64)
  ; [rbp - 317] ; // 64 bytes "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
  %define pwd_in_1 (rbp - 317)
  %define pwd_in_len (64)
  ; [rbp - 382] ; // 64 bytes "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
  %define pwd_in_2 (rbp - 382)
  %define pwd_in_len (64)
  ; [rbp - 447] ; // 64 bytes "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
  %define pwd_in_3 (rbp - 447)
  %define pwd_in_len (64)
  ; [rbp - 512] ; // 64 bytes "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
  ; [rbp - 536] ; // 23 bytes "Sorry, wrong password!\n"
  %define wrong_pwd (rbp - 536)
  %define wrong_pwd_len (23)

ask_password_1:
  ; Ask and check password 1
  lea rdi, [pwd_ask_1]
  mov rsi, pwd_ask_len_1
  call _print
  lea rdi, [pwd_in_1]
  mov rsi, 36
  call _read
  mov eax, [pwd_in_1 + 0]
  mov edi, [pwd_cmp_1 + 0]
  sub eax, edi
  mov [pwd_in_1 + 0], eax
  cmp eax, 0x1c0afff8
  jne wrong_password
  mov eax, [pwd_in_1 + 4]
  mov edi, [pwd_cmp_1 + 4]
  sub eax, edi
  mov [pwd_in_1 + 4], eax
  cmp eax, 0x1d1e09b9
  jne wrong_password
  mov eax, [pwd_in_1 + 8]
  mov edi, [pwd_cmp_1 + 8]
  sub eax, edi
  mov [pwd_in_1 + 8], eax
  cmp eax, 0x1bb221fe
  jne wrong_password
  mov eax, [pwd_in_1 + 12]
  mov edi, [pwd_cmp_1 + 12]
  add eax, edi
  mov [pwd_in_1 + 12], eax
  cmp eax, 0xbb86dce3
  jne wrong_password
  mov eax, [pwd_in_1 + 16]
  mov edi, [pwd_cmp_1 + 16]
  add eax, edi
  mov [pwd_in_1 + 16], eax
  cmp eax, 0x6fbec3b4
  jne wrong_password
  mov eax, [pwd_in_1 + 20]
  mov edi, [pwd_cmp_1 + 20]
  add eax, edi
  mov [pwd_in_1 + 20], eax
  cmp eax, 0x57bcc5aa
  jne wrong_password


ask_password_2:
  ; Ask and check password 2
  lea rdi, [pwd_ask_2]
  mov rsi, pwd_ask_len_2
  call _print
  lea rdi, [pwd_in_2]
  mov rsi, 36
  call _read
  mov eax, [pwd_in_2 + 0]
  mov edi, [pwd_cmp_2 + 0]
  add eax, edi
  mov [pwd_in_2 + 0], eax
  cmp eax, 0xe4cddec0
  jne wrong_password
  mov eax, [pwd_in_2 + 4]
  mov edi, [pwd_cmp_2 + 4]
  add eax, edi
  mov [pwd_in_2 + 4], eax
  cmp eax, 0x99b6d3ba
  jne wrong_password
  mov eax, [pwd_in_2 + 8]
  mov edi, [pwd_cmp_2 + 8]
  add eax, edi
  mov [pwd_in_2 + 8], eax
  cmp eax, 0xe6dde0bf
  jne wrong_password
  mov eax, [pwd_in_2 + 12]
  mov edi, [pwd_cmp_2 + 12]
  sub eax, edi
  mov [pwd_in_2 + 12], eax
  cmp eax, 0x2c021c26
  jne wrong_password
  mov eax, [pwd_in_2 + 16]
  mov edi, [pwd_cmp_2 + 16]
  add eax, edi
  mov [pwd_in_2 + 16], eax
  cmp eax, 0x7a5cc6d1
  jne wrong_password


ask_password_3:
  ; Ask and check password 3
  lea rdi, [pwd_ask_3]
  mov rsi, pwd_ask_len_3
  call _print
  lea rdi, [pwd_in_3]
  mov rsi, 36
  call _read
  mov eax, [pwd_in_3 + 0]
  mov edi, [pwd_cmp_3 + 0]
  sub eax, edi
  mov [pwd_in_3 + 0], eax
  cmp eax, 0x211eb60b
  jne wrong_password
  mov eax, [pwd_in_3 + 4]
  mov edi, [pwd_cmp_3 + 4]
  add eax, edi
  mov [pwd_in_3 + 4], eax
  cmp eax, 0x62939776
  jne wrong_password
  mov eax, [pwd_in_3 + 8]
  mov edi, [pwd_cmp_3 + 8]
  add eax, edi
  mov [pwd_in_3 + 8], eax
  cmp eax, 0xd9c4c6c3
  jne wrong_password
  mov eax, [pwd_in_3 + 12]
  mov edi, [pwd_cmp_3 + 12]
  add eax, edi
  mov [pwd_in_3 + 12], eax
  cmp eax, 0x79d8ccc2
  jne wrong_password

  add dword [pwd_in_1 + 0], 1264807755
  add dword [pwd_in_1 + 4], 1482053561
  add dword [pwd_in_1 + 8], 1304575854
  sub dword [pwd_in_1 + 12], 2606394996
  sub dword [pwd_in_1 + 16], 1330205755
  sub dword [pwd_in_1 + 20], 927487555
  add dword [pwd_in_1 + 24], 543516788
  add dword [pwd_in_1 + 28], 1734437990
  add dword [pwd_in_1 + 32], 1952391226
  sub dword [pwd_in_2 + 0], 1988394331
  sub dword [pwd_in_2 + 4], 877816391
  sub dword [pwd_in_2 + 8], 2058130244
  add dword [pwd_in_2 + 12], 1114380102
  sub dword [pwd_in_2 + 16], 453988744
  add dword [pwd_in_2 + 20], 1647342160
  add dword [pwd_in_2 + 24], 1936536428
  add dword [pwd_in_2 + 28], 863122527
  add dword [pwd_in_2 + 32], 1916037215
  add dword [pwd_in_3 + 0], 257272153
  add dword [pwd_in_3 + 4], 161274857
  sub dword [pwd_in_3 + 8], 2842006349
  sub dword [pwd_in_3 + 12], 359884941
  add dword [pwd_in_3 + 16], 959526199
  add dword [pwd_in_3 + 20], 959658292
  add dword [pwd_in_3 + 24], 892482404
  add dword [pwd_in_3 + 28], 1647392612
  add dword [pwd_in_3 + 32], 175978544

  lea rdi, [pwd_in_1]
  mov rsi, 36
  call _print

  lea rdi, [pwd_in_2]
  mov rsi, 36
  call _print

  lea rdi, [pwd_in_3]
  mov rsi, 36
  call _print
  jmp _exit

wrong_password:
  lea rdi, [wrong_pwd]
  mov rsi, wrong_pwd_len
  call _print
  call _exit

  
_read:
    mov rdx, rsi
    mov rsi, rdi
    mov r9, rsi
    mov rax, 0
    mov rdi, 0
    syscall
    add r9, rax
    xor rdi, rdi
    mov [r9], rdi
    ret

_print:
    mov rdx, rsi
    mov rsi, rdi
    mov rax, 1
    mov rdi, 1
    syscall
    ret

_exit:
    mov rax, 60
    xor rdi, rdi
    syscall
    ret

_trace_trap:
    lea rdi, [wrong_pwd]
    mov rsi, 10
    call _read
    jmp _trace_trap
