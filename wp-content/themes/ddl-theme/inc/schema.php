<?php

  $site_url = get_site_url();
  $site_name = get_bloginfo('name');
  $site_description = get_option('site-description');
  $phone_number = get_option('site-phone-number');
  $email_address = get_option('site-email-address');
  $street_address = get_option('site-street-address');
  $address_locality = get_option('site-address-locality');
  $address_region = get_option('site-address-region');
  $postal_code = get_option('site-postal-code');
  $address_country = get_option('site-address-country');

?>

<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Dentist",
    "@id":"LocalBusiness",
    "name": "<?= $site_name; ?>",
    "description": "<?= $site_description; ?>",
    "legalName": "<?= $site_name; ?>",
    "url": "<?= $site_url; ?>",
    "logo": "<?= get_template_directory_uri(); ?>/assets/img/schema-logo.jpg",
    "address": {
    "@type": "PostalAddress",
    "streetAddress": "<?= $street_address; ?>",
    "addressLocality": "<?= $address_locality; ?>",
    "addressRegion": "<?= $address_region; ?>",
    "postalCode": "<?= $postal_code; ?>",
    "addressCountry": "<?= $address_country; ?>",
    },
    "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "customer support",
    "email": "<?= $email_address; ?>",
    "telephone": "<?= $phone_number; ?>"
    },

    <!-- <?php if (!empty($socials)) : ?>
        <?php foreach ($socials as $index => $block) : ?>

            "sameAs": [
                "<?= $block['social_url'] ?>"<?= $index < count($socials) - 1 ? ',' : '' ?>
            ],

        <?php endforeach; ?>
    <?php endif; ?> -->

    <!-- "openingHoursSpecification": [
        <?php if (!empty($openingHours)) : ?>
            <?php foreach ($openingHours as $index => $hours) : ?>

                {
                    "@type": "OpeningHoursSpecification",
                    "dayOfWeek": "<?= $hours['day_of_week']; ?>",
                    "opens": "<?= $hours['opens']; ?>",
                    "closes": "<?= $hours['closes']; ?>"
                }<?= $index < count($openingHours) - 1 ? ',' : '' ?>

            <?php endforeach; ?>
        <?php endif; ?>
    ], -->

    <!-- <?php if (!empty($aggregateRating)) : ?>

        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "<?= $aggregateRating['rating_value']; ?>",
            "reviewCount": "<?= $aggregateRating['review_count']; ?>"
        },

    <?php endif; ?> -->

    "inLanguage":"en-GB"
  }
</script>