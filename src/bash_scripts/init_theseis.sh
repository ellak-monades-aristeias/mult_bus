#!/bin/bash

#Replace these if needed.
ip="192.168.255.254"
IMAGE_DIR=images
IMAGE_HTML=images.html
MYSQL_PASS="raspberry"

#Delete the old files and images from the disk.
/bin/rm -rf $IMAGE_DIR
/bin/mkdir -p $IMAGE_DIR

#Delete the old pasword from the database.
mysql -h "localhost" -p${MYSQL_PASS} -u "root" multsyst --skip-column-names -e "TRUNCATE TABLE theseis"

#Create an html file with the seats and the corresponding passwords.
echo "<!DOCTYPE html>" > $IMAGE_HTML
echo "<html>" >> $IMAGE_HTML
echo "<body style=\"font-size: 4em;\">" >> $IMAGE_HTML

#Insert the seats
for i in $(seq 1 51)
do
    #Create a randon 4 digit password.
    pass=$[ ( $RANDOM % 9000) + 1000 ]
    #Create an image iwth the qr code.
    /usr/bin/qrencode -s 7 -o "$IMAGE_DIR/$i.png" "http://$ip/index.php?thesh=$i&pass=$pass"
    #Insert the code to the dataabse.
    query="INSERT INTO theseis (id,pass) VALUES ('$i', '$pass');"
    mysql -h "localhost" -p${MYSQL_PASS} -u "root" multsyst --skip-column-names -e "$query"

    #Also, append to the html file the seath, the password and the image with the qr code.
    echo "<div style=\"display: inline-block;\">" >> $IMAGE_HTML
    echo "<img src=\"$IMAGE_DIR/$i.png\" title=\"Home\"/>" >> $IMAGE_HTML
    echo "<br/>" >> $IMAGE_HTML
    echo "<label>or Browser--> 192.168.255.254</label>" >> $IMAGE_HTML
    echo "<br/>" >> $IMAGE_HTML
    echo "<label> Seat: $i </label>" >> $IMAGE_HTML
    echo "<br/>" >> $IMAGE_HTML
    echo "<label> Pass: $pass </label>" >> $IMAGE_HTML
    echo "</div>" >> $IMAGE_HTML
done

echo "</body>" >> $IMAGE_HTML
echo "</html>" >> $IMAGE_HTML

exit 0
