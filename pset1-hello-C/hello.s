	.file	"hello.c"
	.text
	.globl	main
	.align	16, 0x90
	.type	main,@function
main:                                   # @main
# BB#0:
	pushl	%ebp
	movl	%esp, %ebp
	pushl	%esi
	subl	$20, %esp
	movl	12(%ebp), %eax
	movl	8(%ebp), %ecx
	leal	.L.str, %edx
	leal	.L.str1, %esi
	movl	%ecx, -8(%ebp)
	movl	%eax, -12(%ebp)
	movl	%edx, (%esp)
	movl	%esi, 4(%esp)
	calll	printf
	movl	$0, %ecx
	movl	%eax, -16(%ebp)         # 4-byte Spill
	movl	%ecx, %eax
	addl	$20, %esp
	popl	%esi
	popl	%ebp
	ret
.Ltmp0:
	.size	main, .Ltmp0-main

	.type	.L.str,@object          # @.str
	.section	.rodata.str1.1,"aMS",@progbits,1
.L.str:
	.asciz	"hello, world. My name is %s!\n"
	.size	.L.str, 30

	.type	.L.str1,@object         # @.str1
.L.str1:
	.asciz	"Makar"
	.size	.L.str1, 6


	.ident	"Ubuntu clang version 3.4-1ubuntu3 (tags/RELEASE_34/final) (based on LLVM 3.4)"
	.section	".note.GNU-stack","",@progbits
