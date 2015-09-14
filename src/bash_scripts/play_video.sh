#!/bin/bash

/bin/sleep 120

BASE_DIR="/home/pi/media_files/video/"
MYSQL_PASS="raspberry"

psifoi=$(/usr/bin/mysql -p${MYSQL_PASS} -h "localhost" -u "root" multsyst --skip-column-names -e "SELECT count(*) as count FROM psifoi_video LIMIT 1" | /usr/bin/head -n 1)
if [ "$psifoi" -le "0" ]
then
    /bin/echo "No votes ..."
else
    id_video=$(/usr/bin/mysql -p${MYSQL_PASS} -h "localhost" -u "root" multsyst --skip-column-names -e "SELECT id_video FROM psifoi_video GROUP BY id_video ORDER BY count(*) DESC" | /usr/bin/head -n 1)
    name_video=$(/usr/bin/mysql -p${MYSQL_PASS} -h "localhost" -u "root" multsyst --skip-column-names -e "SELECT name FROM video WHERE id=$id_video" | /usr/bin/head -n 1)
    eksodos=$(/usr/bin/mysql -p${MYSQL_PASS} -h "localhost" -u "root" multsyst --skip-column-names -e "DELETE FROM psifoi_video WHERE id_video=$id_video" | /usr/bin/head -n 1 | /usr/bin/cut -f1)
    /usr/bin/omxplayer -o local "$BASE_DIR/$name_video.avi"
fi
