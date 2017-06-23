#!/bin/bash
PATH=/sbin:/bin:/usr/sbin:/usr/bin; export PATH

# 1. 清除规则
iptables -F
iptables -X
iptables -Z
# 2. 设定政策
iptables -P
INPUT DROP
iptables -P OUTPUT ACCEPT
iptables -P FORWARD ACCEPT
# 3~5. 制订各项规则
iptables -A INPUT -i lo -j ACCEPT
iptables -A INPUT -i enp0s3 -m state --state RELATED,ESTABLISHED -j ACCEPT
iptables -A INPUT -i enp0s3 -s 192.168.0.0/24 -j ACCEPT
# 6. 写入防火墙规则配置文件
/etc/init.d/iptables save
