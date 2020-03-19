function sprint(text, args) {
	var newStr = text;
	for (var key in args) {
		newStr = newStr.replace(new RegExp('{' + key + '}', 'gi'), args[key]);
	}
	return newStr;
}
String.prototype.allReplace = function(obj) {
	var retStr = this;
	for (var x in obj) {
		retStr = retStr.replace(new RegExp(x, 'g'), obj[x]);
	}
	return retStr;
};