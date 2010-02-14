<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5.X Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
global $users, $torrents, $seeds, $leechers, $percent, $BASEURL;

define("ACP_BAN_IP", "Ban IPs");
define("ACCOUNT_CONFIRM", "Confirmare Cont $SITENAME");
define("ACP_FORUM", "Forum`uri<br />Setari");
define("ACP_USER_GROUP", "Users Group<br />Settings");
define("ACCOUNT_EDIT", "Editeaza Cont");
define("ACCOUNT_MSG", "Salut,\n\nAcest email a fost trimis pentru ca cineva a creat un cont pe tracker-ul nostru cu aceasta adresa de email.\nDaca nu esti acea persoana ignora acest email, altfel te rugam sa iti confirmi contul");
define("ACCOUNT_CONGRATULATIONS", "Felicitari contul tau este acum valid!<br>Acum te poti <a href=login.php>autentifica</a> pe site folosindu-ti contul.");
define("ACP_STYLES", "Stil<br />Setari");
define("ACP_LANGUAGES", "Limba<br />Setari");
define("ACP_CATEGORIES", "Categorii<br />Setari");
define("ACCOUNT_CREATED", "Cont Creat");
define("ACTIVE_ONLY", "Doar Active");
define("ACCOUNT_DELETE", "Sterge Cont");
define("ACCOUNT_DETAILS", "detalii cont");
define("ACCOUNT_MGMT", "Administrare cont");
define("ACCOUNT_CREATE", "Creaza Cont");
define("ACP_TRACKER_SETTINGS", "Tracker's<br />Setari");
define("ACTION", "Actiune");
define("ACP_OPTIMIZE_DB", "Optimizeaza<br />Baza de Date");
define("ACP_CENSURED", "Cuvinte Cenzurate<br />Setari");
define("ADD", "Adaugare");
define("ADD_REPLY", "Adauga raspuns");
define("ADDED", "Adaugat");
define("ADMINCP_NOTES", "Aici iti poti controla toate setarile tracker`ului ...");
define("ADD_RATING", "adauga nota");
define("MOD_CPANEL", "Mod Control Panel");
define("ADMIN_CPANEL", "Admin Control Panel");
define("OWNER_CPANEL", "Owner Control Panel");
define("ALL_SHOUT", "Toate Mesajele");
define("ALL", "Tot");
define("ANSWER", "Raspuns");
define("ANONYMOUS", "Anonymous");
define("ANNOUNCE_URL","Tracker announce url:");
define("AUTHOR", "Autor");
define("AVERAGE", "Medie");
define("AVATAR_URL", "Avatar (url): ");
define("BAN_NOTE", "Aici poti vedea IP`urile restrictionate pentru tracker");
define("BACK", "Inapoi la");
define("BAD_ID", "ID Gresit!");
define("BAD_FORUM_ID", "ID Forum Gresit");
define("BCK_USERCP", "Inapoi la Panoul De Control");
define("BLOCK_USER", "User Info");
define("BLOCK_INFO", "Tracker Info");
define("BLOCK_MENU", "Meniu Principal");
define("BODY", "Body");
define("BY", "By");
define("CAT_SETTINGS", "Setari Categorii");
define("CANT_DELETE_TORRENT", "Nu esti autorizat sa stergi acest torrent!...");
define("CATEGORY", "Cat.");
define("CATEGORY_FULL", "Categorie");
define("CANT_DELETE_NEWS", "Nu esti autorizat sa stergi stirile!");
define("CATCHUP", "Marcheaza tot ca citit");
define("CANT_EDIT_TORR", "Nu esti autorizat sa editezi acest torrent!");
define("CANT_DO_QUERY", "Can't do SQL query - ");
define("CANT_DELETE_USER", "Nu esti autorizat sa stergi conturile!");
define("CANT_DELETE_ADMIN", "E imposibil sa stergi alt admin!");
define("CANT_WRITE_CONFIG", "Warning: nu am putut sa modific config.php!");
define("CANT_SAVE_CONFIG", "Nu am putu salva config.php");
define("CAT_IMAGE", "Imagine categorie");
define("CANT_FIND_TORRENT", "Nu am putut gasi torrent-ul!");
define("CAT_INSERT_NEW", "Adauga o noua Categorie");
define("CAT_SORT_INDEX", "Sorteaza Index");
define("CAT_ADD_CAT", "Adauga Categorie");
define("CANT_DELETE_GROUP", "Acest Level/Group nu poate fi anulat!");
define("CANT_SAVE_LANGUAGE", "Nu pot salva fisierul language");
define("CANT_READ_LANGUAGE", "nu pot citi fisierul language!");
define("CENS_ONE_PER_LINE", "Scrie <b>un cuvant pe line</b> pentru a-l interzice (va fi schimbat in *censured*)");
define("CHANGE_PID", "Schimba PID");
define("CHOOSE", "Alege");
define("CHOOSE_ONE", "alege unul");
define("CHARACTERS", "caractere");
define("CLOSE", "inchide");
define("CLICK_HERE", "click aici");
define("COMMENTS", "Comentarii");
define("CONFIG_SAVED", "Felicitari, noile setari au fost salvate");
define("COMMENT","Com.");
define("COMMENT_1", "Comentariu");
define("CURRENT_DETAILS", "Detalii Curente");
define("DATABASE_ERROR", "Database error.");
define("DATE", "Data");
define("DB_ERROR_REQUEST", "Database error. Cannot complete request.");
define("DB_SETTINGS", "Database's settings");
define("DELETE_ALL_READED", "Sterge tot ce ai citit");
define("DELETE_TOPIC", "Sterge Topic");
define("DELETE_TORRENT", "Sterge Torrent");
define("DEAD_ONLY", "Doar Inactive");
define("DESCRIPTION", "Descriere");
define("DELETE_CONFIRM", "Esti sigur ca vrei sa stergi asta?");
define("DELETE", "Sterge");
define("DIF_PASSWORDS", "Parolele nu se potrivesc!");
define("DOWNLOADED", "Downloaded");
define("DOWN", "Dl");
define("DONT_NEED_CHANGE", "nu trebuie sa schimbi asta!");
define("DOWNLOAD","Download");
define("DOWNLOAD_TORRENT", "Download Torrent");
define("EDIT_CAT", "Editeaza Categorie");
define("EDIT", "Editeaza");
define("EDIT_POST", "Editeaza Post");
define("EDIT_STYLE", "Editeaza Stil");
define("EDIT_TORRENT", "Editeaza Torrent");
define("EDIT_CENSURED", "Editeaza Cuvinte Cenzurate");
define("EDIT_LANGUAGE", "Editeaza Limba");
define("EMAIL_SENT", "Un email a fost trimis la adresa introdusa<br>click in linkul din email pentru ati confirma contul");
define("EMAIL", "Email");
define("ERR_DELETE_POST", "Sterge post. Sanity check: Esti pe cale sa stergi un mesaj. Click");
define("ERR_CANT_CONNECT", "Can't connect to local MySQL server");
define("ERR_CANT_OPEN_DB", "Can't open database");
define("ERR_500", "HTTP/1.0 500 Unauthorized access!");
define("ERR_NOT_FOUND", "Not Found...");
define("ERR_MISSING_DATA", "Missing data!");
define("ERR_EMAIL_ALREADY_EXISTS", "This Email is already in our database!");
define("ERR_USER_NOT_FOUND", "Sorry, User not Found");
define("ERR_NOT_AUTH", "you're not authorized!");
define("ERR_GUEST_EXISTS", "The Guest name is a registered named. You can't register as 'Guest'");
define("ERR_PARSER", "Se pare ca exista o eroare in torrent-ul tau ( foloseste naibii uTorrent )");
define("ERR_HASH", "Info hash trebuie sa aiba exact 40 hex bytes.");
define("ERR_CANT_START_TOPICS", "Nu esti autorizat sa creezi topicuri noi in acest forum");
define("ERR_ALREADY_EXIST", "Acest torrent exista deja in baza noastra de date");
define("ERR_CANT_FIND_GROUP", "Nu pot gasi acest grup");
define("ERR_TORRENT_IN_BROWSER", "Acest fisier este pentru clientele BitTorrent.");
define("ERR_INVALID_INFO_BT_CLIENT", "Invalid information received from BitTorrent client");
define("ERR_PID_NOT_FOUND", "Please redownload the torrent. PID system is active and pid was not found in the torrent");
define("ERR_LEVEL", "Scuze frate, nivelul tau ");
define("ERR_INVALID_CLIENT_EVENT", "Invalid event= from client.");
define("ERROR_ID", "Eroare ID");
define("ERR_USER_NOT_USER", "Nu esti autorizat sa accesezi panoul de control al altui user!");
define("ERROR", "Error:");
define("ERR_NO_POST_WITH_ID", "Nici un post cu acest ID ");
define("ERR_FORUM_TOPIC", "Forum sau Topic ID Gresit.");
define("ERR_TOPIC_ID", "Topic ID Gresit");
define("ERR_PERM_DENIED", "Acces Interzis");
define("ERR_NO_BODY", "Nu ai scris nimic");
define("ERR_NO_TOPIC_ID", "Nici un Topic ID returnat");
define("ERR_TOPIC_ID_NA", "Topic ID este N/A");
define("ERR_TOPIC_LOCKED", "Topic este Inchis");
define("ERR_POST_ID_NA", "Post ID ieste N/A");
define("ERR_LEVEL_CANT_VIEW", "Nu ai access pentri a vedea acest topic");
define("ERR_LEVEL_CANT_POST", "Nu ai access pentri a vedea acest forum.");
define("ERR_FORUM_NOT_FOUND", "Forum inexistent");
define("ERR_DELETE_TOPIC", "Sterge topic. Sanity check: Esti pe cale sa stergi un topic. Click");
define("ERR_NO_TOPIC_POST_ID", "Nici un topic asocita cu acest post");
define("ERR_BODY_EMPTY", "Body nu poate fi gol!");
define("ERR_POST_NOT_FOUND", "Mesaj inexistent");
define("ERR_POST_UNIQUE", "Nu poti sterge mesajul; este singur mesaj din topic. Ar trebui");
define("ERR_POST_UNIQUE_2", "sa stergi topicul topic");
define("ERR_POST_UNIQUE_3", "in loc");
define("ERR_SERVER_LOAD", "Siteul nostru este foarte incarcat . Incerc, mai asteapta...");
define("ERR_ENTER_NEW_TITLE", "Trebuie sa introduci un titlu nou!");
define("ERR_NOT_PERMITED", "Respins");
define("ERR_USER_ALREADY_EXISTS", "Mai exista un cont cu acest nume!");
define("ERR_BAD_LAST_POST", "");
define("ERR_USERNAME_INCORRECT", "User Incorect");
define("ERR_PASSWORD_INCORRECT", "Parola Incorecta");
define("ERR_IMAGE_CODE", "Codul din imagine nu se potriveste cu ce ai scris");
define("ERR_NO_SPACE", "Numele nu poate contine spatii, inlocuiestel cu _ ex:<br /><br />");
define("ERR_SPECIAL_CHAR", "<font color=\"black\">Numele nu poate contine caractere speciale ca:<br /><br /><font color=\"red\"><strong>* ? < > @ $ & % etc.</strong></font></font><br />");
define("ERR_PASS_LENGTH", "<font color=\"black\">Parola trebuie sa aiba minim 4 caractere.</font>");
define("ERR_BAD_NEWS_ID", "Stire proasta!");
define("ERR_NO_NEWS_ID", "ID`ul stirii nu s`a gasit!");
define("ERR_INS_TITLE_NEWS", "Trebuie sa introduci si titlu si continut");
define("ERR_NO_EMAIL", "Trebuie sa introduci o adresa de email");
define("ERR_EMAIL_NOT_FOUND_1", "Aceasta adresa de email");
define("ERR_EMAIL_NOT_FOUND_2", "nu a fost gasita in baza de date");
define("ERR_DB_ERR", "Database error. Te rog contacteaza un admin in legatura cu aceasta eroare.");
define("ERR_SEND_EMAIL", "Nu pot trimite mail. Te rog contacteaza un admin in legatura cu aceasta eroare.");
define("ERR_UPDATE_USER", "Nu pot acutualiza datele user-ului. Te rog contacteaza un admin in legatura cu aceasta eroare.");
define("ERR_FORUM_UNKW_ACT", "Eroare Forum: Actiune necunoscuta");
define("ERR_MUST_BE_LOGGED_SHOUT", "Trebuie sa te autentifici pentru a posta");
define("ERR_INV_NUM_FIELD", "Invalid numerical field(s) from client");
define("ERR_MOVING_TORR", "Nu pot muta torrent`ul ...");
define("ERR_INVALID_IP_NUMB", "Adresa IP invalida. trebuie sa fie de genul 1.1.1.1 (domeniile nu sunt permise)");
define("ERR_SUBJECT", "Trebuie sa introduci un subiect.");
define("ERR_NO_VOTE", "Trebuie sa alegi o nota pentru a vota");
define("ERR_EXTERNAL_NOT_ALLOWED", "Torrentele externe nu sunt permise");
define("ERR_RETR_DATA", "Error retreaving data!");
define("ERR_SQL_ERR", "SQL Error");
define("FACOLTATIVE", "optional");
define("FILE_UPLOAD_ERROR_2", "File Upload Error");
define("FINISHED", "Terminat");
define("FIND_USER", "Cauta user");
define("FILE", "Fisier");
define("FIVE_STAR", "5 stele");
define("FIRST_IP", "Primul IP");
define("FILE_UPLOAD_ERROR_1", "Nu pot citi fisierul upload`at");
define("FILE_UPLOAD_ERROR_3", "Fisierul are 0 b");
define("FILE_NAME", "Nume fisier");
define("FILE_CONTENTS", "Continut Fisier");
define("FOUND", "Gasit");
define("FORUM_PRUNE_1", "Sunt topicuri si/sau mesaje in acest forum!<br />O sa le pierzi pe toate...<br />");
define("FORUM_MIN_CREATE", "Clasa minima pentru a citi");
define("FORUMS", "Forumuri");
define("FORUM_MIN_WRITE", "Clasa minima pentru a scrie");
define("FORUM_MIN_READ", "Clasa minima pentru a citi");
define("FORUM_PRUNE_3", "altfel dute inapoi.");
define("FORUM_NAME", "Nume Forum");
define("FORUM_SETTINGS", "Setari Forumuri");
define("FORUM_N_TOPICS", "N. Topicuri");
define("FORUM_ERROR", "Forum Error");
define("FOUR_STAR", "4 stele");
define("FORUM_INFO","Forum Info");
define("FORUM", "Forum");
define("FORUM_SEARCH", "Cauta in Forumuri");
define("FORUM_PRUNE_2", "Daca esti sigur sa anulezi acest forum");
define("FORUM_N_POSTS", "N. Posturi");
define("FRM_DELETE", "Sterge");
define("FRM_RESET", "Reset");
define("FRM_SEND", "Trimite");
define("FRM_LOGIN", "Autentificare");
define("FRM_CANCEL", "Anuleaza");
define("FRM_CONFIRM", "Confirma");
define("GLOBAL_SERVER_LOAD", "Global Server Load (All websites on current server)");
define("GO","Dute");
define("GROUP_NAME", "Numele grupului");
define("GROUP_VIEW_NEWS", "Vezi Stiri");
define("GROUP_VIEW_FORUM", "Vezi Forum");
define("GROUP_EDIT_FORUM", "Editeaza Forum");
define("GROUP_BASE_LEVEL", "Alege un nivel de baza");
define("GROUP_ERR_BASE_SEL", "Eroare la nivel de baza selectat!");
define("GROUP", "Grup");
define("GROUP_DELETE_NEWS", "Sterge Stire");
define("GROUP_PCOLOR", "Prefix Culoare ( ca ");
define("GROUP_SCOLOR", "Sufix Culoare ( ca ");
define("GROUP_VIEW_TORR", "Vezi Torrente");
define("GROUP_EDIT_TORR", "Editeaza Torrente");
define("GROUP_VIEW_USERS", "Vezi Useri");
define("GROUP_DELETE_TORR", "Sterge Torrente");
define("GROUP_EDIT_USERS", "Editeaza Useri");
define("GROUP_DOWNLOAD", "Poate Downloada");
define("GROUP_DELETE_USERS", "Sterge Useri");
define("GROUP_DELETE_FORUM", "Sterge Forum");
define("GROUP_MOD_CP", "Poate accesa Mod CP");
define("GROUP_GO_CP", "Poate accesa Admin CP");
define("GROUP_OWNER_CP", "Poate accesa Owner CP");
define("GROUP_EDIT_NEWS", "Editeaza Stiri");
define("GROUP_ADD_NEW", "Adauga grup nou");
define("GROUP_UPLOAD", "Poate face Upload");
define("GUEST", "Guest");
define("HERE", "aici");
define("HISTORY", "Istorie");
define("HOME", "Acasa");
define("IF_YOU_ARE_SURE", "daca estio sigur.");
define("IMAGE_CODE", "Cod imagine");
define("IM_SURE", "Sunt sigur");
define("INVALID_ID", "ID`ul nu este valid!");
define("INFINITE", "Inf.");
define("IN", "in");
define("INSERT_NEW_FORUM", "Adauga forum nou");
define("INSERT_USERNAME", "Trebuie sa introduci un user!");
define("INSERT_PASSWORD", "Trebuie sa introduci o parola!");
define("INSERT_NEW_LANGUAGE", "Adauga o Limba");
define("INF_CHANGED", "Informatie schimbata!");
define("INVALID_PID", "PID Invalid");
define("INS_OLD_PWD", "Introdu parola VECHE!");
define("INSERT_NEW_STYLE", "Adauga Stil Nou");
define("INVALID_TORRENT", "Tracker error: invalid torrent");
define("INSERT_DATA", "Nu esti sigur de ce poti upload`a? Foloseste <a class=altlink href=ulguide.php>Ghidul de Upload.</a><br>Adauga datele necesare de upload.<br>");
define("UPLOADERS_GUIDE", "Ghidul Uploader`ilor");
define("INFO_HASH", "Info Hash");
define("INSERT_USER_GROUP", "Adauga un nou Grup de Useri");
define("INVALID_INFO_HASH", "info hash invalid.");
define("INS_NEW_PWD", "Scrie NOUA parola!");
define("IP_ERROR", "Bad IP address.");
define("KEYWORDS", "Cuvinte cheie");
define("LASTPOST", "Ultimul mesaj");
define("LANGUAGE_SETTINGS", "Setari Limba");
define("LAST_EDITED_BY", "Ultima oara editat de");
define("LAST_10_POSTS", "Ultimele 10 mesaje, in ordine inversa");
define("LANGUAGE_SAVED", "Felicitari, limba a fost modificate");
define("LAST_UPDATE", "Ultimul Update");
define("LAST_TORRENTS", "Ultimele Torrent`e");
define("LAST_EXTERNAL", "Ultimul Update Facut torrent`elor externe a fost facut ");
define("LAST_SANITY", "Ultima verificare a fost facuta ");
define("LAST_POST_BY", "Ultimul mesaj de");
define("LAST_NEWS", "Ultimele stiri");
define("LAST_IP", "Ultimul IP");
define("LEECHERS", "leecher(s)");
define("LOGIN", "Autentificare");
define("LOCKED", "Inchis");
define("LOGOUT", "Iesi");
define("MANAGE_NEWS", "Modifca Stiri");
define("MAILBOX", "Mailbox");
define("MEMBER", "membru");
define("MEMBERS_LIST", "Lista User`ilor");
define("MEMBERS", "Useri");
define("MINIMUM_5_SEED", " cu maxim 5 seeders ");
define("MINIMUM_100_DOWN", "( cu maxim 100 MB download`ati )");
define("MINIMUM_5_LEECH", " cu maxim 5 leechers, torrentele inactive nu sunt incluse ");
define("MKTOR_INVALID_HASH", "makeTorrent: Received an invalid hash");
define("MNU_UPLOAD", "Upload");
define("MNU_MEMBERS", "Membri");
define("MNU_INDEX", "InDeX");
define("MNU_UCP_INFO", "Modifica Profil");
define("MNU_UCP_NEWPM", "Mesaj privat nou");
define("MNU_UCP_OUT", "Your PM outbox");
define("MNU_TORRENT", "Torrent`e");
define("MNU_UCP_CHANGEPWD", "Modifica Parola");
define("MNU_STATS", "Extra Statistici");
define("MNU_ADMINCP", "Admin Panel");
define("MNU_FORUM", "Forum");
define("MNU_NEWS", "Stiri");
define("MNU_UCP_IN", "Your PM inbox");
define("MNU_UCP_HOME", "User's CP Home");
define("MNU_UCP_PM", "Your PM box");
define("MORE_THAN_2", "items found, le arat pe primele");
define("MORE_SMILES", "Mai multi zambareti");
define("MORE_THAN", "Mai mult de ");
define("MOVE_THREAD", "Muta acest thread in/la");
define("MSG_UP_SUCCESS", "Upload complet! torrent`ul a fost adaugat.");
define("MSG_DOWNLOAD_PID","Sistemul PID este active iati torrent`ul cu PID");
define("NA", "N/A");
define("NAME", "Nume");
define("NEWS_TITLE","Titlu:");
define("NEWS_INSERT","Scrieti stirea");
define("NEW_COMMENT", "Adauga un comentariu la");
define("NEED_COOKIES", "Nota: Ai nevoie de cookies activ pentru a te putea autentifica.");
define("NEWS_PANEL", "Panoul de stiri");
define("NEXT", "Urnatorul");
define("NEW_COMMENT_T", "Comentariu Nou");
define("NEWS", "stirile");
define("NEWS_DESCRIPTION","Stiri:");
define("NOT_ADMIN_CP_ACCESS", "Nu esti autorizat sa accesezi panoul adminului! iesi de aici");
define("NO_MESSAGES", "Nici un PM gasit ...");
define("NO_FORUMS", "Nici un Forum gasit!");
define("NOW_LOGIN", "Acum, o sa fii rugat sa te autentifici");
define("NO_PEERS", "Nici un peer");
define("NOT_AUTHORIZED", "Nu esti autorizat sa vezi asta");
define("NO_COMMENTS", "Nici un comentariu ...");
define("NOT_AUTH_DOWNLOAD", "Nu esti autorizat sa download`ezi. Sugus ...");
define("NO_SHA_NO_UP", "Nu poti face upload - functia SHA1 nu exista");
define("NOT_SHA", "functia SHA1 nu exista. Ai nevoie de PHP 4.3.0 sau mai nou.");
define("NOT_AUTHORIZED_UPLOAD", "Nu esti autorizat pentru upload!<br><br>Click <a class=altlink href=uploader_request.php>aici</a> pentru a face o cerere de uploader!");
define("NO", "Nu");
define("NO_MAIL", "nu ai mesaje noi.");
define("NO_IP_WRITE", "Nu ai scris o adresa IP. ce naiba faci, dormi pe tine!");
define("NO_NEWS", "nu sunt stiri");
define("NONE", "None");
define("NOT_AVAILABLE", "N/A");
define("NOT_ALLOW_DOWN", "nu ai voie sa download`ezi de la");
define("NO_TOPIC", "Nu sunt topicuri gasite");
define("NO_TORRENTS", "Nu sunt torrente aici...");
define("NO_BANNED_IPS", "Nu sunt IP`uri interzise");
define("NOBODY_ONLINE", "Nimeni online<img src=images/smilies/console.gif>");
define("NOT_AUTH_VIEW_NEWS", "Nu esti autorizat sa vezi stirile!");
define("NEED_TO_BE_AN_MEMBER", "Nu esti aurorizat sa vezi asta, trebuie sa fii membru!");
define("NOT_POSS_RESET_PID", "Nu este posibil sa iti resetezi PID`ul! <br />Contacteaza un admin ...");
define("NO_TORR_UP_USER", "Nici un torrent adaugat de acest user");
define("NO_USERS_FOUND", "nici un user gasit!");
define("OLD_PWD", "Parola veche");
define("ONE_STAR", "1 stea");
define("ONLY_REG_COMMENT", "Doar membrii pot adauga comentarii!");
define("OPT_DB_RES", "Optimizing database result");
define("PASS_RESET_CONF", "password reset confirmation");
define("PEER_PROGRESS", "Progres");
define("PEER_COUNTRY", "Tara");
define("PEER_PORT", "Port");
define("PEER_STATUS", "Status");
define("PEER_LIST", "Peer(s) List");
define("PEERS", "peer(s)");
define("PEER_ID", "Peer ID");
define("PEERS_DETAILS", "Click aici pentru a vedea detaliile peers");
define("PEER_CLIENT", "Client");
define("PID", "PID");
define("PICTURE", "Imagine");
define("PLEASE_WAIT", "Te rog asteapta ...");
define("PM", "PM");
define("POSTED_BY", "Scris de");
define("POSTS_PER_DAY", "%s mesaje pe zi");
define("POST", "Post");
define("POSTS_PER_PAGE", "mesaje pe pagina");
define("POSTED_DATE", "adaugat pe");
define("POSTS", "Mesaje");
define("POST_REPLY", "Adauga replica");
define("PRIVATE_MSG", "Mesaj Privat");
define("PREVIOUS", "Prev.");
define("PWD_CHANGED", "Parola schimbata!");
define("QUICK_JUMP","Scurtatura");
define("QUOTE", "Citez");
define("RATING", "Nota");
define("RATIO", "Ratie");
define("RECEIVER", "Receptor");
define("READED", "Citit");
define("REMOVE", "Scoate");
define("RETURN_TORRENTS", "Inapoi la lista cu torrent`e");
define("RECOVER_PWD", "Recupereaza parola");
define("RECOVER_TITLE","Recupereaza user`ul sau parola pierduta");
define("RETRY", "Reincearca");
define("REACHED_MAX_USERS", "Numarul de utilizatori a ajuns la maxim<img src=images/smilies/hooray.gif><br /> Nu face infarct inca, poti ruga un membru existent sa iti trimita o invitatie"); // cybernet
define("REDOWNLOAD_TORR_FROM", "Redownload`eaza torrent`ul de la");
define("RESULT", "Rezultat");
define("REGISTERED_EMAIL", "Email inregistrat");
define("REPLY", "Raspuns");
define("REDIRECT", "daca browserul dvs. nu are javascript pornit ( instaleaza`tzi naibi Firefox ) sau click");
define("RENAME_TOPIC", "Redenumeste topic"); // cybernet0
define("RECOVER_DESC","Foloseste formularul de mai jos pentru a`ti reseta parola si a primi detaliile contului pe email<br>( Trebuie sa`ti reactivezi contul prin linkul din email. )");
define("REPLIES", "Raspunsuri");
define("SEARCH_AGAIN", "Cauta din nou");
define("SEARCH", "Cauta");
define("SEARCH_HELP","Introdu unul sau mai multe cuvinte pentru a cauta.<br>Cuvantul trebuie sa aiba mai mult de 3 cuvinte");
define("SEEDERS", "seed(s)");
define("SENDER", "Expeditor");
define("SEARCHED_FOR", "Cautat pentri");
define("SENT_ERROR", "Eroare Trimitere");
define("SEEN", "Vazut");
define("SHORT_S", "S"); //Shortname for Seeders
define("SHORT_L", "L"); //Shortname for Leechers
define("SHORT_C", "C"); //Shortname for Completed
define("SHOUTBOX", "ShoutBox");
define("SIZE", "Marime");
define("SORRY", "Sory Coaie");
define("SPEED", "Viteza");
define("STYLE_SETTINGS", "Setari Stil");
define("STYLE_NAME", "Nume Stil");
define("STYLE_URL", "URL Stil");
define("STICKY", "Lipicios");
define("STYLE_MODIFIED", "Stilul a fost modificat");
define("STYLE_ADD", "Adauga un nou stil");
define("STYLE_ADDED", "Stilul a fost adaugat");
define("STYLE_NOTE", "In aceasta sectiune poti modifica setarile stilurilor, dar mai intai trebuie sa upload`ezi stilul prin ftp");
define("SUBJECT", "Subiect");
define("SUC_SEND_EMAIL", "Un email de confirmare a fost trimis catre tine");
define("SUC_SEND_EMAIL_2", "Te rog asteapta 2 secunde");
define("SUMADD_BUG", "Tracker bug calling summaryAdd");
define("SUC_POST_SUC_EDIT", "Mesajul a fost editat cu succes");
define("SUBJECT_MAX_CHAR", "Subiectul este limitat la ");
define("SUCCESS", "Succes");
define("TABLE_NAME", "Nume tabel");
define("THREE_STAR", "3 stele");
define("TITLE", "Titlu");
define("TORRENTS_PER_PAGE", "Torrent`e / pagina");
define("TOPICS_PER_PAGE", "Topicuri / pagina");
define("TOP_10_DOWNLOAD", "Top 10 Download`eri");
define("TOPIC_UNREAD_POSTS","Topicuri cu mesaje necitite");
define("TOP_TORRENTS", "Cele mai populare Torrent`e");
define("TORRENT","Torrent");
define("TORRENTS", "torrent(s)");
define("TORRENT_FILE","Fisier Torrent");
define("TORRENT_CHECK","Dau voie tracker`ului sa foloseasca detaliile in scopuri teroriste.");
define("TORRENT_ANONYMOUS","Upload ca anonim");
define("TORR_PEER_DETAILS", "Torrent peers detailii");
define("TORRENT_DETAIL","Detailii Torrent`e");
define("TORRENT_STATUS", "Status");
define("TOP_10_UPLOAD", "Top 10 Upload`eri");
define("TOP_10_SHARE", "Top 10 + Pomanagii ( Sharers )");
define("TOP_10_WORST", "Top 10 - Pomanagii ( Sharers )");
define("TOP_10_ACTIVE", "Cele mai active 10 torrent`e");
define("TOP_10_BEST_SEED", "10 Torrent`e Cei mai Buni Seed`eri");
define("TOP_10_WORST_SEED", "10 Torrent`e Cei mai ... Seed`eri");
define("TOPIC_NOT_FOUND", "Topic inexistent");
define("TOPIC", "Topic");
define("TORRENT_SEARCH", "Cauta Torrent`e");
define("TOPICS", "Topicuri");
define("TOP_10_BSPEED", "10 Torrent`e ( Cea mai buna viteza )");
define("TORRENT_UPDATE", "Actualizez, asteapta in plm ...");
define("TOPIC_LOCKED", "Acest topic este inchis; mesajele noi nu sunt acceptate<img src=images/smilies/ras.gif>");
define("TOP_10_WSPEED", "10 Torrent`e Cu Cea mai Proasta Viteza");
define("TRACKING", "tracking");
define("TRACK_DB_ERR", "Tracker/database error. The details are in the error log.");
define("TRACKER_LOAD", "Tracker Load");
define("TRACKER_SETTINGS", "Setari Tracker");
define("TRAFFIC", "Trafic");
define("TRACKER_STATS", "Statistici Tracker");
define("TRACKER_INFO", "$users users, tracking $torrents torrents ($seeds seeds e $leechers leechers, $percent%)");
define("TWO_STAR", "2 stele");
define("UCP_NOTE_1", "Aici iti poti controla mesajele primite, sa scrii mesaje private altor useri,");
define("UCP_NOTE_2", "Controla si modifica setarile tale, etc...");
define("UNAUTH_IP", "Unauthorized IP address.");
define("UNKNOWN", "necunoscut");
define("UPLOADER","Uploader");
define("UPDATE", "Actualizare");
define("UPLOAD_IMAGE", "Upload Imagine");
define("UPLOADED", "Uploaded");
define("UPLOAD_LANGUAGE_FILE", "Upload Fisier Limba");
define("UPLOADS", "Uploads");
define("URL", "URL");
define("USER_LASTACCESS", "Ultima accesare");
define("USER_PASS_RECOVER", "Parola/user recuperare");
define("USER_JOINED", "E cu noi din");
define("USER_CP_1", "Panoul de control al user`ului");
define("USER_EMAIL", "Email Valid");
define("USER_CP", "Panoul Meu");
define("USER_DETAILS", "Detalii User");
define("USER_STYLE", "Stil");
define("USER_LANGUE", "Limba");
define("USER_LEVEL", "Rang");
define("USERS_SEARCH", "Cautare membri");
define("USER_PWD_AGAIN", "Repeta parola");
define("USER_PWD", "Parola");
define("USER_NAME", "User");
define("USER_GROUPS", "Setarile de grup ale userilor"); // cybernet2u
define("VIEW_EDIT_DEL", "View/Edit/Del");
define("VIEW_TOPIC", "Vezi Topic");
define("VIEW_DETAILS", "Vezi detalii");
define("VIEWS", "Vizualizari");
define("VIEW_UNREAD", "Vezi Necitite");
define("VOTE", "Voteaza!");
define("VOTES_RATING", "voturi ( rating ");
define("WAIT_ADMIN_VALID", "Ar trebui sa astepti validarea de la un admin ...");
define("WARNING", "Atentie!");
define("WELCOME_ADMINCP", "Bine ai venit in panoul de control al Adminului");
define("WELCOME_BACK", "Bine ai revenit");
define("WELCOME", "Bine ai venit");
define("WELCOME_UCP", "Bine ai venit la panoul de control");
define("WORD_NEW", "Nou");
define("WORD_AND", "si");
define("WROTE", "a scris");
define("WRITE_CATEGORY", "Trebuie sa specificati o categorie pentru torrent ...");
define("X_TIMES", "ori");
define("YES", "Da");
define("YOU_RATE", "ai notat acest torrent cu");

