var SerialPort = require("serialport").SerialPort
var serialPort = new SerialPort({
  path: 'COM3',
  baudRate:9600,
});



serialPort.on("open", function () {
  console.log('Communication is on!');

  // when your app receives data, this event is fired
  // so you can capture the data and do what you need
  serialPort.on('data', function(data) {
    console.log('data received: ' + data);
  });
});