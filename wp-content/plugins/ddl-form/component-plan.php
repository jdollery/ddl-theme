<section class="contact" id="planForm">

  <div class="contact__row">

    <div class="contact__two">

      <center><h3>Register for our skin plan today</h3></center>

      <form class="form form--chimp" id="chimpForm" name="plan" novalidate="true" method="post" action="https://www.securedent.net/submit.ashx" enctype="multipart/form-data">
        
        <fieldset class="contact__fieldset">

          <div class="form__row">

            <div class="form__col form__col--6">
              <div class="form__input">
                <input
                  type="text"
                  id="first_name"
                  name="first_name"
                  placeholder="First Name*"
                  required
                  data-input="first"
                />
                <label for="first_name">First Name*</label>
              </div>
            </div>

            <div class="form__col form__col--6">
              <div class="form__input">
                <input
                  type="text"
                  id="last_name"
                  name="last_name"
                  placeholder="Last Name*"
                  required
                  data-input="last"
                />
                <label for="last_name">Last Name*</label>
              </div>
            </div>

            <div class="form__col form__col--6">
              <div class="form__input">
                <input
                  type="email"
                  id="email_address"
                  name="submit_by"
                  placeholder="Email address*"
                  required
                  data-input="email"
                />
                <label for="email_address">Email address*</label>
              </div>
            </div>

            <div class="form__col form__col--6">
              <div class="form__input">
                <input 
                  type="number"
                  id="phone_number"
                  name="phone_number"
                  placeholder="Telephone number"
                />
                <label for="phone_number">Telephone number</label>
              </div>
            </div>

          </div>

          <div class="form__row">

            <!-- <div class="form__col form__col--full">
              <div class="form__input form__input--checkbox">
                <input type="checkbox" id="subscribe" name="subscribe">
                <label for="subscribe"><small>Tick this box to subscribe to the <?php bloginfo( 'name' ); ?> newsletter and receive up-to-date offers &amp; the latest news.</small></label>
              </div>
            </div> -->

            <div class="form__col form__col--0">
              <button class="button-blue button--submit" type="submit">
                <span class="button__text">Register now</span>
                <span class="button__icon">Sending</span>
              </button>
            </div>
          </div>

          <div class="form__row form__row--disclaimer">
            <div class="form__col form__col--0">
              <p><small>By clicking &lsquo;Register Now&rsquo;, you consent to the Tracey Bell Clinic collecting your personal data for processing purposes. This includes contacting you about exclusive offers and sharing our latest news. To learn more about how the Tracey Bell Clinic collects, uses, shares, and protects your personal data, please read our <a href="<?php echo get_privacy_policy_url() ?>">privacy policy</a>.</small></p>
              <hr>
              <p><small>We use Mailchimp as our marketing platform. By submitting this form you acknowledge that your information will be transferred to Mailchimp for processing. <a href="https://mailchimp.com/legal/" target="_blank" rel="noopener noreferrer">Learn more about Mailchimp’s privacy practices</a>.</small></p>
              <p><small>You can change your mind at any time by clicking the unsubscribe link in the footer of any email you receive from us, or by contacting us at <a href="mailto:reinvent@traceybell.co.uk">reinvent@traceybell.co.uk</a>. We will treat your information with respect.</small></p>
            </div>
          </div>

        </fieldset>

        <input type="hidden" name="recaptcha_response" id="recaptcha_response">

        <input type="hidden" id="first" name="FNAME">
        <input type="hidden" id="last" name="LNAME">
        <input type="hidden" id="email" name="MERGE0">
        <input type="hidden" id="tag" name="TAG" value="Skin Plan">

        <input type="hidden" name="form_uid" value="0eaa4fec-6528-44a8-a5df-f6b2075eacff">
        
        <input name="required" type="hidden" value="first_name,last_name,submit_by">
        <input type="hidden" name="data_order" value="first_name,last_name,submit_by,phone_number">
        <input name="ok_url" type="hidden" id="ok_url" value="<?php echo site_url() ?>/thank-you/">
        <input name="not_ok_url" type="hidden" id="not_ok_url" value="<?php echo site_url() ?>/sorry/">

      </form>

    </div> 

  </div>

</section>