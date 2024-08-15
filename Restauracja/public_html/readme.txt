 Tytuł projektu:
Restauracja 


 
 !!!Projekt2 ma wszystkie funkcjonalności projekt1 i projekt3 nie posiadają wszystkich funkcji. Takich jak rejestracja dla użytkownika czy logowanie dla użytkownika

 Wymagania systemowe:
PHP 7.4.3
Apache/2.4.41 (Ubuntu)
MariaDB: 10.3.34



 Instalacja:
 1.Utworzyć na serwerze folder projekt2 w nim umieścić plik install.php i folder config oraz folder sql. Folder config powinien zawierać plik constants.php,
  natomiast  folder sql zawierający pliki insert.php i sql.php.

 Można do tego celu wykorzystać WinSCP 
 podając odpowiednią nazwę hosta serwera oraz nazwę użytkownika i hasło.
 2. Otworzyć terminal ssh na serwerze manticore i zmienić uprawnienia dla pliku constants.php. Przykładowe polecenie 
należy zmieić ścieżkę na tą gdzie umieściliśmy plik constants.php:
 (przykładowe polecenie)chmod o+w /home/students/inf2022/acdc000/public_html/projekt3/config/constants.php
2.Po przerzuceniu, otwórz w przeglądarce  install.php.
3.Uzupełnij formularz wymaganymi danymi.
4.Przejść przez wszystkie kroki instalatora.
5. To wszystko aplikacja powinna być zainstalowana.

Strona została wykonan przy pomocy:
CSS
HTML
PHP

 Autor:
Marcin Pierzgalski
nr albumu: 387410
