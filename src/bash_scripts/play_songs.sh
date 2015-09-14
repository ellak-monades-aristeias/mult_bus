#!/bin/bash

BASE_DIR="/home/pi/media_files/music/"
MYSQL_PASS="raspberry"

#Pairnei thn proth grammh toy arxeioy.
while true
do
    psifoi=$(/usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "SELECT count(*) as count FROM psifoi WHERE valid=true LIMIT 1" | /usr/bin/head -n 1)
    if [ "$psifoi" -le "0" ]
    then
        /bin/echo "No votes. sleep ..."
        /bin/sleep 10
    else
        id_tragoydioy=$(/usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "SELECT id_tragoydioy FROM psifoi WHERE valid=true GROUP BY id_tragoydioy ORDER BY count(*) DESC" | /usr/bin/head -n 1)
        name_tragoydioy=$(/usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "SELECT name FROM tragoudia WHERE id=$id_tragoydioy" | /usr/bin/head -n 1)
        eksodos=$(/usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "UPDATE psifoi SET valid=false WHERE id_tragoydioy=$id_tragoydioy" | /usr/bin/head -n 1 | /usr/bin/cut -f1)
        /usr/bin/mpg321 "$BASE_DIR/$name_tragoydioy.mp3"
    fi
done
