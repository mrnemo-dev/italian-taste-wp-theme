<?php
/**
 * Шаблон секции "Бронирование"
 */
?>
<section class="booking animate-on-scroll" id="booking">
    <!-- Волна сверху -->
    <div class="booking__wave" aria-hidden="true">
        <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path d="M0,50 C360,100 720,0 1080,50 C1260,75 1380,60 1440,50 L1440,0 L0,0 Z" fill="var(--color-bg-primary)"/>
        </svg>
    </div>

    <div class="booking__container">
        <div class="booking__content">
            <span class="booking__eyebrow">Забронируйте столик</span>
            <h2 class="booking__title">Ваш вечер в Italian Taste</h2>
            <p class="booking__desc">Оставьте заявку, и мы перезвоним вам в течение 15 минут, чтобы подтвердить бронирование.</p>
            
            <ul class="booking__features">
                <li>✓ Без предоплаты</li>
                <li>✓ Подтверждение по SMS</li>
                <li>✓ Отмена за 2 часа</li>
            </ul>
        </div>

        <div class="booking__form-wrapper">
            <form class="booking-form" id="bookingForm">
                <div class="booking-form__group">
                    <label for="name">Ваше имя</label>
                    <input type="text" id="name" name="name" required placeholder="Иван Иванов">
                </div>
                
                <div class="booking-form__group">
                    <label for="phone">Телефон</label>
                    <input type="tel" id="phone" name="phone" required placeholder="+7 (999) 000-00-00">
                </div>

                <div class="booking-form__row">
                    <div class="booking-form__group">
                        <label for="date">Дата</label>
                        <!-- type="text" позволяет Flatpickr полностью контролировать поле без конфликтов с браузером -->
                        <input type="text" id="date" name="date" required placeholder="ДД.ММ.ГГГГ" autocomplete="off">
                    </div>
                    <div class="booking-form__group">
                        <label for="time">Время</label>
                        <select id="time" name="time" required>
                            <option value="" disabled selected>Выберите время</option>
                            <option value="18:00">18:00</option>
                            <option value="19:00">19:00</option>
                            <option value="20:00">20:00</option>
                            <option value="21:00">21:00</option>
                        </select>
                    </div>
                </div>

                <div class="booking-form__group">
                    <label for="guests">Количество гостей</label>
                    <select id="guests" name="guests" required>
                        <option value="" disabled selected>Выберите количество</option>
                        <option value="2">2 персоны</option>
                        <option value="3">3 персоны</option>
                        <option value="4">4 персоны</option>
                        <option value="5+">5+ персон</option>
                    </select>
                </div>

                <button type="submit" class="btn btn--primary btn--full">Забронировать</button>
            </form>
        </div>
    </div>
</section>

<script>
    // Простая заглушка для формы
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Спасибо! Ваша заявка принята. Мы скоро свяжемся с вами.');
        this.reset();
    });
</script>