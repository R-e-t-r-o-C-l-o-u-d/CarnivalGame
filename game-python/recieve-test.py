import serial
ser = serial.Serial("COM5", 9600)
print(ser.name)

while True:
    data = ser.readline().decode('utf-8').strip()
    if data != "-1":
        print(data)
    else:
        print("No data")