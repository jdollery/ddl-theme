<?php 

/* Template Name: Xmas Offers Page */

get_header(); 

$offers_one = get_field('offers_one'); 
$offers_two = get_field('offers_two');

?>

<?php get_template_part('template-parts/component', 'banner'); ?>

<section class="offers">

  <div class="offers__row">

    <div class="offers__one">
      <div class="wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.8s">
        <?php echo $offers_one ?>
      </div>
    </div>

    <div class="offers__two">
      <div class="wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.8s">
        <?php echo $offers_two ?>
      </div>
    </div>

  </div>

</section>

<section class="contact" id="offerForm">

  <div class="contact__row">

    <div class="contact__two">

      <center><h3>Claim your offer!</h3></center>

      <form class="form form--chimp" id="chimpForm" name="offer" novalidate="true" method="post" action="https://www.securedent.net/submit.ashx" enctype="multipart/form-data">
        
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
            <div class="form__col form__col--0">
              <div class="form__input">
                <select 
                  name="offer" 
                  id="offer" 
                  data-placeholder="Select your offer*"
                  required
                  >
                  <option></option>
                  <option label="Sign me up for 50% off whitening!" value="Whitening Offer">Sign me up for 50% off whitening!</option>
                  <option label="I want the £100 voucher! (registered patients only)" value="Voucher Offer">I want the £100 voucher! (registered patients only)</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form__row">
            <div class="form__col form__col--0">
              <button class="button-blue button--submit" type="submit">
                <span class="button__text">Claim today</span>
                <span class="button__icon">Sending</span>
              </button>
            </div>
          </div>

          <div class="form__row form__row--disclaimer">
            <div class="form__col form__col--0">
              <p><small>By clicking &lsquo;Claim today&rsquo;, you consent to the Tracey Bell Clinic collecting your personal data for processing purposes. This includes contacting you about exclusive offers and sharing our latest news. To learn more about how the Tracey Bell Clinic collects, uses, shares, and protects your personal data, please read our <a href="<?php echo get_privacy_policy_url() ?>">privacy policy</a>.</small></p>
              <hr>
              <p><small>We use Mailchimp as our marketing platform. By submitting this form you acknowledge that your information will be transferred to Mailchimp for processing. <a href="https://mailchimp.com/legal/" target="_blank" rel="noopener noreferrer">Learn more about Mailchimp’s privacy practices</a>.</small></p>
              <p><small>You can change your mind at any time by clicking the unsubscribe link in the footer of any email you receive from us, or by contacting us at <a href="mailto:reinvent@traceybell.co.uk">reinvent@traceybell.co.uk</a>. We will treat your information with respect.</small></p>
            </div>
          </div>
          
          <div class="form__row form__row--terms">
            <div class="form__col form__col--0">

              <hr>

              <h6>Offer terms and conditions</h6>
              <ol>
                <li>Eligibility: These offers are available only to individuals aged 18 years or over.</li>
                <li>Validity: The £100 voucher must be used by 31st March 2025. It is valid for a period of 3 months from the date of issue, provided the expiration date is not exceeded.</li>
                <li>Eligible Services: The £100 voucher can be used towards dental or aesthetic/laser treatments provided at Tracey Bell Clinic, unless specifically excluded.</li>
                <li>Exclusions:
                  <ul>
                    <li>The voucher cannot be used for any skincare products, dental products, or weight loss prescribed injections.</li>
                    <li>It also cannot be redeemed for consultations, Denplan membership fees, or treatments/products already on special offer or discounted.</li>
                    <li>The voucher is not valid in conjunction with any other promotions.</li>
                  </ul>
                </li>
                <li>Location: These offers can only be redeemed at the Douglas clinic on the Isle of Man.</li>
                <li>Patient History: To redeem this voucher, the patient must have attended a payable treatment of over £100 at Tracey Bell Clinic within the last two years.</li>
                <li>Non-Transferable: This voucher is issued in the recipient's name and is non-transferable. Proof of identity may be required.</li>
                <li>Partial Use: If the total value of the treatment is less than £100, the remaining balance will not be refunded or carried forward.</li>
                <li>Appointment Booking: To redeem the voucher, an appointment must be booked in advance. Please inform the clinic at the time of booking that you will be using the voucher.</li>
                <li>Cancellation Policy: If an appointment booked using the voucher is cancelled without 24 hours' notice or not attended, the voucher will be void.</li>
                <li>Lost or Stolen Vouchers: Tracey Bell Clinic is not responsible for lost or stolen vouchers. Duplicates will not be issued.</li>
                <li>No Cash Alternative: The voucher cannot be exchanged for cash or other payment methods.</li>
                <li>Manager's Discretion: In the event of any disputes regarding the use of the voucher, the clinic manager’s decision is final.</li>
                <li>Right to Amend: Tracey Bell Clinic reserves the right to amend the terms and conditions of this voucher without prior notice.</li>
              </ol>
            </div>
          </div>

        </fieldset>

        <input type="hidden" name="recaptcha_response" id="recaptcha_response">

        <input type="hidden" id="first" name="FNAME">
        <input type="hidden" id="last" name="LNAME">
        <input type="hidden" id="email" name="MERGE0">
        <input type="hidden" id="tag" name="TAG">

        <input type="hidden" name="form_uid" value="69c851b8-324f-4275-8239-e76347f3643f">
        
        <input name="required" type="hidden" value="first_name,last_name,submit_by,offer">
        <input type="hidden" name="data_order" value="first_name,last_name,submit_by,phone_number,offer">
        <input name="ok_url" type="hidden" id="ok_url" value="<?php echo site_url() ?>/thank-you/">
        <input name="not_ok_url" type="hidden" id="not_ok_url" value="<?php echo site_url() ?>/sorry/">

      </form>

    </div> 

  </div>

</section>

<?php get_template_part('template-parts/component', 'social'); ?>
<?php get_template_part('template-parts/component', 'cta'); ?>

<?php get_footer(); ?>