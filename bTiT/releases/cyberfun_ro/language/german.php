<?

// WELCOME & MENUS
define("WELCOME", "Willkommen");
define("WELCOME_BACK", "Willkommen");
define("LOGIN", "Login");
define("LOGOUT", "Logout");
define("MNU_INDEX", "Startseite");
define("MNU_TORRENT", "Torrents");
define("MNU_UPLOAD", "Hochladen");
define("MNU_MEMBERS", "Members");
define("MNU_NEWS", "News");
define("MNU_FORUM", "Forum");
define("MNU_ADMINCP", "Admin Panel");

// Blocks
// USER
define("BLOCK_USER", "User Info");
// INFO
define("BLOCK_MENU", "Trackernavi");
// TRACKER
define("BLOCK_INFO", "Tracker Info");
define("TRACKER_INFO", "$users users, tracking $torrents torrents ($seeds seeds e $leechers leechers, $percent%)");
// NEWS
define("LAST_NEWS", "Neuigkeiten");
define("POSTED_DATE", "geposted am");
define("POSTED_BY", "geposted von");
define("TITLE", "Betreff");
define("NO_NEWS", "keine neuigkeiten");
// USERS
define("MEMBERS_LIST", "Mitgliederliste");

// account
define("ACCOUNT_EDIT", "User CP");
define("ACCOUNT_CREATE", "Anmelden");
define("ACCOUNT_DELETE", "Account löschen");
define("USER_NAME", "User");
define("USER_PWD", "Passwort");
define("USER_PWD_AGAIN", "Passwort wiederholen");
define("USER_EMAIL", "gültige email");
define("USER_LEVEL", "Rang");
define("USER_LANGUE", "Sprache");
define("USER_STYLE", "Style");
define("USER_LASTACCESS", "letzter Zugriff");
define("USER_JOINED", "Angemeldet am");
define("USER_CP", "User CP");
define("EMAIL_SENT", "eine email wird zugeschickt zur bestätigung.");
define("ACCOUNT_CONFIRM", "Mitgliedsbestätigung $SITENAME site.");
define("ACCOUNT_MSG", "Hello,\n\ndiese email wurde aufgrund einer anmeldung geschickt, wenn nicht beachten sie diesemail nicht \n\ngrüße vom team.");
define("ACCOUNT_CONGRATULATIONS", "Gratuliere dein account wurde bestätigt!<br>nun kannst du dich einloggen <a href=login.php>login</a>");

// ADMIN


// general
define("MEMBERS", "Users");
define("TRACKING", "tracking");
define("TORRENTS", "torrent(s)");
define("SEEDERS", "seed(s)");
define("LEECHERS", "leecher(s)");
define("WORD_AND", "und");
define("HERE", "hier");
define("REDIRECT", "wenn dein browser kein java unterstützt klick hier");
define("NOT_AUTORIZED", "keine berechtigung");
define("NEWS", "Neuigkeiten");
define("ADD", "hinzufügen");
define("EDIT", "ändern");
define("DELETE", "löschen");
define("DELETE_CONFIRM", "wirklich löschen/entfernen?");
define("SORRY", "Sorry");
define("ALL", "Alle");
define("SEARCH", "Suche");
define("PREVIOUS", "vorherige");
define("NEXT", "nächste");
define("CHOOSE", "wählen");
define("FILE_NAME", "Dateiname");
define("FACOLTATIVE", "optional");
define("DESCRIPTION", "Beschreibung");
define("MORE_SMILES", "Mehr Emoticons");
define("YES", "Ja");
define("NO", "Nein");

// VARIOUS FORM
define("FRM_CONFIRM", "Bestätigen");
define("FRM_DELETE", "löschen");
define("FRM_CANCEL", "abbrechen");
define("FRM_LOGIN", "Login");
define("FRM_SEND", "Senden");
define("FRM_RESET", "Reset");


