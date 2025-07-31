// Funcionalidad del carrusel infinito
document.addEventListener('DOMContentLoaded', function() {
  const carousel = document.querySelector('.carousel-wrapper');
  const slides = document.querySelectorAll('.carousel-slide');
  const prevBtn = document.querySelector('.carousel-btn.prev');
  const nextBtn = document.querySelector('.carousel-btn.next');
  const indicators = document.querySelectorAll('.indicator');
  
  if (!carousel || slides.length === 0) return;
  
  let currentSlide = 0;
  const slideWidth = 100 / 3; // Para mostrar 3 imágenes
  const totalSlides = slides.length;
  
  // Calcular cuántas imágenes necesitamos clonar para completar el último grupo
  const imagesPerView = 3;
  const remainder = totalSlides % imagesPerView;
  const imagesToClone = remainder > 0 ? imagesPerView - remainder : imagesPerView;
  
  // Clonar las primeras imágenes al final para crear el efecto infinito
  for (let i = 0; i < imagesToClone; i++) {
    const clone = slides[i].cloneNode(true);
    carousel.appendChild(clone);
  }
  
  // Clonar las últimas imágenes al principio
  for (let i = totalSlides - imagesToClone; i < totalSlides; i++) {
    const clone = slides[i].cloneNode(true);
    carousel.insertBefore(clone, carousel.firstChild);
  }
  
  // Ajustar la posición inicial para compensar los clones del principio
  currentSlide = imagesToClone;
  carousel.style.transform = `translateX(-${currentSlide * slideWidth}%)`;
  
  // Función para actualizar el carrusel
  function updateCarousel(transition = true) {
    if (!transition) {
      carousel.style.transition = 'none';
    } else {
      carousel.style.transition = 'transform 0.8s ease-in-out';
    }
    
    carousel.style.transform = `translateX(-${currentSlide * slideWidth}%)`;
    
    // Actualizar indicadores (solo para las imágenes originales)
    indicators.forEach((indicator, index) => {
      indicator.classList.toggle('active', index === (currentSlide - imagesToClone + totalSlides) % totalSlides);
    });
  }
  
  // Función para manejar el final del carrusel
  function handleInfiniteScroll() {
    if (currentSlide >= totalSlides + imagesToClone) {
      // Si llegamos al final, saltar al principio sin transición
      currentSlide = imagesToClone;
      updateCarousel(false);
    } else if (currentSlide < imagesToClone) {
      // Si llegamos al principio, saltar al final sin transición
      currentSlide = totalSlides + imagesToClone - 1;
      updateCarousel(false);
    }
  }
  
  // Botón siguiente
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      currentSlide++;
      updateCarousel();
      setTimeout(handleInfiniteScroll, 800);
    });
  }
  
  // Botón anterior
  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      currentSlide--;
      updateCarousel();
      setTimeout(handleInfiniteScroll, 800);
    });
  }
  
  // Indicadores
  indicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
      currentSlide = index + imagesToClone;
      updateCarousel();
    });
  });
  
  // Auto-play
  setInterval(() => {
    currentSlide++;
    updateCarousel();
    setTimeout(handleInfiniteScroll, 800);
  }, 5000);
  
  // Inicializar
  updateCarousel(false);
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