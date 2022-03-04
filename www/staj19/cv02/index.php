<?php

include 'php/Company.php';
include 'php/Address.php';
include 'php/Person.php';


$mrDelContact = [
  'phone' => '+420913942941',
  'email' => 'mr.delivery@greenthumb.com',
  'web' => 'www.greenthumb.com/deliv'
];
$greenThumbLogo = [
  'src' => 'greenThumb.svg',
  'alt' => 'GreenThumb logo'
];
$greenThumb = new Company('GreenThumb Fast Track', $greenThumbLogo);
$westEvrgTerr = new Address('Westfield', '05 198', 'Evergreen terrace', '57', '6');
$mrDelivery = new Person('Mr.', 'Delivery', '2001-01-10', 'Delivery boy', true, $mrDelContact, $westEvrgTerr, $greenThumb);

$mrDelContact = [
  'phone' => '+420941164872',
  'email' => 'jessie.grey@greenthumb.com',
  'web' => 'www.greenthumb.com/jess'
];
$newYoLibStr = new Address('New York', '12 067', 'Liberty street', '95', '1');
$jessieGrey = new Person('Jessie', 'Gray', '1998-11-18', 'Logistic specialist', true, $mrDelContact, $newYoLibStr, $greenThumb);

$lloydHansContact = [
  'phone' => '+420949158127',
  'email' => 'lloyd.hans@skypass.com',
  'web' => 'skypasspeony.com/Lloyd_Hans'
];

$skypassPeony = [
  'src' => 'skypassPeony.svg',
  'alt' => 'Skypass Peony logo'
];
$skypassPeony = new Company('Skypass Peony', $skypassPeony);
$grnGrns = new Address('Greenland', '15 974', 'Greenstreet', '57', '8');
$lloydHans = new Person('Lloyd', 'Hans', '1989-09-01', 'Marketing specialist', true, $lloydHansContact, $grnGrns, $skypassPeony);


$persons = [
  $mrDelivery,
  $jessieGrey,
  $lloydHans
]

?>

<?php include 'components/head.php'; ?>

<main>
  <h1>Business card - cv02</h1>
  <?php foreach ($persons as $person) : ?>
    <?php if ($person->getJobAvail()) : ?>
      <div class="bc">
        <div class="bc-heading">
          <img src="img/<?php echo $person->getCompany()->getLogo('src'); ?>" alt="<?php echo $person->getCompany()->getLogo('alt'); ?>">
          <div>
            <h2><?php echo $person->getFullName() . ' (' . $person->getAge() . ')'; ?></h2>
            <span><?php echo $person->getJob(); ?></span>
          </div>
        </div>
        <i></i>
        <div>
          <div class="address">
            <i class="fa-solid fa-location-dot"></i>
            <div>
              <span><?php echo $person->getAddress()->getFullStreet(); ?></span>
              <span><?php echo $person->getAddress()->getFullCity(); ?></span>
            </div>
          </div>
          <div>
            <a href="tel:<?php echo $person->getContact('phone'); ?>">
              <i class="fa-solid fa-phone"></i>
              <?php echo $person->getContact('phone'); ?>
            </a>
          </div>
          <div>
            <a href="mailto:<?php echo $person->getContact('email'); ?>">
              <i class="fa-solid fa-envelope"></i>
              <?php echo $person->getContact('email'); ?>
            </a>
          </div>
          <div>
            <a href="https://<?php echo $person->getContact('web'); ?>">
              <i class="fa-solid fa-globe"></i>
              <?php echo $person->getContact('web'); ?>
            </a>
          </div>
        </div>
        <p><?php echo $person->getCompany()->getName(); ?></p>
      </div>
    <?php endif ?>
  <?php endforeach ?>
</main>

<?php include 'components/foot.php'; ?>