// torrent
define("TORRENT_UPDATE", "Updating, bitte warten...");
define("TORRENT_SEARCH", "Suche Torrents");
define("ACTIVE_ONLY", "nur aktive");
define("DEAD_ONLY", "nur inaktive");
define("CATEGORY", "Kat.");
define("CATEGORY_FULL", "Kategorie");
define("FILE", "Datei");
define("DOWN", "Dl");
define("ADDED", "hinzgf.");
define("SIZE", "Grösse");
define("DOWNLOADED", "DL'ed");
define("SPEED", "Speed");
define("AVERAGE", "Durchschnitt");
define("VIEW_DETAILS", "Details ansehen");
define("PEERS_DETAILS", "Peer Deatils");
define("NA", "N/A");
define("NO_TORRENTS", "Keine torrents hier...");
define("NOT_AUTORIZED_UPLOAD", "keine Upload Berechtigung!");
define("ERR_PARSER", "fehler im torrent.");
define("ERR_HASH", "info hash muss 40bytes lang sein.");
define("MSG_UP_SUCCESS", "erfolgreich hochgeladen.");
define("RETURN_TORRENTS", "zurück zu den torrents");
define("ERR_ALLREADY_EXIST", "torrent gibst schon.");
define("INSERT_DATA", "alles ausfüllen");
define("ANNOUNCE_URL","Tracker announce url:");
define("TORRENT_FILE","Torrent File");
define("TORRENT_CHECK","tracker wählt info");
define("TORRENT_ANONYMOUS","als anonymer senden");

// ADDED 27/10/04
// TORRENT'S DETAILS
define("TORRENT_DETAIL","Torrentdetails");
define("TORRENT","Torrent");
define("UPLOADER","Uploader");
define("PEERS", "peer(s)");
define("CLOSE", "schliessen");
define("UPDATE", "Update");

//PEERS
define("PEER_LIST", "Peer(s) List");
define("PEER_ID", "Peer ID");
define("PEER_COUNTRY", "Land");
define("PEER_PORT", "Port");
define("PEER_PROGRESS", "Fortschritt");
define("PEER_STATUS", "Status");
define("PEER_CLIENT", "Client");

// ADD NEWS

define("NEWS_INSERT","News einfügen");
define("NEWS_TITLE","Betreff:");
define("NEWS_DESCRIPTION","News:");

// ADDED 06/11/2004
// FORUMS
define("VIEW_UNREAD", "ungelesene ansehen");
define("CATCHUP", "alle als gelesen markieren");
define("WORD_NEW", "New");
define("POST", "Post");
define("POSTS", "Posts");
define("TOPIC", "Topic");
define("TOPICS", "Topics");
define("LOCKED", "Locked");
define("IN", "in");
define("FORUM", "Forum");
define("REPLY", "antworten");
define("SUBJECT", "Betreff");
define("LAST_10_POSTS", "letzten 10 posts, umgekehrte Reihenfolge");
define("ERR_SUBJECT", "Betreff angeben.");
define("VIEW_TOPIC", "Topic ansehen");
define("QUOTE", "kommentieren");
define("LAST_EDITED_BY", "zuletzt editiert von");
define("RENAME_TOPIC", "topic umbenennen");
define("MOVE_THREAD", "thread verschieben in");
define("TOPIC_LOCKED", "topic ist gesperrt; keine neuen posts sind erlaubt.");
define("ADD_REPLY", "antworten");
define("POST_REPLY", "antwort abgeben");
define("EDIT_POST", "Post ändern");
define("BODY", "Inhalt");
define("REPLIES", "Antworten");
define("VIEWS", "Angesehen");
define("AUTHOR", "Autor");
define("LASTPOST", "Letzter&nbsp;post");
define("STICKY", "Sticky");
define("NO_TOPIC", "keine topics gefunden");
define("TOPIC_UNREAD_POSTS","Topics mit ungelesenen posts");
define("SEARCH_HELP","gib mehrere suchbegriffe ein um alles zufinden.");
define("QUICK_JUMP","Wechsel");
define("GO","Los");

// 12/11/2004
define("OLD_PWD", "Altes Passwort");
define("READED", "gelesen");
define("SENDER", "Sender");
define("DATE", "Datum");
define("RECEIVER", "Empfänger");
define("FIND_USER", "Mitglied suchen");
define("ANSWER", "Answer");
define("NO_MESSAGES", "keine Nachrichten...");

define("RECOVER_PWD", "Passwort verloren");
define("RECOVER_TITLE","Wiederherstellung Name/Passwort");
define("RECOVER_DESC","Benutze dieses Formular um deine Daten wiederherzustellen, es wird dir eine email zugesandt.");


define("TORRENT_STATUS", "Status");
define("LAST_IP", "Letzte IP");
define("UPLOADED", "Hochgeladen");
define("RATIO", "Ratio");
define("WRITE_CATEGORY", "torrent kat. angeben...");
define("NEED_COOKIES", "Note: cookies müssen aktiviert sein.");
define("NO_FORUMS", "keine Foren gefunden!");
define("MNU_UCP_HOME", "User CP");
define("MNU_UCP_PM", "deine PM box");
define("MNU_UCP_NEWPM", "Neue PM");
define("MNU_UCP_INFO", "Profil ändern");
define("MNU_UCP_CHANGEPWD", "Passwort ändern");


?>