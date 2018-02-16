describe("pow", function() {
	
	it("Возводит x в степень n", function() {
		var x = 5;
		
		var result = x;
		assert.equal(pow(x, 1), result);
		
		result *= x;
		assert.equal(pow(x, 2), result);
		
		result *= x;
		assert.equal(pow(x, 3), result);
	});
	
});
