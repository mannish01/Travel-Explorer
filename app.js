
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

  function toggleChat() {
  const chat = document.getElementById("chat-widget");
  chat.style.display = chat.style.display === "flex" ? "none" : "flex";
}

function handleKey(event) {
  if (event.key === "Enter") {
    sendMessage();
  }
}

function sendMessage() {
  const input = document.getElementById("user-input");
  const message = input.value.trim();
  if (!message) return;

  addMessage("user", message);
  input.value = "";

  // Simulated bot response after delay
  setTimeout(() => {
    const response = getBotResponse(message);
    addMessage("bot", response);
  }, 1000);
}

function addMessage(sender, text) {
  const chatBody = document.getElementById("chat-body");
  const msgDiv = document.createElement("div");
  msgDiv.className = sender === "user" ? "user-message" : "bot-message";
  msgDiv.textContent = text;
  chatBody.appendChild(msgDiv);
  chatBody.scrollTop = chatBody.scrollHeight;
}

function getBotResponse(userMsg) {
  const lower = userMsg.toLowerCase();
  if (lower.includes("hello") || lower.includes("hi")) {
    return "Hello! How can I assist you today?";
  } else if (lower.includes("price")) {
    return "You can view our pricing plans on the Pricing page.";
  } else if (lower.includes("support")) {
    return "Our support team is available 24/7 via email.";
  } else {
    return "I'm just a demo bot. Feel free to ask anything!";
  }
}


