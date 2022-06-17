<h1>Základní setup</h1>
Po naklonování projektu použijte příkaz composer install, případně composer update

Pak si zkopírujte `.env.example` a změňte název na `.env`.
V souboru následně vyplňte tyto hodnoty:<br>
***
<b>K nastavení DB</b><br>
`DB_CONNECTION=mysql`<br>
`DB_HOST=127.0.0.1`<br>
`DB_PORT=3306`<br>
`DB_DATABASE=haos`<br>
`DB_USERNAME=root`<br>
`DB_PASSWORD=`<br>
***

<b>Kvůli odesílání emailů (zprávy, objednávky, faktury)</b><br>
`MAIL_MAILER=`<br>
`MAIL_HOST=`<br>
`MAIL_PORT=`<br>
`MAIL_USERNAME=`<br>
`MAIL_PASSWORD=`<br>
`MAIL_ENCRYPTION=`<br>
`MAIL_FROM_ADDRESS=`

K emailům se ještě vztahuje emailová adresa, na kterou budou chodit zprávy z webu či vytvoření nové objednávky.
Adresa se nastavuje v `App\Custom\Texts.php` v `EMAIL_FROM`
***

<h3>DB model</h3>
Pokud již vše máte nastavené, tak pomocí příkazu `php artisan migrate` se vám vytvoří v DB tabulky.
Případně s použitím `php artisan migrate --seed` se vám naplní dummy datama<br>
![image](https://user-images.githubusercontent.com/61250416/166170914-2e75ae10-0641-4251-85c7-3d09c231504a.png)<br>


<h3>Postman requesty</h3>
Následně si všechny requesty můžete vyzkoušet v postmanu, s mojí kolekcí requestů, kterou najdete v root složce s názvem <b>haos.store.postman_collection.json </b><br>
Všechny requesty se píší v tomto formátu <b>127.0.0.1:8000/api/{role}/{table}/{record}</b><br>
role - admin/user<br>
record - specifikace řádku v tabulce <br><br>

Většina rout je pod middlewarem, takže pro vyzkoušení je nutné si vytvořit uživale přes request "user - store" a následně se přihlásit, kvůli vygenerování Bearer tokenu.
