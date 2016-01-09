# mult_bus

This project contains the necessary source code and documentation in 
order to set up a multimedia center, which can be used inside a bus, in 
order to improve customer services. This system mainly uses (technological) 
devices such as monitors and speakers which exist in buses, which  after our 
system setup, passengers will be able to vote and play multimedia. They will 
connect to the system with their smart phones through wi-fi. In addition to that, 
the system will show the position of the bus on the Map, which will give 
opportunity to the passengers, and the people that wait for the bus to learn
where the bus exactly is on map. 

[User Documentation](Readme_user.md)

[Developer Documentation](Readme_developer.md)

# Wiki info

In order to install the software, please follow the guide in the wiki: https://github.com/ellak-monades-aristeias/mult_bus/wiki.

The milestones of the project are recorded in https://github.com/ellak-monades-aristeias/mult_bus/wiki/Milestones.

# Παραδοτέα

| Παραδοτέο | URL |
|-----------|-----|
| Παραδοτέο 1 |  |
|Αγορά υλικού| |
| Παραδοτέο 2 |  |
| εγκατάστασης προ εγκατάστασης των απαραίτητων λογισμικών και πακέτων στο raspberry pi (rasbian, apache, mariadb, php) | https://github.com/ellak-monades-aristeias/mult_bus/wiki/Pre-Installation-Requirements |
| Παραδοτέο 3 |  |
| Δημιουργία script που θα φτιάχνει τους πινάκες της βάσης δεδομένων | file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/mysql_scripts/create_tables.sql |
| Δημιουργία αρχείων πηγαίου κώδικα για την ψηφοφορία ώστε να προκύψει το δημοφιλέστερο οπτικοακουστικό αρχείο κάθε κατηγορίας (ταινία, μουσική). | directory : https://github.com/ellak-monades-aristeias/mult_bus/tree/master/src/www, file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/bash_scripts/init_theseis.sh, file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/bash_scripts/init_songs.sh, file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/bash_scripts/init_video.sh |
| Εγκατάσταση των παραπάνω αρχείων του λογισμικού στο raspberry pi. | https://github.com/ellak-monades-aristeias/mult_bus/wiki/Create-the-database-tables, https://github.com/ellak-monades-aristeias/mult_bus/wiki/Copy-the-php-script-to-apache, https://github.com/ellak-monades-aristeias/mult_bus/wiki/Initialize-the-seats-and-the-multimedia-directory |
| Παραδοτέο 4 |  |
| Δημιουργία αρχείων πηγαίου κώδικα για την αναπαραγωγή των δημοφιλέστερων επιλογών. | file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/bash_scripts/play_songs.sh, file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/bash_scripts/play_video.sh, file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/bash_scripts/run_mult_bus.sh |
| Εγκατάσταση των νέων αρχείων στο σύστημα. | https://github.com/ellak-monades-aristeias/mult_bus/wiki/Enable-the-playback-scripts |
| Παραδοτέο 5 |  |
| Σύνδεσης του raspberry pi με το 3g module. Σύνδεσης με το wifi usb. Δημιουργία τοπικού δικτύου μέσω του wifi usb. Προώθηση των πακέτων ip από το wifi στό 3g module.  | https://github.com/ellak-monades-aristeias/mult_bus/wiki/3G-module-with-local-access-point |
| Παραδοτέο 6 |  |
| Δημιουργία αρχείων πηγαίου κώδικα για την ανάγνωση των gps συντεταγμένων. | file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/python_scripts/read_and_send_gps.py |
| Σύνδεσης του raspberry pi με το gps module. | https://github.com/ellak-monades-aristeias/mult_bus/wiki/Connect-GPS |
| Παραδοτέο 7 |  |
| Δημιουργία αρχείων πηγαίου κώδικα για την εμφάνιση της τοποθεσίας του λεωφορείου στον χάρτη, και στους επιβάτες και σε ανθρώπους εκτός λεωφορείου. | file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/php_scripts/config.php, file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/php_scripts/index.php, file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/php_scripts/insert.php, file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/php_scripts/list.php, file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/php_scripts/map.php, file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/mysql_scripts/create_tables_opeshift.sql |
| Εγκατάσταση των νέων αρχείων στο σύστημα. | https://github.com/ellak-monades-aristeias/mult_bus/wiki/Create-a-server-that-will-store-the-GPS-coordinates |
| Παραδοτέο 8 |  |
| Δημιουργία αρχείων πηγαίου κώδικα για την σύνδεση με ιστοσελίδες κοινωνικής δικτύωσης. | file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/www/index.php |
| Παραδοτέο 9 |  |
| Δημιουργία αρχείων πηγαίου κώδικα για την παρουσίαση πληροφοριών για σημεία ενδιαφέροντος που είναι κοντά στο σημείο που βρίσκεται το λεωφορείο. | file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/php_scripts/map.php |
| Δημιουργία αρχείων πηγαίου κώδικα για την ανάκτηση των πληροφοριών από κεντρικό server. | file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/php_scripts/insert_place.php |
| Δημιουργία κεντρικού server όπου θα μπορούν να εισάγουν πληροφορίες διάφοροι φορείς για σημεία ενδιαφέροντος. | file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/php_scripts/delete_place.php, file: https://github.com/ellak-monades-aristeias/mult_bus/blob/master/src/mysql_scripts/create_tables_opeshift2.sql |
| Εγκατάσταση των νέων αρχείων στο σύστημα. | https://github.com/ellak-monades-aristeias/mult_bus/wiki/Create-the-scripts-that-will-show-info-around-the-bus |
