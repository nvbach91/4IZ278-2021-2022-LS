<?php

return [
    'common' => [
        'greeting' => 'Dobrý den,',
        'ending' => 'S pozdravem,',
    ],

    'user' => [
        'registered' => [
            'subject' => 'Registrace do systému :appName',
            'line1' => 'děkujeme za Vaši registraci do systému :appName. Pomocí tlačítka níže, prosím, potvrďtě svou emailovou adresu.',
            'action' => 'Potvrdit emailovou adresu',
        ],

        'email_verification' => [
            'subject' => 'Potvrzení emailové adresy do systému :appName',
            'line1' => 'pro ověření své emailové adresy použijte tlačítko níže.',
            'action' => 'Potvrdit emailovou adresu',
        ],

        'forgotten_password' => [
            'subject' => 'Zapomenuté heslo do systému :appName',
            'line1' => 'pro nastavení nového hesla použijte tlačítko níže. Pokud jste o nastavení hesla nežádali, můžete tento email ignorovat.',
            'action' => 'Nastavit nové heslo',
        ],

        'password_reset' => [
            'subject' => 'Změna hesla v systému :appName',
            'line1' => 'Vaše heslo do aplikace bylo změněno. Pokud jste si v poslední době heslo neměnili, neprodleně kontaktujte podporu na email :supportEmail.',
        ],

        'registered_without_verification' => [
            'subject' => 'Vítejte v systému :appName',
            'line1' => 'děkujeme za Vaši registraci do systému :appName.',
        ],
    ],

    'position' => [
        'new_application' => [
            'subject' => 'Nový zájem o pozici v systému :appName',
            'message' => 'Pro zobrazení zprávy si zobrazte zájem v aplikaci.',
            'line1' => 'v aplikaci se objevil nový zájem o Vaši pozici **:positionName**.',
            'action' => 'Detail v aplikaci',
        ],
    ],
];
