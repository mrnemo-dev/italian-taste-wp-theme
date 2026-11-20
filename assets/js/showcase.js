/**
 * Логика "Летающей витрины"
 * Киллер-фича: блюдо физически перемещается, вращается и меняет масштаб.
 */

(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', () => {
        if (typeof gsap === 'undefined') return;

        const dishes = document.querySelectorAll('.showcase__dish');
        const thumbs = document.querySelectorAll('.showcase__thumb');
        
        // Элементы текста для анимации
        const textElements = {
            rank: document.querySelector('.showcase__rank'),
            name: document.querySelector('.showcase__dish-name'),
            score: document.querySelector('.showcase__score'),
            chefName: document.querySelector('.showcase__chef-name'),
            chefDesc: document.querySelector('.showcase__chef-desc'),
        };

        // Данные для обновления текста (дублируем из PHP)
        const dishData = [
            { 
                rank: '#1 Most loved dish', 
                name: 'Тальятелле с трюфелем', 
                score: '4.9', 
                chef: 'Шеф Марко', 
                desc: 'Домашняя паста с чёрным трюфелем, пармезаном и сливочным соусом.',
                time: '25 мин',
                difficulty: 'Средняя',
                servings: '2 порции',
                calories: '650 ккал'
            },
            { 
                rank: '#2 Most loved dish', 
                name: 'Равиоли с рикоттой', 
                score: '4.8', chef: 'Шеф Лука', 
                desc: 'Равиоли с начинкой из рикотты и шпината в соусе из шалфея.',        
                time: '25 мин',
                difficulty: 'Средняя',
                servings: '2 порции',
                calories: '650 ккал' 
            },
            { 
                rank: '#3 Most loved dish', 
                name: 'Пицца Маргарита', 
                score: '4.9', chef: 'Шеф Джованни', 
                desc: 'Классическая неаполитанская пицца с моцареллой, томатами и базиликом.', 
                time: '25 мин',
                difficulty: 'Средняя',
                servings: '2 порции',
                calories: '650 ккал' 
            },
            { rank: '#4 Most loved dish', 
                name: 'Ризотто алла миланезе', 
                score: '4.7', chef: 'Шеф Алессандро', 
                desc: 'Кремовое ризотто с шафраном, пармезаном и костным мозгом.',
                time: '25 мин',
                difficulty: 'Средняя',
                servings: '2 порции',
                calories: '650 ккал'             
            },
            { rank: '#5 Most loved dish', 
                name: 'Оссобуко', 
                score: '4.8', 
                chef: 'Шеф Франческо', 
                desc: 'Томлёная телячья голяшка с ризотто и гремолатой.',
                time: '25 мин',
                difficulty: 'Средняя',
                servings: '2 порции',
                calories: '650 ккал'             
            },
            { rank: '#6 Most loved dish', 
                name: 'Тирамису', 
                score: '5.0', 
                chef: 'Кондитер София', 
                desc: 'Классический итальянский десерт с маскарпоне, кофе и какао.',
                time: '25 мин',
                difficulty: 'Средняя',
                servings: '2 порции',
                calories: '650 ккал'             
            },
        ];

        let currentIndex = 0;
        let isAnimating = false;

        function switchDish(newIndex) {
            if (isAnimating || newIndex === currentIndex) return;
            isAnimating = true;

            const currentDish = dishes[currentIndex];
            const newDish = dishes[newIndex];
            const data = dishData[newIndex];

            // Создаём timeline
            const tl = gsap.timeline({
                onComplete: () => {
                    currentIndex = newIndex;
                    isAnimating = false;
                }
            });

            // 1. Убираем старое блюдо (улетает влево-вниз)
            tl.to(currentDish, {
                x: -300,
                y: 200,
                rotation: 45,
                scale: 0.2,
                opacity: 0,
                duration: 0.6,
                ease: 'power3.in'
            }, 0);

            // 2. Скрываем старый текст
            tl.to(Object.values(textElements), {
                opacity: 0,
                y: 20,
                duration: 0.3,
                stagger: 0.05
            }, 0);

            // 3. Обновляем текст (пока он невидим)
            tl.call(() => {
                textElements.rank.textContent = data.rank;
                textElements.name.textContent = data.name;
                textElements.score.textContent = data.score;
                textElements.chefName.textContent = data.chef;
                textElements.chefDesc.textContent = data.desc;
                document.getElementById('detailTime').textContent = data.time;
                document.getElementById('detailDifficulty').textContent = data.difficulty;
                document.getElementById('detailServings').textContent = data.servings;
                document.getElementById('detailCalories').textContent = data.calories;
            }, null, 0.3);

            // 4. Влетаем новое блюдо (справа-сверху)
            tl.fromTo(newDish, 
                {
                    x: 300,
                    y: -200,
                    rotation: -30,
                    scale: 0.2,
                    opacity: 0
                },
                {
                    x: 0,
                    y: 0,
                    rotation: -5, // Лёгкий наклон как в референсе
                    scale: 1,
                    opacity: 1,
                    duration: 0.8,
                    ease: 'back.out(1.2)' // Пружинистый эффект в конце
                }, 
                0.2 // Начинаем чуть раньше, чем старое улетит полностью
            );

            // 5. Показываем новый текст
            tl.to(Object.values(textElements), {
                opacity: 1,
                y: 0,
                duration: 0.4,
                stagger: 0.05,
                ease: 'power2.out'
            }, 0.5);

            // Обновляем активную миниатюру
            thumbs.forEach(t => t.classList.remove('active'));
            thumbs[newIndex].classList.add('active');
        }

        // Вешаем клики на миниатюры
        thumbs.forEach((thumb, index) => {
            thumb.addEventListener('click', () => switchDish(index));
        });
    });
})();