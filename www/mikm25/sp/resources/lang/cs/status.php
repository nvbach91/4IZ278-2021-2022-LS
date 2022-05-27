<?php

return [
    'auth' => [
        'unauthenticated' => 'Před vstupem na danou stránku se prosím přihlašte.',
        'register' => [
            'success' => 'Registrace proběhla úspěšně. Na emailovou adresu jsme Vám poslali odkaz pro potvrzení Vaší emailové adresy.',
            'success_github' => 'Nový účet byl vytvořen. Přihlášení proběhlo úspěšně.',
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
            'success' => 'Emailová adresa byla úspěšně potvrzena.',
            'invalid_url' => 'Odkaz pro ověření emailové adresy není platný.',
        ],
        'forgotten_password' => [
            'success' => 'Pokud zadaný email v systému existuje, přijde na něj odkaz pro nastavení nového hesla.',
            'invalid_url' => 'Odkaz pro nastavení nového hesla není platný.',
        ],
        'password_reset' => [
            'invalid_url' => 'Odkaz pro nastavení nového hesla není platný.',
            'success' => 'Heslo bylo úspěšně obnoveno.',
        ],
    ],
    'positions' => [
        'create' => [
            'success' => 'Pozice byla úspěšně vytvořena.',
        ],
        'update' => [
            'success' => 'Pozice byla úspěšně upravena.',
        ],
        'delete' => [
            'success' => 'Pozice :positionName byla úspěšně odstraněna.',
        ],
    ],
    'companies' => [
        'create' => [
            'success' => 'Společnost byla úspěšně vytvořena.',
        ],
        'update' => [
            'success' => 'Společnost byla úspěšně upravena.',
        ],
        'delete' => [
            'success' => 'Společnost :companyName byla úspěšně odstraněna.',
        ],
    ],
    'users' => [
        'delete' => [
            'passwordFailed' => 'Zadané heslo se neshoduje.',
            'nameFailed' => 'Zadané jméno se neshoduje.',
            'success' => 'Váš účet byl úspěšně smazán.',
        ],
        'resend_verification_link' => [
            'already_verified' => 'Vaše emailová adresa je již ověřena.',
            'success' => 'Odkaz byl úspěšně odeslán na Vaši emailovou adresu.',
        ],
    ],
];