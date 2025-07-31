// Funcionalidad del carrusel
document.addEventListener('DOMContentLoaded', function() {
  const carousel = document.querySelector('.carousel-wrapper');
  const slides = document.querySelectorAll('.carousel-slide');
  const prevBtn = document.querySelector('.carousel-btn.prev');
  const nextBtn = document.querySelector('.carousel-btn.next');
  const indicators = document.querySelectorAll('.indicator');
  
  let currentSlide = 0;
  const slideWidth = 100 / 3; // Para mostrar 3 imágenes
  
  // Función para actualizar el carrusel
  function updateCarousel() {
    carousel.style.transform = `translateX(-${currentSlide * slideWidth}%)`;
    
    // Actualizar indicadores
    indicators.forEach((indicator, index) => {
      indicator.classList.toggle('active', index === currentSlide);
    });
  }
  
  // Botón siguiente
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      currentSlide = (currentSlide + 1) % slides.length;
      updateCarousel();
    });
  }
  
  // Botón anterior
  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      currentSlide = currentSlide === 0 ? slides.length - 1 : currentSlide - 1;
      updateCarousel();
    });
  }
  
  // Indicadores
  indicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
      currentSlide = index;
      updateCarousel();
    });
  });
  
  // Auto-play
  setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    updateCarousel();
  }, 5000);
  
  // Inicializar
  updateCarousel();
});

// Funcionalidad del formulario de reservaciones
document.addEventListener('DOMContentLoaded', function() {
  const checkInInput = document.getElementById('check-in');
  const checkOutInput = document.getElementById('check-out');
  const nightsSpan = document.getElementById('nights');
  const totalPriceSpan = document.getElementById('total-price');
  
  const pricePerNight = 150000; // Precio por noche
  
  function calculateNights() {
    if (checkInInput.value && checkOutInput.value) {
      const checkIn = new Date(checkInInput.value);
      const checkOut = new Date(checkOutInput.value);
      
      if (checkOut > checkIn) {
        const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
        const total = nights * pricePerNight;
        
        nightsSpan.textContent = nights;
        totalPriceSpan.textContent = `$${total.toLocaleString()}`;
      }
    }
  }
  
  if (checkInInput && checkOutInput) {
    checkInInput.addEventListener('change', calculateNights);
    checkOutInput.addEventListener('change', calculateNights);
  }
  
  // Validación de fecha mínima
  const today = new Date().toISOString().split('T')[0];
  if (checkInInput) {
    checkInInput.min = today;
  }
  if (checkOutInput) {
    checkOutInput.min = today;
  }
});

// Efectos de scroll para el header
document.addEventListener('DOMContentLoaded', function() {
  const header = document.querySelector('.header');
  
  window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
      header.style.background = 'rgba(0, 0, 0, 0.8)';
    } else {
      header.style.background = 'rgba(0, 0, 0, 0.4)';
    }
  });
}); 