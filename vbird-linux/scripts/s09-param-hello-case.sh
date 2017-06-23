#!/bin/bash
# Program:
#Check $1 is equal to "hello"
# History:
# 2005/08/28 VBird First release
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin:~/bin
export PATH

case $1 in
"hello")
  echo "Hello, how are you ?"
;;
"")
  echo "You MUST input parameters, ex> {$0 someword}"
;;
*) # 其实就相当亍通配符,0~无穷多个任意字符乀意!
  echo "Usage $0 {hello}"
;;
esac
