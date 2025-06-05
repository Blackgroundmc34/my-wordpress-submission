/**
 * Main JavaScript file for Custom Theme
 *
 * This file will contain custom JavaScript for theme interactions,
 * such as mobile menu toggles, sliders, animations, etc.
 * It is enqueued via inc/theme-scripts.php.
 *
 * Theme Name: Custom Theme
 * Version: 1.0.0
 */

(function ($) { 
  'use strict';

  /**
   * Document Ready
   *
   */
  $(document).ready(function () {

    // Mobile Menu Toggle Functionality
    const menuToggle = $('.menu-toggle'); // The hamburger button
    const mobileMenuPanel = $('#mobile-menu-panel'); // The slide-out panel
    const closeMobileMenuButton = $('.close-mobile-menu'); // The 'X' button inside the panel
    const mobileMenuOverlay = $('.mobile-menu-overlay'); // The semi-transparent overlay
    const body = $('body');

    // Check if all necessary elements exist
    if (menuToggle.length && mobileMenuPanel.length && closeMobileMenuButton.length && mobileMenuOverlay.length) {

      // Function to open the mobile menu
      function openMobileMenu() {
        menuToggle.attr('aria-expanded', 'true');
        mobileMenuPanel.addClass('is-open').attr('aria-hidden', 'false');
        mobileMenuOverlay.addClass('is-visible').attr('aria-hidden', 'false');
        body.addClass('mobile-menu-active'); // Optional: for preventing body scroll or other styling
        closeMobileMenuButton.focus(); // Set focus to the close button for accessibility
      }

      // Function to close the mobile menu
      function closeMobileMenu() {
        menuToggle.attr('aria-expanded', 'false');
        mobileMenuPanel.removeClass('is-open').attr('aria-hidden', 'true');
        mobileMenuOverlay.removeClass('is-visible').attr('aria-hidden', 'true');
        body.removeClass('mobile-menu-active');
        menuToggle.focus(); // Return focus to the hamburger button
      }

      // Event listener for the hamburger button
      menuToggle.on('click', function () {
        if (mobileMenuPanel.hasClass('is-open')) {
          closeMobileMenu();
        } else {
          openMobileMenu();
        }
      });

      // Event listener for the 'X' button inside the panel
      closeMobileMenuButton.on('click', function() {
        closeMobileMenu();
      });

      // Event listener for the overlay (to close menu when clicking outside)
      mobileMenuOverlay.on('click', function() {
        closeMobileMenu();
      });

      // Event listener for the 'Escape' key to close the menu
      $(document).on('keydown', function(event) {
        if (event.key === 'Escape' && mobileMenuPanel.hasClass('is-open')) {
          closeMobileMenu();
        }
      });

    } else {

    }



  }); // End Document Ready

  // Accordion Block Functionality
    $('.wp-block-custom-accordion-section .accordion-item-trigger').on('click', function(e) {
      e.preventDefault();
      const $this = $(this);
      const $content = $this.closest('.accordion-item').find('.accordion-item-content');
      const isExpanded = $this.attr('aria-expanded') === 'true';

      $this.attr('aria-expanded', !isExpanded);
      $content.attr('hidden', isExpanded); // Toggle 'hidden' attribute
    });

    /*when scrolling */

  window.addEventListener('scroll', function () {
    const header = document.querySelector('header#masthead');
    if (window.scrollY > 10) {
      header.classList.add('sticky');
    } else {
      header.classList.remove('sticky');
    }
  });



})(jQuery);
