const replies = [
  {
    keywords: ["hi", "hello", "hey", "hii"],
    reply: "Hi there! 👋 Welcome to CampusStore! How can I help you today?",
  },
  {
    keywords: ["product", "item", "buy", "shop", "available"],
    reply:
      "We have Electronics, Clothing, Accessories and Stationery. Browse from the top menu! 🛍️",
  },
  {
    keywords: ["order", "delivery", "ship", "track", "when"],
    reply:
      "Orders are delivered within 3-5 working days. Track your order in Order History after logging in. 📦",
  },
  {
    keywords: ["return", "refund", "exchange", "back"],
    reply:
      "You can return items within 7 days of delivery. Visit the Contact page and fill the return form. 🔄",
  },
  {
    keywords: ["login", "sign in", "account", "password"],
    reply: "Click the Login button on the top right of the page. 🔐",
  },
  {
    keywords: ["signup", "sign up", "register", "new account", "create"],
    reply:
      'Click "Sign Up" on the top right to create your free CampusStore account! 📝',
  },
  {
    keywords: ["cart", "add", "remove"],
    reply:
      'Click "Add to Cart" on any product. View your cart from the cart icon on the top right. 🛒',
  },
  {
    keywords: ["payment", "pay", "cod", "upi", "online"],
    reply:
      "We accept UPI, Credit/Debit cards, and Cash on Delivery. Choose at checkout. 💳",
  },
  {
    keywords: ["wishlist", "save", "favourite", "favorite", "heart"],
    reply: "Click the ❤️ icon on any product to save it to your Wishlist!",
  },
  {
    keywords: ["contact", "help", "support", "email"],
    reply: "Reach us via the Contact page. We reply within 24 hours! 📩",
  },
  {
    keywords: ["electronics", "laptop", "mouse", "earbuds", "keyboard"],
    reply:
      "Check out our Electronics section — computer accessories, audio, tablet accessories and more! 💻",
  },
  {
    keywords: ["clothing", "hoodie", "tshirt", "t-shirt", "shoes"],
    reply:
      "Browse our Clothing section for hoodies, t-shirts, shoes and more! 👕",
  },
  {
    keywords: ["stationery", "notebook", "pen", "calculator", "files"],
    reply:
      "Our Stationery section has notebooks, pens, calculators, files and more! 📒",
  },
  {
    keywords: ["price", "cost", "discount", "offer", "deal", "₹99"],
    reply:
      "Check our Top Offers section on the homepage for the latest deals and discounts! 🏷️",
  },
  {
    keywords: ["bye", "thanks", "thank you", "ok", "okay", "great"],
    reply: "Happy to help! Have a great day at campus! 😊",
  },
];

function getReply(userText) {
  const lower = userText.toLowerCase();
  for (const item of replies) {
    if (item.keywords.some((k) => lower.includes(k))) return item.reply;
  }
  return "I'm not sure about that 🤔 Try asking about products, orders, returns, login, or payments!";
}

let chatOpened = false;

function toggleChat() {
  const win = document.getElementById("cs-chat-window");
  const isHidden = win.style.display === "none" || win.style.display === "";
  win.style.display = isHidden ? "flex" : "none";
  if (isHidden && !chatOpened) {
    chatOpened = true;
    addMessage(
      "bot",
      "Hi! 👋 Welcome to CampusStore! Ask me about products, orders, returns, payments and more.",
    );
  }
}

function addMessage(role, text) {
  const box = document.getElementById("cs-chat-messages");
  const div = document.createElement("div");
  div.style.cssText = `max-width:80%;padding:10px 14px;border-radius:12px;font-size:14px;line-height:1.5;word-wrap:break-word;
    ${role === "user" ? "background:#4f46e5;color:#fff;align-self:flex-end;border-bottom-right-radius:2px;" : "background:#f1f5f9;color:#1e293b;align-self:flex-start;border-bottom-left-radius:2px;"}`;
  div.textContent = text;
  box.appendChild(div);
  box.scrollTop = box.scrollHeight;
}

function sendMessage() {
  const input = document.getElementById("cs-chat-input");
  const userText = input.value.trim();
  if (!userText) return;
  input.value = "";
  addMessage("user", userText);
  setTimeout(() => addMessage("bot", getReply(userText)), 400);
}
