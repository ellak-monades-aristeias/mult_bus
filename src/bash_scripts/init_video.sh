#!/bin/bash

BASE_DIR="/home/pi/media_files/video/"
MYSQL_PASS="raspberry"

#Diagrafoyme ta palia video.
/usr/bin/mysql -p${MYSQL_PASS} -h "localhost" -u "root" multsyst --skip-column-names -e "TRUNCATE TABLE psifoi_video"
/usr/bin/mysql -p${MYSQL_PASS} -h "localhost" -u "root" multsyst --skip-column-names -e "TRUNCATE TABLE video"

#Bazoyme ta kainoyria.
cd "$BASE_DIR"
video=$(/bin/ls *.avi 2> /dev/null | /bin/sed "s/.avi$//g" )
ls_status=$?
if [ $ls_status -eq 0 ]
then
    id=1
    printf "%s\n" "$video" | while IFS= read -r line
    do
        #line = $(/bin/echo $line | /bin/sed "s/\'/\\\'/g")
        query="INSERT INTO video (id, name) VALUES ($id, '$line');"
        #echo $query
        /usr/bin/mysql -p${MYSQL_PASS} -h "localhost" -u "root" multsyst --skip-column-names -e "$query"
         id=$[$id +1]
    done
else
    echo "Directory $BASE_DIR does not exist or empty."
    exit 1
fi

exit 0
