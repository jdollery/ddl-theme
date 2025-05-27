<?php 

  $form_button            =   "Send appointment request"; // Same on both contact section and dialog forms
  $form_button_sending    =   "Sending request"; // Same on both contact section and dialog forms

  $form_patient           =   true; // true = shows new patient radios / false = hides new patient radios

  $securedent_form        =   true; // true = enables Securedent form - Secudent key in under locations line 56
  $dengro_form            =   false; // true = enables Dengro form, e.g https://hooks.dengro.com/capture/XXXXXX-XXXX-XXXX-XXXX-XXXXXX
  $mailer_form            =   false; // true = enables PHPMailer form

  $mailchimp_signup       =   false; // true = enables MailChimp

?>

<?php if ($securedent_form == true) { ?>
  <form class="form" id="contactForm" method="post" action="https://www.securedent.net/submit.ashx" novalidate="true" data-form="securedent">
<?php } elseif($dengro_form == true) { ?>
  <form class="form" id="contactForm" method="post" action="" novalidate="true" data-form="dengro">
<?php } elseif($mailer_form == true) { ?>
  <form class="form" id="contactForm" novalidate="true" data-form="mailer">
<?php } ?>

  <div class="form__row">

    <div class="form__input form__input--focus">
      <input 
        type="text"
        id="name"
        name="name"
        placeholder="Enter your full name"
        required
        aria-required="true"
        aria-label="First name"
        data-input="first"
      />
      <label for="name">Your name<sup>*</sup></label>
    </div>

    <div class="form__input form__input--focus ">
      <input 
        type="text"
        id="telephone"
        name="telephone"
        data-pristine-pattern="/^[0-9]{11}(?:-[0-9]{10})?$/"
        data-pristine-pattern-message="Invalid telephone number"
        placeholder="Enter your telephone number"
        aria-label="Telephone number"
      >
      <label for="telephone">Tel number<sup>*</sup></label>
    </div>

    <div class="form__input form__input--focus form__input--span">
      <input 
        type="email"
        id="email_address"
        name="submit_by"
        placeholder="Enter your email address"
        required
        aria-required="true"
        aria-label="Email address"
        <?php if($mailchimp_signup) { ?>data-input="email"<?php } ?>
      >
      <label for="email">Email address<sup>*</sup></label>
    </div>

    <div class="form__input form__input--focus form__input--span">
      <textarea 
        id="message"
        name="message"
        rows="3"
        placeholder="Your message"
        aria-label="Please give us a brief description about your enquiry"
      ></textarea>
      <label for="message">Your message</label>
    </div>
    
    <div class="form__input form__input--span">
      
      <label for="teatment">Please select a treatment</label>
      <div class="form__input--select">
        <select 
          id="teatment" 
          name="teatment" 
          required
          aria-required="true"
          >
          <option></option>
          <option label="Invisalign" value="Invisalign">Invisalign</option>
          <option label="Implant" value="Implant">Implant</option>
          <option label="Endodontic" value="Endodontic">Endodontic</option>
          <option label="Oral surgery" value="Oral surgery">Oral surgery</option>
        </select>
      </div>

    </div>

    <?php if($form_patient) { ?>

      <div class="form__input form__input--radio form__input--span">
        
        <fieldset class="radio">

          <?php 
          
            $patient_legend = 'Are you a new patient?<sup><span class="icon icon--asterisk"><svg role="img"><use xlink:href="#asterisk" href="#asterisk"></use></svg></span></sup>';

          ?>

          <legend hidden><?php echo $patient_legend ?></legend>

          <span class="radio__label"><?php echo $patient_legend ?></span>

          <span class="radio__options">

            <?php 

            $options = array(

              array(
                "value"     =>   "Yes",
                "label"     =>   "Yes, I’m a new patient",
              ),

              array(
                "value"     =>   "No",
                "label"     =>   "No, I’m an existing patient",
              ),
              
            );
            
            $count = 1;

            foreach($options as $option) { ?>

            <span class="btn btn--radio">
              <input 
                type="radio"
                id="patient_<?php echo $count ?>"
                name="new_patient"
                value="<?php echo $option['value'] ?>"
                aria-label="<?php echo $option['label'] ?>"
                required
                aria-required="true"
              >
              <label for="patient_<?php echo $count ?>" tabindex="0">
                <span class="icon icon--tick"><svg role="img"><use xlink:href="#tick" href="#tick"></use></svg></span>
                <span><?php echo $option['value'] ?></span>
              </label>
            </span>

            <?php

            $count++;

            } ?>

          </span>

        </fieldset>

      </div>

    <?php } ?>   

    <div class="form__input--submit form__input--span">

      <?php if($mailchimp_signup) { ?>

        <div class="form__checkbox">
          <input 
            type="checkbox"
            id="subscribe"
            name="subscribe"
            value="Yes"
            aria-label="Marketing consent checkbox"
          >
          <label for="subscribe">Tick this box to subscribe to the <strong><?php echo bloginfo( 'name' ); ?></strong> newsletter and receive up-to-date offers &amp; the latest news.<sup>*</sup></label>
        </div>

      <?php } else { ?>

        <div class="form__checkbox">
          <input 
            type="checkbox"
            id="marketing"
            name="marketing"
            value="Yes"
            aria-label="Marketing consent checkbox"
          >
          <!-- <label for="marketing">Tick this box if you would like to receive information about the latest offers and updates from <strong><?php echo bloginfo( 'name' ); ?></strong>.</label> -->
          <label for="marketing">Tick this box to receive the latest updates &amp; news from <strong><?php echo bloginfo( 'name' ); ?></strong>.</label>
        </div>

      <?php } ?>

      <div>

        <button class="btn btn--submit" type="submit">
          <span class="btn__text">Send message</span>
          <span class="btn__sending">Sending <span class="icon icon--loader"><svg role="img"><use xlink:href="#loader" href="#loader"></use></svg></span></span></span>
        </button>

      </div>

    </div>

    <div class="form__note">
      <small><sup><span class="icon icon--asterisk"><svg role="img"><use xlink:href="#asterisk" href="#asterisk"></use></svg></span></sup>Required fields</small>
      <small>On submitting this form you agree to <strong><?php echo bloginfo( 'name' ); ?></strong> collecting your personal data. To learn more about how we collect, use, share and protect your personal data, please read our <a href="<?php echo get_privacy_policy_url() ?>">privacy policy</a>.</small>
    </div>

  </div>

  <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

  <?php if($mailchimp_signup) { ?>

    <input type="hidden" id="first" name="FNAME">
    <input type="hidden" id="last" name="LNAME">
    <input type="hidden" id="email" name="MERGE0">

  <?php } ?>

  <?php if($securedent_form == true) { ?>

    <input type="hidden" name="form_uid" value="d92ea4ec-097e-4711-8886-b55dbd8330a7">
    <input name="required" type="hidden" value="name,submit_by,treatment,new_patient">
    <input name="data_order" type="hidden" value="name,submit_by,treatment,<?php if($form_patient) { ?>new_patient,<?php } ?><?php if($mailchimp_signup) { ?>subscribe<?php } else { ?>marketing<?php } ?>">
    <input name="ok_url" type="hidden" id="ok_url" value="<?php echo get_the_permalink( 1 ) // thank you page ?>">
    <input name="not_ok_url" type="hidden" id="not_ok_url" value="<?php echo get_the_permalink( 1 ) // sorry page ?>">

  <?php } elseif ($dengro_form == true) { ?>

    <input type="hidden" name="attribution" value="practice">
    <input type="hidden" name="utm_source" value="google">
    <input type="hidden" name="utm_medium" value="cpc">
    <input type="hidden" name="landing_url" value="<?php echo site_url() ?>">
    <input type="hidden" name="capture_url" value="<?php echo site_url() ?>">

  <?php } elseif($mailer_form == true) { ?>

    <input name="practice_name" type="hidden" id="practice_name" value="<?php bloginfo( 'name' ); ?>">
    <input name="form_name" type="hidden" id="form_name" value="Contact">
    <input type="hidden" name="data_order" value="name,submit_by,treatment,<?php if($form_patient) { ?>new_patient,<?php } ?><?php if($mailchimp_signup) { ?>subscribe<?php } else { ?>marketing<?php } ?>">

  <?php } ?>

</form>