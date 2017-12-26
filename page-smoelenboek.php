<?php

/**
 * Template Name: Smoelenboek
 */
if (!is_user_logged_in()):
  header('Location: '. get_home_url(null, 'login'));
else:
  get_header();

  $person_name = (empty($_GET['person_name'])) ? false : $_GET['person_name'];
  $person_query = (empty($_GET['person_query'])) ? false : $_GET['person_query'];
?>

<header class="smoelenboek__top">
  <h1 class="smoelenboek__title">Smoelenboek</h1>
</header>

<main class="smoelenboek__mid">
  <form class="smoelenboek__search" method="get">

    <label for="person_query" class="login__label">
      <?php echo esc_attr_e('I’m looking for...', 'svid-theme-domain');?>
    </label>
    <input name="person_query" id="person_query" type="text"
      class="login__input" required
      placeholder="<?=esc_attr_e('Jamie Doe', 'svid-theme-domain')?>"
      value="<?php echo htmlspecialchars($person_query); ?>">

  </form>

      if (!$person) esc_attr_e('This person does not exist.', 'svid-theme-domain');

  <?php
  if ($person_name) {
    $specific_person_query = urldecode($person_name);
    $person_list = Lassie::getModel('person_model', 'search_persons', array('keywords' => $specific_person_query));
    $person_id = $person_list[0];
    $person = Lassie::getModel('person_model', 'get_populated_person', array('person_id' => $person_id));
    $full_name = "$person->first_name $person->infix $person->last_name"; ?>

    <section class="smoelenboek__results">

      <?php
        if ($person_query) {
          $back_url = strtok($_SERVER["REQUEST_URI"],'?') . "?person_query=$person_query";
          echo "<a href='$back_url' class='smoelenboek__back'>⇤ ";
          esc_attr_e('Back to the results', 'svid-theme-domain');
          echo "</a>";
        }
      ?>

      <div class="smoelenboek__person person person--large">

        <h2 class="person__name person__name--large"><?php echo $full_name; ?></h2>
        <address class="person__contact">
          <?php
            if ($person->email_primary)
              echo "<a href='mailto:$person->email_primary'>
                $person->email_primary</a><br>";
            if ($person->phone_mobile)
              echo "<a href='tel:$person->phone_mobile'>
                $person->phone_mobile</a><br>";
            if ($person->address_street) {
              echo "<br>";
              echo "$person->address_street $person->address_number<br>";
              echo "$person->address_zip $person->address_city<br>";
              echo "$person->address_country";
            }
          ?>
        </address>

      </div>
    </section>

  <?php } elseif ($person_query) {
    $user = Lassie::getPerson();
    $person_list = Lassie::getModel(
      'person_model',
      'search_persons',
      array('keywords' => $person_query));
  ?>
  <section class="smoelenboek__results">

    <?php foreach ($person_list as $key => $person_id):
      $method = ($user->is_board) ? 'get_populated_person' : 'get_person';
      $person = Lassie::getModel(
        'person_model',
        $method,
        array('person_id' => $person_id));
      $full_name = "$person->first_name $person->infix $person->last_name";
    ?>
    <article class="smoelenboek__person person person--small">
      <h2 class="person__name person__name--small">
        <?php
          $person_url = "?person_query=$person_query&person_name=" . urlencode($full_name);
          echo "<a href='$person_url'>$full_name</a>";
          if ($user->is_board) {
            if ($person->birthdate == "0000-00-00 00:00:00") {
              $age = "?";
            } else {
              $age = date_diff(date_create($person->birthdate), date_create('now'))->y;
            }
            echo " [$age]";
          }
        ?>
      </h2>
    </article>
    <?php endforeach; ?>

  </section>
  <?php } ?>

</main>

<?php
  get_footer();
endif;
?>
