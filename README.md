# vMCShop
Nowy wymiar automatycznego sklepu Minecraft!

Aktualna wersja: **1.6.2**

Dla osób, które posiadają już sklep w wersji **1.6.1** przygotowałem specjalną paczkę, aby nie musiały na nowo wszystkiego konfigurować.
Można ją pobrać [tutaj](https://dl.vmcshop.pro/vMCShop-update-1.6.2.zip). W paczce znajduje się też instrukcja przeprowadzania aktualizacji.

<hr>

Demo: [Klik](https://vmcshop.pro/)

Demo ACP: [Klik](https://vmcshop.pro/admin)

Login: **Admin**

Hasło: **password**

<hr>

### Opis

Sklep oferuje obsługę wielu serwerów i usług, dodawanie newsów z obrazkami oraz realizację voucherów. Dashboard ACP zawiera kilka podstawowych informacji takich jak ilosć sprzedanych usług czy zarobki. Znajduje się tam również wykres statystyk sprzedaży w bieżącym tygodniu, status serwerów podpiętych do skryptu, lista ostatnich zakupów oraz logowań do ACP. Panel sklepu obsługuje wiele kont dlatego została dodana zakładka logów sklepu, aby móc zobaczyć co i kiedy dany użytkownik zrobił. Sklep na razie obsługuje tylko serwis MicroSMS.pl w przyszłosci zostanie dodana obsługa płatnosci PayPal, dotpay.pl, LVLUP.pro i kilku innych hostingów serwerów Minecraft. Przed realizacją usługi czy vouchera sprawdzane jest czy serwer na którym komenda ma być wykonana jest aktualnie włączony.

W razie jakichkolwiek pytań/wątpliwosci/problemów/błędów zapraszam do kontaktu [mailowego](mailto:kontakt@verlikylos.pro), przez mój [FanPage](https://www.facebook.com/verlikylos), Discord (Verlikylos#5640) lub przy pomocy komunikatora [Telegram](https://t.me/Verlikylos).

Używasz tego skryptu sklepu? Napisz do mnie, a dodam Twoją stronę do poniższej listy!

### Lista serwisów używających skryptu vMCShop
- Na razie brak :C

### Obsługiwani operatorzy płatności
- MicroSMS.pl
- LvlUp.pro

### TO-DO
- [x] Strona główna z newsami, ostatnimi zakupami i statusem serwerów
- [x] Strona sklepu z listą usług
- [x] Logowanie do ACP
- [x] Dashboard z wykresem statystyk sprzedaży, statusem serwerów, ostatnimi zakupami dla poszczególnych serwerów, historią logowań do panelu i kilkoma podstawowymi informacjami
- [x] Dodawanie i usuwanie użytkowników ACP
- [x] Ustawienia konta użytkownika ACP ze zmianą hasła i avataru
- [x] Dodawanie i usuwanie serwerów
- [x] Dodawanie i usuwanie usług
- [x] Dodawanie i usuwanie newsów
- [x] Historia zakupów
- [x] Realizacja zakupów (Sprawdzanie czy serwer jest włączony podczas realizacji usługi)
- [x] Obsługa voucherów
- [x] Logi panelu administratora
- [ ] Możliwość edycji serwerów, usług i newsów (Aktualnie można tylko dodawać i usuwać)
- [ ] Własne podstrony
- [ ] Własne zakładki w menu
- [ ] Anty-bot (Weryfikacja nicku gracza poprzez wysyłanie odpowiedniej komendy do serwera)
- [ ] Możliwość dodania newsa bez obrazka
- [ ] Podział strony z logami na kategorie
- [ ] Poprawa responsywności strony
- [ ] Jeżeli do skryptu dodany jest tylko jeden serwer, tooltipsy w "ostatnich kupujących" nie wyświetlają informacji na jakim serwerze usługa została zakupiona
- [ ] Panel gracza z własnym pluginem zbierającym statystyki
- [ ] Top gildi i graczy. Integracja z [FunnyGuilds](https://github.com/FunnyGuilds/FunnyGuilds/) oraz [NovaGuilds](https://github.com/MarcinWieczorek/NovaGuilds)
- [ ] Możliwość wyłączenia strony z newsami

### Wymagania
 - PHP 5.6
 - MySQL
 - Aktywne mod_rewrite

### Instalacja

1. Wgraj pliki na serwer www.
2. Importuj plik ```database.sql``` do swojej bazy danych MySQL.
3. Edytuj plik ```application/config/config.php```. Zmienną ```$config['base_url']``` ustaw na adres do swojej witryny. Przykład ```$config['base_url'] = 'https://vmcshop.pro/'```.
4. Edytuj plik ```application/config/database.php```. Zmienne ```'hostname' => 'adres bazy danych'```, ```'username' => 'nazwa użytkownika bazy danych'```, ```'password' => 'hasło do bazy danych'```, ```'database' => 'nazwa bazy danych'``` ustaw na wartosci odpowiadające Twojej bazie danych.
5. Edytuj plik ```application/config/settings.php```. Skonfiguruj go według upodobań. Ustawiasz tam między innymi dane do integracji z operatorem płatnosci, tło strony, logo itp.
6. Przejdź do witryny ```twojadomena.com/admin``` i zaloguj się używając domyslnych danych. (Login: Admin, Hasło: password).
7. Sklep jest gotowy do użycia.

### Changelog
##### Wersja 1.6.2
 - Poprawiono skrypty łączące się z serwerem przy pomocy RCON oraz Query
 - Jeżeli do sklepu dodany jest tylko jeden serwer, w navigacji pojawia się jeden przycisk prowadzący do sklepu zamiast listy
 - Poprawiono zachowanie historii zakupów kiedy usuniemy dotyczącą jej usługę lub serwer
 - Poprawiono wyświetlanie listy sklepów na stronie realizacji voucheru i logowania do acp
 - Formularz dodawania usługi wyświetla teraz odpowiednie pola w zależności od wybranego operatora płatności SMS
 - W zakładce Usługi w ACP wyświetla się teraz informacja o aktualnym operatorze płatności SMS
 - Kilka mniejszych poprawek

##### Wersja 1.6.1
 - Dodanie operatora płatności SMS LvlUp.pro
 - Kilka mniejszych poprawek
 
##### Wersja 1.6
 - Publikacja sklepu

### Licencja: **GNU GPLv3**