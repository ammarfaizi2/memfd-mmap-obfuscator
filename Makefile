

NASM = nasm
CC   = gcc

all: layer1

src/helpers_l1.o: src/helpers_l1.asm
	${NASM} -felf64 -O0 src/helpers_l1.asm -o src/helpers_l1.o

src/helpers_l2.o: src/helpers_l2.asm
	${NASM} -felf64 -O0 src/helpers_l2.asm -o src/helpers_l2.o

src/layer1.o: src/layer1.asm
	${NASM} -felf64 -O0 src/layer1.asm -o src/layer1.o

layern: src/layern.o src/helpers_l1.o src/helpers_l2.o
	ld src/layern.o src/helpers_l1.o src/helpers_l2.o -o layern

clean:
	rm -rfv *.o src/*.o layer1