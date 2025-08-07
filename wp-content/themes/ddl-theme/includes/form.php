<?php 

  $form_patient           =   true; // true = shows new patient radios / false = hides new patient radios
  $dengro_form            =   false; // true = enables Dengro form - add hook to submit.js e.g https://hooks.dengro.com/capture/XXXXXX-XXXX-XXXX-XXXX-XXXXXX
  $mailchimp_signup       =   true; // true = enables MailChimp

?>

<?php if($dengro_form == true) { ?>
  <form class="form" id="contactForm" method="post" novalidate="true" data-form="dengro">
<?php } else { ?>
  <form class="form" id="contactForm" method="post" novalidate="true" data-form="securedent" enctype="multipart/form-data" >
<?php } ?>

  <div class="form__row">

    <div class="form__column">

      <div class="form__input form__input--focus">

        <input 
          type="text"
          id="name"
          name="name"
          placeholder="Enter your full name"
          required
          aria-required="true"
          aria-label="Full name"
          <?php if($mailchimp_signup) { ?>data-input="first"<?php } ?>
        />
        <label for="name">Your name<sup aria-label="required">*</sup></label>

      </div>

      <div class="form__input form__input--focus ">

        <input 
          type="text"
          id="telephone"
          name="telephone"
          placeholder="Enter your telephone number"
          required
          aria-required="true"
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
        <label for="email_address">Email address<sup aria-label="required">*</sup></label>

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
        
        <label for="treatment">Please select a treatment<sup aria-label="required">*</sup></label>
        <select 
          id="treatment" 
          name="treatment" 
          required
          aria-required="true"
          data-placeholder="Please select an option" 
          >
          <option></option>
          <option label="Invisalign" value="Invisalign">Invisalign</option>
          <option label="Implant" value="Implant">Implant</option>
          <option label="Endodontic" value="Endodontic">Endodontic</option>
          <option label="Oral surgery" value="Oral surgery">Oral surgery</option>
        </select>

      </div>

      <?php if($form_patient) { ?>

        <div class="form__input form__input--radio form__input--span">
          
          <fieldset class="radio">

            <?php 
            
              $patient_legend = 'Are you a new patient?<sup aria-label="required">*</sup>';

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

              <?php

              $count++;

              } ?>

            </span>

          </fieldset>

        </div>

      <?php } ?>  
      
    </div>
  </div>
  <div class="form__row form__row--submit">

    <?php if($mailchimp_signup) { ?>

      <div class="form__input form__input--checkbox">
        <input 
          type="checkbox"
          id="subscribe"
          name="subscribe"
          value="Yes"
          aria-label="Marketing consent checkbox"
        >
        <label for="subscribe">Tick this box to subscribe to the <strong><?php echo bloginfo( 'name' ); ?></strong> newsletter and receive up-to-date offers &amp; the latest news.</label>
      </div>

    <?php } else { ?>

      <div class="form__input form__input--checkbox">
        <input 
          type="checkbox"
          id="marketing"
          name="marketing"
          value="Yes"
          aria-label="Marketing consent checkbox"
        >
        <label for="marketing">Tick this box to receive all the latest news and updates from <strong><?php echo bloginfo( 'name' ); ?></strong>.</label>
      </div>

    <?php } ?>

    <button class="btn btn--submit" type="submit">
      <span class="btn__text">Send message</span>
      <span class="btn__sending">Sending <span class="icon icon--loader"><svg role="img"><use xlink:href="#loader" href="#loader"></use></svg></span></span></span>
    </button>

  </div>
  <div class="form__row">

    <div class="form__input form__input--note form__input--span">
      <small>On submitting this form you agree to <strong><?php echo bloginfo( 'name' ); ?></strong> collecting your personal data. To learn more about how we collect, use, share and protect your personal data, please read our <a href="<?php echo get_privacy_policy_url() ?>">privacy policy</a>.</small>
    </div>

  </div>

  <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

  <?php if($mailchimp_signup) { ?>

    <input type="hidden" id="first" name="FNAME">
    <input type="hidden" id="last" name="LNAME">
    <input type="hidden" id="email" name="MERGE0">

  <?php } ?>

  <?php if($dengro_form == true) { ?>

    <input type="hidden" name="attribution" value="practice">
    <input type="hidden" name="utm_source" value="google">
    <input type="hidden" name="utm_medium" value="cpc">
    <input type="hidden" name="landing_url" value="<?php echo site_url() ?>">
    <input type="hidden" name="capture_url" value="<?php echo site_url() ?>">

  <?php } else { ?>

    <input type="hidden" name="form_uid" value="d92ea4ec-097e-4711-8886-b55dbd8330a7"> 
    <input name="required" type="hidden" value="name,submit_by,treatment<?php if($form_patient) { ?>,new_patient<?php } ?>">
    <input name="data_order" type="hidden" value="name,submit_by,treatment,<?php if($form_patient) { ?>new_patient,<?php } ?><?php if($mailchimp_signup) { ?>subscribe<?php } else { ?>marketing<?php } ?>">
    <input name="ok_url" type="hidden" id="ok_url" value="<?php echo get_the_permalink( 1 ) // thank you page ?>">
    <input name="not_ok_url" type="hidden" id="not_ok_url" value="<?php echo get_the_permalink( 1 ) // sorry page ?>">

  <?php } ?>

</form>