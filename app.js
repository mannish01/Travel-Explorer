let navBar = document.querySelector("nav");

document.addEventListener("scroll", function (event) {
  if ("scrollY" > 200) {
    navBar.classList.add("shadow-sm");
  } else {
    navBar.classList.remove("shadow-sm");
  }
});

  const newsletterForm = document.querySelector('form[action="newsletter.php"]');
  const emailInput = newsletterForm.querySelector('input[name="email"]');

  newsletterForm.addEventListener('submit', async function (e) {
    e.preventDefault(); // stop form from submitting normally

    const formData = new FormData(newsletterForm);

    const response = await fetch('newsletter.php', {
      method: 'POST',
      body: formData
    });

    if (response.ok) {
      alert("✅ Subscribed successfully! Check your email.");
      newsletterForm.reset();
    } else {
      alert("❌ Subscription failed. Try again.");
    }
  });