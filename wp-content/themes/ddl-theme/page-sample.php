<?php 

/* Template Name: Sample Page */

get_header(); ?>

<?php get_template_part('includes/banner'); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('includes/sections'); ?>

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

      <form class="form" id="contactForm" name="contact" novalidate="true" method="post" action="https://www.securedent.net/submit.ashx">

        <div class="form__row">

          <div class="form__cell form__cell--half">

            <div class="form__input form__input--focus">
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

            <div class="form__input form__input--focus">
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

            <div class="form__input form__input--focus">
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

          <div class="form__cell form__cell--half">

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

            <div class="form__input form__input--focus">
              <textarea 
                id="enquiry"
                name="enquiry"
                rows="3"
                placeholder="Your enquiry" 
                aria-label="Your enquiry"
              ></textarea>
              <label for="enquiry">Your enquiry</label> 
            </div>

          </div>

        </div>

        <div class="form__row form__row--footer">

          <div class="form__cell form__cell--flex">
            By clicking &lsquo;send&rsquo;, you agree to <?php bloginfo( 'name' ); ?> collecting your personal data. To learn more about how <?php bloginfo( 'name' ); ?> collects, uses, shares and protects your personal data, please read our <a href="<?php echo get_privacy_policy_url() ?>">privacy policy</a>.
          </div>

          <div class="form__cell">
            <button class="btn btn--black btn--submit" type="submit">
              <span class="btn__text">Send</span>
              <span class="btn__icon">Sending <span class="icon icon--loader"><svg role="img"><use xlink:href="#loader" href="#loader"></use></svg></span></span></span>
            </button>
          </div>

        </div>

        <!-- <input type="hidden" name="recaptcha_response" id="recaptcha_response"> -->

        <!-- <input type="hidden" name="form_uid" value="b395082e-6e12-4fcd-92e4-cfa8ffed4066">
        <input name="required" type="hidden" value="first_name,last_name,submit_by,new_patient">
        <input type="hidden" name="data_order" value="first_name,last_name,phone_number,submit_by,new_patient,enquiry,subscribe">
        <input name="ok_url" type="hidden" id="ok_url" value="<?php echo get_the_permalink( 1 ) // thank you page ?>">
        <input name="not_ok_url" type="hidden" id="not_ok_url" value="<?php echo get_the_permalink( 1 ) // sorry page ?>"> -->

      </form>

      <form class="form" id="referralForm" name="referral" novalidate="true" method="post" action="https://www.securedent.net/submit.ashx" enctype="multipart/form-data">

        <fieldset>

          <legend>Patient Details</legend>
          <div class="form__row">

            <div class="form__cell form__cell--half">

              <div class="form__input">
                <label for="patient_name">Full name<span aria-label="required">*</span></label>
                <input
                  type="text"
                  id="patient_name"
                  name="patient_name"
                  required
                  aria-required="true"
                />
              </div>

            </div>
            <div class="form__cell form__cell--half">

              <div class="form__input">
                <label for="patient_dob">Date of birth</label>
                <input
                  type="text"
                  id="patient_dob"
                  name="patient_dob"
                />
              </div>

            </div>
            <div class="form__cell form__cell--half">

              <div class="form__input">
                <label for="patient_email">Email address<span aria-label="required">*</span></label>
                <input
                  type="email"
                  id="patient_email"
                  name="patient_email"
                  required
                  aria-required="true"
                />
              </div>

            </div>
            <div class="form__cell form__cell--half">

              <div class="form__input">
                <label for="patient_phone">Telephone number</label>
                <input
                  type="number"
                  id="patient_phone"
                  name="patient_phone"
                />
              </div>

            </div>

            <div class="form__cell form__cell--full">

              <div class="form__input">
                <label for="patient_address">Address</label> 
                <textarea 
                  id="patient_address"
                  name="patient_address"
                  rows="3"
                ></textarea>
              </div>

            </div>

          </div>

        </fieldset>

        <fieldset>

          <legend>Referral Details</legend>

          <div class="form__row">

            <div class="form__cell form__cell--full">

              <div class="form__input">
                <label for="referral_type">Please select a type of treatment to be referred<span aria-label="required">*</span></label> 
                <select 
                  id="referral_type" 
                  name="referral_type" 
                  data-placeholder="Please select an option" 
                  required
                  aria-required="true"
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
                <label for="referral_reason">Reason for referral<span aria-label="required">*</span></label> 
                <textarea 
                  id="referral_reason"
                  name="referral_reason"
                  rows="3"
                  required
                  aria-required="true"
                ></textarea>
              </div>

            </div>

            <div class="form__cell form__cell--full">

              <!-- <div class="form__input form__input--textarea"> -->
              <div class="form__input">
                <label for="referral_history">Medical history and relevant information</label> 
                <textarea 
                  id="referral_history"
                  name="referral_history"
                  rows="3"
                ></textarea>
              </div>

            </div>

            <div class="form__cell form__cell--frame">

              <div class="form__row">

                <div class="form__cell form__cell--flex">

                  <div class="form__input">
                    <span>Is the tooth symptomatic?</span>
                  </div>

                </div>

                <div class="form__cell">

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
                <label for="referrer_name">Full name<span aria-label="required">*</span></label>
                <input
                  type="text"
                  id="referrer_name"
                  name="referrer_name"
                  required
                  aria-required="true"
                />
              </div>

            </div>
            <div class="form__cell form__cell--half">

              <div class="form__input">
                <label for="referrer_position">Position/Job title</label>
                <input
                  type="text"
                  id="referrer_position"
                  name="referrer_position"
                />
              </div>

            </div>
            <div class="form__cell form__cell--half">

              <div class="form__input">
                <label for="referrer_email">Email address<span aria-label="required">*</span></label>
                <input
                  type="email"
                  id="referrer_email"
                  name="submit_by"
                  required
                  aria-required="true"
                />
              </div>

            </div>
            <div class="form__cell form__cell--half">

              <div class="form__input">
                <label for="referrer_phone">Telephone number</label>
                <input
                  type="number"
                  id="referrer_phone"
                  name="referrer_phone"
                />
              </div>

            </div>
            <div class="form__cell form__cell--full">

              <div class="form__input form__input--textarea">
                <label for="referrer_address">Address</label> 
                <textarea 
                  id="referrer_address"
                  name="referrer_address"
                  rows="3"
                  required
                  aria-required="true"
                ></textarea>
              </div>

            </div>

          </div>

        </fieldset>

        <div class="form__row form__row--footer">

          <div class="form__cell form__cell--frame">

            <div class="form__row">

              <div class="form__cell form__cell--flex">

                <div class="form__input">
                  <span>I confirm I have the patient&rsquo;s consent to share this information.</span>
                </div>

              </div>

              <div class="form__cell">

                <div class="form__input form__input--checkbox">
                  <input 
                    type="checkbox"
                    id="patient_consent"
                    name="patient_consent"
                    value="Yes"
                  >
                  <label for="patient_consent">Yes</label>
                </div>

              </div>

            </div>
            
          </div>

          <div class="form__cell form__cell--flex">
            <span>By clicking &lsquo;submit referral&rsquo;, you agree to <?php bloginfo( 'name' ); ?> collecting your personal data. To learn more about how <?php bloginfo( 'name' ); ?> collects, uses, shares and protects your personal data, please read our <a href="<?php echo get_privacy_policy_url() ?>">privacy policy</a>.</span>
          </div>

          <div class="form__cell">
            <button class="btn btn--black btn--submit" type="submit">
              <span class="btn__text">Submit referral</span>
              <span class="btn__icon">Sending <span class="icon icon--loader"><svg role="img"><use xlink:href="#loader" href="#loader"></use></svg></span></span></span>
            </button>
          </div>

        </div>

        <!-- <input type="hidden" name="recaptcha_response" id="recaptcha_response"> -->
        <!-- <input type="hidden" name="form_uid" value="XXXXXXXXXXXX">
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