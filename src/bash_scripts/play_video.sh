#!/bin/bash

#Wait for 2 minutes before start counting the votes.
/bin/sleep 120

#Replace these with the apropriate values.
BASE_DIR="/home/pi/media_files/video/"
MYSQL_PASS="raspberry"

# Check if there are votes in the database.
psifoi=$(/usr/bin/mysql -p${MYSQL_PASS} -h "localhost" -u "root" multsyst --skip-column-names -e "SELECT count(*) as count FROM psifoi_video LIMIT 1" | /usr/bin/head -n 1)
if [ "$psifoi" -le "0" ]
then
    #If no song has votes, then do nothing.
    /bin/echo "No votes ..."
else
    #Get the id of the video with the most votes.
    id_video=$(/usr/bin/mysql -p${MYSQL_PASS} -h "localhost" -u "root" multsyst --skip-column-names -e "SELECT id_video FROM psifoi_video GROUP BY id_video ORDER BY count(*) DESC" | /usr/bin/head -n 1)
    #Find the name of the video with the specific id.
    name_video=$(/usr/bin/mysql -p${MYSQL_PASS} -h "localhost" -u "root" multsyst --skip-column-names -e "SELECT name FROM video WHERE id=$id_video" | /usr/bin/head -n 1)
    #Delete the votes of this video. This is not necessary, as only one video will play.
    eksodos=$(/usr/bin/mysql -p${MYSQL_PASS} -h "localhost" -u "root" multsyst --skip-column-names -e "DELETE FROM psifoi_video WHERE id_video=$id_video" | /usr/bin/head -n 1 | /usr/bin/cut -f1)
    #Play the video.
    /usr/bin/omxplayer -o local "$BASE_DIR/$name_video.avi"
fi
