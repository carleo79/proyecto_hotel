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

// Funcionalidad del carrusel de habitaciones
document.addEventListener('DOMContentLoaded', function() {
  const roomsCarousel = document.querySelector('.rooms-carousel-wrapper');
  const roomsSlides = document.querySelectorAll('.rooms-carousel-slide');
  const roomsPrevBtn = document.querySelector('.rooms-carousel-btn.prev');
  const roomsNextBtn = document.querySelector('.rooms-carousel-btn.next');
  const roomsIndicators = document.querySelectorAll('.rooms-indicator');
  
  if (!roomsCarousel || roomsSlides.length === 0) return;
  
  let currentRoomsSlide = 0;
  const totalRoomsSlides = roomsSlides.length;
  
  // Función para actualizar el carrusel de habitaciones
  function updateRoomsCarousel() {
    if (roomsCarousel) {
      // Calcular el desplazamiento para mostrar 3 imágenes a la vez
      const slideWidth = 33.333; // 100% / 3
      const offset = currentRoomsSlide * slideWidth;
      roomsCarousel.style.transform = `translateX(-${offset}%)`;
    }
    
    // Actualizar indicadores
    roomsIndicators.forEach((indicator, index) => {
      indicator.classList.toggle('active', index === currentRoomsSlide);
    });
    
    // Actualizar clases active en slides
    roomsSlides.forEach((slide, index) => {
      slide.classList.toggle('active', index === currentRoomsSlide);
    });
  }
  
  // Función para mover el carrusel
  function moveRoomsCarousel(direction) {
    currentRoomsSlide += direction;
    
    // Limitar el rango de slides
    if (currentRoomsSlide >= totalRoomsSlides - 2) {
      currentRoomsSlide = totalRoomsSlides - 3;
    } else if (currentRoomsSlide < 0) {
      currentRoomsSlide = 0;
    }
    
    updateRoomsCarousel();
  }
  
  // Función para ir a una slide específica
  function goToRoomsSlide(slideIndex) {
    currentRoomsSlide = slideIndex - 1;
    
    // Limitar el rango
    if (currentRoomsSlide >= totalRoomsSlides - 2) {
      currentRoomsSlide = totalRoomsSlides - 3;
    } else if (currentRoomsSlide < 0) {
      currentRoomsSlide = 0;
    }
    
    updateRoomsCarousel();
  }
  
  // Botón siguiente
  if (roomsNextBtn) {
    roomsNextBtn.addEventListener('click', () => {
      moveRoomsCarousel(1);
    });
  }
  
  // Botón anterior
  if (roomsPrevBtn) {
    roomsPrevBtn.addEventListener('click', () => {
      moveRoomsCarousel(-1);
    });
  }
  
  // Indicadores
  roomsIndicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
      goToRoomsSlide(index + 1);
    });
  });
  
  // Auto-play para el carrusel de habitaciones
  setInterval(() => {
    moveRoomsCarousel(1);
  }, 4000);
  
  // Inicializar
  updateRoomsCarousel(false);
  
  // Hacer las funciones globales para los onclick del HTML
  window.moveRoomsCarousel = moveRoomsCarousel;
  window.currentRoomsSlide = goToRoomsSlide;
}); 

// Funcionalidad del carrusel de eventos
document.addEventListener('DOMContentLoaded', function() {
  const eventsCarousel = document.querySelector('.events-carousel-wrapper');
  const eventsSlides = document.querySelectorAll('.events-carousel-slide');
  const eventsPrevBtn = document.querySelector('.events-carousel-btn.prev');
  const eventsNextBtn = document.querySelector('.events-carousel-btn.next');
  const eventsIndicators = document.querySelectorAll('.events-indicator');
  
  if (!eventsCarousel || eventsSlides.length === 0) return;
  
  let currentEventsSlide = 0;
  const totalEventsSlides = eventsSlides.length;
  
  // Función para actualizar el carrusel de eventos
  function updateEventsCarousel() {
    if (eventsCarousel) {
      // Calcular el desplazamiento para mostrar 3 imágenes a la vez
      const slideWidth = 33.333; // 100% / 3
      const offset = currentEventsSlide * slideWidth;
      eventsCarousel.style.transform = `translateX(-${offset}%)`;
    }
    
    // Actualizar indicadores
    eventsIndicators.forEach((indicator, index) => {
      indicator.classList.toggle('active', index === currentEventsSlide);
    });
    
    // Actualizar clases active en slides
    eventsSlides.forEach((slide, index) => {
      slide.classList.toggle('active', index === currentEventsSlide);
    });
  }
  
  // Función para mover el carrusel
  function moveEventsCarousel(direction) {
    currentEventsSlide += direction;
    
    // Limitar el rango de slides
    if (currentEventsSlide >= totalEventsSlides - 2) {
      currentEventsSlide = totalEventsSlides - 3;
    } else if (currentEventsSlide < 0) {
      currentEventsSlide = 0;
    }
    
    updateEventsCarousel();
  }
  
  // Función para ir a una slide específica
  function goToEventsSlide(slideIndex) {
    currentEventsSlide = slideIndex - 1;
    
    // Limitar el rango
    if (currentEventsSlide >= totalEventsSlides - 2) {
      currentEventsSlide = totalEventsSlides - 3;
    } else if (currentEventsSlide < 0) {
      currentEventsSlide = 0;
    }
    
    updateEventsCarousel();
  }
  
  // Botón siguiente
  if (eventsNextBtn) {
    eventsNextBtn.addEventListener('click', () => {
      moveEventsCarousel(1);
    });
  }
  
  // Botón anterior
  if (eventsPrevBtn) {
    eventsPrevBtn.addEventListener('click', () => {
      moveEventsCarousel(-1);
    });
  }
  
  // Indicadores
  eventsIndicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
      goToEventsSlide(index + 1);
    });
  });
  
  // Auto-play para el carrusel de eventos
  setInterval(() => {
    moveEventsCarousel(1);
  }, 4000);
  
  // Inicializar
  updateEventsCarousel();
  
  // Hacer las funciones globales para los onclick del HTML
  window.moveEventsCarousel = moveEventsCarousel;
  window.currentEventsSlide = goToEventsSlide;
}); 