<?php 

/* Template Name: Sample Page */

get_header(); ?>

<?php get_template_part('inc/banner'); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('inc/sections'); ?>

<article class="space-p">

  <?php the_content(); ?>

  <figure class="quote">
    <blockquote cite="https://www.huxley.net/bnw/four.html">
      Words can be like X-rays, if you use them properly—they’ll go through anything. You read and you’re pierced.
    </blockquote>
    <figcaption>—Aldous Huxley, <cite>Brave New World</cite></figcaption>
  </figure>

  <a href="/" class="btn btn--black btn--space">Test</a>

  <a class="btn btn--accent btn--space" href="<?php echo site_url() ?>/team/#joe-smith" onclick="window.open(this.href, '_self'); return false;">View Joe’s Profile</a>

  <h1>Heading h2</h1>
  <h2>Heading h2</h2>
  <h3>Heading h3</h3>
  <h4>Heading h4</h4>
  <h5>Heading h5</h5>
  <h6>Heading h6</h6>

  <form class="form" id="validateForm" novalidate="true" method="post" action="https://www.securedent.net/submit.ashx" enctype="multipart/form-data">

    <fieldset>

      <legend>Patient Details</legend>
      <div class="cell-row cell-row-gutter-x-sm">

        <div class="cell-6 cell-gutter-x-sm">

          <div class="form__input">
            <input
              type="text"
              id="patient_name"
              name="patient_name"
              placeholder="Full name*"
              required
            />
            <label for="patient_name">Full name*</label>
          </div>

        </div>
        <div class="cell-6 cell-gutter-x-sm">

          <div class="form__input">
            <input
              type="date"
              id="patient_dob"
              name="patient_dob"
              placeholder="Date of birth"
            />
            <label for="patient_dob">Date of birth</label>
          </div>

        </div>
        <div class="cell-6 cell-gutter-x-sm">

          <div class="form__input">
            <input
              type="email"
              id="patient_email"
              name="patient_email"
              placeholder="Email address*"
              required
            />
            <label for="patient_email">Email address*</label>
          </div>

        </div>
        <div class="cell-6 cell-gutter-x-sm">

          <div class="form__input">
            <input
              type="number"
              id="patient_phone"
              name="patient_phone"
              placeholder="Telephone number"
            />
            <label for="patient_phone">Telephone number</label>
          </div>

        </div>

        <div class="cell-12 cell-gutter-x-sm">

          <div class="form__input">
          <select 
              id="new_patient" 
              name="new_patient" 
              data-placeholder="Are you a new patient?*" 
              required 
              >
              <option></option>
              <option label="Yes, I&rsquo;m a new patient" value="Yes">Yes, I&rsquo;m a new patient</option>
              <option label="No, I&rsquo;m an existing patient" value="No">No, I&rsquo;m an existing patient</option>
            </select> 
          </div>

        </div>

        <div class="cell-12 cell-gutter-x-sm">

          <div class="form__input form__input">
            <textarea 
              id="patient_address"
              name="patient_address"
              rows="3"
              placeholder="Address" 
            ></textarea>
            <label for="patient_address">Address</label> 
          </div>

        </div>

      </div>

    </fieldset>

    <fieldset>

      <legend>Referral Details</legend>

      <div class="cell-row cell-row-gutter-x-sm">

        <div class="cell-12 cell-gutter-x-sm">

          <div class="form__input">
            <select 
              id="referral_type" 
              name="referral_type" 
              data-placeholder="Choose a referral type" 
              required
              >
              <option></option>
              <option label="Implant referral" value="Implant referral">Implant referral</option>
              <option label="Endodontic referral" value="Endodontic referral">Endodontic referral</option>
              <option label="Cosmetic referral" value="Cosmetic referral">Cosmetic referral</option>
              <option label="Restorative referral" value="Restorative referral">Restorative referral</option>
            </select>        
          </div>

        </div>
        <div class="cell-12 cell-gutter-x-sm">

          <div class="form__input form__input">
            <textarea 
              id="referral_reason"
              name="referral_reason"
              rows="3"
              placeholder="Reason for referral" 
              required
            ></textarea>
            <label for="referral_reason">Reason for referral</label> 
          </div>

        </div>

        <div class="cell-12 cell-gutter-x-sm">

          <!-- <div class="form__input form__input--textarea"> -->
          <div class="form__input form__input">
            <textarea 
              id="referral_history"
              name="referral_history"
              rows="3"
              placeholder="Medical history and relevant information" 
            ></textarea>
            <label for="referral_history">Medical history and relevant information</label> 
          </div>

        </div>

        <div class="cell-12 cell-gutter-x-sm">
          <div class="cell-row cell-row-gutter-x-sm px-md-6 cell-align-center h-100">
            <div class="cell-0 cell-gutter-x-sm">
              <div class="form__input">
                <p class="m-0"><span>Is the tooth symptomatic?</span></p>
              </div>
            </div>
            <div class="cell-auto cell-gutter-x-sm">
              <div class="form__input">
                <input type="radio" id="endodontic_symptomatic_yes" name="symptomatic" value="Yes">
                <label for="endodontic_symptomatic_yes">Yes</label>
              </div>
            </div>
            <div class="cell-auto cell-gutter-x-sm">
              <div class="form__input">
                <input type="radio" id="endodontic_symptomatic_no" name="symptomatic" value="No">
                <label for="endodontic_symptomatic_no">No</label>
              </div>
            </div>
          </div>
        </div>

        <div class="cell-12 cell-gutter-x-sm">

          <div class="form__input form__input--upload">
            <input 
              type="file" 
              name="referral_uploads" 
              id="referral_uploads" 
              class="upload"
              size="40" >
            <label for="referral_uploads"><span class="upload__file">Upload any supporting radiographs/images/documents (Max 5MB)</span><span class="upload__button">Upload</span></label>
          </div>

        </div>

      </div>

    </fieldset>

    <fieldset>

      <legend>Referrer Details</legend>
      <div class="cell-row cell-row-gutter-x-sm">

        <div class="cell-md-6 cell-gutter-x-sm">

          <div class="form__input">
            <input
              type="text"
              id="referrer_name"
              name="referrer_name"
              placeholder="Full name*"
              required
            />
            <label for="referrer_name">Full name*</label>
          </div>

        </div>
        <div class="cell-md-6 cell-gutter-x-sm">

          <div class="form__input">
            <input
              type="text"
              id="referrer_position"
              name="referrer_position"
              placeholder="Position/Job title"
            />
            <label for="referrer_position">Position/Job title</label>
          </div>

        </div>
        <div class="cell-md-6 cell-gutter-x-sm">

          <div class="form__input">
            <input
              type="email"
              id="referrer_email"
              name="submit_by"
              placeholder="Email address*"
              required
            />
            <label for="referrer_email">Email address*</label>
          </div>

        </div>
        <div class="cell-md-6 cell-gutter-x-sm">

          <div class="form__input">
            <input
              type="number"
              id="referrer_phone"
              name="referrer_phone"
              placeholder="Telephone number"
            />
            <label for="referrer_phone">Telephone number</label>
          </div>

        </div>
        <div class="cell-12 cell-gutter-x-sm">

          <div class="form__input form__input--textarea">
            <textarea 
              id="referrer_address"
              name="referrer_address"
              rows="3"
              placeholder="Address" 
            ></textarea>
            <label for="referrer_address">Address</label> 
          </div>

        </div>

      </div>

      <div class="cell-row cell-row-gutter-x-sm cell-align-center pt-7">

        <div class="cell-0 cell-gutter-x-sm">
          <div class="form__input form__input--checkbox">
            <input type="checkbox" id="marketing_consent" name="marketing_consent" value="Yes, I consent" required>
            <label for="marketing_consent">I confirm I have the patient&rsquo;s consent to share this information, and also consent to <?php bloginfo( 'name' ); ?> replying and storing these personal details (please see our <a href="<?php echo site_url() ?>/privacy-policy/">privacy policy</a> for more information).</label>
          </div>
        </div>

        <div class="cell cell-gutter-x-sm cell-12 cell-lg-auto pt-3 pt-lg-0">
          <button class="btn btn--black" type="submit">Submit referral</button>
        </div>

      </div>

    </fieldset>

    <!-- <input type="hidden" name="form_uid" value="5fc07193-b633-4f3a-adff-ff7a32f3e11f">
    <input name="required" type="hidden" value="name,submit_by,new_patient">
    <input type="hidden" name="data_order" value="name,submit_by,phone,new_patient,enquiry,gdpr_consent">
    <input name="ok_url" type="hidden" id="ok_url" value="<?php echo site_url() ?>/thank-you/">
    <input name="not_ok_url" type="hidden" id="not_ok_url" value="<?php echo site_url() ?>/sorry/"> -->

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

</article>

<?php endwhile; ?>

<?php get_footer();?>