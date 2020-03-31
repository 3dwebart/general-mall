<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Document</title>
</head>
<body>
json
</body>
<script src="https://code.jquery.com/jquery.js"></script>
<script>
var json = {
	data1: 'data1',
	data2: 'data2',
	data3: {
		subData1: 'sub data1',
		subData2: 'sub data2',
		subData3: 'sub data3'
	}
};
(function($) {
	console.log(json);
})(jQuery);
</script>
</html>