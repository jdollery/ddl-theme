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
$opening_times = get_option('site-times');
$social_links = get_option('site-social');
$aggregate_value = get_option('site-aggregate-value');
$aggregate_count = get_option('site-aggregate-count');

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

  <?php if (!empty($social_links)) : ?>
    <?php foreach ($social_links as $index => $block) : ?>
      "sameAs": ["<?= $block['0'] ?>"],
    <?php endforeach; ?>
  <?php endif; ?>

  "openingHoursSpecification": [
    <?php if (!empty($opening_times)) : ?>
      <?php foreach ($opening_times as $index => $times) : ?>
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": "<?= $times['0']; ?>",
          "opens": "<?= $times['1']; ?>",
          "closes": "<?= $times['2']; ?>"
        }
      <?php endforeach; ?>
    <?php endif; ?>
  ],

  <?php if (!empty($aggregate_value || $aggregate_count)) : ?>
    "aggregateRating": {
      "@type": "AggregateRating",
      <?php if (!empty($aggregate_value)) : ?>"ratingValue": "<?= $aggregate_value; ?>",<?php endif; ?>
      <?php if (!empty($aggregate_count)) : ?>"reviewCount": "<?= $aggregate_count; ?>",<?php endif; ?>
    },
  <?php endif; ?>

  "inLanguage":"en-GB"
}
</script>