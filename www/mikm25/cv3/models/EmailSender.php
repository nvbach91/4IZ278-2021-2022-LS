<?php

require_once __DIR__ . '/SignupForm.php';

class EmailSender
{

    public function sendEmail(SignupForm $form): bool
    {
        $subject = "Card tournament registration";

        $headers = [
            'Reply-To' => 'Marek Mikula <marek.mikula01@gmail.com>',
            'From' => 'Marek Mikula <marek.mikula01@gmail.com>',
            'X-Mailer' => 'PHP/' . phpversion(),
            'Content-Type' => 'text/html;charset=UTF-8',
            'MIME-Version' => '1.0'
        ];

        return mail($form->getEmail(), $subject, $this->getContent($form), $headers);
    }

    private function getContent(SignupForm $form): string
    {
        $template = <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<p>Hello {name},</p>
<p>we just received your registration into the card tournament.</p>
<table>
<tbody>

<tr>
<th>Name</th>
<td>{name}</td>
</tr>

<tr>
<th>Email</th>
<td>{email}</td>
</tr>

<tr>
<th>Gender</th>
<td>{gender}</td>
</tr>

<tr>
<th>Phone</th>
<td>{phone}</td>
</tr>

<tr>
<th>Deck name</th>
<td>{deckName}</td>
</tr>

<tr>
<th>Number of cards in deck</th>
<td>{deckNumber}</td>
</tr>

</tbody>
</table>

<br>

<p>Thank you for your registration and we wish you good luck,</p>
<p>Team DeckTournament</p>
</body>
</html>
HTML;

        $arguments = [
            'name' => $form->getName(),
            'email' => $form->getEmail(),
            'gender' => SignupForm::getGenders()[$form->getGender()],
            'phone' => $form->getPhone(),
            'deckName' => $form->getDeckName(),
            'deckNumber' => $form->getDeckNumber(),
        ];

        foreach ($arguments as $argument => $value) {
            $template = str_replace('{' . $argument . '}', $value, $template);
        }

        return $template;
    }
}