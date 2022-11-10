<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('inc/banner'); ?>

<article class="content block">
  <div class="cell-fluid">
    <div class="cell-row cell-row-gutter-x">
      <div class="cell cell-gutter-x cell-gutter-y cell-span-12">

        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <a href="/" class="button button--black button--body">Test</a>

        <form class="form" id="validateForm" novalidate="true" method="post" action="https://www.securedent.net/submit.ashx">
    
          <fieldset>

            <legend>Patient Details</legend>
            <div class="cell-row cell-row-gutter-x-sm">

              <div class="cell cell-gutter-x-sm cell-span-6">

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
              <div class="cell cell-gutter-x-sm cell-span-6">

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
              <div class="cell cell-gutter-x-sm cell-span-6">

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
              <div class="cell cell-gutter-x-sm cell-span-6">

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

              <div class="cell cell-gutter-x-sm cell-span-12">

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

              <div class="cell cell-gutter-x-sm cell-span-12">

                <div class="form__input form__input--textarea">
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

          <hr>

          <fieldset>

            <legend>Referral Details</legend>

            <div class="cell-row cell-row-gutter-x-sm">

              <div class="cell cell-gutter-x-sm cell-span-12">

                <div class="form__input">
                  <select 
                    id="referral_type" 
                    name="referral_type" 
                    data-placeholder="Choose a referral type"  
                    >
                    <option></option>
                    <option label="Implant referral" value="Implant referral">Implant referral</option>
                    <option label="Endodontic referral" value="Endodontic referral">Endodontic referral</option>
                    <option label="Cosmetic referral" value="Cosmetic referral">Cosmetic referral</option>
                    <option label="Restorative referral" value="Restorative referral">Restorative referral</option>
                  </select>        
                </div>

              </div>
              <div class="cell cell-gutter-x-sm cell-span-12">

                <div class="form__input form__input--textarea">
                  <textarea 
                    id="referral_reason"
                    name="referral_reason"
                    rows="3"
                    placeholder="Reason for referral" 
                  ></textarea>
                  <label for="referral_reason">Reason for referral</label> 
                </div>

              </div>

              <div class="cell cell-gutter-x-sm cell-span-12">

                <div class="form__input form__input--textarea">
                  <textarea 
                    id="referral_history"
                    name="referral_history"
                    rows="3"
                    placeholder="Medical history and relevant information" 
                  ></textarea>
                  <label for="referral_history">Medical history and relevant information</label> 
                </div>

              </div>

              <div class="cell cell-gutter-x-sm cell-span-12">

                <div class="form__input form__input--upload">
                  <input 
                    type="file" 
                    name="referral_uploads" 
                    id="referral_uploads" 
                    class="upload"
                    size="40" >
                  <label for="referral_uploads"><span class="upload__file">Upload any supporting radiographs/images/documents (Max 15MB)</span><span class="upload__button">Upload</span></label>
                </div>

              </div>

            </div>

          </fieldset>

          <hr>

          <fieldset>

            <legend>Referrer Details</legend>
            <div class="cell-row cell-row-gutter-x-sm">

              <div class="cell cell-gutter-x-sm cell-span-6">

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
              <div class="cell cell-gutter-x-sm cell-span-6">

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
              <div class="cell cell-gutter-x-sm cell-span-6">

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
              <div class="cell cell-gutter-x-sm cell-span-6">

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
              <div class="cell cell-gutter-x-sm cell-span-12">

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

              <div class="cell cell-gutter-x-sm cell-span-0">
                <div class="form__input form__input--checkbox">
                  <input type="checkbox" id="marketing_consent" name="marketing_consent" value="Yes, I consent">
                  <label for="marketing_consent">I confirm I have the patient&rsquo;s consent to share this information, and also consent to <?php bloginfo( 'name' ); ?> replying and storing these personal details (please see our <a href="<?php echo site_url() ?>/privacy-policy/">privacy policy</a> for more information).</label>
                </div>
              </div>

              <div class="cell cell-gutter-x-sm cell-span-auto pt-3 pt-lg-0">
                <button class="button button--black" type="submit">Submit referral</button>
              </div>

            </div>

          </fieldset>

          <!-- <input type="hidden" name="form_uid" value="5fc07193-b633-4f3a-adff-ff7a32f3e11f">
          <input name="required" type="hidden" value="name,submit_by,new_patient">
          <input type="hidden" name="data_order" value="name,submit_by,phone,new_patient,enquiry,gdpr_consent">
          <input name="ok_url" type="hidden" id="ok_url" value="<?php echo site_url() ?>/thank-you/">
          <input name="not_ok_url" type="hidden" id="not_ok_url" value="<?php echo site_url() ?>/sorry/"> -->

        </form>

      </div>
    </div>
  </div>
</article>

<?php endwhile; ?>

<?php get_footer();?>