define("SUB_CATEGORY","Sub-Categorie");
define("ACP_BLOCKS","Block Settings");
define("BLOCK","Block");
define("POSITION","Pozitie");
define("SORTID","Sortid");
define("ACTIVE","Status");
define("BLOCKS_SETTINGS","Block Configuration");
define("LEFT","stanga");
define("RIGHT","dreapta");
define("CENTER","centru");
define("TOP","sus");
define("WT","WT");
define("GROUP_WT","Timp de asteptare daca ratia < 1");
define("ACP_POLLS","Setari pentru Sondaj");
define("POLLS_SETTINGS","Configuratie Sondaje");
define("POLLID","Sondajid");
define("QUESTION","Intrebare");
define("VOTES","Voturi");
define("ACTIVATED","Activat");
define("INSERT_NEW_POLL","Adauga sondaj nou");
define("CANT_FIND_POLL","sondaj inexistent");
define("ADD_NEW_POLL","Adauga Sondaj");
define("OPTION","Optiune");
define("UPFAILED","Upload Failed");
define("DELFAILED","Delete Failed");
define("TIMEZONE", "Timezone");
define("FRM_PREVIEW","Previzualizare");
define("COMMENT_PREVIEW","Previzualizare comentariu");
define("USER_LOCAL_TIME","Timpul local al userului");
define("GO_BACK","Dute inapoi");
define("TORRENT_REQUESTED", "Cerut");
define("TORRENT_NUKED", "Nuked");
define("TORRENT_NUKED_REASON", "Motiv");
define("REQUESTS", "Request`uri");
define("SORT_BY", "Sorteaza Dupa");
define("REQ_BLOCK_NAME", "Nume");
define("REQ_BLOCK_CAT", "Cat");
define("REQ_BLOCK_DATE", "Data");
define("REQ_BLOCK_BY", "De");
define("REQ_BLOCK_FILLED", "Completat de");
define("REQ_BLOCK_VOTES", "Voturi");
define("REQUEST_BLOCK_NAME", "Request&nbsp;nume");
define("REQUEST_BLOCK_CAT", "Request&nbsp;categorie");
define("REQUEST_BLOCK_ADDED", "Request&nbsp;adaugat");
define("REQUEST_BLOCK_BY", "Requested&nbsp;de");
define("REQUEST_BLOCK_FILLEDBY", "Request&nbsp;filtrat&nbsp;by");
define("REQUEST_BLOCK_VOTE", "Request&nbsp;voturi");
define("REQUEST_BLOCK_DETAILS", "Request&nbsp;detailii");
define("ADMIN_CONTROLS", "Control Admin");
define("USERCOMMENT", "Coment User:");
define("HELPED_FOR", "Ajutat pentru:");
define("WHAT_ABOUT" ,"Descriere");
define("POINTS" ,"Puncte");
define("EXCHANGE" ,"Schimb");

