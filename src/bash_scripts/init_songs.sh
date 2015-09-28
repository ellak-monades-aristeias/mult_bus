#!/bin/bash

#Replace these if needed.
BASE_DIR="/home/pi/media_files/music/"
MYSQL_PASS="raspberry"

#Delete the previous songs and votes from the database.
/usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "TRUNCATE TABLE psifoi"
/usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "TRUNCATE TABLE tragoudia"

#Read the new songs from the directory in the disk.
cd "$BASE_DIR"
#Get only the files that end with .pm3 and keep only the part before the .mp3
tragoydia=$(/bin/ls *.mp3 2> /dev/null | /bin/sed "s/.mp3$//g" )
ls_status=$?
if [ $ls_status -eq 0 ]
then
    id=1
    printf "%s\n" "$tragoydia" | while IFS= read -r line
    do
        #line = $(/bin/echo $line | /bin/sed "s/\'/\\\'/g")
        #Create the query that inserts the name of the song in the database.
        query="INSERT INTO tragoudia (id, name) VALUES ($id, '$line');"
        #echo $query
        #Actually execute the querry.
        /usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "$query"
         id=$[$id +1]
    done
else
    #If the directory is empty, do nothing.
    echo "Directory $BASE_DIR does not exist or empty."
    exit 1
fi

exit 0
