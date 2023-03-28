import threading

import serial
import msvcrt

ser = serial.Serial("COM3", 9600)
print(ser.name)


def sendToArduino():
    while True:
        sendData = input()
        ser.write(sendData.encode())


def recieveFromArduino():
    while True:
        data = ser.readline().decode('utf-8').strip()
        print(data)


threading.Thread(target=sendToArduino).start()
threading.Thread(target=recieveFromArduino).start()
