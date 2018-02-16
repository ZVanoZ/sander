describe('Тест', function() {
	before(function() {
		console.log('Начало всех тестов');
	});
	after(function() {
		console.log('Окончание всех тестов');
	});

	beforeEach(function() {
		console.log('Вход в тест');
	});
	afterEach(function() {
		console.log('Выход из теста');
	});
	it('Тест №1', function() {
		console.log('Тест №1');
		chai.assert.equal(1, 1);
	});
	describe('Тест №2', function() {
		console.log('Тест №2');
		it('Тест №2.1', function() {
			console.log('Тест №2.1');
			chai.assert.equal(1, 1);
		});
		it('Тест №2.2', function() {
			console.log('Тест №2.2');
			chai.assert.equal(1, 2);
		});
	});
});
