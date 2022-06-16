<?

// set name for not set if empty
if(empty($first_name) && empty($lastname)) :
    $first_name = 'Your name is not set';
?>
<? endif; ?>


<?
// check for phone number if empty set not set
if(empty($phone)) :
    $phone = 'Your phone is not set';
?>
<? endif; ?>

<?
// check for adress. All fields must be filled or else empty
if(empty($city) && empty($street) && empty($postalCode)) :
    $city = 'Your adress is not set'
?>
<? endif; ?>