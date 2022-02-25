<main>
    <?php foreach($arr as $person): ?>
        <div class="card-wrapper 💪">
            <div class="card">
                <img src="<?php echo $person->avatar_url ?>" alt="avatar">
                <span class="firstname">Jméno: <?php echo $person->getFullName() ?></span>
                <span class="job">Práce: <?php echo $person->job ?></span>
                <span class="work">Firma: <?php echo $person->company_name ?></span>
                <span class="age">Věk: <?php echo $person->getAge() ?></span>
            </div>

            <div class="card">
                <h2>Kontakt</h2>
                <span class="email">Email: <a href="<?php echo "mailto:" . $person->email ?>"><?php echo $person->email ?></a></span>
                <span class="phone">Telefon: <a href="<?php echo "tel:" . str_replace(" ", "", $person->phone) ?>"><?php echo $person->phone ?></a></span>
                <span class="web">Web: <a target="_blank" href="<?php echo $person->web ?>"><?php echo $person->web ?></a></span>
                <span class="jobReady"> <?php echo $person->job_ready ? "Hledám práci" : "Prici momentálně nehledám" ?></span>
                <span class="address">Adresa: <?php echo $person->getAddress() ?></span>
            </div>
        </div>
    <?php endforeach ?>
</main>
