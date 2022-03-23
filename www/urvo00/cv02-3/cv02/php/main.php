<main>
        <h1>This is my business card</h1>

        <?php //foreach ($array as $key => $value) :
            foreach ($array as $person) : ?>
            <div class="business-card">
                <td><?= $key; ?></td>
                <img class="bc-logo" src="./img/<?= $person.$logo; ?>"></img>
                <div class="bc-name"><?= $person.getFullName(); ?></div>
                <div class="bc-age"><?php echo date("Y") - $age; ?></div>
                <div class="bc-position"><?php echo $position; ?></div>
                <div class="bc-phone"><a href="tel: <?php echo $phone; ?>"><?php echo $phone; ?></a></div>
                <div class="bc-email"><a href="mailto: <?php echo $email; ?>"><?php echo $email; ?></a></div>
                <div class="bc-website"><a target="_blank" href="<?php echo $website; ?>"><?php echo $website; ?></a></div>
                <div class="bc-address"><?php echo $address; ?></div>
                <div class="bc-status"><?php echo $available; ?></div>
            </div>
        <?php endforeach; ?>
        <div class="business-card">
            <img class="bc-logo" src="./img/<?php echo $logo; ?>"></img>
            <div class="bc-name"><?php echo $name; ?></div>
            <div class="bc-age"><?php echo date("Y") - $age; ?></div>
            <div class="bc-position"><?php echo $position; ?></div>
            <div class="bc-phone"><a href="tel: <?php echo $phone; ?>"><?php echo $phone; ?></a></div>
            <div class="bc-email"><a href="mailto: <?php echo $email; ?>"><?php echo $email; ?></a></div>
            <div class="bc-website"><a target="_blank" href="<?php echo $website; ?>"><?php echo $website; ?></a></div>
            <div class="bc-address"><?php echo $address; ?></div>
            <div class="bc-status"><?php echo $available; ?></div>
        </div>
    </main>