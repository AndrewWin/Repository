/* Дата создания: 02.05.2016 */

/* Транслитерация */
	function transliteration() { //Объявляем функцию транслитерации
		
		var stroka = document.getElementById("stroka").value; //Получаем введенную строку
		
		var result = ''; //Переменная результата
		
		
		var simvols = { //Объявляем массив символов для последующей замены
			'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',
			'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
			'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
			'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '',
			'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya'
		}
		
		if (stroka != '') { //Если полученная строка не пустая
			stroka = stroka.toLowerCase(); //Переводим все символы в нижний регистр
		}

		for (var i = 0; i < stroka.length; i++){
			if (/[а-яё]/.test(stroka.charAt(i))){ // заменяем символы на русском
				result += simvols[stroka.charAt(i)];
			} else if (/[a-z]/.test(stroka.charAt(i))){ // символы на английском оставляем как есть
				result += stroka.charAt(i);
			} else { //Прочие символы оставляем как есть
				result += stroka.charAt(i);
			}
		}
		if (result.length > 0) { //Если строка результата не пустая
			document.getElementById('zag').style.display = 'block'; //Показываем строку "Результат:"
			document.getElementById('result').style.display = 'block'; //Показываем строку где выводиться сам результат
			document.getElementById('result').innerHTML = result; //Выводим результат в блок "result"
		} else { //Если строка результата пуста
			document.getElementById('zag').style.display = 'none'; //Прячем строку "Результат:"
			document.getElementById('result').style.display = 'none'; //Прячем строку где выводиться сам результат
		}
	}

	
/* Расширение базового объекта String */
	function String(str) { //Класс-объект String
		this.str = str; //Свойство - строка
	}
	String.prototype.analog = function(str) { //Метод, заменяем цифры на цифра-словом буквы (АНАЛОГ по собственному выбору)
		var result = ''; //Переменная результата
		var simvols = { //Объявляем массив символов для последующей замены
			'1': 'один', '2': 'два', '3': 'три', '4': 'четыре', '5': 'пять', '6': 'шесть', '7': 'семь', '8': 'восемь', '9': 'девять', '0': 'ноль'
		}
		for (var i = 0; i < str.length; i++){
			if (/[0-9]/.test(str.charAt(i))){ // находим цифры
				result += simvols[str.charAt(i)];
			} else { //Прочие символы оставляем как есть
				result += str.charAt(i);
			}
		}
		alert("Работает: " + result);
	};
	var string = new String();
	string.analog("1 вот 2 вот 9"); //Вызываем метод замены
	
/* Создание классов с использованием прототипов */
	function Vehicle(marka, model) { //Класс автомобиль
		this.marka = marka; //Свойство - марка автомобиля
		this.model = model; //Свойство - модель автомобиля
	}
	Vehicle.prototype.drive = function() { //Метод ехать для автомобиля
		alert("Автомобиль марки " + this.marka + " модель " + this.model + " едет.");
	};
	Vehicle.prototype.stop = function() { //Метод ехать для автомобиля
		alert("Автомобиль марки " + this.marka + " модель " + this.model + " остановился.");
	};
	Vehicle.prototype.turn = function() { //Метод ехать для автомобиля
		alert("Автомобиль марки " + this.marka + " модель " + this.model + " повернул.");
	};
	/*
	var vehicle = new Vehicle('Subaru', 'Legacy');
	vehicle.drive(); //Вызываем метод ехать
	vehicle.stop();  //Вызываем метод остановиться
	vehicle.turn();	 //Вызываем метод повернуть
	*/
	
	
	function Passenger(mesta) { //Класс легковой
		this.mesta = mesta; //Свойство - количество пассажирских мест
	}
	Passenger.prototype = Object.create(Vehicle.prototype); //Наследуемся от класса Автомобиль
	Passenger.prototype.constructor = Vehicle; //Сохраняем конструктор
	
	Passenger.prototype.seat = function() { //Метод посадить пассажиров для легковой
		alert("Легковой автомобиль марки " + this.marka + " модель " + this.model + " посадил " + this.mesta + " пассажиров.");
	};
	Passenger.prototype.land = function() { //Метод высадить пассажиров для легковой
		alert("Легковой автомобиль марки " + this.marka + " модель " + this.model + " высадил " + this.mesta + " пассажиров.");
	};
	/*
	var passenger = new Passenger(7);
	passenger.marka = "Mitsubishi";  //Переопределяем свойства
	passenger.model = "Pajero";      //Переопределяем свойства
	passenger.seat(); //Вызываем метод посадить пассажиров
	passenger.land(); //Вызываем метод высадить пассажиров
	*/
	
	
	function Cargo(max) { //Класс грузовой
		this.max = max; //Свойство - максимальная грузоподъемность в тоннах
	}
	Cargo.prototype = Object.create(Vehicle.prototype); //Наследуемся от класса Автомобиль
	Cargo.prototype.constructor = Vehicle; //Сохраняем конструктор
	
	Cargo.prototype.load = function() { //Метод загрузить для грузовой
		alert("Грузовой автомобиль марки " + this.marka + " модель " + this.model + " загрузил  " + this.max + " тонн.");
	};
	Cargo.prototype.unload = function() { //Метод разгрузить для грузовой
		alert("Грузовой автомобиль марки " + this.marka + " модель " + this.model + " разгрузил " + this.max + " тонн.");
	};
	var cargo = new Cargo(20);
	cargo.marka = "Saab"; //Переопределяем свойства
	cargo.model = "9000"; //Переопределяем свойства
	cargo.load(); //Вызываем метод загрузить
	cargo.unload(); //Вызываем метод разгрузить
	
	
	function Sport(max) { //Класс спортивный
		this.max = max; //Свойство - максимальная скорость
	}
	Sport.prototype = Object.create(Passenger.prototype); //Наследуемся от класса Легковой
	Sport.prototype.constructor = Passenger; //Сохраняем конструктор
	
	Sport.prototype.onspeed = function() { //Метод включить ускорение для спортивной
		alert("Спортивный автомобиль марки " + this.marka + " модель " + this.model + " с количеством сидячих мест: " + this.mesta + ", включил ускорение, теперь его скорость " + this.max + " км/ч.");
	};
	var sport = new Sport(210);
	sport.marka = "Toyota"; //Переопределяем свойства
	sport.model = "Celica"; //Переопределяем свойства
	sport.mesta = "2";      //Переопределяем свойства наследованного класса легковой
	sport.onspeed(); //Вызываем метод загрузить
	
	