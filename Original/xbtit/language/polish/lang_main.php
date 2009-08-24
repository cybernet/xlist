<?php
global $users, $torrents, $seeds, $leechers, $percent;
// $language["rtl"]="rtl"; // if your language is  right to left then uncomment this line
$language["charset"]="UTF-8"; // uncomment this line with specific language charset if different than tracker's one
$language["ACCOUNT_CONFIRM"]="Potwierdzenie konta na stronie $SITENAME .";
$language["ACCOUNT_CONGRATULATIONS"]="Gratulacje twoje konto jest teraz aktywne!<br>Możesz się <a href=index.php?page=login>zalogować</a> na stronie używając swojego konta.";
$language["ACCOUNT_CREATE"]="Zarejestruj się";
$language["ACCOUNT_DELETE"]="Usuń konto";
$language["ACCOUNT_DETAILS"]="szczegóły konta";
$language["ACCOUNT_EDIT"]="Edytuj konto";
$language["ACCOUNT_MGMT"]="Zarządzanie kontem";
$language["ACCOUNT_MSG"]="Witam,\n\nTen email został wysłany ponieważ ktoś zarejestrował się na naszej stronie pod takim adresem email.\nJeżeli nie jesteś tą osobą zignoruj ten email, a jeżeli to Ty prosimy potwierdzić rejestrację \n\nZ pozdrowieniami od załogi.";
$language["ACTION"]="Akcja";
$language["ACTIVATED"]="Aktywna";
$language["ACTIVE"]="Status";
$language["ACTIVE_ONLY"]="Tylko aktywne";
$language["ADD"]="Dodaj";
$language["ADDED"]="Dodane";
$language["ADMIN_CPANEL"]="Panel kontrolny Admina";
$language["ADMINCP_NOTES"]="Tutaj możesz kontrolować wszystkie ustawienia swojego trackera...";
$language["ALL"]="Wszystko";
$language["ALL_SHOUT"]="Historia";
$language["ANNOUNCE_URL"]="Tracker announce url:";
$language["ANONYMOUS"]="Anonimowy";
$language["ANSWER"]="Odpowiedź";
$language["AUTHOR"]="Autor";
$language["AVATAR_URL"]="Avatar (url): ";
$language["AVERAGE"]="Średnio";
$language["BACK"]="Powrót";
$language["BAD_ID"]="Zły ID!";
$language["BCK_USERCP"]="Powrót do Panelu Usera";
$language["BLOCK"]="Blok";
$language["BODY"]="Treść";
$language["BOTTOM"]="dół";
$language["BY"]="przez";
$language["CANT_DELETE_ADMIN"]="Nie można usunąć innego Admina!";
$language["CANT_DELETE_NEWS"]="Nie masz uprawnień na usuwanie newsów!";
$language["CANT_DELETE_TORRENT"]="Nie masz uprawnień na usuwanie torrentów!...";
$language["CANT_DELETE_USER"]="Nie masz uprawnień na usuwanie userów!";
$language["CANT_DO_QUERY"]="Nie można wykonać zapytania SQL - ";
$language["CANT_EDIT_TORR"]="Nie masz uprawnień na edytowanie torrentów!";
$language["CANT_FIND_TORRENT"]="Nie można znaleźć pliku torrent!";
$language["CANT_READ_LANGUAGE"]="Nie można odczytać pliku językowego!";
$language["CANT_SAVE_CONFIG"]="Nie można zapisać ustawień do config.php";
$language["CANT_SAVE_LANGUAGE"]="Nie można zapisać pliku językowego";
$language["CANT_WRITE_CONFIG"]="Ostrzeżenie: nie można zapisać config.php!";
$language["CATCHUP"]="Zaznacz jako przeczytane";
$language["CATEGORY"]="Kat.";
$language["CATEGORY_FULL"]="Kategoria";
$language["CENTER"]="środek";
$language["CHANGE_PID"]="Zmień PID";
$language["CHARACTERS"]="znaki";
$language["CHOOSE"]="Wybierz";
$language["CHOOSE_ONE"]="Wybierz jedno";
$language["CLICK_HERE"]="kliknij tutaj";
$language["CLOSE"]="zamknij";
$language["COMMENT"]="Kom.";
$language["COMMENT_1"]="Komentarz";
$language["COMMENT_PREVIEW"]="Podgląd komentarza";
$language["COMMENTS"]="Komentarze";
$language["CONFIG_SAVED"]="Gratulacje, nowa konfiguracja została zapisana";
$language["COUNTRY"]="Kraj";
$language["CURRENT_DETAILS"]="Szczegóły";
$language["DATABASE_ERROR"]="Błąd bazy danych.";
$language["DATE"]="Dodano";
$language["DB_ERROR_REQUEST"]="Błąd bazy danych. Nie można wykonać zapytania.";
$language["DB_SETTINGS"]="Ustawienia bazy danych";
$language["DEAD_ONLY"]="Tylko Martwe";
$language["DELETE"]="Usuń";
$language["DELETE_ALL_READED"]="Usuń wszystkie przeczytane";
$language["DELETE_CONFIRM"]="Jesteś pewien, że chcesz to usunąć?";
$language["DELETE_TORRENT"]="Usuń torrent";
$language["DELFAILED"]="Usunięcie zakończone niepowodzeniem";
$language["DESCRIPTION"]="Opis";
$language["DONT_NEED_CHANGE"]="nie musisz zmieniać tych ustawień!";
$language["DOWN"]="DL";
$language["DOWNLOAD"]="Pobierz";
$language["DOWNLOAD_TORRENT"]="Pobierz Torrent";
$language["DOWNLOADED"]="Pobrane";
$language["EDIT"]="Edytuj";
$language["EDIT_LANGUAGE"]="Edytuj Język";
$language["EDIT_POST"]="Edytuj Post";
$language["EDIT_TORRENT"]="Edytuj Torrent";
$language["EMAIL"]="Email";
$language["EMAIL_SENT"]="Email został wysłany pod wskazany adres<br>kliknij w załączony link aby potwierdzić konto.";
$language["EMAIL_VERIFY"]="zmiana adresu email na stronie $SITENAME";
$language["EMAIL_VERIFY_BLOCK"]="Email weryfikacyjny wysłany";
$language["EMAIL_VERIFY_MSG"]="Witam,\n\nTen email został wysłany ponieważ zmieniasz aktualny adres email, proszę kliknąć w poniższy link aby zakończyć proces zmiany adresu email.\n\nZ pozdrowieniami od załogi.";
$language["EMAIL_VERIFY_SENT1"]="<br /><center>Email weryfikacyjny został wysłany na adres:<br /><br /><strong><font color=red>";
$language["EMAIL_VERIFY_SENT2"]="</font></strong><br /><br />Musisz kliknąć na link zawarty w emailu wysłanym na twoją prośbę.<br />Email powinien dotrzeć w ciągu 10 minut(najczęściej natychmiast)<br />czasami niektórzy operatorzy skrzynek email mogą oznaczyć taki mail jako SPAM<br /> więc sprawdź swój folder SPAM jeżeli nie możesz go znaleźć.<br /><br />";
$language["ERR_500"]="HTTP/1.0 500 Nieautoryzowany dostęp!";
$language["ERR_AVATAR_EXT"]="Sorry tylko gif, jpg, bmp lub png są dozwolone";
$language["ERR_BAD_LAST_POST"]="";
$language["ERR_BAD_NEWS_ID"]="Zły ID newsa!";
$language["ERR_BODY_EMPTY"]="Pole Treść nie może być puste!";
$language["ERR_CANT_CONNECT"]="Nie można się połączyć z lokalnym serwerem MySQL";
$language["ERR_CANT_OPEN_DB"]="Nie można otworzyć bazy danych";
$language["ERR_DB_ERR"]="Błąd bazy danych. Proszę skontaktować sie z administratorem w tej sprawie.";
$language["ERR_DELETE_POST"]="Usuń post. Sanity check: Chcesz usunąć post. Kliknij";
$language["ERR_DELETE_TOPIC"]="Usuń wątek. Sanity check: Chcesz usunąć wątek. Kliknij";
$language["ERR_EMAIL_ALREADY_EXISTS"]="Ten email już istnieje w naszej bazie danych!";
$language["ERR_EMAIL_NOT_FOUND_1"]="Adres email";
$language["ERR_EMAIL_NOT_FOUND_2"]="nie znaleziony w bazie danych.";
$language["ERR_ENTER_NEW_TITLE"]="Musisz wpisać nowy tytuł!";
$language["ERR_FORUM_NOT_FOUND"]="Forum nie znalezione";
$language["ERR_FORUM_UNKW_ACT"]="Błąd forum: Nieznana akcja";
$language["ERR_GUEST_EXISTS"]="Gość to nick zarezerwowany. Nie możesz sie zarejestrować jako 'Gość'";
$language["ERR_IMAGE_CODE"]="Kod obrazka nie pasuje";
$language["ERR_INS_TITLE_NEWS"]="Musisz wpisać oba: tytuł i treść newsa";
$language["ERR_INV_NUM_FIELD"]="Nieprawidłowe pole(a) z klienta";
$language["ERR_INVALID_CLIENT_EVENT"]="Nieprawidłowe zdarzenie = po stronie klienta.";
$language["ERR_INVALID_INFO_BT_CLIENT"]="Nieprawidłowa informacja otrzymana od klienta BitTorrent";
$language["ERR_INVALID_IP_NUMB"]="Nieprawidłowy adres IP. Musi być w standardowym kropkowym decymalnym zapisie (nazwy hostów niedozwolone)";
$language["ERR_LEVEL"]="Sorry, twoja ranga ";
$language["ERR_LEVEL_CANT_POST"]="Nie masz uprawnień do pisania postów w tym forum.";
$language["ERR_LEVEL_CANT_VIEW"]="Nie masz uprawnień do przeglądania tego wątku.";
$language["ERR_MISSING_DATA"]="Brakuje danych!";
$language["ERR_MUST_BE_LOGGED_SHOUT"]="Musisz być zalogowany aby pisać w shoutboxie...";
$language["ERR_NO_BODY"]="Brak Treści";
$language["ERR_NO_NEWS_ID"]="ID newsa nie znaleziony!";
$language["ERR_NO_POST_WITH_ID"]="Brak postu z ID ";
$language["ERR_NO_SPACE"]="Twój nick nie może zawierać spacji, proszę zamienić je na podkreślenie:<br /><br />";
$language["ERR_NO_TOPIC_ID"]="Zwrócono brak ID wątku";
$language["ERR_NO_TOPIC_POST_ID"]=" Brak wątku skojarzonego z ID postu";
$language["ERR_NOT_AUTH"]="nie masz uprawnień!";
$language["ERR_NOT_FOUND"]="Nie znaleziono...";
$language["ERR_NOT_PERMITED"]="Niedozwolone";
$language["ERR_PASS_LENGTH"]="<font color=\"black\">Hasło musi się składać z minimum 4 znaków.</font>";
$language["ERR_PASSWORD_INCORRECT"]="Hasło nieprawidłowe";
$language["ERR_PERM_DENIED"]="Brak dostępu";
$language["ERR_PID_NOT_FOUND"]="Proszę ponownie ściągnąć plik torrent. PID system jest aktywny, a w tym torrencie pid nie został znaleziony";
$language["ERR_RETR_DATA"]="Błąd przy odbieraniu danych!";
$language["ERR_SEND_EMAIL"]="Nie można wysłać maila. Proszę skontaktować sie z administratorem w sprawie tego błędu.";
$language["ERR_SERVER_LOAD"]="Ładowanie serwera jest zbyt duże w tym momencie. Odświeżanie, proszę czekać...";
$language["ERR_SPECIAL_CHAR"]="<font color=\"black\">Twój nick nie może zawierać znaków specjalnych takich jak:<br /><br /><font color=\"red\"><strong>* ? < > @ $ & % etc.</strong></font></font><br />";
$language["ERR_SQL_ERR"]="Błąd SQL";
$language["ERR_SUBJECT"]="Musisz wpisać temat.";
$language["ERR_TOPIC_ID_NA"]="ID wątku jest N/A";
$language["ERR_TOPIC_LOCKED"]="Wątek jest zamknięty";
$language["ERR_TORRENT_IN_BROWSER"]="Ten plik należy uruchomić w kliencie BitTorrent.";
$language["ERR_UPDATE_USER"]="Nie można uaktualnić danych usera. Proszę skontaktować sie z administratorem w sprawie tego błędu";
$language["ERR_USER_ALREADY_EXISTS"]="Już istnieje user o takim nick-u!";
$language["ERR_USER_NOT_FOUND"]="Sorry, User nie znaleziony";
$language["ERR_USER_NOT_USER"]="Nie masz uprawnień do przeglądania innego Panelu Usera!";
$language["ERR_USERNAME_INCORRECT"]="Nick nieprawidłowy";
$language["ERROR"]="Błąd";
$language["ERROR_ID"]="BŁĄD ID";
$language["FACOLTATIVE"]="opcjonalnie";
$language["FILE"]="Plik";
$language["FILE_CONTENTS"]="Zawartość pliku";
$language["FILE_NAME"]="Nazwa pliku";
$language["FIND_USER"]="Znajdź użytkownika";
$language["FINISHED"]="Zakończone";
$language["FORUM"]="Forum";
$language["FORUM_ERROR"]="Błąd forum";
$language["FORUM_INFO"]="Forum Info";
$language["FORUM_MIN_CREATE"]="Min ranga tworzenia";
$language["FORUM_MIN_READ"]="Min ranga odczytu";
$language["FORUM_SEARCH"]="Wyszukiwarka forum";
$language["FORUM_N_TOPICS"]="L. wątków";
$language["FORUM_N_POSTS"]="L. postów";
$language["FRM_DELETE"]="Usuń";
$language["FRM_LOGIN"]="Zaloguj";
$language["FRM_PREVIEW"]="Podgląd";
$language["FRM_REFRESH"]="Odśwież";
$language["FRM_RESET"]="Wyczyść";
$language["FRM_SEND"]="Wyślij";
$language["FRM_CONFIRM"]="Potwierdź";
$language["FRM_CANCEL"]="Anuluj";
$language["FRM_CLEAN"]="Wyczyść";
$language["GLOBAL_SERVER_LOAD"]="Globalne ładowanie serwera (Wszystkie strony na tym serwerze)";
$language["GO"]="Idź";
$language["GROUP"]="Ranga";
$language["GUEST"]="Gość";
$language["GUESTS"]="Gości";
$language["HERE"]="tutaj";
$language["HISTORY"]="Historia";
$language["HOME"]="Strona główna";
$language["IF_YOU_ARE_SURE"]="jeżeli jesteś pewien.";
$language["IM_SURE"]="Jestem pewien";
$language["IN"]="w";
$language["INF_CHANGED"]="Informacje zmienione!";
$language["INFINITE"]="Inf.";
$language["INFO_HASH"]="Info Hash";
$language["INS_NEW_PWD"]="Wpisz NOWE hasło!";
$language["INS_OLD_PWD"]="Wpisz STARE hasło!";
$language["INSERT_DATA"]="Wpisz wszystkie wymagane dane przy wstawianiu.";
$language["INSERT_NEW_FORUM"]="Dodaj nowe forum";
$language["INVALID_ID"]="To jest nieprawidłowy ID. Sorry!";
$language["INVALID_INFO_HASH"]="Nieprawidłowa wartość info hash.";
$language["INVALID_PID"]="Nieprawidłowy PID";
$language["INVALID_TORRENT"]="Błąd trackera: nieprawidłowy torrent";
$language["KEYWORDS"]="słowa";
$language["LAST_EXTERNAL"]="Ostatnia aktualizacja zewnętrznych torrentów odbyła się ";
$language["LAST_NEWS"]="Najnowsze newsy";
$language["LAST_POST_BY"]="Ostatni post napisany przez";
$language["LAST_SANITY"]="Ostatni Sanity Check wykonany o ";
$language["LAST_TORRENTS"]="Najnowsze torrenty";
$language["LAST_UPDATE"]="Ostatnia aktualizacja";
$language["LASTPOST"]="Ostatni&nbsp;post";
$language["LEECHERS"]="leecherów";
$language["LEFT"]="lewa";
$language["LOGIN"]="Zaloguj";
$language["LOGOUT"]="Wyloguj";
$language["MAILBOX"]="Skrzynka";
$language["MANAGE_NEWS"]="Zarządzaj newsami";
$language["MEMBER"]="User";
$language["MEMBERS"]="Użytkownicy";
$language["MEMBERS_LIST"]="Lista użytkowników";
$language["MINIMUM_100_DOWN"]="(z minimum 100MB ściągniętych)";
$language["MINIMUM_5_LEECH"]="z minimum 5 leecherami, nie dotyczy martwych torrentów";
$language["MINIMUM_5_SEED"]="z minimum 5 seedami";
$language["MKTOR_INVALID_HASH"]="makeTorrent: Otrzymano nieprawidłowy hash";
$language["MNU_ADMINCP"]="Panel Admina";
$language["MNU_FORUM"]="Forum";
$language["MNU_INDEX"]="Strona Główna";
$language["MNU_MEMBERS"]="Użytkownicy";
$language["MNU_NEWS"]="Newsy";
$language["MNU_STATS"]="Statystyki";
$language["MNU_TORRENT"]="Torrenty";
$language["MNU_UCP_CHANGEPWD"]="Zmień hasło";
$language["MNU_UCP_HOME"]="Panel Usera - Główna";
$language["MNU_UCP_IN"]="Twója PM odbiorcza";
$language["MNU_UCP_INFO"]="Edytuj Profil";
$language["MNU_UCP_NEWPM"]="Nowa PM";
$language["MNU_UCP_OUT"]="Twoja PM nadawcza";
$language["MNU_UCP_PM"]="Twój PM box";
$language["MNU_UPLOAD"]="Wstaw";
$language["MORE_SMILES"]="Więcej emotikon";
$language["MORE_THAN"]="Znaleziono więcej niż ";
$language["MORE_THAN_2"]=", wyświetlam pierwsze";
$language["NA"]="N/A";
$language["NAME"]="Nazwa";
$language["NEED_COOKIES"]="Nota: Musisz mieć włączoną obsługę cookies aby się zalogować.";
$language["NEW_COMMENT"]="Wpisz swój komentarz...";
$language["NEW_COMMENT_T"]="Nowy komentarz";
$language["NEWS"]="news";
$language["NEWS_DESCRIPTION"]="Treść newsa:";
$language["NEWS_INSERT"]="Wpisz swojego newsa";
$language["NEWS_PANEL"]="Panel newsów";
$language["NEWS_TITLE"]="Tytuł:";
$language["NEXT"]="Następna";
$language["NO"]="Nie";
$language["NO_BANNED_IPS"]="Nie ma zbanowanych IP";
$language["NO_COMMENTS"]="Brak komentarzy...";
$language["NO_FORUMS"]="Nie znaleziono forum!";
$language["NO_MAIL"]="nie masz nowych PM.";
$language["NO_MESSAGES"]="Nie masz nowych PM...";
$language["NO_NEWS"]="brak newsów";
$language["NO_PEERS"]="brak peerów";
$language["NO_RECORDS"]="Sorry, lista jest pusta...";
$language["NO_TOPIC"]="Nie znaleziono wątków";
$language["NO_TORR_UP_USER"]="Ten user nie wstawił zadnych torrentów";
$language["NO_TORRENTS"]="Brak torrentów...";
$language["NO_USERS_FOUND"]="nie znaleziono userów!";
$language["NOBODY_ONLINE"]="Nikt online";
$language["NONE"]="Nic";
$language["NOT_ADMIN_CP_ACCESS"]="Nie masz uprawnień dostępu do Panelu Admina!";
$language["NOT_ALLOW_DOWN"]="zabronione jest ściąganie z";
$language["NOT_AUTH_DOWNLOAD"]="Nie masz uprawnień do pobierania. Sorry...";
$language["NOT_AUTH_VIEW_NEWS"]="Nie masz uprawnień do przeglądania newsów!";
$language["NOT_AUTHORIZED"]="Nie masz uprawnień do przeglądania strony";
$language["NOT_AUTHORIZED_UPLOAD"]="Nie masz uprawnień do wysyłania!";
$language["NOT_AVAILABLE"]="N/A";
$language["NOT_MAIL_IN_URL"]="To nie jest adres email znajdujący sie w linku";
$language["NOT_POSS_RESET_PID"]="Nie można zresetować twojego PID! <br />Skontaktuj sie z administratorem...";
$language["NOW_LOGIN"]="Teraz, zostaniesz poproszony o zalogowanie się";
$language["NUMBER_SHORT"]="#";
$language["OLD_PWD"]="Stare hasło";
$language["ONLY_REG_COMMENT"]="Tylko zarejestrowani użytkownicy mogą pisać komentarze!";
$language["OPT_DB_RES"]="Wynik optymalizacji bazy danych";
$language["OPTION"]="Opcje";
$language["PASS_RESET_CONF"]="potwierdzenie resetu hasła";
$language["PEER_CLIENT"]="Klient";
$language["PEER_COUNTRY"]="Kraj";
$language["PEER_ID"]="Peer ID";
$language["PEER_LIST"]="Lista Peerów";
$language["PEER_PORT"]="Port";
$language["PEER_PROGRESS"]="Postęp";
$language["PEER_STATUS"]="Status";
$language["PEERS"]="peerów";
$language["PEERS_DETAILS"]="Kliknij tutaj aby zobaczyć listę peerów";
$language["PICTURE"]="Obrazek";
$language["PID"]="PID";
$language["PLEASE_WAIT"]="Proszę czekać...";
$language["PM"]="PM";
$language["POSITION"]="Pozycja";
$language["POST_REPLY"]="Napisz odpowiedź";
$language["POSTED_BY"]="napisane przez";
$language["POSTED_DATE"]="Napisane dnia";
$language["POSTS"]="Postów";
$language["POSTS_PER_DAY"]="%s postów na dzień";
$language["POSTS_PER_PAGE"]="Postów na stronę";
$language["PREVIOUS"]="Poprz.";
$language["PRIVATE_MSG"]="Prywatna wiadomość";
$language["PWD_CHANGED"]="Hasło zmienione!";
$language["QUESTION"]="Pytanie";
$language["QUICK_JUMP"]="Skocz do";
$language["QUOTE"]="Cytuj";
$language["RANK"]="Ranga";
$language["RATIO"]="Ratio";
$language["REACHED_MAX_USERS"]="Maksymalna liczba użytkowników osiągnięta";
$language["READED"]="Przeczytane";
$language["RECEIVER"]="Odbiorca";
$language["RECOVER_DESC"]="Użyj poniższego formularza aby zresetować swoje haslo, a w ciągu kilku minut otrzymasz email z detalami konta.<br>(Będziesz musiał/-a odpowiedzieć na email potwierdzający.)";
$language["RECOVER_PWD"]="Odzyskiwanie hasła";
$language["RECOVER_TITLE"]="Odzyskaj stracony nick lub hasło";
$language["REDIRECT"]="jeżeli twoja przeglądarka nie ma włączonej obsługi javascript, kliknij";
$language["REDOWNLOAD_TORR_FROM"]="Pobierz ponownie torrent z";
$language["REGISTERED"]="Zarejestrowany";
$language["REGISTERED_EMAIL"]="Zarejestrowany email";
$language["REMOVE"]="Usuń";
$language["REPLIES"]="Odpowiedzi";
$language["REPLY"]="Odpowiedz";
$language["RESULT"]="Rezultat";
$language["RETRY"]="Powtórz";
$language["RETURN_TORRENTS"]="Powrót do listy torrentów";
$language["REVERIFY_CONGRATS1"]="<center><br />Gratulacje, twój email został zweryfikowany i pomyślnie zmieniony<br /><br /><strong>Z: <font color=red>";
$language["REVERIFY_CONGRATS2"]="</strong></font><br /><strong>Na: <font color=red>";
$language["REVERIFY_CONGRATS3"]="</strong></font><br /><br />";
$language["REVERIFY_FAILURE"]="<center><br /><strong><font color=red><u>Sorry ale ten url jest nieprawidłowy</u></strong></font><br /><br />Za każdym razem gdy chcesz zmienić adres email zostaje generowany losowy numer więc<br />jeżeli widzisz tą wiadomość najprawdopodobniej próbujesz zmienić swój adres email <br />więcej niż raz i używasz starego url.<br /><br /><strong>Prosimy poczekać aż będzie Pan/Pani absolutnie pewny/-a że nie otrzymał/-a Pan/Pani nowego<br />emaila weryfikacyjnego przed próbą zmiany adresu email ponownie.</strong><br /><br />";
$language["REVERIFY_MSG"]="Jeżeli zmienisz stary adres email otrzymasz link potwierdzający na nowy adres email który chcesz zmienić.<br /><br /><font color=red><strong>Adres email nie zostanie uaktualniony dopóki nie zweryfikujesz nowego adresu email klikając na link.</strong></font>";
$language["RIGHT"]="prawa";
$language["SEARCH"]="Szukaj";
$language["SEEDERS"]="seedów";
$language["SEEN"]="Widziany";
$language["SELECT"]="Wybierz...";
$language["SENDER"]="Nadawca";
$language["SENT_ERROR"]="Błąd wysyłania";
$language["SHORT_C"]="C"; //Shortname for Completed
$language["SHORT_L"]="L"; //Shortname for Leechers
$language["SHORT_S"]="S"; //Shortname for Seeders
$language["SHOUTBOX"]="ShoutBox";
$language["SIZE"]="Rozmiar";
$language["SORRY"]="Sorry";
$language["SORTID"]="Kolejność";
$language["SPEED"]="Prędkość";
$language["STICKY"]="Przyklejony";
$language["SUB_CATEGORY"]="Sub-kategoria";
$language["SUBJECT"]="Temat";
$language["SUBJECT_MAX_CHAR"]="Temat może mieć";
$language["SUC_POST_SUC_EDIT"]="Post został pomyślnie edytowany.";
$language["SUC_SEND_EMAIL"]="Email potwierdzający został wysłany do";
$language["SUC_SEND_EMAIL_2"]="Proszę poczekać kilka minut na email.";
$language["SUCCESS"]="Sukces";
$language["SUMADD_BUG"]="Tracker zwraca błąd summaryAdd";
$language["TABLE_NAME"]="Nazwa tabeli";
$language["TIMEZONE"]="Strefa czasowa";
$language["TITLE"]="Tytuł";
$language["TOP"]="góra";
$language["TOP_10_ACTIVE"]="Top 10 Najaktywniejszych torrentów";
$language["TOP_10_BEST_SEED"]="Top 10 Najlepiej seedowanych torrentów";
$language["TOP_10_BSPEED"]="Top 10 Najszybszych torrentów";
$language["TOP_10_DOWNLOAD"]="Top 10 Ściągających";
$language["TOP_10_SHARE"]="Top 10 Najlepszych Wysyłąjących";
$language["TOP_10_UPLOAD"]="Top 10 Wstawiających";
$language["TOP_10_WORST"]="Top 10 Najgorszych Wysyłających";
$language["TOP_10_WORST_SEED"]="Top 10 Najgorzej seedowanych torrentów";
$language["TOP_10_WSPEED"]="Top 10 Najwolniejszych torrentów";
$language["TOP_TORRENTS"]="Najpopularniejsze torrenty";
$language["TOPIC"]="Wątek";
$language["TOPICS"]="Wątków";
$language["TOPICS_PER_PAGE"]="Wątków na stronę";
$language["TORR_PEER_DETAILS"]="Lista peerów";
$language["TORRENT"]="Torrent";
$language["TORRENT_ANONYMOUS"]="Wyślij jako anonimowy";
$language["TORRENT_CHECK"]="Pozwól trackerowi pobrać i użyć informacje z pliku torrent.";
$language["TORRENT_DETAIL"]="Szczegóły torrenta";
$language["TORRENT_FILE"]="Plik torrent";
$language["TORRENT_SEARCH"]="Szukaj torrentów";
$language["TORRENT_STATUS"]="Status";
$language["TORRENT_UPDATE"]="Aktualizacja, proszę czekać...";
$language["TORRENTS"]="torrentów";
$language["TORRENTS_PER_PAGE"]="Torrentów na stronę";
$language["TRACK_DB_ERR"]="Błąd trackera/bazy danych. Szczegóły znajdują sie w logu błędów.";
$language["TRACKER_INFO"]="$users userów, $torrents torrentów ($seeds seedów i $leechers leecherów, $percent%)";
$language["TRACKER_LOAD"]="Obciążenie trackera";
$language["TRACKER_SETTINGS"]="Ustawienia trackera";
$language["TRACKER_STATS"]="Statystyki Trackera";
$language["TRACKING"]="tracking";
$language["TRAFFIC"]="Traffic";
$language["UCP_NOTE_1"]="Tutaj możesz kontrolować swoją skrzynkę odbiorczą, pisać PM do innych użytkowników,";
$language["UCP_NOTE_2"]="Kontrolować i modyfikować ustawienia konta, etc...";
$language["UNAUTH_IP"]="Nieautoryzowany adres IP.";
$language["UNKNOWN"]="nieznany";
$language["UPDATE"]="Aktualizacja";
$language["UPFAILED"]="Upload zakończony niepowodzeniem";
$language["UPLOAD_IMAGE"]="Upload obrazka";
$language["UPLOAD_LANGUAGE_FILE"]="Wyślij plik językowy";
$language["UPLOADED"]="Wysłane";
$language["UPLOADER"]="Uploader";
$language["UPLOADS"]="Wysyłanie";
$language["URL"]="URL";
$language["USER_CP"]="Mój Panel";
$language["USER_CP_1"]="Panel Usera";
$language["USER_DETAILS"]="Profil użytkownika";
$language["USER_EMAIL"]="Prawidłowy email";
$language["USER_ID"]="ID usera";
$language["USER_JOINED"]="Zarejestrowany";
$language["USER_LASTACCESS"]="Ostatnio widoczny";
$language["USER_LEVEL"]="Ranga";
$language["USER_LOCAL_TIME"]="Lokalny czas użytkownika";
$language["USER_NAME"]="Nick";
$language["USER_PASS_RECOVER"]="Odzyskiwanie hasła/nick-a";
$language["USER_PWD"]="Hasło";
$language["USERS_SEARCH"]="Szukaj użytkownika";
$language["VIEW_DETAILS"]="Podgląd szczegółów";
$language["VIEW_TOPIC"]="Podgląd wątków";
$language["VIEW_UNREAD"]="Zobacz nieprzeczytane";
$language["VIEWS"]="Wejść";
$language["VISITOR"]="Odwiedzający";
$language["VISITORS"]="Odwiedzających";
$language["WAIT_ADMIN_VALID"]="Powinieneś poczekać na zatwierdzenie przez administratora...";
$language["WARNING"]="Uwaga!";
$language["WELCOME"]="Witamy";
$language["WELCOME_ADMINCP"]="Witamy w Panelu Admina";
$language["WELCOME_BACK"]="Witamy ponownie";
$language["WELCOME_UCP"]="Witamy w Panelu Usera";
$language["WORD_AND"]="i";
$language["WORD_NEW"]="Nowy";
$language["WROTE"]="napisał";
$language["WT"]="WT";
$language["X_TIMES"]="razy";
$language["YES"]="Tak";
$language["LAST_IP"]="Ostatnie IP";
$language["FIRST_UNREAD"]="Przejdź do pierwszego nieczytanego postu";
$language["MODULE_UNACTIVE"]="Wymagany moduł jest nieaktywny!";
$language["MODULE_NOT_PRESENT"]="Wymagany moduł nie istnieje!";
$language["MODULE_LOAD_ERROR"]="Wymagany moduł wydaje się być zły!";
?>