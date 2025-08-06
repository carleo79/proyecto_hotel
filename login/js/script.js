// Funcionalidades del sistema de login
document.addEventListener('DOMContentLoaded', function() {
    
    // Validación de contraseñas en el formulario de registro
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    
    if (passwordInput && confirmPasswordInput) {
        function validatePasswords() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            
            if (confirmPassword && password !== confirmPassword) {
                confirmPasswordInput.setCustomValidity('Las contraseñas no coinciden');
            } else {
                confirmPasswordInput.setCustomValidity('');
            }
        }
        
        passwordInput.addEventListener('input', validatePasswords);
        confirmPasswordInput.addEventListener('input', validatePasswords);
    }
    
    // Mostrar/ocultar contraseña
    const passwordFields = document.querySelectorAll('input[type="password"]');
    passwordFields.forEach(field => {
        const toggleBtn = document.createElement('button');
        toggleBtn.type = 'button';
        toggleBtn.className = 'password-toggle';
        toggleBtn.innerHTML = '👁️';
        toggleBtn.style.cssText = `
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #666;
        `;
        
        const fieldContainer = field.parentElement;
        fieldContainer.style.position = 'relative';
        fieldContainer.appendChild(toggleBtn);
        
        toggleBtn.addEventListener('click', function() {
            if (field.type === 'password') {
                field.type = 'text';
                toggleBtn.innerHTML = '🙈';
            } else {
                field.type = 'password';
                toggleBtn.innerHTML = '👁️';
            }
        });
    });
    
    // Animaciones de entrada para las alertas
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        alert.style.transition = 'all 0.3s ease';
        
        setTimeout(() => {
            alert.style.opacity = '1';
            alert.style.transform = 'translateY(0)';
        }, 100);
    });
    
    // Auto-hide alerts after 5 seconds
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    });
    
    // Validación en tiempo real del email
    const emailInput = document.getElementById('email');
    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (email && !emailRegex.test(email)) {
                this.style.borderColor = '#c53030';
                this.style.boxShadow = '0 0 0 3px rgba(197, 48, 48, 0.1)';
            } else {
                this.style.borderColor = '#e1e5e9';
                this.style.boxShadow = 'none';
            }
        });
        
        emailInput.addEventListener('focus', function() {
            this.style.borderColor = '#667eea';
            this.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.1)';
        });
    }
    
    // Efectos hover en botones
    const buttons = document.querySelectorAll('.login-btn, .action-card');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Sidebar toggle para móviles
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    
    if (sidebar && mainContent) {
        // Crear botón de toggle para móviles
        const toggleBtn = document.createElement('button');
        toggleBtn.innerHTML = '☰';
        toggleBtn.className = 'sidebar-toggle';
        toggleBtn.style.cssText = `
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 20px;
            cursor: pointer;
            display: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        `;
        
        document.body.appendChild(toggleBtn);
        
        // Mostrar botón solo en móviles
        function checkMobile() {
            if (window.innerWidth <= 768) {
                toggleBtn.style.display = 'block';
                sidebar.style.transform = 'translateX(-100%)';
            } else {
                toggleBtn.style.display = 'none';
                sidebar.style.transform = 'translateX(0)';
            }
        }
        
        checkMobile();
        window.addEventListener('resize', checkMobile);
        
        // Toggle sidebar
        toggleBtn.addEventListener('click', function() {
            if (sidebar.style.transform === 'translateX(-100%)' || !sidebar.style.transform) {
                sidebar.style.transform = 'translateX(0)';
                toggleBtn.innerHTML = '✕';
            } else {
                sidebar.style.transform = 'translateX(-100%)';
                toggleBtn.innerHTML = '☰';
            }
        });
        
        // Cerrar sidebar al hacer clic fuera
        mainContent.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                sidebar.style.transform = 'translateX(-100%)';
                toggleBtn.innerHTML = '☰';
            }
        });
    }
    
    // Contador de caracteres para contraseña
    const passwordField = document.getElementById('password');
    if (passwordField) {
        const counter = document.createElement('div');
        counter.className = 'password-counter';
        counter.style.cssText = `
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            text-align: right;
        `;
        
        passwordField.parentElement.appendChild(counter);
        
        passwordField.addEventListener('input', function() {
            const length = this.value.length;
            const minLength = 8;
            
            if (length < minLength) {
                counter.style.color = '#c53030';
                counter.textContent = `${length}/${minLength} caracteres (mínimo ${minLength})`;
            } else {
                counter.style.color = '#38a169';
                counter.textContent = `${length}/${minLength} caracteres ✓`;
            }
        });
    }
    
    // Prevenir envío de formulario con Enter en campos de texto
    const textInputs = document.querySelectorAll('input[type="text"], input[type="email"]');
    textInputs.forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const nextInput = this.parentElement.nextElementSibling?.querySelector('input');
                if (nextInput) {
                    nextInput.focus();
                }
            }
        });
    });
    
    // Animación de carga en botones de envío
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '⏳ Procesando...';
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.7';
            }
        });
    });
    
    // Tooltip para información adicional
    const infoElements = document.querySelectorAll('[data-tooltip]');
    infoElements.forEach(element => {
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip';
        tooltip.textContent = element.getAttribute('data-tooltip');
        tooltip.style.cssText = `
            position: absolute;
            background: #333;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            white-space: nowrap;
        `;
        
        element.style.position = 'relative';
        element.appendChild(tooltip);
        
        element.addEventListener('mouseenter', function() {
            tooltip.style.opacity = '1';
        });
        
        element.addEventListener('mouseleave', function() {
            tooltip.style.opacity = '0';
        });
    });
    
    // Auto-focus en el primer campo del formulario
    const firstInput = document.querySelector('input[type="email"], input[type="text"]');
    if (firstInput && !firstInput.value) {
        setTimeout(() => {
            firstInput.focus();
        }, 500);
    }
    
    // Validación de fuerza de contraseña
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    passwordInputs.forEach(input => {
        input.addEventListener('input', function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);
            updatePasswordStrengthIndicator(this, strength);
        });
    });
    
    function calculatePasswordStrength(password) {
        let score = 0;
        
        if (password.length >= 8) score++;
        if (/[a-z]/.test(password)) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;
        
        return score;
    }
    
    function updatePasswordStrengthIndicator(input, strength) {
        let indicator = input.parentElement.querySelector('.password-strength');
        
        if (!indicator) {
            indicator = document.createElement('div');
            indicator.className = 'password-strength';
            indicator.style.cssText = `
                margin-top: 5px;
                font-size: 12px;
            `;
            input.parentElement.appendChild(indicator);
        }
        
        const strengthTexts = ['Muy débil', 'Débil', 'Regular', 'Buena', 'Excelente'];
        const strengthColors = ['#c53030', '#e53e3e', '#dd6b20', '#38a169', '#38a169'];
        
        indicator.textContent = strengthTexts[strength - 1] || 'Muy débil';
        indicator.style.color = strengthColors[strength - 1] || '#c53030';
    }
});

// Funciones de utilidad
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        z-index: 10000;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    if (type === 'success') {
        notification.style.background = '#38a169';
    } else if (type === 'error') {
        notification.style.background = '#c53030';
    } else {
        notification.style.background = '#667eea';
    }
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Exportar funciones para uso global
window.showNotification = showNotification; 