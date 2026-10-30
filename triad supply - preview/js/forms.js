// Form handling with fetch/AJAX
const FALLBACK = 'Please contact us directly on +966 50 894 7616 or al-atwi2911@hotmail.com';

function setMsg(el, text, type) {
  el.textContent = text;
  el.className = 'form-message ' + type;
}

function setLoading(btn, loading) {
  if (loading) {
    btn.dataset.orig = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
    btn.disabled = true;
  } else {
    btn.innerHTML = btn.dataset.orig;
    btn.disabled = false;
  }
}

// Contact form
const contactForm = document.getElementById('contactForm');
if (contactForm) {
  contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = contactForm.querySelector('button[type="submit"]');
    const msg = document.getElementById('contactMsg');
    // client validation
    if (!contactForm.checkValidity()) { setMsg(msg, 'Please fill all required fields correctly.', 'error'); return; }
    setLoading(btn, true);
    try {
      const res = await fetch('php/send-contact.php', { method: 'POST', body: new FormData(contactForm) });
      const data = await res.json();
      if (data.success) {
        setMsg(msg, data.message || 'Thank you! We received your message and will contact you soon.', 'success');
        contactForm.reset();
      } else {
        setMsg(msg, data.message || FALLBACK, 'error');
      }
    } catch (err) {
      setMsg(msg, FALLBACK, 'error');
    } finally {
      setLoading(btn, false);
    }
  });
}

// CV form
const cvForm = document.getElementById('cvForm');
if (cvForm) {
  cvForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = cvForm.querySelector('button[type="submit"]');
    const msg = document.getElementById('cvMsg');
    const fileInput = cvForm.querySelector('input[name="cv"]');
    const file = fileInput.files[0];
    // client-side validation
    if (!cvForm.checkValidity()) { setMsg(msg, 'Please fill all required fields.', 'error'); return; }
    if (!file) { setMsg(msg, 'Please select a CV file.', 'error'); return; }
    const allowed = ['application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    const ext = file.name.split('.').pop().toLowerCase();
    if (!['pdf','doc','docx'].includes(ext)) { setMsg(msg, 'Only PDF, DOC, DOCX allowed.', 'error'); return; }
    if (file.size > 5 * 1024 * 1024) { setMsg(msg, 'File must be under 5MB.', 'error'); return; }
    setLoading(btn, true);
    try {
      const res = await fetch('php/send-cv.php', { method: 'POST', body: new FormData(cvForm) });
      const data = await res.json();
      if (data.success) {
        setMsg(msg, data.message || 'Thank you! We received your CV and will contact you soon.', 'success');
        cvForm.reset();
      } else {
        setMsg(msg, data.message || FALLBACK, 'error');
      }
    } catch (err) {
      setMsg(msg, FALLBACK, 'error');
    } finally {
      setLoading(btn, false);
    }
  });
}
