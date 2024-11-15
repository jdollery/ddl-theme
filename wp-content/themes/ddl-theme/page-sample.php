<?php 

/* Template Name: Sample Page */

get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('inc/sections'); ?>

  <section class="content content--white content--top content--bottom">

    <div class="content__body">

      <?php the_content(); ?>

      <figure class="quote">
        <blockquote cite="https://www.huxley.net/bnw/four.html">
          Words can be like X-rays, if you use them properly—they’ll go through anything. You read and you’re pierced.
        </blockquote>
        <figcaption>—Aldous Huxley, <cite>Brave New World</cite></figcaption>
      </figure>

      <a href="/" class="btn btn--black btn--space">Test</a>

      <a class="btn btn--accent btn--space" href="<?php echo site_url() ?>/team/#joe-bloggs">View John’s Profile</a>

      <h1>Heading h2</h1>
      <h2>Heading h2</h2>
      <h3>Heading h3</h3>
      <h4>Heading h4</h4>
      <h5>Heading h5</h5>
      <h6>Heading h6</h6>

      <form class="form" id="validateForm" novalidate="true" method="post" action="https://www.securedent.net/submit.ashx" enctype="multipart/form-data" name="referral">

        <fieldset>

          <legend>Patient Details</legend>
          <div class="form__row">

            <div class="form__cell form__cell--half">

              <div class="form__input">
                <input
                  type="text"
                  id="patient_name"
                  name="patient_name"
                  placeholder="Full name*"
                  required
                  aria-required="true"
                  aria-label="Full name"
                />
                <label for="patient_name">Full name<span aria-label="required">*</span></label>
              </div>

            </div>
            <div class="form__cell form__cell--half">

              <div class="form__input">
                <input
                  type="date"
                  id="patient_dob"
                  name="patient_dob"
                  placeholder="Date of birth"
                  aria-label="Date of birth"
                />
                <label for="patient_dob">Date of birth</label>
              </div>

            </div>
            <div class="form__cell form__cell--half">

              <div class="form__input">
                <input
                  type="email"
                  id="patient_email"
                  name="patient_email"
                  placeholder="Email address*"
                  required
                  aria-required="true"
                  aria-label="Email address"
                />
                <label for="patient_email">Email address<span aria-label="required">*</span></label>
              </div>

            </div>
            <div class="form__cell form__cell--half">

              <div class="form__input">
                <input
                  type="number"
                  id="patient_phone"
                  name="patient_phone"
                  placeholder="Telephone number"
                  aria-label="Telephone number"
                />
                <label for="patient_phone">Telephone number</label>
              </div>

            </div>

            <div class="form__cell form__cell--full">

              <div class="form__input">
              <select 
                  id="new_patient" 
                  name="new_patient" 
                  data-placeholder="Are you a new patient?*" 
                  required 
                  aria-required="true"
                  aria-label="Are you a new patient?"
                  >
                  <option></option>
                  <option label="Yes, I&rsquo;m a new patient" value="Yes">Yes, I&rsquo;m a new patient</option>
                  <option label="No, I&rsquo;m an existing patient" value="No">No, I&rsquo;m an existing patient</option>
                </select> 
              </div>

            </div>

            <div class="form__cell form__cell--full">

              <div class="form__input">
                <textarea 
                  id="patient_address"
                  name="patient_address"
                  rows="3"
                  placeholder="Address" 
                  aria-label="Address"
                ></textarea>
                <label for="patient_address">Address</label> 
              </div>

            </div>

          </div>

        </fieldset>

        <fieldset>

          <legend>Referral Details</legend>

          <div class="form__row">

            <div class="form__cell form__cell--full">

              <div class="form__input">
                <select 
                  id="referral_type" 
                  name="referral_type" 
                  data-placeholder="Choose a referral type" 
                  required
                  aria-required="true"
                  aria-label="Choose a referral type"
                  >
                  <option></option>
                  <option label="Implant referral" value="Implant referral">Implant referral</option>
                  <option label="Endodontic referral" value="Endodontic referral">Endodontic referral</option>
                  <option label="Cosmetic referral" value="Cosmetic referral">Cosmetic referral</option>
                  <option label="Restorative referral" value="Restorative referral">Restorative referral</option>
                </select>        
              </div>

            </div>
            <div class="form__cell form__cell--full">

              <div class="form__input">
                <textarea 
                  id="referral_reason"
                  name="referral_reason"
                  rows="3"
                  placeholder="Reason for referral" 
                  aria-required="true"
                  aria-label="Reason for referral"
                ></textarea>
                <label for="referral_reason">Reason for referral</label> 
              </div>

            </div>

            <div class="form__cell form__cell--full">

              <!-- <div class="form__input form__input--textarea"> -->
              <div class="form__input">
                <textarea 
                  id="referral_history"
                  name="referral_history"
                  rows="3"
                  placeholder="Medical history and relevant information" 
                  aria-label="Medical history and relevant information"
                ></textarea>
                <label for="referral_history">Medical history and relevant information</label> 
              </div>

            </div>

            <div class="form__cell form__cell--full">

              <div class="form__row cell-align-center">

                <div class="form__cell form__cell--flex">

                  <div class="form__input">
                    <p class="m-0"><span>Is the tooth symptomatic?</span></p>
                  </div>

                </div>

                <div class="form__cell pr-4">

                  <div class="form__input form__input--checkbox">
                    <input 
                      type="radio"
                      id="endodontic_symptomatic_yes"
                      name="symptomatic"
                      value="Yes"
                      aria-label="Is the tooth symptomatic?"
                    >
                    <label for="endodontic_symptomatic_yes">Yes</label>
                  </div>

                </div>

                <div class="form__cell">

                  <div class="form__input form__input--checkbox">
                    <input 
                      type="radio"
                      id="endodontic_symptomatic_no"
                      name="symptomatic"
                      value="No"
                      aria-label="Is the tooth symptomatic?"
                    >
                    <label for="endodontic_symptomatic_no">No</label>
                  </div>

                </div>

              </div>
            </div>

            <div class="form__cell form__cell--full">

              <div class="form__input form__input--upload">
                <input 
                  type="file" 
                  name="referral_uploads" 
                  id="referral_uploads" 
                  class="upload"
                  aria-label="Upload any supporting radiographs/images/documents (Max 5MB)"
                >
                <label for="referral_uploads"><span class="upload__file">Upload any supporting radiographs/images/documents (Max 5MB)</span><span class="upload__button">Upload</span></label>
              </div>

            </div>

          </div>

        </fieldset>

        <fieldset>

          <legend>Referrer Details</legend>
          <div class="form__row">

            <div class="form__cell form__cell--half">

              <div class="form__input">
                <input
                  type="text"
                  id="referrer_name"
                  name="referrer_name"
                  placeholder="Full name*"
                  required
                  aria-required="true"
                  aria-label="Full name"
                />
                <label for="referrer_name">Full name<span aria-label="required">*</span></label>
              </div>

            </div>
            <div class="form__cell form__cell--half">

              <div class="form__input">
                <input
                  type="text"
                  id="referrer_position"
                  name="referrer_position"
                  placeholder="Position/Job title"
                  aria-label="Position/Job title"
                />
                <label for="referrer_position">Position/Job title</label>
              </div>

            </div>
            <div class="form__cell form__cell--half">

              <div class="form__input">
                <input
                  type="email"
                  id="referrer_email"
                  name="submit_by"
                  placeholder="Email address*"
                  required
                  aria-required="true"
                  aria-label="Email address"
                />
                <label for="referrer_email">Email address<span aria-label="required">*</span></label>
              </div>

            </div>
            <div class="form__cell form__cell--half">

              <div class="form__input">
                <input
                  type="number"
                  id="referrer_phone"
                  name="referrer_phone"
                  placeholder="Telephone number"
                  aria-label="Telephone number"
                />
                <label for="referrer_phone">Telephone number</label>
              </div>

            </div>
            <div class="form__cell form__cell--full">

              <div class="form__input form__input--textarea">
                <textarea 
                  id="referrer_address"
                  name="referrer_address"
                  rows="3"
                  placeholder="Address" 
                  required
                  aria-required="true"
                  aria-label="Address"
                ></textarea>
                <label for="referrer_address">Address</label> 
              </div>

            </div>

          </div>

          <div class="form__row form__row--footer">

            <!-- <div class="form__cell form__cell--full">
              <div class="form__input form__input--checkbox">
                <input 
                  type="checkbox"
                  id="marketing_consent"
                  name="marketing_consent"
                  value="Yes, I consent"
                  required
                  aria-required="true"
                  aria-label="Yes, I consent"
                >
                <label for="marketing_consent">I confirm I have the patient&rsquo;s consent to share this information, and also consent to <?php bloginfo( 'name' ); ?> replying and storing these personal details (please see our <a href="<?php echo get_privacy_policy_url() ?>">privacy policy</a> for more information).</label>
              </div>
            </div> -->

            <div class="form__cell form__cell--flex">

              <div class="form__input form__input--checkbox">
                <input 
                  type="checkbox" 
                  id="patient_consent" 
                  name="patient_consent" 
                  value="Yes" 
                  aria-label="Yes, I confirm I have the patient&rsquo;s consent to share this information."
                >
                <label for="patient_consent">Yes, I confirm I have the patient&rsquo;s consent to share this information.</label>
              </div>

            </div>

            <div class="form__cell">

              <!-- <button class="btn btn--black" type="submit">Submit referral</button>

              <button class="btn btn--black btn--submit" type="submit">
                <span class="btn__text">Send message</span>
                <span class="btn__icon">Sending <span class="icon icon--loader"><svg role="img"><use xlink:href="#loader" href="#loader"></use></svg></span></span></span>
              </button> -->

              <button class="btn btn--black btn--submit" type="submit">
                <span class="btn__text">Submit referral</span>
                <span class="btn__icon">Submitting <span class="icon icon--loader"><svg role="img"><use xlink:href="#loader" href="#loader"></use></svg></span></span></span>
              </button>

            </div>

            <small>By clicking &lsquo;submit referral&rsquo;, you agree to <?php bloginfo( 'name' ); ?> collecting your personal data. To learn more about how <?php bloginfo( 'name' ); ?> collects, uses, shares and protects your personal data, please read our <a href="<?php echo get_privacy_policy_url() ?>">privacy policy</a>.</small>

          </div>

        </fieldset>

        <!-- <input type="hidden" name="recaptcha_response" id="recaptcha_response"> -->
        <!-- <input type="hidden" name="form_uid" value="5fc07193-b633-4f3a-adff-ff7a32f3e11f">
        <input name="required" type="hidden" value="name,submit_by,new_patient">
        <input type="hidden" name="data_order" value="name,submit_by,phone,new_patient,enquiry,gdpr_consent">
        <input name="ok_url" type="hidden" id="ok_url" value="<?php echo get_the_permalink( 1 ) // thank you page ?>">
        <input name="not_ok_url" type="hidden" id="not_ok_url" value="<?php echo get_the_permalink( 1 ) // sorry page ?>"> -->

      </form>

      <table class="table-responsive ">
        <thead>
          <tr>
            <th>Service</th>
            <th>Private Price</th>
            <th>Membership Plan Price</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td data-title="">New Patient Consultation</td>
            <td data-title="Private Price">£150.00</td>
            <td data-title="Membership Plan Price">N/A</td>
          </tr>
          <tr>
            <td data-title="">New Patient Hygiene</td>
            <td data-title="Private Price">£120.00</td>
            <td data-title="Membership Plan Price">N/A</td>
          </tr>
          <tr>
            <td data-title="">Dental Health Assessment</td>
            <td data-title="Private Price">£67.50</td>
            <td data-title="Membership Plan Price">Inclusive</td>
          </tr>
          <tr>
            <td data-title="">Child&rsquo;s Dental Health Assessment</td>
            <td data-title="Private Price">£34.00</td>
            <td data-title="Membership Plan Price">Inclusive</td>
          </tr>
          <tr>
            <td data-title="">Emergency Assessment</td>
            <td data-title="Private Price">£62.00</td>
            <td data-title="Membership Plan Price">Inclusive</td>
          </tr>
          <tr>
            <td data-title="">Implant Review</td>
            <td data-title="Private Price">£67.50</td>
            <td data-title="Membership Plan Price">Inclusive</td>
          </tr>
          <tr>
            <td data-title="">Endodontic Assessment</td>
            <td data-title="Private Price">£84.00</td>
            <td data-title="Membership Plan Price">Inclusive</td>
          </tr>
          <tr>
            <td data-title="">Small X-ray</td>
            <td data-title="Private Price">£15.00</td>
            <td data-title="Membership Plan Price">Inclusive</td>
          </tr>
          <tr>
            <td data-title="">Large X-ray</td>
            <td data-title="Private Price">£45.00</td>
            <td data-title="Membership Plan Price">Inclusive</td>
          </tr>
        </tbody>
      </table>

    </div>
  </section>

<?php endwhile; ?>

<?php get_footer();?>