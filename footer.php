<?php
/**
 * Шаблон футера
 */
?>
<footer class="site-footer" id="contacts">
    <!-- Волна сверху для плавного перехода -->
    <div class="site-footer__wave" aria-hidden="true">
        <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path d="M0,50 C360,100 720,0 1080,50 C1260,75 1380,60 1440,50 L1440,0 L0,0 Z" fill="var(--color-bg-secondary)"/>
        </svg>
    </div>

    <div class="site-footer__container">
        <div class="site-footer__grid">
            <!-- Колонка 1: О нас -->
            <div class="site-footer__col">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo">Italian Taste</a>
                <p class="site-footer__desc">Аутентичная итальянская кухня с доставкой на дом. Вкус, созданный с душой и страстью к традициям.</p>
                <div class="site-footer__socials">
                    <a href="#" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="#" aria-label="Telegram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    </a>
                </div>
            </div>

            <!-- Колонка 2: Навигация -->
            <div class="site-footer__col">
                <h4 class="site-footer__title">Навигация</h4>
                <ul class="site-footer__links">
                    <li><a href="#hero">Главная</a></li>
                    <li><a href="#about">О нас</a></li>
                    <li><a href="#showcase">Популярные блюда</a></li>
                    <li><a href="#booking">Бронирование</a></li>
                </ul>
            </div>

            <!-- Колонка 3: Контакты -->
            <div class="site-footer__col">
                <h4 class="site-footer__title">Контакты</h4>
                <ul class="site-footer__contacts">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>ул. Итальянская, 1, Москва</span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <a href="tel:+79991234567">+7 (999) 123-45-67</a>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <a href="mailto:ciao@italiantaste.ru">ciao@italiantaste.ru</a>
                    </li>
                </ul>
            </div>

            <!-- Колонка 4: Часы работы -->
            <div class="site-footer__col">
                <h4 class="site-footer__title">Часы работы</h4>
                <ul class="site-footer__hours">
                    <li><span>Пн - Пт:</span> <strong>10:00 - 23:00</strong></li>
                    <li><span>Сб - Вс:</span> <strong>11:00 - 01:00</strong></li>
                </ul>
            </div>
        </div>

        <div class="site-footer__bottom">
            <p>&copy; <?php echo date('Y'); ?> Italian Taste. Все права защищены.</p>
            <p class="site-footer__made">Made with ❤️ and 🍝</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>