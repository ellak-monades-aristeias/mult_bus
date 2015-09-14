#!/bin/bash

#/bin/sleep 60
BASE_DIR='/home/pi/Desktop/mult_bus/src/bash_scripts'

/usr/bin/sudo /usr/bin/killall play_songs.sh
/usr/bin/sudo /usr/bin/killall play_video.sh
#/usr/bin/sudo /usr/sbin/service networking stop
#/usr/bin/sudo /usr/sbin/service networking start
#/usr/bin/sudo /usr/sbin/service isc-dhcp-server stop
#/usr/bin/sudo /usr/sbin/service hostapd stop
#/usr/bin/sudo /sbin/ifconfig wlan0 10.0.0.254 netmask 255.255.255.0 up
#/usr/bin/sudo /usr/sbin/service isc-dhcp-server start
#/usr/bin/sudo /sbin/ifconfig wlan0 10.0.0.254 netmask 255.255.255.0 up
#/usr/bin/sudo /usr/sbin/service hostapd start
#/usr/bin/sudo /sbin/ifconfig wlan0 10.0.0.254 netmask 255.255.255.0 up

${BASE_DIR}/init_songs.sh
${BASE_DIR}/play_songs.sh &
${BASE_DIR}/init_video.sh
${BASE_DIR}/play_video.sh &
