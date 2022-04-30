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

        'resend_email_verification' => [
            'subject' => 'Potvrzení emailové adresy do systému :appName',
            'line1' => 'pro ověření své emailové adresy použijte tlačítko níže.',
            'action' => 'Potvrdit emailovou adresu',
        ],

        'forgotten_password' => [
            'subject' => 'Obnovení hesla do systému :appName',
            'line1' => 'pro nastavení nového hesla použijte tlačítko níže. Pokud jste o nastavení hesla nežádali, můžete tento email ignorovat.',
            'action' => 'Nastavit nové heslo',
        ],
    ],
];
