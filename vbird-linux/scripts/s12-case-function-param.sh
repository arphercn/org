#!/bin/bash
# Program:
#This script only accepts the flowing parameter: one, two or three.
# History:
# 2005/08/29 VBird First release

PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin:~/bin
export PATH

function printit(){
  echo "Your choice is $1" # 这个 $1 必须要参考底下指令的下达
}

echo "This program will print your selection !"

case $1 in
"one")
  printit 1 # 请注意, printit 指令后面还有接参数!
;;
"two")
  printit 'bbbb'
;;
"three")
  printit 3
;;
*)
  echo "Usage $0 {one|two|three}"
;;
esac
