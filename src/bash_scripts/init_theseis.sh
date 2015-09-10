#!/bin/bash

ip="10.0.0.254"
IMAGE_DIR=images
IMAGE_HTML=images.html
MYSQL_PASS="raspberry"

#Diagrafoyme tis plies eikones.
/bin/rm -rf $IMAGE_DIR
/bin/mkdir -p $IMAGE_DIR

#Diagrafoyme tis palies theseis.
mysql -h "localhost" -p${MYSQL_PASS} -u "root" multsyst --skip-column-names -e "TRUNCATE TABLE theseis"

echo "<!DOCTYPE html>" > $IMAGE_HTML
echo "<html>" >> $IMAGE_HTML
echo "<body style=\"font-size: 4em;\">" >> $IMAGE_HTML

#Bazoyme tis theseis
for i in $(seq 1 51)
do
    #Tyxaios tetrapsifios aritjmos
    pass=$[ ( $RANDOM % 9000) + 1000 ]
    /usr/bin/qrencode -s 7 -o "$IMAGE_DIR/$i.png" "http://$ip/index.php?thesh=$i&pass=$pass"
    query="INSERT INTO theseis (id,pass) VALUES ('$i', '$pass');"
    mysql -h "localhost" -p${MYSQL_PASS} -u "root" multsyst --skip-column-names -e "$query"

    echo "<div style=\"display: inline-block;\">" >> $IMAGE_HTML
    echo "<img src=\"$IMAGE_DIR/$i.png\" title=\"Home\"/>" >> $IMAGE_HTML
    echo "<br/>" >> $IMAGE_HTML
    echo "<label>or Browser--> 192.168.2.1</label>" >> $IMAGE_HTML
    echo "<br/>" >> $IMAGE_HTML
    echo "<label> Seat: $i </label>" >> $IMAGE_HTML
    echo "<br/>" >> $IMAGE_HTML
    echo "<label> Pass: $pass </label>" >> $IMAGE_HTML
    echo "</div>" >> $IMAGE_HTML
done

echo "</body>" >> $IMAGE_HTML
echo "</html>" >> $IMAGE_HTML

exit 0
