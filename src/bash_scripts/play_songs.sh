#!/bin/bash

#Replace these with the apropriate values.
BASE_DIR="/home/pi/media_files/music/"
MYSQL_PASS="raspberry"

#Run forever.
while true
do
    # Check if there are votes in the database.
    psifoi=$(/usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "SELECT count(*) as count FROM psifoi WHERE valid=true LIMIT 1" | /usr/bin/head -n 1)
    if [ "$psifoi" -le "0" ]
    then
        #If no song has votes, then do nothing for 10 seconds.
        /bin/echo "No votes. sleep ..."
        /bin/sleep 10
    else
        #Get the id of the song with the most votes.
        id_tragoydioy=$(/usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "SELECT id_tragoydioy FROM psifoi WHERE valid=true GROUP BY id_tragoydioy ORDER BY count(*) DESC" | /usr/bin/head -n 1)
        #Find the name of the song with the specific id.
        name_tragoydioy=$(/usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "SELECT name FROM tragoudia WHERE id=$id_tragoydioy" | /usr/bin/head -n 1)
        #Mark the votes of this song as invalid, in order to prevent them to be counted twice.
        eksodos=$(/usr/bin/mysql -h "localhost" -u "root" -p${MYSQL_PASS} multsyst --skip-column-names -e "UPDATE psifoi SET valid=false WHERE id_tragoydioy=$id_tragoydioy" | /usr/bin/head -n 1 | /usr/bin/cut -f1)
        #Play the song.
        /usr/bin/mpg321 "$BASE_DIR/$name_tragoydioy.mp3"
    fi
done
