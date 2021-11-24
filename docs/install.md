# How to install

1. Zet alle bestanden in `/htdocs` of `/www`
2. Maak een mysql database aan en run het bestand `/modtools.sql` om de database te vullen
3. Verander de credentials in `/query.php`, `/makelog.php` en `/modtoolsconfig.php`.
4. Gebruik een bcrypt generator (https://bcrypt-generator.com/) om een wachtwoord aan te maken en verander een van de wachtwoorden in `modtools.users`.