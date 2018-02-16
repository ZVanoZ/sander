'use strict';
describe('Тест', function() {
	before(function() {
		add2log('Начало всех тестов');
	});
	after(function() {
		add2log('Окончание всех тестов');
	});
	beforeEach(function() {
		add2log('Вход в тест');
		add2log(this.currentTest);
	});
	afterEach(function() {
		add2log('Выход из теста');
	});
	describe('chai.assert(...)', function() {
		add2log(this);
		it('(true)', function() {
			chai.assert(true);
		});
		it('(false)', function() {
			chai.assert(false);
		});
		it('(1)', function() {
			chai.assert(1);
		});
		it('(0)', function() {
			chai.assert(0);
		});
		it('("")', function() {
			chai.assert("");
		});
		it('("1")', function() {
			chai.assert("1");
		});
		it('("0")', function() {
			chai.assert("0");
		});
	});

	describe('chai.assert.equal(...)', function() {
		add2log(this);
		it('(1, 1)', function() {
			chai.assert.equal(1, 1);
		});
		it('(1, "1")', function() {
			chai.assert.equal(1, '1');
		});
		it('(1, 2)', function() {
 			chai.assert.equal(1, 2);
		});
		it('(true, false)', function() {
			chai.assert.equal(true, false);
		});
	});
	describe('chai.assert.strictEqual(...)', function() {
		add2log(this);
		it('(1, 1)', function() {
			chai.assert.strictEqual(1, 1);
		});
		it('(1, "1")', function() {
			chai.assert.strictEqual(1, '1');
		});
	});
	describe('chai.assert.notEqual(...)', function() {
		add2log(this);
	});
	describe('chai.assert.notStrictEqual(...)', function() {
		add2log(this);
	});
	describe('chai.assert.isTrue(...)', function() {
		add2log(this);
	});
	describe('chai.assert.isFalse(...)', function() {
		add2log(this);
	});
	describe('chai.assert.fail(...)', function() {
		add2log(this);
	});
	describe('chai.assert.isOk(...)', function() {
		add2log(this);
	});
	function add2log(entity) {
		if ('string' === typeof (entity)) {
			console.log(entity);
		} else if (entity instanceof Mocha.Suite) {
			/**
			 *
			 * @type {Mocha.Suite}
			 */
			var entityMochaSuit = entity;
			console.log('---Группа тестов: ', entityMochaSuit.title);
		} else if (entity instanceof Mocha.Test) {
			/**
			 * @type {Mocha.Test}
			 */
			var entityMochaTest = entity;
			console.log('Тест:', entityMochaTest.title);
		} else if ('object' === typeof entity && 'test' in entity && entity.test instanceof Mocha.Test) {
			add2log(entityMochaTest.test);
		} else {
			console.log('Неизвестый тип entity', arguments)
		}
	}
});
