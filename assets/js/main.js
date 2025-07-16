const testimonies = [
  {
    id: 1,
    text: "<b>10/10</b>, complimentary <br> consultation rocks, quick <br> and efficient. One of the <br>best experience with tax <br> attorneys at the moment.<br> Will definitely use their <br> service in the future, <br> very smart folks.",
  },
  {
    id: 2,
    text: '<b><a href="https://ihavetaxdebt.com" style="color:#23b26d;text-decoration:underline;">ihavetaxdebt.com</a></b> has always been so helpful in assisting my dad with his tax needs. They are super helpful, very informative, and I appreciate them being genuine and kind always.',
  },
  {
    id: 3,
    text: 'Attorney Nyarko resolved every single issue we had with maximum professionalism, knowledge, and the most important: she cared! Using <a href="https://ihavetaxdebt.com" style="color:#23b26d;text-decoration:underline;">ihavetaxdebt.com</a> again, if needed, is a no brainer.',
  },
  {
    id: 4,
    text: 'Excellent service and very approachable team. Always put the client first.',
  },
  {
    id: 5,
    text: 'Super grateful for all the help they offered my family. Would recommend without hesitation.',
  },
];

let current = 0;
const visibleCount = 3;
const carousel = document.getElementById("carousel");
const displayIndex = document.getElementById("displayIndex");
const totalCount = document.getElementById("totalCount");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

totalCount.textContent = testimonies.length.toString().padStart(2, '0');

function updateCarousel() {
  carousel.innerHTML = "";

  // Always try to center the active card
  let start = current - 1;
  if (start < 0) start = 0;
  if (start > testimonies.length - visibleCount) start = testimonies.length - visibleCount;
  if (testimonies.length <= visibleCount) start = 0;

  // Toggle overflow on the carousel wrapper
  const wrapper = carousel.parentElement;
  if (current === testimonies.length - 1) {
    wrapper.style.overflow = 'visible';
  } else {
    wrapper.style.overflow = 'hidden';
  }

  for (let i = 0; i < visibleCount; i++) {
    const index = start + i;
    const testimony = testimonies[index];
    if (!testimony) continue;

    const card = document.createElement("div");
    card.className = "testimonial-card" + (index === current ? " active" : "");
    card.innerHTML = `
      <h3 class="fw-bold mb-4">Satisfied Client</h3>
      <div class="testimonial-text">${testimony.text}</div>
    `;
    carousel.appendChild(card);
  }

  displayIndex.textContent = (current + 1).toString().padStart(2, '0');
  prevBtn.disabled = current === 0;
  nextBtn.disabled = current === testimonies.length - 1;
}

prevBtn.addEventListener("click", () => {
  if (current > 0) {
    current--;
    updateCarousel();
  }
});
nextBtn.addEventListener("click", () => {
  if (current < testimonies.length - 1) {
    current++;
    updateCarousel();
  }
});

updateCarousel();

// Contact form submission
const contactForm = document.querySelector('.contact-form-custom');
if (contactForm) {
  contactForm.addEventListener('submit', function(e) {
    e.preventDefault();
    // Collect form data
    const formData = new FormData(contactForm);
    const data = {};
    formData.forEach((value, key) => { data[key] = value; });
    alert('Thank you for contacting us!');
    contactForm.reset();
  });
}

// Phone number input masking for (___) ___-____ format
const phoneInput = document.querySelector('.contact-form-custom input[placeholder="(___) ___-____"]');
if (phoneInput) {
  phoneInput.addEventListener('input', function(e) {
    let value = phoneInput.value.replace(/\D/g, '');
    if (value.length > 10) value = value.slice(0, 10);
    let formatted = '';
    if (value.length > 0) formatted = '(' + value.substring(0, 3);
    if (value.length >= 4) formatted += ') ' + value.substring(3, 6);
    if (value.length >= 7) formatted += '-' + value.substring(6, 10);
    phoneInput.value = formatted;
  });
}

// Footer email form submission
const footerForm = document.querySelector('footer form');
if (footerForm) {
  footerForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const email = footerForm.querySelector('input[type="email"]').value;
    alert('Thank you for subscribing with: ' + email);
    footerForm.reset();
  });
}