define("BONUS_DESC","Daca ai atins numarul maxim de puncte, le poti schimba in trafic ( + upload ) / ( - download ) .");
define("BONUS_INFO1","Aici iti poti schimba punctele Bonus Seed (curent ");
define("BONUS_INFO2","(Daca butoanele sunt dezactivate, inseamna ca nu ai destul pentru a face schimbul!");
define("BONUS_INFO3","Pentru ce iau puncte ?<br>Primesti 1 punct pentru fiecare ora de seed.");
define("SEED_BONUS", "Seed Bonus");
define("CUSTOM_TITLE", "Titlu personalizat");
define("NO_CUSTOM_TITLE", "Titlu personalizat inexistent");
define("REGISTRATION_OFFLINE", "Scuze, coaie<br>Inregistrarile sunt inchise momentan, verifica mai tarziu.");
define("PAYPAL", "PayPal");
define("MNU_DONATE", "Donatii");
define("PAYPAL_INSERT_NEW", "Adauga un buton PayPal");
define("INSERT_NEW_DONATOR", "Adauga un donator");
define("DONATION", "Cat s`a strans");
define("YTD_DONATION", "Userul a donat");
define("DONATION_SETTINGS", "Setari donatii");
define("EDIT_DONATOR", "Editeaza Donator");
define("DONATOR_MODIFIED", "Donatorul a fost modificat");
define("DONATOR_ADD", "Adauga un donator nou");
define("DONATOR_NAME", "Numele donatorului");
define("PAYPAL_DONATION", "Fonduri Donatii");
define("PAYPAL_YTD_DONATION", "Total Donatii");
define("ERR_ACCOUNT_DISABLED", "Eroare: Acest cont a fost dezactivat !");
define("ONE_WEEK", "1 saptamana");
define("TWO_WEEKS", "2 saptamani");
define("THREE_WEEKS", "3 saptamani");
define("FOUR_WEEKS", "4 saptamani");
define("PERMANENTLY", "nelimitat");
define("ACP_WARNEDU", "Warning`uri Active");
define("DISABLE_ACCOUNT", "Cont dezactivat<img border=0 src=images/smilies/closedeyes.gif>");// cybernet2u
define("ENABLE_ACCOUNT", "Cont Activ");
define("WARN_FALSE", "coaie nu`mi da warn, promit ca numai fac ( nu )");
define("WARN_TRUE", "da`mi warn ( da )");
define("WARN_CONFIRM", "Esti sigur ca vrei sa`i dai warn ?");
define("WARN_REMOVE", "Esti sigur ca vrei sa`i stergi warn`ul ?");
define("WARN_LEVEL_RESET", "Resetezi warn`ul ?");
define("WARN_DISABLE_ACCOUNT", "Esti sigur ca vrei sa dezactivezi contul ?");
define("WARN_ENABLE_ACCOUNT", "Esti sigur ca vrei sa activezi contul ?");
define("WARNED_USERS", "Useri Atentionati ( ce penal suna )");
define("ACP_DISABLEDU", "Conturi dezactivate");
define("DISABLED_WARNS", "Warn`uri");
define("DISABLED_ON", "pe");
define("DISABLED_BY", "de");
define("DISABLED_ACTIVE", "Dezactivat<img border=0 src=images/smilies/cry.gif>");
define("DISABLED_NO_USERS", "Nu sunt conturi dezactivate");
define("DISABLED_USERS", "Useri dezactivati");
define("USER_WARNED", "Acest user a primit un warn. Pentru mai multe detalii uitete la FAQ");
define("USER_DISABLED", "Acest cont a fost dezactivat. Pentru mai multe detalii uitete la FAQ");
define("WARNED_ID", "ID");
define("WARNED_USERNAME", "User");
define("WARNED_TOTAL_WARNS", "Total Warn`uri");
define("WARNED_DATE_ADDED", "Data adaugat");
define("WARNED_EXPIRATION", "Expira pe");
define("WARNED_DURATION", "Timp");
define("WARNED_REASON", "Motiv");
define("WARNED_BY", "Warned dat de");
define("WARNED_ACTIVE", "Activ");
define("WARNED_NO_USERS", "Nu sunt conturi dezactivate.");
define("WARNED_UNLIMITED", "warn nelimitat<img border=0 src=images/smilies/laugh.gif>");
define("WARNED_WEEK", " warn saptamana");
define("WARNED_WEEKS", " warn saptamani");
define("WARNED_USER_NOTWARNED", "Acest user nu are warn`uri active.");
define("ACP_PREVWARNEDU", "Warn`uri inactive");
define("PREV_WARNED_USERS", "Warned trecute");
define("PREV_REACHED_MAX", "A atins numarul maxim de warn`uri");
define("PREV_NO_USERS", "Nu sunt useri cu warn`uri din trecut");
define("REPORT_CLICK", "Click");
define("APARKED", "User in vacanta<img border=0 src=images/smilies/dancing.gif>");
define("VOTE_FOR_THIS", "Voteaza Pentru Aceasta");
define("REQUEST", "Cerere");
define("INFO", "Info");
define("REQUEST_OFFLINE", "Sectiunea de cereri este oprita momentan");
define("ADD_REQUESTS", "Adauga Cerere");
define("DATE_ADDED", "Data Adaugata");
define("ADDED_BY", "Adaugat de");
define("FILLED_BY", "Completat De");
define("FILLED", "Completat");
define("TYPE", "Typ");
define("INC_DEAD", "Include Inactive");
define("MAKE_REQUEST", "Fa Cerere");
define("DISPLAY", "Arata");
define("ADDED_TO_FRIENDLIST", "Adaugat in lista cu prieteni");
define("MEMBER_ALREADY_EXIST", "Contul exista deja.");
define("MEMBER1", "Membrul");
define("ADDED_TO_YOUR_FRIENDLIST", "a fost adaugat in lista prietenilor.");
define("HERE", "aici");
define("TO_VIEW_FRIENDLIST", "sa`ti vezi prietenii.");
define("RETURN_USERS", "Inapoi la lista cu prieteni");
define("FRIENDLIST", "Lista de prieteni");
define("NOTHING_IN_FRIENDLIST", "Nu ai prieteni , ce emo esti<img border=0 src=images/smilies/crybaby.gif>");
define("ADD_TO_FRIENDLIST", "Adauga in lista cu prieteni |");
define("USER_ONLINE", "Membru online");
define("USER_OFFLINE", "Membru offline");
define("FRIEND_REPORT", "Adauga prieten / Raporteaza`l");
define("GENDER", "Sex");
define("MALE" ,"Male <img border=0 src=images/male.gif>");
define("FEMALE" ,"Female <img border=0 src=images/female.gif>");
define("AGE", "Ani");
define("USER_ALREADY_EXISTS", "User`ul exista");
define("NFORCE", "Nforce");
//Personal Notepad Hack Start
define("NOTE_ADD_NEW", "Adauga o nota personala");
define("NOTE_DATETIME", "Data/Timp");
define("NOTE_DEL_ERR", "Trebuie sa bifezi cel putin o nota, pentru a sterge.");
define("NOTE_EDIT", "Editeaza");
define("NOTE_EDIT_ERROR", "Ce faci mha? Editeazi mesajele altor user`i ?<img border=0 src=images/smilies/chair.gif>");
define("NOTE_ID", "ID");
define("NOTE_NOTE", "Nota");
define("NOTE_VIEW", "Citeste");
define("NOTE_READ_ERROR", "Ce faci mha? Citesti mesajele altor user`i ?<img border=0 src=images/smilies/chair.gif>");
define("NOTE_VIEW_MORE", "Vezi mai multe note");
define("NOTE_NOTEPAD", "Jurnal");
//Personal Notepad hack Stop
define("SNATCHERS", "Snatchers");
//EXPECTED HACK
define("INC_DEAD", "Include inactive");
define("ADD_EXPECTED", "Adauga un torrent asteptat");
define("EXPECTED", "Asteptat");
define("VIEW_MY_EXPECTED", "Vezi torrent`ele mele \"asteptate\"");
define("VIEW_ONLY", "Doar vizualizeaza");
define("FIND_EXPECT", "Cauta");
define("GO", "Dute`n ...");
define("NO_NAME", "Fara nume!");
define("NO_DESCR", "Scrie si tu ceva la descriere, nu fi bulangiu!");
define("EXP_ADD_SUCCES", "a fost adaugat in sectiunea de asteptare");
define("MUST_SEL_EXP", "Trebuie sa selectezi cel putin un torrent, pentru al sterge.");
define("DELETED", "Sters<img border=0 src=images/smilies/crybaby.gif>");
define("RETURN_EXPECT", "Dute la ");
define("DATE_EXPECTED", "Asteptat pe");
//EXPECTED HACK END
//Change Nick
define("CHANGE_NICK", "Schimbati user`ul");
define("PLEASE_LOGIN", "Trebuie sa te autentifici");
define("ERR_MUST_LOGIN", "Trebuie sa te <a href='login.php'>autentifici</a> pentru a accesa aceasta pagina");
define("CURR_NICK", "User curent");
define("NEW_NICK", "User`ul nou");
define("REPEAT_NICK", "Repeta user");
define("NICK_NO_MATCH", "User`ul nu se potriveste");
define("ERR_SAME_NICK", "Userul exista");
define("ERR_NICK_TOO_SMALL", "User`ul trebuie sa contina minim 3 caractere");
define("ERR_NICK_NOT_ALLOWED", "Userul nu poate fi folosit");
define("CONGRATS", "Felicitari");
define("NICK_CHANGE_SUCCESS", "Ti`ai schimbat userul in ");
//Change Nick End
define("MNU_EPISODES", "Episoade");
//Start Make members verify their email if they change it
define("REVERIFY_MSG", "Daca vrei sa iti schimbi adresa de mail , o sa primesti un link de confirmare pe adresa noua.<br /><br /><font color=red><strong>Adresa noua nu va fi activa pana nu accesezi linkul primit.</strong></font>");
define("EMAIL_VERIFY", "cont email actualizat ;a $SITENAME");
define("EMAIL_VERIFY_BLOCK", "Linkul de verificare a fost trimis");
define("EMAIL_VERIFY_MSG", "Salut,\n\nAcest email a fost trimis pentru ca ai vrut sa iti schimbi adresa de email`ul, te rog acceseaza urmatorul link pentru a`ti actualiza profilul.\n\nSalutari din partea staff`ului.");
define("EMAIL_VERIFY_SENT1","<br /><center>Un email de verificare a fost trimis la:<br /><br /><strong><font color=red>");
define("EMAIL_VERIFY_SENT2", "</font></strong><br /><br />Trebuie sa faci un click pe linkul din mail<br />pentru a`ti actualiza contul. Ar trebui sa primesti emailul in maxim 5 minute<br />(deobicei instant) unele companii marcheaza acest email ca fiind SPAM<br />verifica si in categoria de spam, daca nu il gasesti in INBOX<br /><br />");
define("REVERIFY_CONGRATS1", "<center><br />Adresa de email a fost actualizata<br /><br /><strong>De la: <font color=red>");
define("REVERIFY_CONGRATS2", "</strong></font><br /><strong>In: <font color=red>");
define("REVERIFY_CONGRATS3", "</strong></font><br /><br />");
define("REVERIFY_FAILURE", "<center><br /><strong><font color=red><u>Scuze frate, dar acest link nu este valid</u></strong></font><br /><br />Un numar este generat de fiecare data cand incerci sa iti schimbi adresa de email<br />daca vezi acest mesaj este posibil sa mai fi incercat odata sa iti schimbi email`ul<br />de mai multe ori si acum folosesti un link expirat.<br /><br /><strong>Asteapt pana esti sigur ca ai primit mail`ul corespunzator.</strong><br /><br />");
define("NOT_MAIL_IN_URL", "Acest email nu a fost atasat acestui link");
define("MUST_ENTER_PASSWORD", "<br /><font color='#FF0000'><strong>Trebuie sa introduci parola curenta pentru a modifica setarile de mai sus</strong></font>");
define("ERR_PASS_WRONG", "Parola incorencta, nu pot actualiza profilul.");
//End Make members verify their email if they change it 
define("SEEDBONUSEDITOR", "Seedbonus Editor");
define("SEED_CLICK", "Schimba bonus");
define("SEEDBONUS_EDITOR", "Seedbonus Editor");
// blackjack start
define("BLACKJACK", "BlackJack");
define("SORRY", "scuze");
define("MUST_UPLOAD", "Nu ai facut upload");
define("RATIO_GREAT_THAN", "Ratia ta este mai mica de");
define("WAIT_SOMEONE_PLAYS", "Trebuie sa astepti un jucator. ( mai asteapta<img border=0 src=images/smilies/laugh.gif> ) ");
define("FINISH_OLD_GAME", "Trebuie sa`ti continui jocul precedent");
define("FRM_CONTINUE", "Continua");
define("YOU_LOST", "Ai pierdut <img border=0 src=images/smilies/laugh.gif>");
define("YOU_WON", "Ai castigat<img border=0 src=images/smilies/dancing.gif>");
define("NOBODY_WON", "Nu a castigat nimeni");
define("TO", "catre");
define("YOU_HAVE", "ai avut");
define("HE_HAVE", "a avut");
define("HAD", "avut");
define("YOUR_OPPONENT", "Oponentul a fost");
define("END_GAME", "Joc terminat.");
define("NO_PLAYERS", "nu sunt alti jucatori, trebuie sa astepti un alt user. O sa primesti un mesaj cu rezultatul jocului.");
define("FROM", "dela");
define("FRM_STOP", "Stop");
define("GAME_RULES", "<h3>Reguli</h3>Trebuie sa colectezi 21 puncte.");
define("FRM_PLAY", "Joaca");
define("POINTS", "puncte");
define("GAMES", "Jocuri");
define("PROFIT", "Profit (LA)");
define("REQUIRED_RATIO", "Ratie necesara");
// blackjack ends
// PHP EDITOR
define("PHP_CHANGE", "Schimba fisier");
define("PHP_PRESENT", "Fisier curent");
define("PHP_OPEN", "Deschide");
define("PHP_CLOSE", "Inchide");
define("PHP_REFRESH", "Refresh");
define("PHP_SAVE", "Salveaza");
define("PHP_RESET", "Reset");
define("PHP_BACK", "Inapoi");
define("PHP_NOT_SAVED", "nu a fost salvat");
define("PHP_SHOW_HIGHLIGHT", "PHP highlights");
define("PHP_CLOSE_HIGHLIGHT", "Hide highlights");
define("PHP_DELETE", "Sterge");
define("PHP_WATCH", "Urmareste");
define("PHP_DELETE_SUCCES", "a fost sters!");
define("PHP_DELETE_FAILED", "nu a fost sters!");
define("PHP_SAVE_TIME", "a fost salvat la:");
define("PHP_NOT_SAVED_YET", "nu a fost salvat inca!");
define("PHP_FILE", "Nume fisier (scrie .php)");
// PHP Editor Ends
//Lottery Start
define("LOT_SETTINGS", "Setari loterie");
define("EXPIRE_DATE", "Data expira ");
define("EXPIRE_DATE_VIEW", "(01-01-1970 00:00 in acest format)");
define("IS_SET", "este data si timpul)");
define("NUM_WINNERS", "Numarul de castigatori");
define("TICKET_COST", "Trebuie sa platesti( pe bilet )");
define("MIN_WIN", "Castig minim");
define("LOTTERY_STATUS", "Loterie deschisa");
define("UPDATE", "Actualizeaza");
define("VIEW_SELLED", "Vezi bilete vandute");
define("NOT_USER_CLASS", "<h1>Scuze</h1><p>Trebuie sa fii inregistrat pentru a cumpara , vezi <a href=faq.php><b>FAQ</b></a> pentru diferenta dintre clasele de user`i, cei din staff nu pot cumpara bilete</p>");
define("CANNOT_SELL", "Nu pot sa`ti dau bilete!");
define("PURCHASE_SUCCES", "Am reusit sa te fur");
define("PURCH_MSG1", "Tocmai ai cumparat ");
define("PURCH_MSG2", " bilet(e)!");
define("PURCH_MSG3", "total este ");
define("PURCH_MSG4", "Total upload ai ");
define("PURCH_MSG5", "Esti redirectionat catre pagina cu bilete!");
define("YOUR_TICKETS", "Biletele Cumparate");
define("NO_TICKET_SOLD", "Nici un bilet vandut ( a ajuns criza si pe tracker<img border=0 src=images/smilies/crybaby.gif> ) ");
define("ID", "ID");
define("USERNAME", "User");
define("NUMBER_OF_TICKETS", "Numar de bilete");
define("RESET", "Reset");
define("NEED_UPLOAD", "Trebuie sa ai 100 MB la upload pentru a cumpara!");
define("TICK_MSG1", "Biletele nu sunt returnabile");
define("TICK_MSG2", "Fiecare bilet costa ");
define("TICK_MSG3", " care este luat din upload`ul tau");
define("TICK_MSG4", "Arata cate bilete iti poti permite");
define("TICK_MSG5", "Poti cumpara pana la o limita, dar tine minte, daca ai la upload mai putin de 100 MB, ai putea primi un ban");
define("TICK_MSG6", "Concursul se termina pe ");
define("TICK_MSG7", "O sa fie ");
define("TICK_MSG8", "o sa ia fiecare ");
define("TICK_MSG9", " adaugat peste uploadul curent");
define("TICK_MSG10", "Castigatorii vor fi anuntati in ziua urmatoarea, in sectiunea stiri");
define("TICK_MSG11", "Cu cat mai multe bilete vor fi vandute cu atat potul va fi mai mare!");
define("TICK_MSG12", "Detii biletul cu numerele: ");
define("TICK_MSG13", "Noroc si JackPot!");
define("TOTAL_IN_POT", "Total in pot");
define("TOTAL_TICKETS_SELLED", "Numar total de bilete cumparate");
define("YOUR_TICKETS", "Bilete cumparate de tine");
define("PURCHASEABLE", "Cumparabile");
define("COMP_CLOSED", "Concursul este inchis!");
define("TICKETS", "bilete");
define("PURCHASE", "Cumpara");
define("VIEW_LAST_WINNERS", "Vezi ultimii castigatori");
define("YOUR_TICKETS", "Biletele tale ");
define("WINDATE", "Data castigatoare");
define("PRICE", "Pret");
define("VIEW_WINNERS", "Vezi castigatorii la loterie");
define("SOLD_TICKETS", "Bilete Vandute");
define("NO_WINNERS_YET", "Nici un castigator inca");
define("MAX_PURCHASE", "Numarul de bilete pe care le poti cumpara este ");
define("MAX_BUY", "Numarul maxim pe care il poti cumpara");
//Lottery Ends
//Invite Hack Start
define("MNU_UCP_INVITATIONS", "Invitatii");
define("INVITATIONS", "Invitatii");
define("MEMBERS_INVITED_BY", "User invitat de ");
define("SEND_INVITE", "Trimite o invitatie unui prieten");
define("REMAINING", "Ramane");
define("CURRENT_INVITES_CONFIRMED", "Statusul invitatiilor confirmate");
define("NO_INVITES_YET", "Nici o invitatie");
define("STATUS", "Status");
define("CONFIRMED", "Confirmat");
define("INVITES_NEED_CONFIRM", "Invitatii care trebuiesc confirmate");
define("CURRENT_INVITES_NEED_CONFIRM", "Statusul curent al invitatiilor care au nevoie de confirmare");
define("NO_NEED_CONFIRM_YET", "Nici o invitatie de confirmat");
define("PENDING", "Asteptare");
define("INVITES_OUT", "Invitii trimise");
define("SEND_DATE", "Data trimisa");
define("CURRENT_INVITES_OUT", "Statusul curent al invitatiilor trimise");
define("NO_INVITES_OUT", "Nici o invitatie trimisa");
define("INVITE_SOMEONE_TO", "Invita pe cineva sa se alature $SITENAME");
define("INVITATION", "Invitatie");
define("MESSAGE", "Mesaje");
define("INVALID_INVITE", "Invitatie \"maltratata\"");
define("ERR_INVITE", "Nu esti invitat. Dute`n sugus ...");
define("WELCOME_INVITE", "Bine ai venit! Ai acceptat o invitatie de la unul din user`ii nostri. Acum te poti inregistra.");
define("EMAIL_INVALID", "E-mail invalid !");
define("ERR_MISSING_DATA", "Lipsesc cateva informatii !");
define("INSERT_EMAIL", "Trebuie sa introduci o adresa de mail !");
define("INSERT_MESSAGE", "Adauga un mesaj personal !");
define("INVITE_EMAIL_SENT1", "Un email de confirmare a fost trimis la adresa indicata");
define("INVITE_EMAIL_SENT2", "Trebuie sa astepti pana invitatorul iti confirma contul.");
define("INVITE_EMAIL_SENT3", "Un email a fost trimis la adresa indicata");
define("INVITE_EMAIL_SENT4", "Noroc si distreaza`te cu $SITENAME !");
define("PASSWORD_NOT_USERNAME", "Scuze, parola nu poate semana cu userul.");
define("ERR_IP_ALREADY_EXISTS", "Acest IP exista.");
define("ACCOUNT_CONFIRMED", "Confirmare cont");
define("INVIT_CONFIRM", "Confirmare Invitatie");
define("REG_CONFIRM", "Confirmare Inregistrare");
define("VALID_INV_MODE", "Trebuie sa confirmi invitatia");
define("NO_INV", "numai ai invitatii, doneaza pentru a primi.");
define("INVITE_TIMEOUT", "Timpul in care invitatia expira<br />( in zile )");
define("INVITES_OFF", "Invitatiile nu sunt activate");
define("INVIT_MSGCONFIRM", "Salut,\n\nContul a fost confirmat. Acum poti vizita\n\n$BASEURL/login.php\n\nsi folosi datele alese pentru a te autentifica. Speram ca o sa citesti Regulile inainte de a face upload.\n\nNoroc si distreaza`te cu $SITENAME !\n\n\n----------------\nDaca nu te`ai inregistrat la $SITENAME, trimite acest e`mail la $SITEEMAIL");
define("INVIT_MSG_AUTOCONFIRM", "Ai cerut un cont pe $SITENAME si ai\nspecificat aceasta adresa (");
define("INVIT_MSG_AUTOCONFIRM1", ") ca user de contact.\n\nInfo cont:\nUser`:");
define("INVIT_MSG_AUTOCONFIRM2", "Parola:");
define("INVIT_MSG_AUTOCONFIRM3", "----------------\nAcum poti vizita\n\n$BASEURL/login.php\n\nsi folosi datele alese pentru a te autentifica. Speram ca o sa citesti Regulile inainte de a face upload.\n\nNoroc si distreaza`te cu $SITENAME !\n\n\n----------------\nDaca nu te`ai inregistrat la $SITENAME, trimite acest e`mail la $SITEEMAIL");
define("INVIT_MSG", "Salut,\n\nAi fost invitat sa te alaturi comunitatii $SITENAME de");
define("INVIT_MSG1", "Daca accepti aceasta invitatie, trebuie sa faci un click:\n\n\n$BASEURL/account.php?invitenumber=");
define("INVIT_MSG2", "trebuie sa accepti invitatia in de 24 ore, sau linkul va deveni inactiv.\n Speram ca te vei alatura comunitatii noastre\nToate Cele Bune Din partea $SITENAME\n\nMesaj personal de la");
define("INVIT_MSG3", "----------------\nDaca nu cunosti persoana care te`a invitat, ignora acest email");
define("INVIT_MSGINFO", "Ai cerut un cont pe $SITENAME si ai\nspecificat aceasta adresa (");
define("INVIT_MSGINFO1", ") ca user de contact.\n\nContul tau astepta o confirmare de la invitator.\nin timp ce contul este inactiv, nu te poti autentifica pe site.\n\nInfo cont:\nUser`:");
define("INVIT_MSGINFO2", "Parola:");
define("INVIT_MSGINFO3", "Daca contul nu este confirmat in 24 hrs, contul va fi sters.\nCiteste Regulile inainte de a folosi $SITENAME.\n----------------\nDaca nu te`ai inregistrat pe $SITENAME, ignora acest email");
define("ACTIVE_INVITES", "Pentru a activa invitatiile  :");
define("PRIVATE_TRACKER", "Tracker Privat :");
define("PRIVATE_TRACKER_INFO", "Modifica optiunea  \"Max Users (numeric, 0 = no limits)\" at  \"1\" !");
define("ONLY_INVITES", "Numai cu invitatii.");
//Invite Hack Ends
define("BAN_MAILS_INFO", "Theses e-mails are unauthaurized in this web site.<br>But you can disban it");
define("NO_BAN_MAILS", "Nici un email restrictionat");
define("ACP_BAN_MAILS", "Restrictioneaza e-mail`uri");
define("WAS_BANNED_ALLREADY", "deja restrictionat !!");
define("BANNED", "restrictionat !!");
define("NEW_BANNED_MAILS", "email`uri noi.");
define("SYSTEM", "Sistem");
define("EMAIL_BANNED", "Acest email a fost restrictionat pe acest site.");
define("BAN_CHEAPMAIL", "Restrictioneaza domeniile de 2 bani");
define("DOMAIN_BANNED", "Hotmail nu este permis, Foloseste un cont de email real.");
define("ERR_WILDCARD_1", "The wildcard ");
define("ERR_WILDCARD_2", " is already on the list of Cheapmail Domains so there is no need to add ");
define("ERR_WILDCARD_3", " to the list.");
define("CHEAP_CONFIRM_1", "Esti sigur ca vrei sa stergi ");
define("CHEAP_CONFIRM_2", "Nu o sa porimesti nici o confirmare");
define("CHEAP_DELETED_1", " a fost sters");
define("CHEAP_DELETED_2", "Click Aici");
define("CHEAP_DELETED_3", " pentru a te intoarce");
define("ERR_CHEAP_SUBMIT", "Trebuie sa introduci o valoare in casuta!!");
define("CHEAP_ADDED", " a fost adaugat in lista cu domenii-email de cacat");
define("ERR_CHEAP_DUPE", " este deja in lista cu domenii-email de cacat");
define("CHEAP_CURRENT", "lista curenta cu domenii-email de cacat");
define("ADDED_BY", "Adaugat de");
define("CHEAP_COUNT_1", "Gasit ");
define("CHEAP_COUNT_2", " Domenii-email de cacat");
define("CHEAP_ADD", "Adauga un Domeniu-email de cacat:");
define("UNCONFIRMED_ACCOUNTS", "Conturi Neconfirmate");
define("IMPORT_ERROR","\$SBX['import'] este setat false trebuie sa editezi config`ul de mana si sa`l setezi in \"t\" daca chiar vrei sa importezi chat.php!");
define("SHOUTMINI","SBmini");
define("SHOUTACP","SBAdmin");
define("SHOUTDIS","Atentie Shoutbox este dezactivat!");
define("SHOUTDIS_PUBLIC","Shoutbox este oprit, incearca mai tarziu");
define("SHOUT","Shout it!");
define("NO_MSG","No shout found!");
define("NO_USER","Nu ai  setat numele user`ului");
define("NO_DEL","Nu poti sterge mesajele altor user`i!");
define("NO_EDIT","Nu poti edita mesajele user`i!");
define("SHOUTBOX_NOPREM","You dont have permission to view the shoutbox!");
define("NO_ACC","Acces Interzis");
define("SHOUT_MAIN","Please use main shout to post");
define("INFOSITE","Homepage");
define("SCREEN","Screenshot");
define("VIDEO","Video");
define("DD","Demo Download");
define("FORUM_CATS", "Categorii Forum");
define("CAT_NAME", "Nume categorie");
define("CAT_NAME2", "Categorie");
define("CAT_MIN_VIEW", "Min Clasa Vizualizare");
define("SORT_ORDER", "Ordine Sortare");
define("CAT_DEL_ERROR", "Nu poti sterge o categorie care are forumuri in ea.");
define("SCENE_RELEASE","Scene Release");
define("USER_EMAIL_AGAIN", "Email din nou");
define("DIF_EMAILS", "Email`urile nu se potrivesc!");
define("GENRE","Gen");
define("ADDREMOVESTAT", "Adauga / Sterge Statistici");
define("INVITED_BY", "Invitat de");
define("IMDB", "Imdb Info");
define("ERR_PM_GUEST","Nu poti sa trimiti PM - guest / sistem / sau tie!");
define("USER_ID", "User ID");
// added by cybernet
// works on every PB 1.5.4 Edition
// updated on 1243372881
// 2009-05-26 21:21:21
// Have FuN - www.cyberfun.ro
// block for Wanted Seeders - found in /blocks/seedwanted_block.php
define("CF_SEEDER_WANTED", "Seeder`i Cautati");
// Port - found in /userdetails.php
define("CF_PORT", "Port:");
// Connectable - found in /userdetails.php
define("CF_CONNECTABLE", "Se poate conecta la tracker?");
// User Signature - found in /userdetails.php
define("CF_SIGNATURE", "Semnatura:");
// Staff Info - found in /userdetails.php
define("CF_STAFF_INFO", "Staf Info");
// Upload Speed - found in /userdetails.php
define("CF_UPLOAD_SPEED", "Viteza De Upload");
// Download Speed - found in /userdetails.php
define("CF_DOWNLOAD_SPEED", "Viteza De Download");
// User Not in staff - found in /userdetails.php
define("CF_USER_NOT_IN_STAFF", "<i>Acest user nu este in staff</i>");
// Report this user - found in /userdetails.php
define("CF_REPORT_THIS_F_USER", "| Da`l in gat");
// Warning Stats - found in /userdetails.php
define("CF_WARNING_STATS", "Statistici Warn");
// Total number of Warnings - found in /userdetails.php
define("CF_TOTAL_NUMBER_OF_WARNINGS", "Numar total de warn`uri");
// Latest warning removed by - found in /userdetails.php
define("CF_LATEST_WARNING_REMOVED_BY", "Ultimul warn sters de");
// Latest warning reason - found in /userdetails.php
define("CF_LATEST_WARNING_REASON", "Motivul pentru warn`ul curent");
// Unlimited warn - found in /userdetails.php
define("CF_UNLIMITED_WARN", "Warn permanent");
// 1 week warn - found in /userdetails.php
define("CF_ONE_WEEK_WARN"," saptamana warn");
//More than 1 week warn - found in /userdetails.php
define("CF_MORE_THAN_ONE_WEEK_WARN"," saptamani warn");
//Current Warning duration - found in /userdetails.php
define("CF_WARNING_DURATION", "Durata warn curent");
// Warn permanent - found in /userdetails.php
define("CF_PERMANENT_WARN", "Acest tip de warn nu are o durata. E permanent<img border=0 src=images/smilies/laugh.gif>");
// Current Warning period - found in /userdetails.php
define("CF_WARNING_PERIOD", "Perioada warn curent");
// Current Warning reason - found in /userdetails.php
define("CF_WARNING_REASON", "Motiv warn curent");
// Current warn by - found in /userdetails.php
define("CF_CURRENT_WARN_BY", "Warn adaugat de");
// Account Disabled - found in /userdetails.php
define("CF_ACCOUNT_DISABLED", "Cont dezactivat");
// Account Disabled by - found in /userdetails.php
define("CF_DISABLED_BY", "Dezactivat de");
// Account Disabled on - found in /userdetails.php
define("CF_DISABLED_ON", "Dezactivat pe");
// Account Disabled reason - found in /userdetails.php
define("CF_DISABLED_REASON", "Motiv");
// Warn Level - found in /userdetails.php
define("CF_WARN_LEVEL", "Level Warn");
// Admin Controls - found in /userdetails.php
define("CF_ADMIN_CONTROLS","Admin Control");
// Send invites - found in /userdetails.php
define("CF_SEND_INVITES", "Trimite Invitatii");
// Send invites click - found in /userdetails.php
define("CF_SEND_INVITES_CLICK","Pentru a trimite invitatii click ");
// Support for - found in /userdetails.php
define("CF_SUPPORT_FOR","Ajuta la");
// Reset Warn Level - found in /userdetails.php
define("CF_RESET_WARN_LEVEL", "Iarta user`ul de toate pacatele. AMIN<img border=0 src=images/smilies/angel.gif>");
// Remove Warn - found in /userdetails.php
define("CF_REMOVE_WARN","Sterge Warn");
// Active Torrents - found in /userdetails.php
define("CF_ACTIVE_TORRENTS", "Torrent`e Active");
// Uploaded Torrents - found in /userdetails.php
define("CF_UPLOADED_TORRENTS_ON_USER_PAGE", "Torrent`e adaugate de acest user");
// History ( snatched torrents ) - found in /userdetails.php
define("CF_SNATCHED_TORRENTS", "Torrent`e Download`ate ( daca a luat si porno bravo lui )<img border=0 src=images/smilies/angel.gif>");
// No Active torrents for this user - found in /userdetails.php
define("CF_NO_ACTIVE_TORRENTS_FOR_THIS_USER", "Nici un torrent activ pentru acest user");
// No History for this user - found in /userdetails.php
define("CF_NO_HISTORY_FOR_THIS_USER", "Acest User nu are un trecut ( istorie )");
// Donate  - found in /blocks/paypal_block.php
define("CF_DONATE", "Doneaza");
// Latest Member  - found in /blocks/lastmember_block.php
define("CF_LATEST_MEMBER", "Ultimul Membru");
// Welcome to our Tracker - found in /blocks/lastmember_block.php
define("CF_WELCOME", " Bine ai venit ");
// Invite A Friend - found in /blocks/invite_block.php
define("CF_INVITE_A_FRIEND", "Invita un Prieten");
// Send Invitation - found in /blocks/invite_block.php
define("CF_SUBMIT_INVITE", " Trimite Invitatia ");
// Your Name - found in /blocks/invite_block.php
define("CF_INVITE_NAME", "Numele Tau");
// Friends Name - found in /blocks/invite_block.php
define("CF_FRIENDS_NAME", "Numele Prietenului");
// Friends Email - found in /blocks/invite_block.php
define("CF_FRIENDS_EMAIL", "Email`ul prietenului");
// Reports - found in /blocks/mainusertoolbar_block.php
define("CF_REPORTS", "Rapoarte");
// WishList - found in /blocks/mainusertoolbar_block.php
define("CF_WISHLIST", "Dorinte");
// Member Statistics - found in /blocks/online_block.php
define("CF_MEMBER_STATS", "Statistici Membri");
// Total Members - found in /blocks/online_block.php
define("CF_TOTAL_MEMBERS", "Total Useri");
// Members Online Today - found in /blocks/online_block.php
define("CF_MEMBERS_ONLINE_TODAY", "Useri Activi Azi");
// Total Users: - found in /blocks/online_block.php
define("CF_MEMBERS_ACTIVE_TODAY", "Conturi Active:");
// Helpdesk - found in /blocks/mainmenu_block.php
define("CF_HELPDESK", "Oficiu Ajutor");
// Is already your friend, you're starting to look like a gay - found in /friendlist.php
define("CF_FRIEND_ALREADY_EXIST", "Iti este deja prieten, deja incepi sa pari gay");
// - found in /seedbonus.php - ln 85
define("CF_SEED_BONUS_1", "Daca ai punctele pentru aceasta optiune, le poti schimba din mers in - 10 GB Download, noi iti scadem din puncte si o sa primesti - 10 GB Download.");
// - found in /seedbonus.php - ln 76
define("CF_SEED_BONUS_2", "Daca ai punctele pentru aceasta optiune, le poti schimba din mers intr-o invitatie, noi te spargem la puncte si tu primesti invitatia.");
// - found in /seedbonus.php - ln 76
define("CF_SEED_BONUS_3", "O Invitatie");
// - found in /seedbonus.php - ln 90
define("CF_GIVE_SEED_BONUS", "Ofera puncte bonus");
// - found in /seedbonus.php - ln 92
define("CF_2_USER", "Catre utilizatorul:");
// - found in /seedbonus.php - ln 100
define("CF_CHANGE_C_TITLE", "Schimba titlu personalizat (Costa: 500 ");
// - found in /seedbonus.php - ln 96
define("CF_ANONYMOUS", "Trimite ca Anonim <img border=0 src=images/smilies/wub.gif>");
// - found in /details.php - ln 488
define("CF_THANKS", "Multumiri:");
// - found in /details.php - ln 497
define("CF_SAY_THANKS", "Zi merci!");
// - found in /details.php - ln 575
define("CF_USER_ONLINE", "User`ul este online <img src=images/online.gif border=0>");
// - found in /details.php - ln 578
define("CF_USER_OFFLINE", "User`ul este offline <img src=images/offline.gif border=0>");
// - found in /details.php - ln 480 & 477
define("CF_STATISTIC", " Statistici: ");
// - found in /details.php - ln 477
define("CF_NOT_AVAILABLE", "Nu sunt date!");
// - found in /details.php - ln 447
define("CF_RESEED_REQUEST", "Cere Reseed:");
// - found in /details.php - ln 173
define("CF_VIEW_NFO", "Vezi NFO");
// - found in /details.php - ln 111 & 109
define("CF_ADD_2_WISH_LIST", "| Adauga in lista de dorinte");
// - found in /details.php - ln 109 & 111
define("CF_REPORT_THIS_TORRENT", "Raporteaza acest torrent |");
// - found in /details.php - ln 379
define("CF_SHOW_HIDE", "Arata/Ascunde Fisiere: ");
// - found in /admininvite.php - ln 37
define("CF_INVITES_WARNING", "<center><span style='color:red'>Atentie: Formularul de aici va actualiza numarul de invitatii, de exemplu daca scrieti 5,userul va avea 5 invitatii,nu se adauga cu cele in prezent.</span></center>");
// - found in /admininvite.php - ln 12
define("CF_SEND_INVITES","Trimite Invitatii");
// - found in /torrents.php - ln 571
define("CF_OPTIONS", "Optiuni: ");
// - found in /details.php - ln 587
define("CF_AT", " la ");
// - found in /details.php - ln 587
define("CF_SHIT", " <font color=red>|||</font> ");
// - found in /viewrequests.php - ln 50
define("CF_AVAILABLE_REQUEST", "Request`uri pentru ");
// - found in /viewrequests.php - ln 50
define("CF_POSTED_REQUESTS", " Request`uri folosite: ");
// - found in /viewrequests.php - ln 50
define("CF_REMAINING", " Ramase: ");
// - found in /viewrequests.php - ln 52
define("CF_ADD_NEW_REQUESTS", "Fa o Request Nou");
// - found in /viewrequests.php - ln 52
define("CF_VIEW_MY_REQUESTS", "Vezi Requesturile Tale");
// - found in /viewrequests.php - ln 53
define("CF_HIDE_FILLED_REQUESTS", "Ascunde Cererile Completate");
// - found in /viewrequests.php - ln 144
define("CF_NO_RESULTS_SEARCH_FOUND", "Nu am gasit nimic dupa criteriul de cautare specificat...");
// - found in /viewrequests.php - ln 200
define("CF_NOBODY", "Nimeni");
// - found in /viewrequests.php - ln 215
define("CF_DELETE_THEM", "Sterge(le)");
// - found in /requests.php - ln 65
define("CF_REQUEST_NAME", "Numele request`ului");
// - found in /addrequest.php - ln 18
define("CF_ALREADY_VOTED_4_REQUEST", "Ai votat deja pentru acest request, numai 1 singur vot pentru fiecare request este permis");
// - found in /addrequest.php - ln 19
define("CF_SUCC_VOTED_4_REQUEST", "Ai votat cu succes pentru request");
// - found in /index.php - ln 29
define("CF_NO_GUEST_ACCESS", "NU esti autorizat pentru a accesa aceasta pagina");
// - found in /index.php - ln 34
define("CF_LOGIN_2_ACCESS_TRACKER", "<center><span style='color:red'>Trebuie sa te <a href='login.php'>Autentifici</a> pentru a accesa aceasta pagina</span></center>");
?>