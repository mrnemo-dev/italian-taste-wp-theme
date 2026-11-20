/**
 * Инициализация Flatpickr для поля даты с русской локалью
 */
document.addEventListener('DOMContentLoaded', function() {
    if (typeof flatpickr === 'undefined') return;
    
    // Подключаем русскую локаль (если она загрузилась)
    if (typeof flatpickr.l10ns !== 'undefined' && flatpickr.l10ns.ru) {
        flatpickr.localize(flatpickr.l10ns.ru);
    }
    
    flatpickr('#date', {
        dateFormat: 'd.m.Y',
        minDate: 'today',
        locale: 'ru',
        disableMobile: true, // Принудительно используем кастомный календарь на всех устройствах
        allowInput: false    // Запрещаем ручной ввод, только выбор из календаря
    });
});