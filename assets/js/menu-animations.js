/**
 * GSAP-анимации для секции "Меню"
 * 
 * Анимации:
 * 1. Entrance — карточки появляются по очереди при загрузке
 * 2. Filter — плавное переключение категорий
 * 3. Hover — эффект "приподнимания" карточки
 */

(function () {
    'use strict';

    // Ждём загрузки DOM и GSAP
    document.addEventListener('DOMContentLoaded', () => {
        // Проверяем, что GSAP загружен
        if (typeof gsap === 'undefined') {
            console.warn('GSAP не загружен, анимации отключены');
            return;
        }

        initEntranceAnimation();
        initFilterAnimation();
        initHoverAnimation();
    });

    /**
     * 1. Entrance Animation — staggered появление карточек
     * 
     * Почему stagger: карточки появляются не все сразу, а по очереди
     * с задержкой 0.1s. Это создаёт эффект "волны" и привлекает внимание.
     * 
     * Почему from(): анимируем от начального состояния (opacity: 0, y: 50)
     * к текущему (opacity: 1, y: 0). Это проще, чем to().
     */
    function initEntranceAnimation() {
        const cards = document.querySelectorAll('.dish-card');
        
        if (cards.length === 0) return;

        // Устанавливаем начальное состояние (скрыты)
        gsap.set(cards, {
            opacity: 0,
            y: 50,  // Смещены вниз на 50px
            scale: 0.95  // Чуть уменьшены
        });

        // Анимируем появление
        gsap.to(cards, {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 0.6,
            stagger: 0.1,  // Задержка между карточками
            ease: 'power3.out',  // Плавное замедление в конце
            scrollTrigger: {
                trigger: '.menu__grid',
                start: 'top 80%',  // Анимация начинается, когда сетка на 80% viewport
                toggleActions: 'play none none none'
            }
        });
    }

    /**
     * 2. Filter Animation — плавное переключение категорий
     * 
     * Логика:
     * - При клике на фильтр сначала скрываем все карточки (fade out)
     * - Потом показываем нужные (fade in)
     * - Используем timeline для последовательности
     */
    function initFilterAnimation() {
        const filterBtns = document.querySelectorAll('.menu__filter-btn');
        const dishCards = document.querySelectorAll('.dish-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const category = btn.dataset.category;

                // Создаём timeline для последовательной анимации
                const tl = gsap.timeline();

                // Шаг 1: Скрываем все карточки
                tl.to(dishCards, {
                    opacity: 0,
                    scale: 0.8,
                    duration: 0.3,
                    stagger: 0.05,
                    ease: 'power2.in',
                    onComplete: () => {
                        // После скрытия меняем display
                        dishCards.forEach(card => {
                            if (category === 'all' || card.dataset.category === category) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    }
                });

                // Шаг 2: Показываем нужные карточки
                const visibleCards = Array.from(dishCards).filter(card => {
                    return category === 'all' || card.dataset.category === category;
                });

                tl.fromTo(visibleCards, 
                    {
                        opacity: 0,
                        y: 30,
                        scale: 0.9
                    },
                    {
                        opacity: 1,
                        y: 0,
                        scale: 1,
                        duration: 0.5,
                        stagger: 0.08,
                        ease: 'back.out(1.4)',  // Лёгкий "отскок" в конце
                        delay: 0.1
                    }
                );
            });
        });
    }

    /**
     * 3. Hover Animation — эффект "приподнимания" карточки
     * 
     * Почему GSAP, а не CSS transition:
     * - GSAP даёт больше контроля (можно анимировать несколько свойств одновременно)
     * - Можно добавить "пружинистость" (ease: 'back.out')
     * - Легко отменить анимацию при mouseleave
     */
    function initHoverAnimation() {
        const cards = document.querySelectorAll('.dish-card');

        cards.forEach(card => {
            const image = card.querySelector('.dish-card__image img');

            // Mouse enter — карточка приподнимается, фото увеличивается
            card.addEventListener('mouseenter', () => {
                gsap.to(card, {
                    y: -10,  // Приподнимаем на 10px
                    duration: 0.3,
                    ease: 'power2.out'
                });

                gsap.to(image, {
                    scale: 1.1,  // Увеличиваем фото
                    duration: 0.4,
                    ease: 'power2.out'
                });
            });

            // Mouse leave — возвращаем в исходное состояние
            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    y: 0,
                    duration: 0.3,
                    ease: 'power2.out'
                });

                gsap.to(image, {
                    scale: 1,
                    duration: 0.4,
                    ease: 'power2.out'
                });
            });
        });
    }
})();