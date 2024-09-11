<?php

namespace app\modules\control\modules\spygame\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%spygame_words}}`.
 */
class M240911211540CreateSpygameWordsTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $defaultData = '[{"id":1,"name":"Железный человек","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":2,"name":"Хищник","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":3,"name":"Хрустальная туфелька","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":4,"name":"Терминатор","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":5,"name":"Маша и медведь","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":6,"name":"Астрал (фильм)","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":7,"name":"Чужой (фильм)","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":8,"name":"Один дома (фильм)","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":9,"name":"Звонок (фильм)","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":10,"name":"Последний богатырь","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":11,"name":"Форсаж","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":12,"name":"Доминик Торетто","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":13,"name":"Зелёная Миля","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":14,"name":"Бригада","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":15,"name":"Мир юрского периода (Динозавр)","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":16,"name":"Пила (фильм)","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":17,"name":"Крик (фильм)","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":18,"name":"Фреди Крюгер","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":19,"name":"Халк (фильм)","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":20,"name":"Кот в сапогах","category_id":1,"created_at":"2023-12-27 18:31:34","updated_at":"2023-12-27 18:31:34"},{"id":21,"name":"Египет","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":22,"name":"Дания","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":23,"name":"Италия","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":24,"name":"Дубай","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":25,"name":"Россия","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":26,"name":"Америка","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":27,"name":"Франция","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":28,"name":"Корея","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":29,"name":"Китай","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":30,"name":"Швеция","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":31,"name":"Индия","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":32,"name":"Армения","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":33,"name":"Казахстан","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":34,"name":"Колумбия","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":35,"name":"Венгрия","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":36,"name":"Украина","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":37,"name":"Азербайджан","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":38,"name":"Исландия","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":39,"name":"Португалия","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":40,"name":"Чехия","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":41,"name":"Монако","category_id":8,"created_at":"2023-12-27 18:33:09","updated_at":"2023-12-27 18:33:09"},{"id":42,"name":"Гардеробная","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":43,"name":"Чердак","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":44,"name":"Гараж","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":45,"name":"Туалет","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":46,"name":"Прихожая","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":47,"name":"Ванная","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":48,"name":"Гостинная","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":49,"name":"Детская площадка","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":50,"name":"Кладовка","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":51,"name":"Спальня","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":52,"name":"Балкон","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":53,"name":"Задний двор","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":54,"name":"Кухня","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":55,"name":"Подвал","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":56,"name":"Пол","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":57,"name":"Книжный шкаф","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":58,"name":"Диван","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":59,"name":"Стол","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":60,"name":"Душевая кабина","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":61,"name":"Ступеньки","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":62,"name":"Кофемашина","category_id":9,"created_at":"2023-12-27 18:34:00","updated_at":"2023-12-27 18:34:00"},{"id":63,"name":"Зоопарк","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":64,"name":"Банк","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":65,"name":"Пляж","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":66,"name":"Больница","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":67,"name":"Супермаркет","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":68,"name":"Полицейский участок","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":69,"name":"Посольство","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":70,"name":"Ресторан","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":71,"name":"Отель","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":72,"name":"Школа","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":73,"name":"Церковь","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":74,"name":"Университет","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":75,"name":"Казино","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":76,"name":"Овощебаза","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":77,"name":"Театр","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":78,"name":"Цирк-шапито","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":79,"name":"Автосервис","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":80,"name":"Тир","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":81,"name":"Ботанический сад","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":82,"name":"Смотровая площадка","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":83,"name":"Институт","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":84,"name":"Аптека","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":85,"name":"Пешеходный переход","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":86,"name":"Парикмахерская","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":87,"name":"Стомотологическая клиника","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":88,"name":"Ветеренарная клиника","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":89,"name":"Химчистка","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":90,"name":"Почтовое отделение","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":91,"name":"Банкомат","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":92,"name":"Фонтан","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":93,"name":"Мечеть","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":94,"name":"Заправка","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":95,"name":"Мост","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":96,"name":"Газетный киоск","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":97,"name":"Лифт","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":98,"name":"Подземный переход","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":99,"name":"Рынок","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":100,"name":"Салон красоты","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":101,"name":"Книжный магазин","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":102,"name":"Автомойка","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":103,"name":"Строительный магазин","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":104,"name":"Зоомагазин","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":105,"name":"Парковка","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":106,"name":"Мебельный магазин","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":107,"name":"Ферма","category_id":10,"created_at":"2023-12-27 18:34:33","updated_at":"2023-12-27 18:34:33"},{"id":108,"name":"Лес","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":109,"name":"Горы","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":110,"name":"Пустыня","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":111,"name":"Остров","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":112,"name":"звонок","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":113,"name":"Океан","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":114,"name":"Ледник","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":115,"name":"Поле","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":116,"name":"Сад","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":117,"name":"Джунгли","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":118,"name":"Вулкан","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":119,"name":"Саввана","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":120,"name":"Река","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":121,"name":"Пещера","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":122,"name":"Набережная реки","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":123,"name":"Дорога","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":124,"name":"Город","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":125,"name":"Деревня","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":126,"name":"Холм","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":127,"name":"Ущелье","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":128,"name":"Равнина","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":129,"name":"Экватор","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":130,"name":"Оазис","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":131,"name":"Скала","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":132,"name":"Причал","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":133,"name":"Ручей","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":134,"name":"Водопад","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":135,"name":"Каньон","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":136,"name":"Лагуна","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":137,"name":"Залив","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":138,"name":"Тунель","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":139,"name":"Болото","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":140,"name":"Пруд","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":141,"name":"Айсберг","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":142,"name":"Арктика","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":143,"name":"Кратер","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":144,"name":"Берег","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":145,"name":"Ветер","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":146,"name":"Торнадо","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":147,"name":"Материк","category_id":11,"created_at":"2023-12-27 18:35:21","updated_at":"2023-12-27 18:35:21"},{"id":148,"name":"Автобус","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":149,"name":"Троллейбус","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":150,"name":"Камаз","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":151,"name":"Каток","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":152,"name":"Бур Машина","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":153,"name":"Лодка","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":154,"name":"Трамвай","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":155,"name":"Трактор","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":156,"name":"Самолёт","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":157,"name":"Вертолёт","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":158,"name":"Воздушный шар","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":159,"name":"Подводная лодка","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":160,"name":"Мотоцикл","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":161,"name":"Гидроцикл","category_id":2,"created_at":"2023-12-27 18:35:37","updated_at":"2023-12-27 18:35:37"},{"id":162,"name":"Футбол","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":163,"name":"Волейбол","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":164,"name":"Хоккей","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":165,"name":"Плавание","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":166,"name":"Бобслей","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":167,"name":"Гольф","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":168,"name":"Дзюдо","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":169,"name":"Бокс","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":170,"name":"Киберспорт","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":171,"name":"Шахматы","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":172,"name":"Велоспорт","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":173,"name":"Бильярд","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":174,"name":"Акробатика","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":175,"name":"Боулинг","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":176,"name":"Кёрлинг","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":177,"name":"Легкая атлетика","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":178,"name":"Покер","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":179,"name":"Рыболовля","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":180,"name":"Сумо","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":181,"name":"Стрельба (спорт)","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"},{"id":182,"name":"Конькобежный спорт","category_id":12,"created_at":"2023-12-27 18:36:21","updated_at":"2023-12-27 18:36:21"}]';
        $data = json_decode($defaultData, true);

        $this->createTable('{{%spygame_words}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        $this->batchInsert('{{%spygame_words}}', ['id', 'name', 'category_id', 'created_at', 'updated_at'], $data);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%spygame_words}}');
    }
}
