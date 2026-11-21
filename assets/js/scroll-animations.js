/**
 * ScrollTrigger анимации появления секций (Стабильная версия)
 * Без invalidateOnRefresh, чтобы не крашиться при lazy-load картинках
 */
document.addEventListener('DOMContentLoaded', function () {
    // 1. Если GSAP нет — делаем всё видимым сразу и выходим
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        document.querySelectorAll('.animate-on-scroll, .animate-child').forEach(el => {
            el.style.opacity = '1';
            el.style.transform = 'none';
        });
        return;
    }

    // 2. Если на странице нет наших секций — выходим, не трогая ScrollTrigger
    if (!document.querySelector('.animate-on-scroll')) {
        return;
    }

    gsap.registerPlugin(ScrollTrigger);

    // 3. Анимация секций (простой fromTo, без сложных таймлайнов)
    document.querySelectorAll('.animate-on-scroll').forEach(section => {
        const children = section.querySelectorAll('.animate-child');
        
        // Анимация самой секции
        gsap.fromTo(section,
            { opacity: 0, y: 60 },
            {
                opacity: 1, y: 0, duration: 0.8, ease: 'power3.out',
                scrollTrigger: { trigger: section, start: 'top 85%', once: true }
            }
        );

        // Анимация дочерних элементов с небольшой задержкой
        if (children.length) {
            gsap.fromTo(children,
                { opacity: 0, y: 30 },
                { 
                    opacity: 1, y: 0, duration: 0.6, stagger: 0.1, ease: 'power2.out', 
                    delay: 0.2, // Простая задержка вместо сложного timeline
                    scrollTrigger: { trigger: section, start: 'top 85%', once: true }
                }
            );
        }
    });

    // 4. Киллер-фича (только если элемент есть на странице)
    const showcaseDish = document.querySelector('.showcase__dish.active');
    if (showcaseDish) {
        gsap.fromTo(showcaseDish,
            { scale: 0.3, rotation: -30, opacity: 0 },
            {
                scale: 1, rotation: -5, opacity: 1, duration: 1.2, ease: 'back.out(1.4)',
                scrollTrigger: { trigger: '.showcase', start: 'top 70%', once: true }
            }
        );
    }

    // 5. Карточки меню
    const menuCards = document.querySelectorAll('.dish-card');
    if (menuCards.length) {
        gsap.fromTo(menuCards,
            { opacity: 0, y: 50, scale: 0.9 },
            {
                opacity: 1, y: 0, scale: 1, duration: 0.6, stagger: 0.1, ease: 'power3.out',
                scrollTrigger: { trigger: '.menu__grid', start: 'top 85%', once: true }
            }
        );
    }

    // 6. Отзывы
    const reviewCards = document.querySelectorAll('.review-card');
    if (reviewCards.length) {
        gsap.fromTo(reviewCards,
            { opacity: 0, x: -30 },
            {
                opacity: 1, x: 0, duration: 0.6, stagger: 0.15, ease: 'power2.out',
                scrollTrigger: { trigger: '.reviews__grid', start: 'top 85%', once: true }
            }
        );
    }

    // 7. БЕЗОПАСНЫЙ refresh после загрузки страницы
    // Даём 500мс на то, чтобы lazy-картинки встали на место, затем тихо обновляем триггеры
    window.addEventListener('load', () => {
        setTimeout(() => {
            try {
                ScrollTrigger.refresh();
            } catch (e) {
                // Игнорируем ошибки refresh, чтобы не ломать сайт
                console.warn('ScrollTrigger refresh skipped');
            }
        }, 500);
    });
});