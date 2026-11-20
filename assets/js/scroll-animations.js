/**
 * ScrollTrigger анимации для всех секций
 * 
 * Логика:
 * - Все секции с классом .animate-on-scroll начинаются с opacity: 0 и смещением вниз
 * - При появлении в viewport (на 80% высоты экрана) добавляется класс .is-visible
 * - CSS transition делает плавное появление
 * - Дочерние элементы (карточки, заголовки) появляются с задержкой (stagger)
 */

document.addEventListener('DOMContentLoaded', function() {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        console.warn('GSAP или ScrollTrigger не загружены');
        return;
    }

    // Регистрируем плагин
    gsap.registerPlugin(ScrollTrigger);

    // Анимация для всех секций
    const sections = document.querySelectorAll('.animate-on-scroll');
    
    sections.forEach(section => {
        // Находим дочерние элементы для stagger-анимации
        const children = section.querySelectorAll('.animate-child');
        
        // Создаём timeline
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: 'top 80%', // Анимация начинается, когда верх секции на 80% высоты viewport
                end: 'bottom 20%',
                toggleActions: 'play none none none', // Проигрываем один раз
                once: true // Только один раз
            }
        });

        // Анимация самой секции (fade + slide up)
        tl.fromTo(section, 
            {
                opacity: 0,
                y: 60
            },
            {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power3.out'
            }
        );

        // Анимация дочерних элементов с задержкой
        if (children.length > 0) {
            tl.fromTo(children,
                {
                    opacity: 0,
                    y: 30
                },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    stagger: 0.1, // Задержка между элементами
                    ease: 'power2.out'
                },
                '-=0.4' // Начинаем чуть раньше, чем закончится анимация секции
            );
        }
    });

    // Специальная анимация для киллер-фичи (showcase)
    // Блюдо «влетает» с эффектом пружины
    const showcaseDish = document.querySelector('.showcase__dish.active');
    if (showcaseDish) {
        gsap.fromTo(showcaseDish,
            {
                scale: 0.3,
                rotation: -30,
                opacity: 0
            },
            {
                scale: 1,
                rotation: -5,
                opacity: 1,
                duration: 1.2,
                ease: 'back.out(1.4)',
                scrollTrigger: {
                    trigger: '.showcase',
                    start: 'top 70%',
                    once: true
                }
            }
        );
    }

    // Анимация для карточек меню (stagger при появлении)
    const menuCards = document.querySelectorAll('.dish-card');
    if (menuCards.length > 0) {
        gsap.fromTo(menuCards,
            {
                opacity: 0,
                y: 50,
                scale: 0.9
            },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 0.6,
                stagger: 0.1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.menu__grid',
                    start: 'top 80%',
                    once: true
                }
            }
        );
    }

    // Анимация для отзывов (карточки появляются по очереди)
    const reviewCards = document.querySelectorAll('.review-card');
    if (reviewCards.length > 0) {
        gsap.fromTo(reviewCards,
            {
                opacity: 0,
                x: -30
            },
            {
                opacity: 1,
                x: 0,
                duration: 0.6,
                stagger: 0.15,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: '.reviews__grid',
                    start: 'top 80%',
                    once: true
                }
            }
        );
    }
});