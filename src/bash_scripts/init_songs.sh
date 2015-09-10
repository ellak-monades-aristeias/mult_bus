#!/bin/bash

BASE_DIR="/home/pi/media_files/music/"
MYSQL_PASS="raspberry"

#Diagrafoyme ta palia tragoydia.
/usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "TRUNCATE TABLE psifoi"
/usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "TRUNCATE TABLE tragoudia"

#Bazoyme ta kainoyria.
cd "$BASE_DIR"
tragoydia=$(/bin/ls *.mp3 2> /dev/null | /bin/sed "s/.mp3$//g" )
ls_status=$?
if [ $ls_status -eq 0 ]
then
    id=1
    printf "%s\n" "$tragoydia" | while IFS= read -r line
    do
        #line = $(/bin/echo $line | /bin/sed "s/\'/\\\'/g")
        query="INSERT INTO tragoudia (id, name) VALUES ($id, '$line');"
        #echo $query
        /usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "$query"
         id=$[$id +1]
    done
else
    echo "Directory $BASE_DIR does not exist or empty."
    exit 1
fi

exit 0
