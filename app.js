
document.addEventListener('scroll',() => {
  const nav = document.querySelector('nav')
  if(window.screenY>0){
    nav.classList.add('scrolled');
  } else {
    nav.classList.remove('scrolled');
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