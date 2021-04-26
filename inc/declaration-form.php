<form method="post" id="declaration_form"
  action="<?=esc_url( admin_url('admin-post.php') ) ?>">

  <div class="decl-form__rule">
    <label for="purchase" class="login__label login__label--white-bg">What did you buy? (+ committee receipt number)</label>
    <input id="purchase" name="purchase" type="text" required
      class="login__input login__input--white-bg"
      placeholder="Box of screws/ginger beer/carpet">
  </div>

  <div class="decl-form__rule">
    <label for="amount" class="login__label login__label--white-bg">How much did it cost?</label>
    <input id="amount" name="amount" type="text" required
      class="login__input login__input--white-bg"
      placeholder="44,44">
  </div>

  <div class="decl-form__rule">
    <label for="committee" class="login__label login__label--white-bg">For which committee?</label>
    <select id="committee" name="committee" required
      class="login__input login__input--white-bg">
      <option value="ID Algemeen;svid@tudelft.nl">ID Algemeen</option>
      <?php
        $args = array( 'post_type' => 'committee', 'posts_per_page' => -1 );
    		$committee_loop = new WP_Query( $args );
        if($committee_loop->have_posts()) : while($committee_loop->have_posts()) :
    			$committee_loop->the_post();
          $committee_name = get_the_title();
          $committee_email = get_field('email');
          echo "<option value='$committee_name;$committee_email'>
            $committee_name</option>";
    		endwhile; endif;
    		wp_reset_postdata();
      ?>
    </select>
  </div>

  <div class="decl-form__rule">
    <label for="post" class="login__label login__label--white-bg">Under what post does it fit?</label>
    <input id="post" name="post" type="text" required
      class="login__input login__input--white-bg"
      placeholder="Overige uitgaven"
      list="posts">
    <datalist id="posts">
      <?php
        $posten = explode(",", get_field('posten'));
        foreach($posten as $post_name) {
          echo "<option value='$post_name'>$post_name</option>";
        }
      ?>
    </datalist>
  </div>

  <div class="decl-form__rule">
    <label for="date" class="login__label login__label--white-bg">When did you buy it?</label>
    <input id="date" name="date" type="date" required
      class="login__input login__input--white-bg"
      id="js-date">
  </div>

  <div class="decl-form__rule">
    <label for="file" class="login__label login__label--white-bg">Could you upload a scan of the file (with BTW information)?</label>
    <input id="file" name="file" type="file" required
      class="login__input login__input--white-bg"
      id="js-receipt">
      <p class="decl-form__comment"><strong>Psst...</strong> Please make sure your receipt is readable and contains the information about BTW/VAT. (No need to upload the PIN receipts!)</p>
  </div>



  <h2>Oh and about you...</h2>

  <?php
    $personInstance = Lassie::getPersonApi();
    $person = Lassie\Person::getInformation($personInstance);
    $first_name = $person->first_name;
    $last_name = $person->last_name;
    $email_primary = $person->email_primary;
    $bank_iban = $person->bank_iban;
  ?>

  <div class="decl-form__rule">
    <label for="name" class="login__label login__label--white-bg">What’s your name?</label>
    <input id="name" name="name" type="text" required
      class="login__input login__input--white-bg"
      placeholder="Sam van Iepen Dalen" value="<?php echo "$first_name $last_name"; ?>">
  </div>

  <div class="decl-form__rule">
    <label for="email" class="login__label login__label--white-bg">What’s your email address?</label>
    <input id="email" name="email" type="text" required
      class="login__input login__input--white-bg"
      placeholder="knap_mens@svid.nl" value="<?php echo $email_primary; ?>">
  </div>

  <div class="decl-form__rule">
    <label for="iban" class="login__label login__label--white-bg">What IBAN do you want us to transfer the money to?</label>
    <input id="iban" name="iban" type="text" required
      class="login__input login__input--white-bg"
      placeholder="NL44 ABCD 0123456789" value="<?php echo $bank_iban; ?>">
  </div>

  <div class="decl-form__rule">
    <label for="owner" class="login__label login__label--white-bg">What name is linked to that IBAN?</label>
    <input id="owner" name="owner" type="text" required
      class="login__input login__input--white-bg"
      placeholder="S v Iepen Dalen">
  </div>

  <input type="hidden" name="action" value="declaration">
  <input type="hidden" name="feedback" value="-">
  <input type="hidden" name="submit">

  <div class="decl-form__rule">
    <label for="" class="login__label login__label--white-bg">Done?</label>
    <button class="button" type="submit">
      Declare!
    </button>
  </div>

  <?php wp_nonce_field( $action = 'declaration' ); ?>

</form>
