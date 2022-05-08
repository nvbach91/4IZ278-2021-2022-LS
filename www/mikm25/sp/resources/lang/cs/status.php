<?php

return [
    'auth' => [
        'unauthenticated' => 'Před vstupem na danou stránku se prosím přihlašte.',
        'register' => [
            'success' => 'Registrace proběhla úspěšně.',
            'error' => 'Při registraci nastala chyba.',
        ],
        'login' => [
            'error_credentials' => 'Email nebo heslo není správné.',
            'error_unverified' => 'Nejdříve musíte potvrdit svou emailovou adresu.',
            'success' => 'Přihlášení proběhlo úspěšně.',
        ],
        'logout' => [
            'success' => 'Úspěšně jste byl odhlášen.',
        ],
        'email_verification' => [
            'success' => 'Emailová adresa byla úspěšně potvrzena. Nyní se můžete přihlásit.',
            'invalid_url' => 'Odkaz pro ověření emailové adresy není platný.',
            'resend_success' => 'Pokud zadaný email v systému existuje a nebyl ještě ověřen, přijde na něj odkaz pro verifikaci emailové adresy.',
        ],
        'forgotten_password' => [
            'success' => 'Pokud zadaný email v systému existuje, přijde na něj odkaz pro nastavení nového hesla.',
            'invalid_url' => 'Odkaz pro nastavení nového hesla není platný.',
        ],
        'password_reset' => [
            'invalid_url' => 'Odkaz pro nastavení nového hesla není platný.',
            'success' => 'Heslo bylo úspěšně obnoveno.',
        ]
    ],
    'positions' => [
        'create' => [
            'success' => 'Pozice byla úspěšně vytvořena.'
        ],
        'update' => [
            'success' => 'Pozice byla úspěšně upravena.'
        ],
        'delete' => [
            'success' => 'Pozice :positionName byla úspěšně odstraněna.'
        ]
    ],
    'companies' => [
        'create' => [
            'success' => 'Společnost byla úspěšně vytvořena.'
        ],
        'update' => [
            'success' => 'Společnost byla úspěšně upravena.'
        ],
        'delete' => [
            'success' => 'Společnost :companyName byla úspěšně odstraněna.'
        ],
    ]
];