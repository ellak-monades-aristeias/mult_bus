# Developer documentation

The software is based on Linux, Apache, Mysql and PHP (LAMP), and some bash scripts.

First, you need to clone the repository:

    git clone https://github.com/ellak-monades-aristeias/mult_bus.git

The source code is placed in the src folder. The directory structure is based on the programming languate that is used for the scripts in the subdirectory.

The bash_scripts directory contains the scripts that are writen in bash. They contain the programs that initialize the database contents based on the contents of the filesystem, that count the votes and play the most voted song or video and that create the document with the seat and the password which can be placed in every seat.

The mysql_scripts contain the files with the sql commands that initialize tha database and insert initial contents, like the translations.

The php_scripts directory contain the php scripts that run in the remote server and store and display the location of the bus and the information around this place.

The python_scripts direcotry contains the program that reads the gps coordinates and send them to the server.

The www directory contain the web interface that use the clients in order to vote for the song or the video.

For a detailed documentation, please refer to the [wiki](https://github.com/ellak-monades-aristeias/mult_bus/wiki).
